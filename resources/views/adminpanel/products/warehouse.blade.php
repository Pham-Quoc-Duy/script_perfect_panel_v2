@extends('adminpanel.layouts.app')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">Warehouse</span>
        <div class="d-flex mb-5">
            <button class="btn btn-primary btn-sm" onclick="_products.on.click.showModalAddWarehouse()" data-lang="New warehouse">
                Thêm kho sản phẩm
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-2 mb-0">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th></th>
                                <th data-lang="Name">Tên</th>
                                <th data-lang="Goods remain">Tồn kho</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="fs-7">
                            @forelse ($warehouses as $wh)
                                <tr data-id="{{ $wh->id }}">
                                    <td width="1"><i class="fas fa-bars ui-sortable-handle"></i></td>
                                    <td>{{ $wh->name }}</td>
                                    <td class="fw-bolder">
                                        {{ $wh->available_goods_count }}
                                        @if ($wh->goods_count > $wh->available_goods_count)
                                            <span class="text-muted fs-8">/ {{ $wh->goods_count }} tổng</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline btn-outline-primary me-1 px-4 py-0"
                                            onclick="_products.on.click.showModalAddGoods({{ $wh->id }}, '{{ addslashes($wh->name) }}')" data-lang="Add goods">
                                            Thêm sản phẩm
                                        </button>
                                        <button class="btn btn-sm btn-outline btn-outline-secondary me-3 px-4 py-0"
                                            onclick="_products.on.click.downloadGoods({{ $wh->id }}, '{{ addslashes($wh->name) }}')" data-lang="Download goods">
                                            Tải sản phẩm
                                        </button>
                                        <a href="javascript:;"
                                            class="btn btn-icon btn-light-danger btn-circle btn-sm w-25px h-25px"
                                            onclick="_products.on.click.deleteGoods({{ $wh->id }}, '{{ addslashes($wh->name) }}')">
                                            <i class="bi bi-trash3 fs-7"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5" data-lang="Warehouse not found">Chưa có kho nào</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Modal: Thêm kho --}}
        <div class="modal fade" tabindex="-1" id="modal-new-warehouse" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" data-lang="New warehouse">Thêm kho sản phẩm</h4>
                    </div>
                    <div class="modal-body">
                        <label class="required form-label" data-lang="Name">Tên kho</label>
                        <input type="text" class="form-control form-control-solid ipt-warehouse-name"
                            placeholder="Ví dụ: Kho Via tích xanh" data-lang="Warehouse">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                        <button type="button" class="btn btn-primary btn-sm"
                            onclick="_products.on.click.addWarehouse()" data-lang="button::Add">Thêm</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal: Thêm sản phẩm vào kho --}}
        <div class="modal fade" tabindex="-1" id="modal-add-goods" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" data-lang="Add goods">Thêm sản phẩm</h4>
                    </div>
                    <div class="modal-body">
                        <textarea class="form-control txa-goods" rows="20"
                            onkeyup="_products.on.keyup.goods(this.value.trim())"
                            placeholder="Maximum 4500 lines can be added at one time"
                            data-lang="Maximum 4500 lines can be added at one time"></textarea>
                        <label class="mt-5"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm"
                            onclick="_products.on.click.addGoods(_currentWarehouseId)" data-lang="button::Add">Thêm</button>
                        <button type="button" class="btn btn-light btn-sm me-3"
                            data-bs-dismiss="modal" data-lang="button::Close">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var _currentWarehouseId = null;

        var _products = {
            on: {
                click: {
                    showModalAddWarehouse: function () {
                        document.querySelector('.ipt-warehouse-name').value = '';
                        new bootstrap.Modal(document.getElementById('modal-new-warehouse')).show();
                    },
                    addWarehouse: function () {},

                    showModalAddGoods: function (id, name) {
                        _currentWarehouseId = id;
                        document.querySelector('.txa-goods').value = '';
                        new bootstrap.Modal(document.getElementById('modal-add-goods')).show();
                    },
                    addGoods: function (id) {},
                    downloadGoods: function (id, name) {},
                    deleteGoods: function (id, name) {}
                },
                keyup: {
                    goods: function (val) {
                        var lines = val.split('\n').filter(function (l) { return l.trim() !== ''; }).length;
                        var label = document.querySelector('#modal-add-goods .mt-5');
                        if (label) label.textContent = lines + ' dòng';
                    }
                }
            }
        };
    </script>
@endsection
