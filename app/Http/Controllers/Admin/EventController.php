<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSpin;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()->where('domain', $request->getHost());

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->withCount('spins')->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:spin,box',
            'status' => 'boolean',
            'max_spins_per_day' => 'required|integer|min:1',
            'max_spins_total' => 'required|integer|min:0',
            'rewards' => 'required|json',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validated['domain'] = $request->getHost();
        $validated['rewards'] = json_decode($validated['rewards'], true);

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Tạo sự kiện thành công!');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:spin,box',
            'status' => 'boolean',
            'max_spins_per_day' => 'required|integer|min:1',
            'max_spins_total' => 'required|integer|min:0',
            'rewards' => 'required|json',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validated['rewards'] = json_decode($validated['rewards'], true);

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Cập nhật sự kiện thành công!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Xóa sự kiện thành công!');
    }

    public function toggleStatus(Request $request, Event $event)
    {
        $event->update(['status' => !$event->status]);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công!',
            'status' => $event->status
        ]);
    }

    public function history(Request $request)
    {
        $query = EventSpin::with(['event', 'user'])
            ->whereHas('event', function($q) use ($request) {
                $q->where('domain', $request->getHost());
            });

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $spins = $query->orderBy('created_at', 'desc')->paginate(20);
        $events = Event::where('domain', $request->getHost())->get();

        return view('admin.events.history', compact('spins', 'events'));
    }
}
