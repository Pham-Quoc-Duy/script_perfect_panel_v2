@extends('adminpanel.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        
        @include('adminpanel.settings.partials.header')
        
        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2" data-lang="">Sản phẩm</h3>
            <div class="d-flex flex-wrap my-2">
                <button class="btn btn-primary btn-sm" data-lang="button::Update"
                    onclick="_settings.on.click.updateSetting({'enable_products': document.querySelector('.cb-enable-products').checked})">Cập
                    nhật</button>
            </div>
        </div>
        <div class="row g-6">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div>
                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                <input class="form-check-input cb-enable-products" type="checkbox">
                                <label class="form-check-label text-gray-900" data-lang="Enable sell products">Bật bán sản
                                    phẩm</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
