@extends('admin.layouts.app')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Ticket #{{ $ticket->id }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.ticket.index') }}">Tickets</a></li>
                                <li class="breadcrumb-item active">Ticket #{{ $ticket->id }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Ticket Info -->
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title mb-0 flex-grow-1">{{ $ticket->subject }}</h5>
                                <div class="flex-shrink-0">
                                    @if($ticket->status == 'open')
                                        <span class="badge bg-warning fs-12">Đang mở</span>
                                    @elseif($ticket->status == 'answered')
                                        <span class="badge bg-info fs-12">Đã trả lời</span>
                                    @else
                                        <span class="badge bg-success fs-12">Đã đóng</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Conversation -->
                            <div class="chat-conversation">
                                @foreach($ticket->replies as $reply)
                                <div class="d-flex {{ $reply->is_admin ? 'justify-content-end' : '' }} mb-4">
                                    <div class="flex-shrink-0 me-3">
                                        @if(!$reply->is_admin)
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-primary text-white">
                                                {{ $reply->is_admin ? 'A' : substr($reply->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="conversation-list">
                                            <div class="ctext-wrap">
                                                <div class="ctext-wrap-content">
                                                    <div class="p-3 {{ $reply->is_admin ? 'bg-light' : 'bg-primary text-white' }} rounded">
                                                        @if($loop->first && $ticket->custom_fields)
                                                            <div class="mb-2">
                                                                <strong>{{ $ticket->subject }}</strong><br>
                                                                @foreach($ticket->custom_fields as $fieldId => $value)
                                                                    @if($value)
                                                                        <small><strong>{{ $fieldId === 'order_id' ? 'Order ID' : ucfirst($fieldId) }}:</strong> {{ $value }}</small><br>
                                                                    @endif
                                                                @endforeach
                                                                <hr class="my-2">
                                                            </div>
                                                        @endif
                                                        
                                                        <p class="mb-0">{!! nl2br(e($reply->message)) !!}</p>
                                                        
                                                        @if($reply->hasAttachments())
                                                            <div class="mt-2">
                                                                @foreach($reply->getAttachmentsList() as $attachment)
                                                                    <div class="attachment-item mb-1">
                                                                        <a href="{{ asset('storage/' . $attachment['file_path']) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                                            <i class="ri-attachment-line"></i> {{ $attachment['original_name'] }}
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="conversation-name">
                                                <small class="text-muted time">{{ $reply->is_admin ? 'admin' : $reply->user->name }} - {{ $reply->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ms-3">
                                        @if($reply->is_admin)
                                        <div class="avatar-xs">
                                            <span class="avatar-title rounded-circle bg-success text-white">
                                                {{ $reply->is_admin ? 'A' : substr($reply->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            @if($ticket->status !== 'closed')
                            <!-- Reply Form -->
                            <div class="border-top pt-4">
                                <form id="replyForm" method="POST" action="{{ route('admin.ticket.reply', $ticket) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Trả lời</label>
                                        <textarea class="form-control" name="message" rows="4" placeholder="Nhập tin nhắn trả lời..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Đính kèm file</label>
                                        <input type="file" class="form-control" name="attachments[]" multiple 
                                               accept="image/jpg,image/jpeg,image/png,image/gif,text/plain,text/csv,application/pdf">
                                        <small class="text-muted">Tối đa 5MB mỗi file. Định dạng: jpg, jpeg, png, gif, pdf, txt, csv</small>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-send-plane-line"></i> Gửi trả lời
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Ticket Details -->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thông tin Ticket</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0" scope="row">ID:</th>
                                            <td class="text-muted">#{{ $ticket->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Người tạo:</th>
                                            <td class="text-muted">{{ $ticket->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Email:</th>
                                            <td class="text-muted">{{ $ticket->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Danh mục:</th>
                                            <td class="text-muted">{{ $ticket->ticketSubject->category ?? 'N/A' }}</td>
                                        </tr>
                                        @if($ticket->ticketSubject && $ticket->ticketSubject->subcategory)
                                        <tr>
                                            <th class="ps-0" scope="row">Danh mục con:</th>
                                            <td class="text-muted">{{ $ticket->ticketSubject->subcategory }}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <th class="ps-0" scope="row">Độ ưu tiên:</th>
                                            <td>
                                                @if($ticket->priority == 'high')
                                                    <span class="badge bg-danger">Cao</span>
                                                @elseif($ticket->priority == 'medium')
                                                    <span class="badge bg-warning">Trung bình</span>
                                                @else
                                                    <span class="badge bg-secondary">Thấp</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Trạng thái:</th>
                                            <td>
                                                <select class="form-select form-select-sm" id="statusSelect">
                                                    <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Đang mở</option>
                                                    <option value="answered" {{ $ticket->status == 'answered' ? 'selected' : '' }}>Đã trả lời</option>
                                                    <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Đã đóng</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Phân công:</th>
                                            <td class="text-muted">
                                                {{ $ticket->assignedTo ? $ticket->assignedTo->name : 'Chưa phân công' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Tạo lúc:</th>
                                            <td class="text-muted">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Cập nhật cuối:</th>
                                            <td class="text-muted">
                                                {{ $ticket->last_reply_at ? $ticket->last_reply_at->format('d/m/Y H:i') : 'Chưa có' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thao tác</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="button" class="btn btn-danger" onclick="deleteTicket({{ $ticket->id }})">
                                    <i class="ri-delete-bin-line"></i> Xóa Ticket
                                </button>
                                <a href="{{ route('admin.ticket.index') }}" class="btn btn-secondary">
                                    <i class="ri-arrow-left-line"></i> Quay lại danh sách
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa ticket này không? Hành động này không thể hoàn tác.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Handle reply form submission
    $('#replyForm').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        
        // Disable submit button
        submitBtn.prop('disabled', true).html('<i class="ri-loader-2-line"></i> Đang gửi...');
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                let message = 'Có lỗi xảy ra';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                alert(message);
            },
            complete: function() {
                // Re-enable submit button
                submitBtn.prop('disabled', false).html(originalText);
            }
        });
    });

    // Handle status change
    $('#statusSelect').on('change', function() {
        const status = $(this).val();
        const ticketId = {{ $ticket->id }};
        
        $.ajax({
            url: `/admin/ticket/${ticketId}/status`,
            method: 'PUT',
            data: {
                status: status,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message || 'Có lỗi xảy ra');
                }
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra khi cập nhật trạng thái');
            }
        });
    });
});

function deleteTicket(ticketId) {
    const form = document.getElementById('deleteForm');
    form.action = `/admin/ticket/${ticketId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endpush