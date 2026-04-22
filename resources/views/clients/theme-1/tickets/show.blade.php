@extends('clients.theme-default.layouts.app')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
<div class="app-content">
    <div class="page-head">
        <div class="container-fluid"></div>
        <div class="page-head-bg">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="100%" height="250" preserveAspectRatio="none" viewBox="0 0 1440 250"><g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none"><path d="M36 250L286 0L604 0L354 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M258.6 250L508.6 0L634.6 0L384.6 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M484.20000000000005 250L734.2 0L956.2 0L706.2 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M740.8000000000001 250L990.8000000000001 0L1311.8000000000002 0L1061.8000000000002 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M1428 250L1178 0L866 0L1116 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M1157.4 250L907.4000000000001 0L788.9000000000001 0L1038.9 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M961.8 250L711.8 0L572.3 0L822.3 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M691.1999999999999 250L441.19999999999993 0L214.69999999999993 0L464.69999999999993 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M1199.0621593075448 250L1440 9.062159307544675L1440 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M0 250L240.93784069245532 250L 0 9.062159307544675z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path></g><defs><mask id="SvgjsMask1003"><rect width="1440" height="250" fill="var(--tw)"></rect></mask><linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="SvgjsLinearGradient1004"><stop stop-color="var(--mc)" offset="0"></stop><stop stop-opacity="0" stop-color="var(--main-bg)" offset="0.66"></stop></linearGradient></defs></svg>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid container-dashboard">
        <div class="top-box">
            <div class="top-text">
                <h4>Ticket #{{ $ticket->id }}</h4>
                <p>{{ $ticket->subject }}</p>
            </div>
            <div class="d-flex gap-2">
                <a class="btn btn-secondary d-flex align-items-center" href="{{ route('client.tickets.index') }}">
                    <i class="fal fa-arrow-left me-2"></i><strong>Quay lại</strong>
                </a>
                @if($ticket->status != 'closed')
                <button class="btn btn-warning d-flex align-items-center" onclick="closeTicket()">
                    <i class="fal fa-times me-2"></i><strong>Đóng Ticket</strong>
                </button>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- Ticket Info Sidebar -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <i class="far fa-info-circle"></i>
                        <span>Thông tin Ticket</span>
                    </div>
                    <div class="card-body">
                        <!-- Status -->
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Trạng thái</h6>
                            @if($ticket->status == 'open')
                                <div class="oc-status pending"><span>Đang mở</span></div>
                            @elseif($ticket->status == 'answered')
                                <div class="oc-status completed"><span>Đã trả lời</span></div>
                            @else
                                <div class="oc-status canceled"><span>Đã đóng</span></div>
                            @endif
                        </div>

                        <!-- Priority -->
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Độ ưu tiên</h6>
                            @if($ticket->priority == 'high')
                                <span class="priority priority-high">Cao</span>
                            @elseif($ticket->priority == 'medium')
                                <span class="priority priority-medium">Trung bình</span>
                            @else
                                <span class="priority priority-low">Thấp</span>
                            @endif
                        </div>

                        <!-- Assigned To -->
                        @if($ticket->assignedTo)
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Được phân công cho</h6>
                            <div class="d-flex align-items-center">
                                <div class="avatar-xs me-2">
                                    <span class="avatar-title rounded-circle bg-success text-white">
                                        {{ substr($ticket->assignedTo->name, 0, 1) }}
                                    </span>
                                </div>
                                <span>{{ $ticket->assignedTo->name }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Dates -->
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Ngày tạo</h6>
                            <p class="mb-0">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        @if($ticket->last_reply_at)
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">Trả lời cuối</h6>
                            <p class="mb-0">{{ $ticket->last_reply_at->format('d/m/Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Chat Area -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="far fa-comments"></i>
                        <span>Cuộc trò chuyện</span>
                    </div>

                    <!-- Messages Area -->
                    <div class="card-body p-0">
                        <div class="chat-conversation" id="chatConversation" style="height: 500px; overflow-y: auto; padding: 20px;">
                            <!-- Initial Message -->
                            <div class="message-item user-message">
                                <div class="message-header">
                                    <div class="avatar-xs">
                                        <span class="avatar-title rounded-circle bg-primary text-white">
                                            {{ substr($ticket->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div class="message-info">
                                        <h6 class="mb-0">{{ $ticket->user->name }}</h6>
                                        <span class="text-muted">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="message-content">
                                    {!! nl2br(e($ticket->message)) !!}
                                </div>
                            </div>

                            <!-- Messages -->
                            <div id="messagesList">
                                @foreach($ticket->messages as $message)
                                <div class="message-item {{ $message->is_admin ? 'admin-message' : 'user-message' }}" data-message-id="{{ $message->id }}">
                                    <div class="message-header">
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle {{ $message->is_admin ? 'bg-success' : 'bg-primary' }} text-white">
                                                {{ substr($message->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="message-info">
                                            <h6 class="mb-0">{{ $message->user->name }}</h6>
                                            <span class="text-muted">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="message-content">
                                        {!! nl2br(e($message->message)) !!}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Reply Form -->
                        @if($ticket->status != 'closed')
                        <div class="p-3 border-top">
                            <form id="replyForm">
                                <div class="form-group mb-3">
                                    <textarea class="form-control" id="messageInput" rows="3" 
                                            placeholder="Nhập tin nhắn trả lời..." required></textarea>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" id="sendBtn">
                                        <i class="far fa-paper-plane"></i> Gửi tin nhắn
                                    </button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="p-3 border-top bg-light">
                            <div class="text-center text-muted">
                                <i class="far fa-lock"></i> Ticket này đã được đóng. Không thể gửi tin nhắn mới.
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications wrapper -->
    <div id="notify-wrapper" class="alert alert-success hidden" style="display: none;"></div>
</div>

<style>
.priority {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
    display: inline-block;
}
.priority-high {
    background-color: #dc3545;
    color: white;
}
.priority-medium {
    background-color: #ffc107;
    color: #212529;
}
.priority-low {
    background-color: #6c757d;
    color: white;
}

.message-item {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.user-message {
    background-color: #f8f9fa;
    margin-right: 20px;
}

.admin-message {
    background-color: #e3f2fd;
    margin-left: 20px;
}

.message-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.message-info {
    margin-left: 10px;
}

.message-content {
    margin-left: 42px;
    line-height: 1.5;
}

.avatar-xs {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-title {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}
</style>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
// Initialize Pusher for real-time updates (if configured)
@if(config('broadcasting.connections.pusher.key'))
const pusher = new Pusher('{{ config("broadcasting.connections.pusher.key") }}', {
    cluster: '{{ config("broadcasting.connections.pusher.options.cluster") }}',
    encrypted: true
});

const channel = pusher.subscribe('private-ticket.{{ $ticket->id }}');

channel.bind('App\\Events\\TicketMessageSent', function(data) {
    addMessageToChat(data, false);
    scrollToBottom();
});
@endif

// Send reply
document.getElementById('replyForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const message = messageInput.value.trim();
    
    if (!message) return;
    
    const originalText = sendBtn.innerHTML;
    sendBtn.disabled = true;
    sendBtn.innerHTML = '<i class="far fa-spinner fa-spin"></i> Đang gửi...';
    
    try {
        const response = await fetch('{{ route("client.tickets.reply", $ticket->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message })
        });
        
        const result = await response.json();
        
        if (result.success) {
            messageInput.value = '';
            addMessageToChat(result.message, true);
            scrollToBottom();
            showNotification('Tin nhắn đã được gửi thành công', 'success');
        } else {
            showNotification(result.message || 'Có lỗi xảy ra khi gửi tin nhắn', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Có lỗi xảy ra khi gửi tin nhắn', 'error');
    } finally {
        sendBtn.disabled = false;
        sendBtn.innerHTML = originalText;
    }
});

// Add message to chat
function addMessageToChat(messageData, isLocal = false) {
    const messagesList = document.getElementById('messagesList');
    const isAdmin = messageData.is_admin || false;
    
    const messageHtml = `
        <div class="message-item ${isAdmin ? 'admin-message' : 'user-message'}" data-message-id="${messageData.id}">
            <div class="message-header">
                <div class="avatar-xs">
                    <span class="avatar-title rounded-circle ${isAdmin ? 'bg-success' : 'bg-primary'} text-white">
                        ${messageData.user.name.charAt(0)}
                    </span>
                </div>
                <div class="message-info">
                    <h6 class="mb-0">${messageData.user.name}</h6>
                    <span class="text-muted">${messageData.created_at}</span>
                </div>
            </div>
            <div class="message-content">
                ${messageData.message.replace(/\n/g, '<br>')}
            </div>
        </div>
    `;
    
    messagesList.insertAdjacentHTML('beforeend', messageHtml);
}

// Scroll to bottom
function scrollToBottom() {
    const chatConversation = document.getElementById('chatConversation');
    chatConversation.scrollTop = chatConversation.scrollHeight;
}

// Close ticket
async function closeTicket() {
    if (!confirm('Bạn có chắc muốn đóng ticket này không?')) {
        return;
    }
    
    try {
        const response = await fetch('{{ route("client.tickets.close", $ticket->id) }}', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification(result.message, 'success');
            setTimeout(() => {
                if (result.redirect) {
                    window.location.href = result.redirect;
                } else {
                    window.location.reload();
                }
            }, 2000);
        } else {
            showNotification(result.message || 'Có lỗi xảy ra', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('Có lỗi xảy ra khi đóng ticket', 'error');
    }
}

// Show notification
function showNotification(message, type = 'info') {
    const notifyWrapper = document.getElementById('notify-wrapper');
    notifyWrapper.className = `alert alert-${type === 'success' ? 'success' : 'danger'}`;
    notifyWrapper.textContent = message;
    notifyWrapper.style.display = 'block';
    
    setTimeout(() => {
        notifyWrapper.style.display = 'none';
    }, 5000);
}

// Auto-scroll to bottom on page load
document.addEventListener('DOMContentLoaded', function() {
    scrollToBottom();
});

// Handle Enter key in textarea
document.getElementById('messageInput')?.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('replyForm').dispatchEvent(new Event('submit'));
    }
});
</script>
@e