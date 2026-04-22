@extends('admin.layouts.app')

@section('title', 'Lịch sử sự kiện')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include('admin.components.breadcrumb', [
                    'title' => 'Lịch sử sự kiện',
                    'breadcrumb' => 'Event History',
                ])

                @include('admin.components.alert')

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">
                                        <i class="bx bx-history me-2"></i>Lịch sử quay/mở hộp
                                    </h4>
                                    
                                    <form method="GET" class="d-flex gap-2">
                                        <select name="event_id" class="form-select form-select-sm" style="width: 200px;" onchange="this.form.submit()">
                                            <option value="">Tất cả sự kiện</option>
                                            @foreach($events as $event)
                                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                                    {{ $event->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                        <input type="search" name="search" class="form-control form-control-sm" 
                                               placeholder="Tìm user..." value="{{ request('search') }}" style="width: 180px;">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="bx bx-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr class="bg-transparent">
                                                <th style="width: 60px;">ID</th>
                                                <th style="width: 200px;">Người dùng</th>
                                                <th>Sự kiện</th>
                                                <th style="width: 150px;">Phần thưởng</th>
                                                <th style="width: 120px;">Số tiền</th>
                                                <th style="width: 120px;">IP</th>
                                                <th style="width: 160px;">Thời gian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($spins ?? [] as $spin)
                                                <tr>
                                                    <td>#{{ $spin->id }}</td>
                                                    
                                                    <td>
                                                        @if($spin->user)
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-xs me-2">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                                        {{ strtoupper(substr($spin->user->name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <h6 class="mb-0 font-size-13">{{ $spin->user->name }}</h6>
                                                                    <small class="text-muted">{{ $spin->user->email }}</small>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        @if($spin->event)
                                                            <span class="badge bg-soft-{{ $spin->event->type == 'spin' ? 'primary' : 'success' }} text-{{ $spin->event->type == 'spin' ? 'primary' : 'success' }}">
                                                                {{ $spin->event->name }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        <span class="fw-medium">{{ $spin->reward_name }}</span>
                                                    </td>
                                                    
                                                    <td>
                                                        @if($spin->reward_amount > 0)
                                                            <span class="text-success fw-bold">+${{ number_format($spin->reward_amount, 2) }}</span>
                                                        @else
                                                            <span class="text-muted">$0.00</span>
                                                        @endif
                                                    </td>
                                                    
                                                    <td>
                                                        <small class="text-muted">{{ $spin->ip_address ?? '-' }}</small>
                                                    </td>
                                                    
                                                    <td>
                                                        <small>{{ $spin->created_at?->format('d/m/Y H:i:s') }}</small>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-4">
                                                        <div class="text-muted">
                                                            <i class="bx bx-info-circle me-1"></i>Chưa có lịch sử
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                @if (isset($spins) && method_exists($spins, 'links'))
                                    <div class="mt-3">{{ $spins->appends(request()->query())->links() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
