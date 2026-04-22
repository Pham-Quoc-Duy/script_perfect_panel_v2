@extends('adminpanel.layouts.app')
@section('title', 'Accounts')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.accounts.partials.header')

        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="Sign in history">Lịch sử đăng nhập</h3>
        </div>

        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-2">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th data-lang="Created">Ngày tạo</th>
                                        <th>IP</th>
                                        <th>User agent</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-7 fw-semibold text-gray-700">
                                    @forelse($loginHistory as $log)
                                        <tr>
                                            <td>{{ $log->created_at?->format('Y-m-d H:i:s') ?? '' }}</td>
                                            <td>{{ $log->activity['ip_address'] ?? '' }}</td>
                                            <td>{{ $log->activity['user_agent'] ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center py-5">
                                                <span class="text-muted">Không có dữ liệu</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
