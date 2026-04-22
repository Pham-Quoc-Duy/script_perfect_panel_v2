@extends('admin.layouts.app')

@section('title', 'Quản lý sự kiện')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Quản lý sự kiện',
                    'breadcrumb' => 'Events',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">
                                        <i class="bx bx-gift me-2"></i>Sự kiện hệ thống
                                    </h4>
                                    
                                    <div class="d-flex gap-2">
                                        <form method="GET" class="d-flex gap-2">
                                            <select name="type" class="form-select form-select-sm" style="width: 140px;" onchange="this.form.submit()">
                                                <option value="">Tất cả loại</option>
                                                <option value="spin" {{ request('type') == 'spin' ? 'selected' : '' }}>Vòng quay</option>
                                                <option value="box" {{ request('type') == 'box' ? 'selected' : '' }}>Mở hộp</option>
                                            </select>
                                            
                                            <select name="status" class="form-select form-select-sm" style="width: 140px;" onchange="this.form.submit()">
                                                <option value="">Tất cả</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Tạm dừng</option>
                                            </select>
                                        </form>
                                        
                                        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
                                            <i class="bx bx-plus me-1"></i>Tạo sự kiện
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 60px;">ID</th>
                                                <th>Tên sự kiện</th>
                                                <th style="width: 100px;">Loại</th>
                                                <th style="width: 120px;">Lượt/ngày</th>
                                                <th style="width: 150px;">Thời gian</th>
                                                <th style="width: 100px;">Đã quay</th>
                                                <th style="width: 90px;">Trạng thái</th>
                                                <th style="width: 100px;">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($events ?? [] as $event)
                                                <tr>
                                                    <td>#{{ $event->id }}</td>
                                                    
                                                    <td>
                                                        <h6 class="mb-0">{{ $event->name }}</h6>
                                                        @if($event->description)
                                                            <small class="text-muted">{{ Str::limit($event->description, 40) }}</small>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        <span class="badge bg-soft-{{ $event->type == 'spin' ? 'primary' : 'success' }} text-{{ $event->type == 'spin' ? 'primary' : 'success' }}">
                                                            {{ $event->type == 'spin' ? 'Vòng quay' : 'Mở hộp' }}
                                                        </span>
                                                    </td>
                                                    
                                                    <td>
                                                        <span class="fw-medium">{{ $event->max_spins_per_day }}</span> lượt
                                                        @if($event->max_spins_total > 0)
                                                            <br><small class="text-muted">Tổng: {{ $event->max_spins_total }}</small>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        <small class="d-block text-success">{{ $event->start_date?->format('d/m/Y') }}</small>
                                                        <small class="d-block text-danger">{{ $event->end_date?->format('d/m/Y') }}</small>
                                                    </td>
                                                    
                                                    <td>
                                                        <span class="badge bg-soft-info text-info">{{ $event->spins_count ?? 0 }}</span>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="form-check form-switch mb-0">
                                                            <input class="form-check-input status-toggle" 
                                                                   type="checkbox" 
                                                                   data-event-id="{{ $event->id }}"
                                                                   {{ $event->status ? 'checked' : '' }}>
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="{{ route('admin.events.edit', $event->id) }}" 
                                                               class="btn btn-sm btn-outline-info" title="Sửa">
                                                                <i class="bx bx-edit"></i>
                                                            </a>
                                                            
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    onclick="if(confirm('Xóa sự kiện này?')) document.getElementById('delete-{{ $event->id }}').submit()">
                                                                <i class="bx bx-trash"></i>
                                                            </button>
                                                            
                                                            <form id="delete-{{ $event->id }}"
                                                                  action="{{ route('admin.events.destroy', $event) }}"
                                                                  method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="bx bx-info-circle me-1"></i>Chưa có sự kiện nào
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if (isset($events) && method_exists($events, 'links'))
                                    <div class="mt-3">{{ $events->appends(request()->query())->links() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).on('change', '.status-toggle', function() {
    const eventId = $(this).data('event-id');
    $.post(`/admin/events/${eventId}/toggle-status`, {
        _token: '{{ csrf_token() }}'
    });
});
</script>
@endpush
