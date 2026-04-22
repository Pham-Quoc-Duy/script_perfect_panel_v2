@extends('clients.theme-4.layouts.app')
@section('title', 'Tickets')

@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Tickets'])
        <!--begin::Post-->
        <div class="post" id="kt_post">
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title fw-bold" data-lang="">Contact Us</div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                        @if (!empty($config?->link_facebook))
                            <div class="d-flex align-items-center me-10 flex-grow-1">
                                <div class="symbol symbol-30px symbol-circle me-3">
                                    <i class="bi bi-facebook text-primary fs-2x"></i>
                                </div>
                                <div class="m-0">
                                    <span class="fw-bold text-gray-600 d-block fs-8">Facebook</span>
                                    <a href="{{ $config->link_facebook }}" target="_blank"
                                        class="fw-bolder text-gray-800 fs-6">{{ $config->link_facebook }}</a>
                                </div>
                            </div>
                        @endif

                        @if (!empty($config?->link_zalo))
                            <div class="d-flex align-items-center me-10 flex-grow-1">
                                <div class="symbol symbol-30px symbol-circle me-3">
                                    <i class="bi bi-chat-dots text-primary fs-2x"></i>
                                </div>
                                <div class="m-0">
                                    <span class="fw-bold text-gray-600 d-block fs-8">Zalo</span>
                                    <a href="{{ $config->link_zalo }}" target="_blank"
                                        class="fw-bolder text-gray-800 fs-6">{{ $config->link_zalo }}</a>
                                </div>
                            </div>
                        @endif

                        @if (!empty($config?->link_telegram))
                            <div class="d-flex align-items-center me-10 flex-grow-1">
                                <div class="symbol symbol-30px symbol-circle me-3">
                                    <i class="bi bi-telegram text-primary fs-2x"></i>
                                </div>
                                <div class="m-0">
                                    <span class="fw-bold text-gray-600 d-block fs-8">Telegram</span>
                                    <a href="{{ $config->link_telegram }}" target="_blank"
                                        class="fw-bolder text-gray-800 fs-6">{{ $config->link_telegram }}</a>
                                </div>
                            </div>
                        @endif

                        @if (!empty($config?->link_whatsapp))
                            <div class="d-flex align-items-center flex-grow-1">
                                <div class="symbol symbol-30px symbol-circle me-3">
                                    <i class="bi bi-whatsapp text-success fs-2x"></i>
                                </div>
                                <div class="m-0">
                                    <span class="fw-bold text-gray-600 d-block fs-8">Whatsapp</span>
                                    <a href="{{ $config->link_whatsapp }}" target="_blank"
                                        class="fw-bolder text-gray-800 fs-6">{{ $config->link_whatsapp }}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <div class="card-title fw-bold" data-lang="">Tickets</div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-7 gy-3 gs-5 mb-0">
                            <thead class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                                <tr>
                                    <th data-lang="ID">ID</th>
                                    <th data-lang="Order ID">Order ID</th>
                                    <th data-lang="Request">Request</th>
                                    <th data-lang="Status">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets as $ticket)
                                    @php
                                        $cf = is_array($ticket->custom_fields) ? $ticket->custom_fields : json_decode($ticket->custom_fields ?? '{}', true);
                                        $orderId = $cf['order_id'] ?? '—';
                                        $request = $ticket->ticketSubject?->subcategory ?: ($ticket->ticketSubject?->category ?: $ticket->subject);
                                    @endphp
                                    <tr>
                                        <td class="ls-1">{{ $ticket->id }}</td>
                                        <td class="ls-1 fw-bold">{{ $orderId }}</td>
                                        <td data-lang="">{{ $request }}</td>
                                        <td class="fw-bold" data-lang="">{{ $ticket->status_text }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5" data-lang="No ticket found">No ticket found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card" id="kt_chat_messenger">
                <div class="card-header" id="kt_chat_messenger_header">
                    <div class="card-title">
                        <div class="d-flex justify-content-center flex-column me-3">
                            <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1"
                                data-lang="Direct message">Direct message</a>
                        </div>
                    </div>
                </div>
                <div class="card-body py-5" id="kt_chat_messenger_body" style="min-height: 300px">
                    <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto chat-mess" id="chat-messages"
                        data-kt-element="messages"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                        data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                        data-kt-scroll-offset="5px">
                        {{-- Render server-side lần đầu --}}
                        @php
                            $allMessages = collect();
                            foreach ($tickets as $ticket) {
                                $allMessages->push((object)[
                                    'id'         => 0,
                                    'is_admin'   => false,
                                    'message'    => $ticket->message,
                                    'created_at' => $ticket->created_at,
                                ]);
                                foreach ($ticket->replies as $reply) {
                                    $allMessages->push((object)[
                                        'id'         => $reply->id,
                                        'is_admin'   => $reply->is_admin,
                                        'message'    => $reply->message,
                                        'created_at' => $reply->created_at,
                                    ]);
                                }
                            }
                            $allMessages = $allMessages->sortBy('created_at')->values();
                        @endphp
                        @forelse ($allMessages as $msg)
                            @if ($msg->is_admin)
                                <div class="d-flex justify-content-start mb-10">
                                    <div class="d-flex flex-column align-items-start">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="symbol symbol-35px symbol-circle me-3"></div>
                                            <div>
                                                <span class="fs-5 fw-bold text-gray-900 me-1">Support</span>
                                                <span class="text-muted fs-7">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                        <div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start">{!! nl2br(e($msg->message)) !!}</div>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex justify-content-end mb-10">
                                    <div class="d-flex flex-column align-items-end">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="me-3">
                                                <span class="text-muted fs-7">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                                                <span class="fs-5 fw-bold text-gray-900 ms-1">You</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle"></div>
                                        </div>
                                        <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end">{!! nl2br(e($msg->message)) !!}</div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="text-center text-muted py-5" id="chat-empty" data-lang="No ticket found">No ticket found.</div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                    <select id="sl-ticket-category" style="display:none;">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ strtolower($cat) === 'other' ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <textarea id="txa-message" class="form-control form-control-flush mb-3" style="overflow:auto;resize:none;max-height:200px"
                        placeholder="Type a message" data-lang="Type a message" rows="1"></textarea>
                    <button type="button" id="btn-send" class="btn btn-primary float-end" data-lang="Send">Send</button>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>

    {{-- Alert Modal --}}
    <div class="modal fade" id="modal-alert" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered rounded-4">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white py-4">
                    <h4 class="modal-title text-white ls-1">Alert</h4>
                </div>
                <div class="modal-body py-10 fs-4" id="modal-alert-body" style="word-break: break-word;"></div>
                <div class="modal-footer text-center py-4">
                    <button type="button" class="btn btn-sm btn-danger px-4 rounded-4"
                        data-bs-dismiss="modal" data-lang="button::Read">Read</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    showFullScreenLoader('Loading...', 'body');
    document.addEventListener('DOMContentLoaded', function () {
        hideFullScreenLoader();
    });
</script>
<script>
(function () {
    var CSRF = '{{ csrf_token() }}';
    var lastTicketId = {{ $tickets->where('status', '!=', 'closed')->first()?->id ?? 'null' }};
    // lastReplyId: ID lớn nhất trong replies hiện có, dùng để polling tin mới
    var lastReplyId = {{ $tickets->flatMap(fn($t) => $t->replies)->max('id') ?? 0 }};
    var pollingTimer = null;

    function timeStr(iso) {
        if (!iso) return '';
        var d = new Date(iso);
        return d.toLocaleDateString('vi-VN') + ' ' + d.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    }

    function buildMsgHtml(isAdmin, message, time) {
        var t = time ? timeStr(time) : '';
        var safe = message.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
        if (!isAdmin) {
            // User: right
            return '<div class="d-flex justify-content-end mb-10">' +
                '<div class="d-flex flex-column align-items-end">' +
                '<div class="d-flex align-items-center mb-2">' +
                '<div class="me-3"><span class="text-muted fs-7">' + t + '</span>' +
                '<span class="fs-5 fw-bold text-gray-900 ms-1">You</span></div>' +
                '<div class="symbol symbol-35px symbol-circle"></div></div>' +
                '<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end">' + safe + '</div>' +
                '</div></div>';
        } else {
            // Admin: left
            return '<div class="d-flex justify-content-start mb-10">' +
                '<div class="d-flex flex-column align-items-start">' +
                '<div class="d-flex align-items-center mb-2">' +
                '<div class="symbol symbol-35px symbol-circle me-3"></div>' +
                '<div><span class="fs-5 fw-bold text-gray-900 me-1">Support</span>' +
                '<span class="text-muted fs-7">' + t + '</span></div></div>' +
                '<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start">' + safe + '</div>' +
                '</div></div>';
        }
    }

    function scrollBottom() {
        var el = document.getElementById('chat-messages');
        if (el) el.scrollTop = el.scrollHeight;
    }

    function appendMsg(isAdmin, message, time) {
        var el = document.getElementById('chat-messages');
        if (!el) return;
        var empty = el.querySelector('#chat-empty');
        if (empty) empty.remove();
        el.insertAdjacentHTML('beforeend', buildMsgHtml(isAdmin, message, time));
        scrollBottom();
    }

    function showModalAlert(msg) {
        document.getElementById('modal-alert-body').textContent = msg;
        new bootstrap.Modal(document.getElementById('modal-alert')).show();
    }

    // Polling: lấy replies mới hơn lastReplyId
    function fetchNewReplies() {
        if (!lastTicketId) return;
        fetch('/tickets/' + lastTicketId + '/messages', {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            if (!data.success || !data.replies) return;
            data.replies.forEach(function (reply) {
                if (reply.id > lastReplyId) {
                    appendMsg(reply.is_admin, reply.message, reply.created_at_full);
                    lastReplyId = reply.id;
                }
            });
        })
        .catch(function () {});
    }

    function startPolling() {
        if (pollingTimer) return;
        pollingTimer = setInterval(fetchNewReplies, 8000);
    }

    function sendMessage() {
        var txa = document.getElementById('txa-message');
        var btn = document.getElementById('btn-send');
        var msg = txa.value.trim();
        if (!msg) { showModalAlert('Message cannot be empty.'); return; }

        btn.disabled = true;
        btn.textContent = '...';

        var url, body;
        if (lastTicketId) {
            url = '/tickets/' + lastTicketId + '/reply';
            body = JSON.stringify({ TicketMessageForm: { message: msg } });
        } else {
            var cat = document.getElementById('sl-ticket-category')?.value || 'Other';
            url = '{{ route("clients.tickets.store") }}';
            body = JSON.stringify({ category: cat, message: msg });
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: body
        })
        .then(function (r) {
            return r.text().then(function (text) {
                try { return JSON.parse(text); }
                catch (e) { throw new Error('Server error: ' + text.substring(0, 200)); }
            });
        })
        .then(function (res) {
            if (res.success) {
                if (res.ticket_id) lastTicketId = res.ticket_id;
                // Hiển thị tin nhắn ngay, không reload
                var now = new Date().toISOString();
                appendMsg(false, msg, now);
                txa.value = '';
                txa.style.height = 'auto';
                // Cập nhật lastReplyId nếu có
                if (res.reply_id && res.reply_id > lastReplyId) lastReplyId = res.reply_id;
                startPolling();
            } else {
                var errs = res.errors ? Object.values(res.errors).flat().join(' ') : (res.message || 'Error.');
                showModalAlert(errs);
            }
        })
        .catch(function (err) {
            showModalAlert(err.message || 'Network error.');
        })
        .finally(function () {
            btn.disabled = false;
            btn.textContent = 'Send';
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        scrollBottom();
        if (lastTicketId) startPolling();

        var txa = document.getElementById('txa-message');
        var btn = document.getElementById('btn-send');

        txa.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 200) + 'px';
        });

        txa.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        btn.addEventListener('click', sendMessage);
    });
})();
</script>
@endpush
