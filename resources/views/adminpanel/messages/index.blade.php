@extends('adminpanel.layouts.app')
@section('title', 'Messages')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="d-flex flex-column flex-lg-row">
            <div class="flex-column flex-lg-row-auto w-100 w-lg-400px w-xl-400px mb-10 mb-lg-0">
                <div class="card card-flush">
                    <div class="card-header pt-7">
                        <form class="w-100 position-relative" autocomplete="off">
                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <input type="text" id="search-ticket" class="form-control from-control-solid px-15"
                                placeholder="Tìm tài khoản" data-lang="Search by username">
                        </form>
                    </div>
                    <div class="card-body card-body ps-3 pt-5">
                        <div class="scroll-y me-n5 pe-5 h-300px h-lg-600px chat_user" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header"
                            data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body"
                            data-kt-scroll-offset="5px" style="max-height: 623px;">
                            <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10"
                                id="div_chat_users">
                                @php
                                    $userTickets = $tickets->getCollection()->unique(fn($t) => $t->user_id);
                                @endphp
                                @forelse($userTickets as $ticket)
                                @php $uname = $ticket->user ? $ticket->user->username : 'unknown'; @endphp
                                <div class="d-users">
                                    <div class="menu-item" onclick="_messages.loadUser('{{ $uname }}', this)">
                                        <span class="menu-link {{ (isset($activeUsername) && $activeUsername === $uname) ? 'active' : '' }}">
                                            <span class="menu-icon">
                                                <span class="svg-icon svg-icon-2 me-3">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z" fill="currentColor"></path>
                                                        <path opacity="0.3" d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                            </span>
                                            <span class="menu-title fw-bold {{ $ticket->unread_replies_count > 0 ? 'text-danger' : '' }}">
                                                {{ $uname }}
                                                @if($ticket->unread_replies_count > 0)
                                                    <span class="badge badge-danger ms-1" style="font-size:9px;padding:2px 5px">{{ $ticket->unread_replies_count }}</span>
                                                @endif
                                            </span>
                                            <span class="text-muted fs-7 me-1">
                                                {{ $ticket->last_reply_at ? $ticket->last_reply_at->diffForHumans() : $ticket->created_at->diffForHumans() }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted py-5">Chưa có ticket nào</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chat panel - giữ đúng cấu trúc t.html --}}
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <a href="#" id="chat-username" class="fs-3 fw-bold chat-user ls-2"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" id="kt_chat_messenger_body">
                        <script>var CUS_USER = '0';</script>
                        <div class="scroll-y me-n5 pe-5 h-300px h-lg-400px chat-mess" id="chat-messages"
                            data-kt-element="messages"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                            data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                            data-kt-scroll-offset="5px" style="max-height: 571px;"></div>
                    </div>

                    {{-- Footer ẩn mặc định như t.html, JS sẽ show khi chọn user --}}
                    <div class="card-footer pt-4 pb-0 d-none" id="kt_chat_messenger_footer">
                        <textarea id="txa-message" class="form-control form-control-flush bg-secondary fs-7 mb-3 chat-message"
                            data-kt-autosize="true" placeholder="Nhập nội dung tin nhắn"
                            data-kt-initialized="1" style="overflow-x: hidden; overflow-wrap: break-word;"></textarea>
                        <button id="btn-chat-send" class="btn btn-primary btn-sm float-end btn-send" type="button"
                            data-lang="Send" onclick="_messages.sendReply()">Gửi</button>
                    </div>
                    <div class="separator d-flex flex-center mb-8 mt-8">
                        <span class="text-uppercase bg-body fs-7 fw-semibold text-muted px-3" data-lang="Suggested replies">Các mẫu trả lời có sẵn</span>
                    </div>
                    <div class="px-5">
                        <p class="text-center"><a href="/admin/settings#support" class="text-hover-primary">* <span data-lang="Go to Setting">Thiết lập</span> *</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var _messages = (function () {
            var currentUsername = null;
            var lastReplyId = 0;
            var pollingTimer = null;
            var CSRF = '{{ csrf_token() }}';
            var INIT_USERNAME = '{{ $activeUsername ?? '' }}';

            function timeHtml(dateStr) {
                if (!dateStr) return '';
                var d = new Date(dateStr);
                return d.toLocaleDateString('vi-VN') + ' ' + d.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
            }

            // Hiển thị ticket header (subject + message gốc) - chỉ 1 lần
            function buildTicketHeader(t) {
                var statusMap = { open: 'Đang mở', answered: 'Đã trả lời', closed: 'Đã đóng' };
                var statusClass = { open: 'badge-success', answered: 'badge-primary', closed: 'badge-secondary' };
                var category = t.ticketSubject ? t.ticketSubject.category : '';
                var subcategory = t.ticketSubject ? t.ticketSubject.subcategory : '';
                var orderId = t.custom_fields && t.custom_fields.order_id ? t.custom_fields.order_id : '';
                return '<div class="p-4 mb-4 rounded border border-2 border-primary bg-light-primary">' +
                    '<div class="d-flex align-items-center justify-content-between mb-2">' +
                    '<span class="fw-bold fs-5 text-primary">' + (t.subject || '') + '</span>' +
                    '<span class="badge ' + (statusClass[t.status] || 'badge-secondary') + '">' + (statusMap[t.status] || t.status) + '</span>' +
                    '</div>' +
                    (category ? '<div class="text-muted fs-8 mb-1"><i class="bi bi-tag me-1"></i>' + category + (subcategory ? ' › ' + subcategory : '') + '</div>' : '') +
                    (orderId ? '<div class="text-muted fs-8 mb-2"><i class="bi bi-hash me-1"></i>Order ID: ' + orderId + '</div>' : '') +
                    '<div class="separator my-2"></div>' +
                    '<div class="fs-7 text-gray-700">' + (t.message || '') + '</div>' +
                    '<div class="text-muted fs-9 mt-1">' + timeHtml(t.created_at) + '</div>' +
                    '</div>';
            }

            // Hiển thị từng reply từ table ticket_reply
            function buildMessageHtml(reply) {
                var isAdmin = reply.is_admin;
                var name = reply.user ? reply.user.username : 'N/A';
                var attachmentsHtml = '';
                if (reply.attachments && reply.attachments.length > 0) {
                    attachmentsHtml = '<div class="mt-2">';
                    reply.attachments.forEach(function (att) {
                        attachmentsHtml += '<a href="/storage/' + att.file_path + '" target="_blank" class="badge badge-secondary me-1"><i class="bi bi-paperclip me-1"></i>' + att.original_name + '</a>';
                    });
                    attachmentsHtml += '</div>';
                }
                if (!isAdmin) {
                    return '<div class="d-flex justify-content-start mb-10">' +
                        '<div class="d-flex flex-column align-items-start">' +
                        '<a target="_blank" href="/admin/accounts/' + name + '" class="fs-6 fw-bold text-gray-900">' + name + '</a>' +
                        '<span class="fst-italic text-muted fs-9 mb-1">' + timeHtml(reply.created_at) + '</span>' +
                        '<div class="px-3 py-2 rounded bg-light-primary mw-lg-400px text-start">' + reply.message + attachmentsHtml + '</div>' +
                        '</div></div>';
                } else {
                    return '<div class="d-flex justify-content-end mb-5">' +
                        '<div class="d-flex flex-column align-items-end">' +
                        '<span class="fs-6 fw-bold text-gray-900">' + name + '</span>' +
                        '<span class="fst-italic text-muted fs-9 mb-1">' + timeHtml(reply.created_at) + '</span>' +
                        '<div class="px-2 py-1 rounded bg-light-info mw-lg-400px text-end">' + reply.message + attachmentsHtml + '</div>' +
                        '</div></div>';
                }
            }

            function scrollToBottom() {
                var el = document.getElementById('chat-messages');
                if (el) el.scrollTop = el.scrollHeight;
            }

            function showFooter() {
                var footer = document.getElementById('kt_chat_messenger_footer');
                if (footer) {
                    footer.classList.remove('d-none');
                    var btn = document.getElementById('btn-chat-send');
                    if (btn) btn.disabled = false;
                }
            }

            function loadUser(username, menuItem) {
                if (currentUsername === username) return;

                document.querySelectorAll('#div_chat_users .menu-link').forEach(function (l) { l.classList.remove('active'); });
                if (menuItem) {
                    var link = menuItem.querySelector('.menu-link');
                    if (link) link.classList.add('active');
                }

                currentUsername = username;
                lastReplyId = 0;
                stopPolling();

                history.pushState(null, '', '/admin/messages/' + username);

                var el = document.getElementById('chat-username');
                if (el) el.textContent = username;

                // Show footer khi chọn user
                showFooter();

                document.getElementById('chat-messages').innerHTML =
                    '<div class="text-center py-5"><span class="spinner-border spinner-border-sm text-primary"></span></div>';

                fetch('/admin/messages/user/' + encodeURIComponent(username), {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (!data.success) {
                        document.getElementById('chat-messages').innerHTML = '<div class="text-center text-danger py-5">Không tìm thấy dữ liệu</div>';
                        return;
                    }
                    var t = data.ticket;
                    var html = '';

                    // Cập nhật card header
                    var subjectEl = document.getElementById('chat-subject');
                    if (subjectEl) subjectEl.textContent = t.subject || '';

                    var statusEl = document.getElementById('chat-status');
                    if (statusEl) {
                        var statusMap = { open: 'Đang mở', answered: 'Đã trả lời', closed: 'Đã đóng' };
                        var statusClass = { open: 'badge-success', answered: 'badge-primary', closed: 'badge-secondary' };
                        statusEl.innerHTML = '<span class="badge ' + (statusClass[t.status] || 'badge-secondary') + ' ms-2">' + (statusMap[t.status] || t.status) + '</span>';
                    }

                    // 1. Ticket header: subject + message gốc từ table tickets (chỉ 1 lần)
                    html += buildTicketHeader(t);

                    // 2. Replies từ table ticket_reply
                    if (t.replies && t.replies.length > 0) {
                        t.replies.forEach(function (reply) {
                            html += buildMessageHtml(reply);
                            if (reply.id > lastReplyId) lastReplyId = reply.id;
                        });
                    }

                    document.getElementById('chat-messages').innerHTML = html;
                    scrollToBottom();
                    startPolling();
                })
                .catch(function () {
                    document.getElementById('chat-messages').innerHTML = '<div class="text-center text-danger py-5">Lỗi tải dữ liệu</div>';
                });
            }

            function sendReply() {
                if (!currentUsername) return;
                var msg = document.getElementById('txa-message').value.trim();
                if (!msg) return;
                var btn = document.getElementById('btn-chat-send');
                if (btn) btn.disabled = true;
                fetch('/admin/messages/user/' + encodeURIComponent(currentUsername) + '/reply', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    body: JSON.stringify({ message: msg })
                })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (btn) btn.disabled = false;
                    if (data.success) {
                        document.getElementById('txa-message').value = '';
                        fetchNewMessages();
                    } else {
                        alert(data.message || 'Gửi thất bại');
                    }
                })
                .catch(function () {
                    if (btn) btn.disabled = false;
                    alert('Lỗi kết nối');
                });
            }

            function fetchNewMessages() {
                if (!currentUsername) return;
                fetch('/admin/messages/user/' + encodeURIComponent(currentUsername) + '/new-messages?last_id=' + lastReplyId, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    if (data.success && data.new_messages && data.new_messages.length > 0) {
                        var container = document.getElementById('chat-messages');
                        var empty = container.querySelector('.text-center.text-muted');
                        if (empty) empty.remove();
                        data.new_messages.forEach(function (reply) {
                            container.insertAdjacentHTML('beforeend', buildMessageHtml(reply));
                            if (reply.id > lastReplyId) lastReplyId = reply.id;
                        });
                        scrollToBottom();
                    }
                });
            }

            function startPolling() { stopPolling(); pollingTimer = setInterval(fetchNewMessages, 8000); }
            function stopPolling() { if (pollingTimer) { clearInterval(pollingTimer); pollingTimer = null; } }

            document.addEventListener('DOMContentLoaded', function () {
                var searchInput = document.getElementById('search-ticket');
                if (searchInput) {
                    searchInput.addEventListener('keyup', function () {
                        var val = this.value.toLowerCase();
                        document.querySelectorAll('#div_chat_users .d-users').forEach(function (item) {
                            item.style.display = item.textContent.toLowerCase().includes(val) ? '' : 'none';
                        });
                    });
                }

                var txa = document.getElementById('txa-message');
                if (txa) {
                    txa.addEventListener('keydown', function (e) {
                        if (e.ctrlKey && e.key === 'Enter') sendReply();
                    });
                }

                // Chỉ auto-load nếu có INIT_USERNAME (vào từ /admin/messages/{username})
                if (INIT_USERNAME) {
                    var matched = null;
                    document.querySelectorAll('#div_chat_users .menu-item').forEach(function (item) {
                        var titleEl = item.querySelector('.menu-title');
                        if (titleEl && titleEl.textContent.trim().split(/\s/)[0] === INIT_USERNAME) matched = item;
                    });
                    if (matched) matched.click();
                }
            });

            return { loadUser: loadUser, sendReply: sendReply };
        })();
    </script>
@endsection
