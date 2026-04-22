@extends('adminpanel.layouts.app')
@section('title', 'Affiliates')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        @include('adminpanel.accounts.partials.header')

        <span class="title d-none">View account - Affiliates</span>
        <div class="d-flex flex-wrap flex-stack mb-6">
            <h3 class="fw-bold my-2" data-lang="menu::Affiliates">Tiếp thị liên kết</h3>
        </div>
        <div class="row g-6">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-5">
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-2">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th data-page="/affiliates" data-lang="Total Earnings">Tổng tiền thu nhập</th>
                                        <th data-page="/affiliates" data-lang="Unpaid">Chưa thanh toán</th>
                                        <th data-page="/affiliates" data-lang="Paid">Đã thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="fw-bolder fs-5">
                                        <td>$ 0</td>
                                        <td>$ 0.000</td>
                                        <td>$ 0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-2">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th data-page="/affiliates" data-lang="Status">Trạng thái</th>

                                        <th data-page="/affiliates" data-lang="Type">Hình thức</th>
                                        <th data-page="/affiliates" data-lang="Amount">Số tiền</th>
                                        <th data-page="/affiliates" data-lang="Details">Chi tiết</th>
                                        <th data-page="/affiliates" data-lang="Created">Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-7 gy-2">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th></th>
                                        <th data-page="/affiliates" data-lang="Refer">Giới thiệu</th>
                                        <th data-page="/affiliates" data-lang="Earnings">Thu nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
