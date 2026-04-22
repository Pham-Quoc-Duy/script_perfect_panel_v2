@extends('admin.layouts.app')

@section('title', 'Chi tiết Ticket Subject')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Chi tiết Ticket Subject</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.ticket-subjects.index') }}">Ticket Subjects</a></li>
                                <li class="breadcrumb-item active">Chi tiết</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">
                                    <i class="bx bx-info-circle me-2"></i>Thông tin chi tiết
                                </h4>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.ticket-subjects.edit', $ticketSubject) }}" class="btn btn-warning btn-sm">
                                        <i class="bx bx-edit me-1"></i> Chỉnh sửa
                                    </a>
                                    <a href="{{ route('admin.ticket-subjects.index') }}" class="btn btn-secondary btn-sm">
                                        <i class="bx bx-arrow-back me-1"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="fw-medium" width="30%">ID</td>
                                            <td>
                                                <span class="badge bg-primary-subtle text-primary font-size-12">#{{ $ticketSubject->id }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Category</td>
                                            <td>
                                                <span class="badge bg-info-subtle text-info">{{ $ticketSubject->category }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Subcategory</td>
                                            <td>
                                                @if($ticketSubject->subcategory)
                                                    <span class="text-dark">{{ $ticketSubject->subcategory }}</span>
                                                @else
                                                    <span class="text-muted font-style-italic">Không có</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Status</td>
                                            <td>
                                                <span class="badge {{ $ticketSubject->status == 1 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} rounded-pill">
                                                    <i class="bx {{ $ticketSubject->status == 1 ? 'bx-check' : 'bx-x' }} me-1"></i>
                                                    {{ $ticketSubject->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Sort Order</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $ticketSubject->sort_order }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Show Message Only</td>
                                            <td>
                                                @if($ticketSubject->show_message_only)
                                                    <span class="badge bg-success-subtle text-success">
                                                        <i class="bx bx-check me-1"></i>Yes
                                                    </span>
                                                    <small class="text-muted d-block">Chỉ hiển thị ô nhập message</small>
                                                @else
                                                    <span class="badge bg-secondary-subtle text-secondary">
                                                        <i class="bx bx-x me-1"></i>No
                                                    </span>
                                                    <small class="text-muted d-block">Hiển thị các field bổ sung</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Created At</td>
                                            <td>
                                                <span class="text-muted">{{ $ticketSubject->created_at->format('d/m/Y H:i:s') }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Updated At</td>
                                            <td>
                                                <span class="text-muted">{{ $ticketSubject->updated_at->format('d/m/Y H:i:s') }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Required Fields Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-list-ul me-2"></i>Required Fields
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($ticketSubject->required_fields)
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Field ID</th>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Required</th>
                                                <th>Placeholder</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ticketSubject->required_fields as $field)
                                                <tr>
                                                    <td>
                                                        <code class="bg-light px-2 py-1 rounded">{{ $field['id'] ?? '-' }}</code>
                                                    </td>
                                                    <td class="fw-medium">{{ $field['name'] ?? '-' }}</td>
                                                    <td>
                                                        <span class="badge bg-info-subtle text-info">{{ $field['type'] ?? 'text' }}</span>
                                                    </td>
                                                    <td>
                                                        @if($field['required'] ?? false)
                                                            <span class="badge bg-danger-subtle text-danger">
                                                                <i class="bx bx-check me-1"></i>Yes
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary-subtle text-secondary">
                                                                <i class="bx bx-x me-1"></i>No
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-muted">{{ $field['placeholder'] ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="bx bx-list-ul font-size-24 text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Không có required fields</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Statistics Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-bar-chart me-2"></i>Thống kê Tickets
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-center mb-3">
                                        <div class="avatar-sm mx-auto mb-2">
                                            <span class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                <i class="bx bx-ticket"></i>
                                            </span>
                                        </div>
                                        <h4 class="font-size-18 mb-1">{{ $ticketSubject->tickets()->count() }}</h4>
                                        <p class="text-muted mb-0">Total Tickets</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center mb-3">
                                        <div class="avatar-sm mx-auto mb-2">
                                            <span class="avatar-title rounded-circle bg-warning-subtle text-warning">
                                                <i class="bx bx-time"></i>
                                            </span>
                                        </div>
                                        <h4 class="font-size-18 mb-1">{{ $ticketSubject->tickets()->where('status', 'open')->count() }}</h4>
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
                                        <h4 class="font-size-18 mb-1">{{ $ticketSubject->tickets()->where('status', 'answered')->count() }}</h4>
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
                                        <h4 class="font-size-18 mb-1">{{ $ticketSubject->tickets()->where('status', 'closed')->count() }}</h4>
                                        <p class="text-muted mb-0">Closed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Card -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="bx bx-cog me-2"></i>Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.ticket-subjects.edit', $ticketSubject) }}" class="btn btn-warning">
                                    <i class="bx bx-edit me-2"></i>Chỉnh sửa
                                </a>
                                
                                <form action="{{ route('admin.ticket-subjects.toggle-status', $ticketSubject) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $ticketSubject->status == 1 ? 'btn-danger' : 'btn-success' }} w-100">
                                        <i class="bx {{ $ticketSubject->status == 1 ? 'bx-x' : 'bx-check' }} me-2"></i>
                                        {{ $ticketSubject->status == 1 ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>

                                @if($ticketSubject->tickets()->count() == 0)
                                    <form action="{{ route('admin.ticket-subjects.destroy', $ticketSubject) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bx bx-trash me-2"></i>Xóa
                                        </button>
                                    </form>
                                @else
                                    <button type="button" class="btn btn-outline-secondary w-100" disabled title="Không thể xóa vì có tickets liên quan">
                                        <i class="bx bx-trash me-2"></i>Không thể xóa
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection