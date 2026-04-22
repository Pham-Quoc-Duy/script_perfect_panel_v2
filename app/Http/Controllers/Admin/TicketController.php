<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display order tickets list (grouped by service)
     */
    public function ticketList(): View
    {
        $ticketOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('services', 'orders.service_id', '=', 'services.id')
            ->whereNotNull('orders.ticket')
            ->where('orders.ticket', '!=', '')
            ->select(
                'orders.id',
                'orders.service_id',
                'orders.ticket',
                'orders.ticket_status',
                'orders.status',
                'orders.created_at',
                'orders.updated_at',
                'orders.note',
                'users.username',
                'services.name as service_name',
                'services.provider_name',
                'services.provider_id'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->map(function ($order) {
                if ($order->service_name) {
                    $decoded = json_decode($order->service_name, true);
                    if (is_array($decoded)) {
                        $order->service_name = $decoded['en'] ?? $decoded[array_key_first($decoded)] ?? $order->service_name;
                    }
                }
                $order->ticket_status = $order->ticket_status ?? null;
                return $order;
            })
            ->groupBy('provider_id');

        $baseQuery = DB::table('orders')->whereNotNull('ticket')->where('ticket', '!=', '');
        $stats = [
            'waiting'    => (clone $baseQuery)->whereNull('ticket_status')->count(),
            'processing' => (clone $baseQuery)->where('ticket_status', 'processing')->count(),
        ];

        return view('adminpanel.ticket.index', compact('ticketOrders', 'stats'));
    }

    /**
     * Update ticket_status for order tickets
     * type: 0 = by provider_id, 1 = by service_id, 2 = by order_id
     */
    public function updateTicketStatus(Request $request)
    {
        $request->validate([
            'type'   => 'required|in:0,1,2',
            'id'     => 'required|integer',
            'status' => 'required|in:processing,completed',
        ]);

        $query = DB::table('orders')->whereNotNull('ticket')->where('ticket', '!=', '');

        switch ((int) $request->type) {
            case 0:
                $query->where('provider_id', $request->id);
                break;
            case 1:
                $query->where('service_id', $request->id);
                break;
            case 2:
                $query->where('id', $request->id);
                break;
        }

        $query->update(['ticket_status' => $request->status]);

        return response()->json(['success' => true]);
    }

    /**
     * Display tickets list for admin
     */
    public function index(): View
    {
        $query = Ticket::with(['user', 'ticketSubject', 'replies'])
            ->where('domain', getDomain())
            ->withCount(['replies as replies_count'])
            ->withCount(['replies as unread_replies_count' => function ($query) {
                $query->whereNull('read_at')->where('is_admin', false);
            }]);

        // Filter by status
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Filter by priority
        if (request('priority')) {
            $query->where('priority', request('priority'));
        }

        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $tickets = $query->orderBy('last_reply_at', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        // Statistics
        $stats = [
            'total' => Ticket::count(),
            'open' => Ticket::where('status', 'open')->count(),
            'answered' => Ticket::where('status', 'answered')->count(),
            'closed' => Ticket::where('status', 'closed')->count(),
        ];

        return view('adminpanel.messages.index', compact('tickets', 'stats'));
    }

    /**
     * Display tickets list, pre-selecting a specific username
     */
    public function indexByUsername(string $username): View
    {
        // Verify user exists
        User::where('username', $username)->firstOrFail();

        $query = Ticket::with(['user', 'ticketSubject', 'replies'])
            ->withCount(['replies as replies_count'])
            ->withCount(['replies as unread_replies_count' => function ($query) {
                $query->whereNull('read_at')->where('is_admin', false);
            }]);

        $tickets = $query->orderBy('last_reply_at', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->paginate(15);

        $stats = [
            'total' => Ticket::count(),
            'open' => Ticket::where('status', 'open')->count(),
            'answered' => Ticket::where('status', 'answered')->count(),
            'closed' => Ticket::where('status', 'closed')->count(),
        ];

        $activeUsername = $username;

        return view('adminpanel.messages.index', compact('tickets', 'stats', 'activeUsername'));
    }

    /**
     * Show ticket by username (latest ticket of that user)
     */
    public function showByUsername(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $ticket = Ticket::with(['user', 'ticketSubject', 'replies.user'])
            ->where('user_id', $user->id)
            ->orderBy('last_reply_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->firstOrFail();

        // Mark user replies as read
        $ticket->replies()
               ->where('is_admin', false)
               ->whereNull('read_at')
               ->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'ticket' => [
                'id' => $ticket->id,
                'subject' => $ticket->subject,
                'message' => $ticket->message,
                'status' => $ticket->status,
                'priority' => $ticket->priority,
                'created_at' => $ticket->created_at,
                'custom_fields' => $ticket->custom_fields,
                'ticketSubject' => $ticket->ticketSubject ? [
                    'category' => $ticket->ticketSubject->category,
                    'subcategory' => $ticket->ticketSubject->subcategory,
                ] : null,
                'user' => $ticket->user ? [
                    'id' => $ticket->user->id,
                    'username' => $ticket->user->username,
                ] : null,
                'replies' => $ticket->replies->map(function ($reply) {
                    return [
                        'id' => $reply->id,
                        'message' => $reply->message,
                        'is_admin' => $reply->is_admin,
                        'created_at' => $reply->created_at,
                        'user' => $reply->user ? [
                            'id' => $reply->user->id,
                            'username' => $reply->user->username,
                        ] : null,
                        'attachments' => $reply->attachments ?? [],
                    ];
                }),
            ],
        ]);
    }

    /**
     * Get new messages by username
     */
    public function getNewMessagesByUsername(Request $request, string $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $ticket = Ticket::where('user_id', $user->id)
            ->orderBy('last_reply_at', 'desc')
            ->firstOrFail();

        return $this->getNewMessages($request, $ticket);
    }

    /**
     * Reply by username
     */
    public function replyByUsername(Request $request, string $username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $ticket = Ticket::where('user_id', $user->id)
            ->orderBy('last_reply_at', 'desc')
            ->firstOrFail();

        return $this->reply($request, $ticket);
    }

    /**
     * Display ticket details for admin (AJAX)
     */
    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'ticketSubject', 'replies.user']);
        
        // Mark admin replies as read
        $ticket->replies()
               ->where('is_admin', false)
               ->whereNull('read_at')
               ->update(['read_at' => now()]);

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'ticket' => [
                    'id' => $ticket->id,
                    'subject' => $ticket->subject,
                    'status' => $ticket->status,
                    'priority' => $ticket->priority,
                    'created_at' => $ticket->created_at,
                    'custom_fields' => $ticket->custom_fields,
                    'user' => $ticket->user ? [
                        'id' => $ticket->user->id,
                        'username' => $ticket->user->username,
                        'email' => $ticket->user->email,
                        'avatar' => $ticket->user->avatar ?? null
                    ] : null,
                    'ticketSubject' => $ticket->ticketSubject ? [
                        'category' => $ticket->ticketSubject->category,
                        'subcategory' => $ticket->ticketSubject->subcategory
                    ] : null,
                    'replies' => $ticket->replies->map(function($reply, $index) use ($ticket) {
                        $replyData = [
                            'id' => $reply->id,
                            'message' => $reply->message,
                            'is_admin' => $reply->is_admin,
                            'created_at' => $reply->created_at,
                            'user' => $reply->user ? [
                                'id' => $reply->user->id,
                                'username' => $reply->user->username,
                                'avatar' => $reply->user->avatar ?? null
                            ] : null,
                            'attachments' => $reply->attachments ?? []
                        ];
                        
                        // Add ticket info to first reply
                        if ($index === 0) {
                            $replyData['ticket_info'] = [
                                'subject' => $ticket->subject,
                                'category' => $ticket->ticketSubject ? $ticket->ticketSubject->category : null,
                                'subcategory' => $ticket->ticketSubject ? $ticket->ticketSubject->subcategory : null,
                                'custom_fields' => $ticket->custom_fields
                            ];
                        }
                        
                        return $replyData;
                    })
                ]
            ]);
        }

        return view('adminpanel.messages.show', compact('ticket'));
    }

    /**
     * Get new messages for realtime chat
     */
    public function getNewMessages(Request $request, Ticket $ticket)
    {
        $lastId = $request->get('last_id', 0);
        
        $newMessages = $ticket->replies()
            ->with('user')
            ->where('id', '>', $lastId)
            ->orderBy('created_at', 'asc')
            ->get();

        $formattedMessages = $newMessages->map(function($reply) {
            return [
                'id' => $reply->id,
                'message' => $reply->message,
                'is_admin' => $reply->is_admin,
                'created_at' => $reply->created_at,
                'user' => $reply->user ? [
                    'id' => $reply->user->id,
                    'username' => $reply->user->username,
                    'avatar' => $reply->user->avatar ?? null
                ] : null,
                'attachments' => $reply->attachments ?? []
            ];
        });

        return response()->json([
            'success' => true,
            'new_messages' => $formattedMessages
        ]);
    }

    /**
     * Reply to ticket as admin
     */
    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,pdf,txt,csv',
        ]);

        try {
            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('ticket-attachments', $fileName, 'public');
                    
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                    ];
                }
            }

            // Create reply and update ticket
            $reply = null;
            DB::transaction(function () use ($ticket, $request, $attachments, &$reply) {
                $reply = TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => Auth::id(),
                    'message' => $request->message,
                    'is_admin' => true,
                    'attachments' => $attachments,
                ]);

                $ticket->update([
                    'status' => 'answered',
                    'last_reply_at' => now(),
                    'assigned_to' => Auth::id(),
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Reply sent successfully.',
                'reply' => [
                    'id' => $reply->id,
                    'attachments' => $attachments
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error sending reply: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update ticket status
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:open,answered,closed'
        ]);

        $ticket->update([
            'status' => $request->status,
            'assigned_to' => $request->status !== 'open' ? Auth::id() : $ticket->assigned_to,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket status updated successfully.'
        ]);
    }

    /**
     * Assign ticket to admin
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'admin_id' => 'nullable|exists:users,id'
        ]);

        $ticket->update([
            'assigned_to' => $request->admin_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket assigned successfully.'
        ]);
    }

    /**
     * Delete ticket reply
     */
    public function deleteReply(TicketReply $reply)
    {
        // Check if user has permission to delete this reply
        if (!Auth::user()->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $reply->delete();

        return response()->json([
            'success' => true,
            'message' => 'Reply deleted successfully.'
        ]);
    }

    /**
     * Delete ticket
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket deleted successfully.'
        ]);
    }
}