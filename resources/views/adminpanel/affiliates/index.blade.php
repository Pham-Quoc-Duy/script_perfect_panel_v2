@extends('adminpanel.layouts.app')
@section('title', 'Affiliates')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="card shadow-sm mb-5 div-affiliates">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-2">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th data-lang="Created">Thời gian</th>
                                <th data-lang="Account">Tài khoản</th>
                                <th data-lang="Type">Hình thức</th>
                                <th data-lang="Amount">Số tiền</th>
                                <th data-lang="Details">Chi tiết</th>
                                <th data-lang="Action">Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loadAffiliates() {
            fetch('/admin/affiliates', {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                var tbody = document.querySelector('.div-affiliates tbody');
                var data  = res.data || [];

                if (!data.length) {
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted py-4">Không có dữ liệu</td></tr>';
                    return;
                }

                var statusMap = {
                    active:    '<span class="badge badge-light-success">Hoạt động</span>',
                    inactive:  '<span class="badge badge-light-secondary">Không HĐ</span>',
                    suspended: '<span class="badge badge-light-danger">Tạm khóa</span>'
                };

                tbody.innerHTML = data.map(function(a) {
                    var referrer = a.referrer ? a.referrer.username : '#' + a.referrer_id;
                    var referred = a.referred ? a.referred.username : '#' + a.referred_id;
                    var date     = a.created_at ? a.created_at.substring(0, 10) : '';
                    var earned   = parseFloat(a.total_earned || 0).toFixed(3);
                    var rate     = parseFloat(a.commission_rate || 0).toFixed(2);
                    var status   = statusMap[a.status] || a.status;

                    return '<tr>'
                        + '<td class="text-muted">' + date + '</td>'
                        + '<td><span class="fw-bold">' + referrer + '</span><br><small class="text-muted">→ ' + referred + '</small></td>'
                        + '<td>' + (a.referral_code ? '<code>' + a.referral_code + '</code>' : '—') + '</td>'
                        + '<td class="fw-bold text-success">' + earned + '</td>'
                        + '<td><small>Hoa hồng: <b>' + rate + '%</b><br>Đơn: <b>' + (a.orders_count || 0) + '</b></small></td>'
                        + '<td>' + status + '</td>'
                        + '</tr>';
                }).join('');
            })
            .catch(function() {
                var tbody = document.querySelector('.div-affiliates tbody');
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Lỗi tải dữ liệu</td></tr>';
            });
        }

        document.addEventListener('DOMContentLoaded', loadAffiliates);
    </script>
@endsection
