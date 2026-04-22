@extends('admin.layouts.app')

@section('title', 'Quản lý Ticket')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Ticket Support</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                    <li class="breadcrumb-item active">Tickets</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="d-lg-flex">
                    <!-- Left Sidebar - Users List -->
                    <div class="chat-leftsidebar card">
                        <div class="p-3 px-4 border-bottom">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3 align-self-center">
                                    <div class="avatar-sm">
                                        <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                            <i class="bx bx-support"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-16 mb-1">
                                        <span class="text-dark">Support Center</span>
                                        <i class="mdi mdi-circle text-success align-middle font-size-10 ms-1"></i>
                                    </h5>
                                    <p class="text-muted mb-0">{{ $stats['total'] }} Total Tickets</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="dropdown chat-noti-dropdown">
                                        <button class="btn dropdown-toggle p-0" type="button" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.ticket-subjects.index') }}">Manage Categories</a>
                                            <a class="dropdown-item" href="#" onclick="refreshTickets()">Refresh</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#statsModal">Statistics</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3">
                            <div class="search-box position-relative">
                                <input type="text" class="form-control rounded border"
                                    placeholder="Search users or tickets..." id="searchInput">
                                <i class="bx bx-search search-icon"></i>
                            </div>
                        </div>

                        <div class="chat-leftsidebar-nav">
                            <ul class="nav nav-pills nav-justified bg-light-subtle p-1" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#all-tickets" data-bs-toggle="tab" class="nav-link active" data-status="">
                                        <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">All</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#open-tickets" data-bs-toggle="tab" class="nav-link" data-status="open">
                                        <i class="bx bx-time font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Open</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#answered-tickets" data-bs-toggle="tab" class="nav-link"
                                        data-status="answered">
                                        <i class="bx bx-message-dots font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Answered</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="all-tickets" role="tabpanel">
                                    <div class="chat-message-list" data-simplebar style="max-height: 600px;">
                                        <div class="pt-3">
                                            <div class="px-3">
                                                <h5 class="font-size-14 mb-3">Recent Tickets</h5>
                                            </div>
                                            <ul class="list-unstyled chat-list" id="ticketsList">
                                                @forelse($tickets as $ticket)
                                                    <li class="ticket-item" data-ticket-id="{{ $ticket->id }}">
                                                        <a href="#" onclick="loadTicket({{ $ticket->id }})">
                                                            <div class="d-flex align-items-start">
                                                                <div
                                                                    class="flex-shrink-0 user-img {{ $ticket->status == 'open' ? 'online' : ($ticket->status == 'answered' ? 'away' : '') }} align-self-center me-3">
                                                                    @if ($ticket->user->avatar)
                                                                        <img src="{{ asset($ticket->user->avatar) }}"
                                                                            class="rounded-circle avatar-sm" alt="">
                                                                    @else
                                                                        <div class="avatar-sm align-self-center">
                                                                            <span
                                                                                class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                                                {{ strtoupper(substr($ticket->user->name, 0, 1)) }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                    <span class="user-status"></span>
                                                                </div>

                                                                <div class="flex-grow-1 overflow-hidden">
                                                                    <h5 class="text-truncate font-size-14 mb-1">
                                                                        {{ $ticket->user->name }}</h5>
                                                                    <p class="text-truncate mb-0">
                                                                        {{ Str::limit($ticket->subject, 30) }}</p>
                                                                    <small
                                                                        class="text-muted">{{ $ticket->ticketSubject->category }}</small>
                                                                </div>

                                                                <div class="flex-shrink-0">
                                                                    <div class="font-size-11">
                                                                        {{ $ticket->created_at->diffForHumans() }}</div>
                                                                    @if ($ticket->unread_replies_count > 0)
                                                                        <div class="unread-message mt-1">
                                                                            <span
                                                                                class="badge bg-danger rounded-pill">{{ $ticket->unread_replies_count }}</span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li class="text-center py-4">
                                                        <i
                                                            class="bx bx-message-square-dots font-size-24 text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">No tickets found</p>
                                                    </li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Chat Area -->
                    <div class="w-100 user-chat">
                        <div class="card">
                            <div class="p-4 border-bottom" id="ticketHeader">
                                <div class="row">
                                    <div class="col-md-4 col-9">
                                        <h5 class="font-size-15 mb-1" id="ticketUserName">Chưa chọn ticket</h5>
                                        <p class="text-muted mb-0" id="ticketSubject">Vui lòng chọn một ticket từ danh
                                            sách bên trái</p>
                                    </div>
                                    <div class="col-md-8 col-3">
                                        <ul class="list-inline user-chat-nav text-end mb-0">
                                            <li class="list-inline-item">
                                                <div class="dropdown">
                                                    <button class="btn nav-btn dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-cog"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#"
                                                            onclick="changeStatus('open')">Mark as Open</a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="changeStatus('answered')">Mark as Answered</a>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="changeStatus('closed')">Close Ticket</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#"
                                                            onclick="deleteTicket()">Delete Ticket</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="chat-conversation p-3 px-2" data-simplebar style="height: 500px;">
                                <div class="ticket-messages" id="messagesList">
                                    <div class="text-center py-5">
                                        <i class="bx bx-message-square-dots font-size-48 text-muted mb-3"></i>
                                        <h5 class="text-muted">Chọn một ticket để xem cuộc trò chuyện</h5>
                                        <p class="text-muted mb-0">Hãy chọn một ticket từ danh sách bên trái để bắt đầu xem
                                            tin nhắn</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 border-top" id="replySection" style="display: none;">
                                <form id="replyForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="currentTicketId" name="ticket_id">
                                    <div class="row g-2 align-items-end">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="text" class="form-control border bg-light-subtle pe-5"
                                                    placeholder="Nhập tin nhắn..." id="messageInput" name="message"
                                                    required style="padding-right: 45px;">
                                                <div class="chat-input-links position-absolute" 
                                                     style="right: 10px; top: 50%; transform: translateY(-50%); z-index: 10;">
                                                    <a href="#" class="text-muted d-inline-flex align-items-center justify-content-center"
                                                       onclick="document.getElementById('attachmentInput').click()"
                                                       title="Đính kèm file"
                                                       style="width: 30px; height: 30px; border-radius: 50%; transition: all 0.2s;">
                                                        <i class="bx bx-paperclip font-size-16"></i>
                                                    </a>
                                                    <input type="file" id="attachmentInput"
                                                           name="attachments[]" multiple style="display: none;"
                                                           accept=".jpg,.jpeg,.png,.gif,.pdf,.txt,.csv,.doc,.docx">
                                                </div>
                                            </div>
                                            <!-- File preview area -->
                                            <div id="filePreview" class="mt-2" style="display: none;">
                                                <div class="d-flex flex-wrap gap-2" id="fileList"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" id="sendButton"
                                                class="btn btn-primary chat-send waves-effect waves-light d-flex align-items-center"
                                                style="min-width: 80px; height: 38px;">
                                                <span class="send-text d-none d-sm-inline-block me-2">Gửi</span>
                                                <i class="mdi mdi-send send-icon"></i>
                                                <div class="spinner-border spinner-border-sm loading-spinner me-2" 
                                                     role="status" style="display: none;">
                                                    <span class="visually-hidden">Đang gửi...</span>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Modal -->
    <div class="modal fade" id="statsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ticket Statistics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-center">
                                <div class="avatar-sm mx-auto mb-2">
                                    <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                        <i class="bx bx-ticket"></i>
                                    </span>
                                </div>
                                <h4>{{ $stats['total'] }}</h4>
                                <p class="text-muted mb-0">Total</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="avatar-sm mx-auto mb-2">
                                    <span class="avatar-title rounded-circle bg-warning-subtle text-warning">
                                        <i class="bx bx-time"></i>
                                    </span>
                                </div>
                                <h4>{{ $stats['open'] }}</h4>
                                <p class="text-muted mb-0">Open</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="avatar-sm mx-auto mb-2">
                                    <span class="avatar-title rounded-circle bg-info-subtle text-info">
                                        <i class="bx bx-message-dots"></i>
                                    </span>
                                </div>
                                <h4>{{ $stats['answered'] }}</h4>
                                <p class="text-muted mb-0">Answered</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="avatar-sm mx-auto mb-2">
                                    <span class="avatar-title rounded-circle bg-success-subtle text-success">
                                        <i class="bx bx-check"></i>
                                    </span>
                                </div>
                                <h4>{{ $stats['closed'] }}</h4>
                                <p class="text-muted mb-0">Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentTicketId = null;

        // Custom CSS cho chat input
        const customStyles = `
            <style>
                .chat-input-links a:hover {
                    background-color: #f8f9fa !important;
                    color: #495057 !important;
                }
                
                .file-preview-item {
                    border: 1px solid #e9ecef;
                    transition: all 0.2s ease;
                }
                
                .file-preview-item:hover {
                    border-color: #007bff;
                    box-shadow: 0 2px 4px rgba(0,123,255,0.1);
                }
                
                .btn.chat-send:disabled {
                    background-color: #007bff !important;
                    border-color: #007bff !important;
                    opacity: 0.8;
                }
                
                .loading-spinner {
                    width: 1rem !important;
                    height: 1rem !important;
                }
                
                #messageInput:focus {
                    border-color: #007bff;
                    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
                }
                
                .chat-input-links a {
                    transition: all 0.2s ease;
                }
            </style>
        `;
        
        // Inject custom styles
        document.head.insertAdjacentHTML('beforeend', customStyles);

        // Load ticket details and messages
        function loadTicket(ticketId) {
            currentTicketId = ticketId;
            document.getElementById('currentTicketId').value = ticketId;

            // Update active state
            document.querySelectorAll('.ticket-item').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelector(`[data-ticket-id="${ticketId}"]`).classList.add('active');

            // Show loading state
            const messagesList = document.getElementById('messagesList');
            messagesList.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <p class="mt-2 text-muted">Đang tải tin nhắn...</p>
        </div>
    `;

            // Load ticket details
            fetch(`/admin/ticket/${ticketId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTicketHeader(data.ticket);
                        updateMessages(data.ticket.replies);
                        document.getElementById('replySection').style.display = 'block';

                        // Set lastMessageId để tracking tin nhắn mới
                        if (data.ticket.replies && data.ticket.replies.length > 0) {
                            lastMessageId = data.ticket.replies[data.ticket.replies.length - 1].id;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    messagesList.innerHTML = `
                <div class="text-center py-4">
                    <i class="bx bx-error font-size-24 text-danger mb-2"></i>
                    <p class="mb-0 text-danger">Lỗi khi tải tin nhắn</p>
                </div>
            `;
                });
        }

        // Update ticket header
        function updateTicketHeader(ticket) {
            document.getElementById('ticketUserName').textContent = ticket.user.name;
            document.getElementById('ticketSubject').innerHTML = `
        <span class="badge bg-${getStatusColor(ticket.status)}-subtle text-${getStatusColor(ticket.status)} me-2">${ticket.status}</span>
        ${ticket.subject}
    `;
        }

        // Update messages list
        function updateMessages(replies) {
            const messagesList = document.getElementById('messagesList');
            messagesList.innerHTML = '';

            // Add day title
            const dayTitle = `
        <li class="chat-day-title">
            <span class="title">Hôm nay</span>
        </li>
    `;
            messagesList.insertAdjacentHTML('beforeend', dayTitle);

            replies.forEach((reply, index) => {
                const isLatest = index === replies.length - 1; // Tin nhắn cuối cùng (gần nhất)
                const isAdmin = reply.is_admin;
                const messageHtml = `
            <li${isAdmin ? ' class="right"' : ''} ${isLatest ? 'id="latestMessage"' : ''} data-message-id="${reply.id}">
                <div class="conversation-list">
                    <div class="ctext-wrap ${isLatest ? 'latest-message' : ''} ${isAdmin ? 'wide-message' : ''}">
                        <div class="ctext-wrap-content">
                            <h5 class="conversation-name">
                                <a href="#" class="user-name">${isAdmin ? 'Admin' : reply.user.name}</a> 
                                <span class="time">${formatTime(reply.created_at)}</span>
                            </h5>
                            <p class="mb-0 message-text">${reply.message}</p>
                            ${reply.attachments && reply.attachments.length > 0 ? `
                                    <ul class="list-inline message-img mt-3 mb-0">
                                        ${reply.attachments.map(attachment => `
                                        <li class="list-inline-item message-img-list">
                                            <a class="d-inline-block m-1" href="/storage/${attachment.file_path}" target="_blank">
                                                ${attachment.mime_type && attachment.mime_type.startsWith('image/') ? 
                                                    `<img src="/storage/${attachment.file_path}" alt="${attachment.original_name}" class="rounded img-thumbnail" style="max-width: 150px;">` :
                                                    `<div class="file-attachment p-2 border rounded">
                                                            <i class="bx bx-file me-2"></i>${attachment.original_name}
                                                        </div>`
                                                }
                                            </a>
                                        </li>
                                    `).join('')}
                                    </ul>
                                ` : ''}
                        </div>
                        <div class="dropdown align-self-start">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="copyMessage('${reply.message.replace(/'/g, "\\'")}')">Sao chép</a>
                                <a class="dropdown-item" href="#" onclick="deleteReply(${reply.id})">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;
                messagesList.insertAdjacentHTML('beforeend', messageHtml);
            });

            // Scroll để hiển thị tin nhắn gần nhất ra màn hình một cách hợp lý
            scrollToLatestMessage();
        }

        // Function để scroll hiển thị tin nhắn gần nhất ra màn hình
        function scrollToLatestMessage() {
            setTimeout(() => {
                const latestMessage = document.getElementById('latestMessage');
                const chatContainer = document.querySelector('.chat-conversation');

                if (latestMessage && chatContainer) {
                    // Scroll để tin nhắn gần nhất hiển thị ở vị trí dễ nhìn (không bị che)
                    latestMessage.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center', // Hiển thị ở giữa màn hình
                        inline: 'nearest'
                    });

                    // Fallback: nếu scrollIntoView không hoạt động
                    setTimeout(() => {
                        const messageRect = latestMessage.getBoundingClientRect();
                        const containerRect = chatContainer.getBoundingClientRect();

                        // Nếu tin nhắn không hiển thị đầy đủ, scroll để hiển thị
                        if (messageRect.bottom > containerRect.bottom || messageRect.top < containerRect
                            .top) {
                            const scrollTop = latestMessage.offsetTop - chatContainer.offsetTop - (
                                chatContainer.clientHeight / 2) + (latestMessage.clientHeight / 2);
                            chatContainer.scrollTop = Math.max(0, scrollTop);
                        }
                    }, 300);
                }
            }, 200);
        }

        // Send reply - Realtime không cần reload
        document.getElementById('replyForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!currentTicketId) return;

            const formData = new FormData(this);
            const messageInput = document.getElementById('messageInput');
            const sendButton = document.getElementById('sendButton');
            const sendText = sendButton.querySelector('.send-text');
            const sendIcon = sendButton.querySelector('.send-icon');
            const loadingSpinner = sendButton.querySelector('.loading-spinner');
            const originalMessage = messageInput.value;

            // Disable form để tránh spam
            messageInput.disabled = true;
            sendButton.disabled = true;
            
            // Show loading state
            sendText.style.display = 'none';
            sendIcon.style.display = 'none';
            loadingSpinner.style.display = 'inline-block';

            fetch(`/admin/ticket/${currentTicketId}/reply`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Clear form
                        messageInput.value = '';
                        document.getElementById('attachmentInput').value = '';
                        clearFilePreview();

                        // Thêm tin nhắn mới vào chat realtime (không reload)
                        addNewMessageToChat({
                            id: data.reply ? data.reply.id : Date.now(),
                            message: originalMessage,
                            is_admin: true,
                            created_at: new Date().toISOString(),
                            user: {
                                name: 'Admin'
                            },
                            attachments: data.reply ? data.reply.attachments || [] : []
                        });

                        // Update lastMessageId để tránh duplicate khi polling
                        if (data.reply && data.reply.id) {
                            lastMessageId = data.reply.id;
                        }

                        // Update ticket status nếu cần
                        updateTicketStatus('answered');

                    } else {
                        alert('Lỗi khi gửi tin nhắn: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Lỗi khi gửi tin nhắn');
                })
                .finally(() => {
                    // Re-enable form và restore button state
                    messageInput.disabled = false;
                    sendButton.disabled = false;
                    
                    // Restore button appearance
                    loadingSpinner.style.display = 'none';
                    sendText.style.display = 'inline-block';
                    sendIcon.style.display = 'inline-block';
                    
                    messageInput.focus();
                });
        });

        // Change ticket status
        function changeStatus(status) {
            if (!currentTicketId) return;

            fetch(`/admin/ticket/${currentTicketId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadTicket(currentTicketId); // Reload ticket
                        location.reload(); // Refresh page to update sidebar
                    }
                });
        }

        // Delete ticket
        function deleteTicket() {
            if (!currentTicketId || !confirm('Are you sure you want to delete this ticket?')) return;

            fetch(`/admin/ticket/${currentTicketId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        // Helper functions
        function getStatusColor(status) {
            const colors = {
                'open': 'warning',
                'answered': 'info',
                'closed': 'success'
            };
            return colors[status] || 'secondary';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString();
        }

        function formatTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            });
        }

        function copyMessage(message) {
            navigator.clipboard.writeText(message).then(() => {
                // Show toast notification
                showToast('Đã sao chép tin nhắn', 'success');
            });
        }

        function replyToMessage(userName) {
            const messageInput = document.getElementById('messageInput');
            if (messageInput) {
                messageInput.value = `@${userName} `;
                messageInput.focus();
            }
        }

        function showToast(message, type = 'info') {
            // Simple toast notification
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 250px;';
            toast.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bx ${type === 'success' ? 'bx-check' : 'bx-info-circle'} me-2"></i>
            ${message}
        </div>
    `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }

        function deleteReply(replyId) {
            if (!confirm('Are you sure you want to delete this reply?')) return;

            fetch(`/admin/ticket/reply/${replyId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadTicket(currentTicketId); // Reload messages
                    }
                });
        }

        function refreshTickets() {
            location.reload();
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const tickets = document.querySelectorAll('.ticket-item');

            tickets.forEach(ticket => {
                const text = ticket.textContent.toLowerCase();
                ticket.style.display = text.includes(searchTerm) ? 'block' : 'none';
            });
        });

        // Tab filtering
        document.querySelectorAll('[data-status]').forEach(tab => {
            tab.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                filterTicketsByStatus(status);
            });
        });

        function filterTicketsByStatus(status) {
            const tickets = document.querySelectorAll('.ticket-item');

            tickets.forEach(ticket => {
                if (!status) {
                    ticket.style.display = 'block';
                } else {
                    // This would need to be implemented with proper data attributes
                    // For now, just show all
                    ticket.style.display = 'block';
                }
            });
        }

        // Load first ticket on page load - REMOVED
        // Không tự động load ticket đầu tiên nữa
        document.addEventListener('DOMContentLoaded', function() {
            // Chỉ khởi tạo các event listener, không load ticket nào
            console.log('Admin ticket page loaded - waiting for user selection');

            // Khởi tạo realtime polling cho tin nhắn mới
            initRealtimePolling();

            // Khởi tạo file input handler
            initFileInputHandler();

            // Khởi tạo attachment button hover effect
            initAttachmentButtonEffect();
        });

        // File input handler
        function initFileInputHandler() {
            const fileInput = document.getElementById('attachmentInput');
            const messageInput = document.getElementById('messageInput');
            
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    showFilePreview(this.files);
                });
            }
            
            // Keyboard shortcut - Enter to send
            if (messageInput) {
                messageInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        const form = document.getElementById('replyForm');
                        if (form && this.value.trim()) {
                            form.dispatchEvent(new Event('submit'));
                        }
                    }
                });
            }
        }

        // Attachment button hover effect
        function initAttachmentButtonEffect() {
            const attachBtn = document.querySelector('.chat-input-links a');
            if (attachBtn) {
                attachBtn.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f9fa';
                    this.style.color = '#495057';
                });
                
                attachBtn.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'transparent';
                    this.style.color = '#6c757d';
                });
            }
        }

        // Show file preview
        function showFilePreview(files) {
            const filePreview = document.getElementById('filePreview');
            const fileList = document.getElementById('fileList');
            
            if (files.length === 0) {
                filePreview.style.display = 'none';
                return;
            }

            fileList.innerHTML = '';
            
            Array.from(files).forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-preview-item d-flex align-items-center bg-light rounded p-2';
                fileItem.style.maxWidth = '200px';
                
                const fileIcon = getFileIcon(file.type);
                const fileName = file.name.length > 20 ? file.name.substring(0, 17) + '...' : file.name;
                const fileSize = formatFileSize(file.size);
                
                fileItem.innerHTML = `
                    <i class="${fileIcon} me-2 text-primary"></i>
                    <div class="flex-grow-1 text-truncate">
                        <div class="small fw-medium">${fileName}</div>
                        <div class="text-muted" style="font-size: 0.75rem;">${fileSize}</div>
                    </div>
                    <button type="button" class="btn-close btn-sm ms-2" onclick="removeFile(${index})"></button>
                `;
                
                fileList.appendChild(fileItem);
            });
            
            filePreview.style.display = 'block';
        }

        // Clear file preview
        function clearFilePreview() {
            const filePreview = document.getElementById('filePreview');
            const fileList = document.getElementById('fileList');
            filePreview.style.display = 'none';
            fileList.innerHTML = '';
        }

        // Remove file from preview
        function removeFile(index) {
            const fileInput = document.getElementById('attachmentInput');
            const dt = new DataTransfer();
            
            Array.from(fileInput.files).forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });
            
            fileInput.files = dt.files;
            showFilePreview(fileInput.files);
        }

        // Get file icon based on file type
        function getFileIcon(mimeType) {
            if (mimeType.startsWith('image/')) return 'bx bx-image';
            if (mimeType.includes('pdf')) return 'bx bx-file-pdf';
            if (mimeType.includes('word') || mimeType.includes('document')) return 'bx bx-file-doc';
            if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'bx bx-spreadsheet';
            if (mimeType.includes('text')) return 'bx bx-file-txt';
            return 'bx bx-file';
        }

        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Function để thêm tin nhắn mới vào chat realtime
        function addNewMessageToChat(reply) {
            const messagesList = document.getElementById('messagesList');

            // Kiểm tra xem tin nhắn đã tồn tại chưa (tránh duplicate)
            const existingMessage = messagesList.querySelector(`[data-message-id="${reply.id}"]`);
            if (existingMessage) {
                console.log('Message already exists, skipping...');
                return;
            }

            // Remove highlight từ tin nhắn cũ
            const oldLatest = document.getElementById('latestMessage');
            if (oldLatest) {
                oldLatest.id = '';
                const oldWrap = oldLatest.querySelector('.ctext-wrap');
                if (oldWrap) oldWrap.classList.remove('latest-message');
            }

            // Tạo tin nhắn mới - chỉ admin reply có wide-message
            const isAdmin = reply.is_admin;
            const messageHtml = `
        <li${isAdmin ? ' class="right"' : ''} id="latestMessage" data-message-id="${reply.id}">
            <div class="conversation-list">
                <div class="ctext-wrap latest-message ${isAdmin ? 'wide-message' : ''}">
                    <div class="ctext-wrap-content">
                        <h5 class="conversation-name">
                            <a href="#" class="user-name">${isAdmin ? 'Admin' : reply.user.name}</a> 
                            <span class="time">${formatTime(reply.created_at)}</span>
                        </h5>
                        <p class="mb-0 message-text">${reply.message}</p>
                        ${reply.attachments && reply.attachments.length > 0 ? `
                                <ul class="list-inline message-img mt-3 mb-0">
                                    ${reply.attachments.map(attachment => `
                                    <li class="list-inline-item message-img-list">
                                        <a class="d-inline-block m-1" href="/storage/${attachment.file_path}" target="_blank">
                                            ${attachment.mime_type && attachment.mime_type.startsWith('image/') ? 
                                                `<img src="/storage/${attachment.file_path}" alt="${attachment.original_name}" class="rounded img-thumbnail" style="max-width: 150px;">` :
                                                `<div class="file-attachment p-2 border rounded">
                                                        <i class="bx bx-file me-2"></i>${attachment.original_name}
                                                    </div>`
                                            }
                                        </a>
                                    </li>
                                `).join('')}
                                </ul>
                            ` : ''}
                    </div>
                    <div class="dropdown align-self-start">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="copyMessage('${reply.message.replace(/'/g, "\\'")}')">Sao chép</a>
                            <a class="dropdown-item" href="#" onclick="deleteReply(${reply.id})">Xóa</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    `;

            // Thêm tin nhắn mới vào cuối
            messagesList.insertAdjacentHTML('beforeend', messageHtml);

            // Scroll tới tin nhắn mới
            scrollToLatestMessage();

            // Hiệu ứng âm thanh (tùy chọn)
            playNotificationSound();
        }

        // Function để update ticket status
        function updateTicketStatus(status) {
            const ticketSubject = document.getElementById('ticketSubject');
            if (ticketSubject) {
                const badge = ticketSubject.querySelector('.badge');
                if (badge) {
                    badge.className = `badge bg-${getStatusColor(status)}-subtle text-${getStatusColor(status)} me-2`;
                    badge.textContent = status;
                }
            }
        }

        // Function để play notification sound
        function playNotificationSound() {
            try {
                // Tạo âm thanh notification đơn giản
                const audioContext = new(window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.value = 800;
                oscillator.type = 'sine';

                gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.3);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.3);
            } catch (error) {
                // Ignore audio errors
                console.log('Audio notification not supported');
            }
        }

        // Realtime polling để check tin nhắn mới từ user
        let pollingInterval = null;
        let lastMessageId = null;

        function initRealtimePolling() {
            // Polling mỗi 3 giây để check tin nhắn mới
            pollingInterval = setInterval(() => {
                if (currentTicketId) {
                    checkForNewMessages();
                }
            }, 3000);
        }

        function checkForNewMessages() {
            if (!currentTicketId) return;

            fetch(`/admin/ticket/${currentTicketId}/new-messages?last_id=${lastMessageId || 0}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.new_messages && data.new_messages.length > 0) {
                        data.new_messages.forEach(message => {
                            addNewMessageToChat(message);
                            lastMessageId = message.id;
                        });

                        // Update unread count trong sidebar
                        updateUnreadCount(currentTicketId, 0);
                    }
                })
                .catch(error => {
                    console.error('Error checking new messages:', error);
                });
        }

        function updateUnreadCount(ticketId, count) {
            const ticketItem = document.querySelector(`[data-ticket-id="${ticketId}"]`);
            if (ticketItem) {
                const unreadBadge = ticketItem.querySelector('.unread-message .badge');
                if (count > 0) {
                    if (unreadBadge) {
                        unreadBadge.textContent = count;
                    } else {
                        const unreadDiv = ticketItem.querySelector('.unread-message') || document.createElement('div');
                        unreadDiv.className = 'unread-message mt-1';
                        unreadDiv.innerHTML = `<span class="badge bg-danger rounded-pill">${count}</span>`;
                        ticketItem.querySelector('.flex-shrink-0').appendChild(unreadDiv);
                    }
                } else {
                    if (unreadBadge) {
                        unreadBadge.parentElement.remove();
                    }
                }
            }
        }
    </script>
@endsection
