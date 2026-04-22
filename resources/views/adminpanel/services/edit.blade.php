@extends('adminpanel.layouts.app')
@section('title', 'Services')
@section('content')
    <div class="content flex-row-fluid" id="kt_content" data-select2-id="select2-data-kt_content"><span
            class="title d-none">Edit</span>
        <div class="card shadow-sm mb-5 div-service">
            <div class="card-header">
                <div class="card-title">
                    <div class="form-check form-switch form-check-custom form-check-solid form-check-primary">
                        <input class="form-check-input cb-service-status" type="checkbox" checked="">
                        <input class="form-check-input cb-service-oldstatus d-none" type="checkbox" checked="">
                        <label class="form-check-label fs-3 fw-bold" data-lang="">Trạng thái</label>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="d-flex">
                    <div class="mb-5 me-15 d-none">
                        <label class="form-label">Schedule</label>
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input cb-service-schedule" type="checkbox" checked="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="mb-5">
                            <label class="required form-label" data-lang="Add Type">Dạng kết nối</label>
                            <select class="form-select form-select-solid sl-service-add-type" data-kt-select2="true"
                                data-hide-search="true" onchange="toggleConnectionType(this.value)">
                                <option value="manual" data-lang="">Thủ công</option>
                                <option value="api">API</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <!-- Manual mode: Giá nhà cung cấp -->
                        <div class="mb-5 div-oprice-manual" style="display: none;">
                            <label class="required form-label" data-lang="Price of provider">Giá nhà cung cấp</label>
                            <input type="number" value="{{ $service->rate_original ?? '' }}" class="form-control form-control-solid ipt-service-oprice"
                                placeholder="Nhập giá gốc"
                                oninput="document.getElementById('rate-original-display').textContent = this.value || '0'">
                        </div>

                        <!-- API mode: Nhà cung cấp + Dịch vụ -->
                        <div class="row div-type-api-container" style="display: none;">
                            <div class="col-lg-3">
                                <div class="mb-5 div-type-api">
                                    <label class="required form-label" data-lang="Providers">Nhà cung cấp</label>
                                    <select class="form-select form-select-solid sl-provider" data-kt-select2="true"
                                        name="provider_id">
                                        <option value="0">Chọn</option>
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider->id }}" data-type="api"
                                                data-rate="{{ $provider->rate ?? 1 }}"
                                                data-fixed-decimal="{{ $provider->fixed_decimal ?? 10 }}"
                                                @if ($service->provider_id == $provider->id) selected @endif>
                                                {{ $provider->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="mb-5 div-type-api">
                                    <div class="mb-5">
                                        <label class="required form-label">Dịch vụ</label>
                                        <select class="form-select form-select-solid sl-provider-sid" data-kt-select2="true"
                                            name="service_api">
                                            <option value="0">Chọn</option>
                                        </select>
                                         <input type="hidden" class="ipt-service-api"
                                            value="{{ $service->service_api ?? '' }}">
                                    </div>
                                </div>
                                <div class="mb-5 div-oprice" style="display: none;">
                                    <label class="required form-label" data-lang="Price of provider">Giá nhà cung
                                        cấp</label>
                                    <input type="number" class="form-control form-control-solid ipt-service-oprice"
                                        placeholder="Nhập giá gốc"
                                        oninput="document.getElementById('rate-original-display').textContent = this.value || '0'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 ">
                    <label class="required form-label" data-lang="Category">Danh mục</label>
                    <select class="form-select form-select-solid sl-category select2-hidden-accessible"
                        data-select2-id="select2-data-1-1453" tabindex="-1" aria-hidden="true">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id ?? '' }}" 
                                data-icon="{{ $category->image ?? '' }}"
                                data-platform="{{ $category->platform->name ?? '' }}"
                                data-category="{{ $category->name['en'] ?? $category->name }}"
                                @if ($service->category_id == $category->id) selected @endif>
                                {{ $category->platform->name ?? '' }} | {{ $category->name['en'] ?? $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label class="form-label"><span data-lang="Label Features">Nhãn thông tin</span><button
                            class="btn btn-sm btn-outline btn-outline-primary ms-2 px-2 py-0 btn-copy btn-copy-feature"
                            onclick="copyFromProvider('feature')" style="display: none;" data-lang="">Sao chép từ nhà
                            cung
                            cấp</button></label>
                    <select class="form-select form-select-solid sl-features select2-hidden-accessible"
                        data-control="select2" data-close-on-select="false" data-placeholder="Chọn"
                        data-allow-clear="true" multiple="" tabindex="-1" aria-hidden="true"
                        data-kt-initialized="1" data-select2-id="select2-data-88-1dxn" name="attributes">
                        <option></option>
                        <option value="Owner">Owner</option>
                        <option value="Exclusive">Exclusive</option>
                        <option value="Provider Direct">Provider Direct</option>
                        <option value="New">New</option>
                        <option value="Best seller">Best seller</option>
                        <option value="Promotion">Promotion</option>
                        <option value="Recommend">Recommend</option>
                        <option value="Instant">Instant</option>
                        <option value="Super Fast">Super Fast</option>
                        <option value="Real">Real</option>
                        <option value="Lifetime">Lifetime</option>
                        <option value="7 days Refill">7 days Refill</option>
                        <option value="15 days Refill">15 days Refill</option>
                        <option value="30 days Refill">30 days Refill</option>
                        <option value="60 days Refill">60 days Refill</option>
                        <option value="90 days Refill">90 days Refill</option>
                        <option value="365 days Refill">365 days Refill</option>
                        <option value="No refill">No refill</option>
                        <option value="Auto Refill">Auto Refill</option>
                        <option value="No refund">No refund</option>
                        <option value="Refill Button">Refill Button</option>
                        <option value="Cancel Button">Cancel Button</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-5 card-title">
            <div class="card-body">
                <div class="mb-5">
                    <label class="required form-label" data-lang="Name">Tên dịch vụ</label>
                    <input type="text" class="form-control form-control-solid ipt-service-name" name="name[en]"
                        value="{{ trim($service->name['en'] ?? ($service->name ?? '')) }}" fdprocessedid="aro32">
                </div>
                <div id="div-translated-name"></div>
                @if (isset($languages) && $languages->count() > 0)
                    <a class="btn btn-secondary btn-sm" href="javascript:void(0);" role="button"
                        data-bs-toggle="dropdown" data-lang="Add translated name">Thêm tên ngôn ngữ khác</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach ($languages as $lang)
                            <a href="javascript:;" class="dropdown-item ai-icon"
                                onclick="addTranslatedName('{{ $lang->code }}')">
                                <span class="rounded-1 fi fi-{{ $lang->code === 'vi' ? 'vn' : $lang->code }} fs-4"></span>
                                <span class="ms-2">{{ $lang->name }}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm mb-5 card-sync">
            <div class="card-header" style="">
                <div class="card-title">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input cb-sync cb-service-sync" type="checkbox" onchange="sync(1)">
                        <label class="form-check-label fs-3 fw-bold" data-lang="Auto sync">Tự động đồng bộ tất cả</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-lg-4 col-sm-6">
                        <fieldset class="border border-2 rounded p-2">
                            <legend class="float-none w-auto p-2 mb-0 show-api" style="">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-sync cb-service-sync-rate w-30px h-20px"
                                        type="checkbox" onchange="sync()">
                                    <label class="form-check-label fs-7" data-lang="">Đồng bộ?</label>
                                </div>
                            </legend>
                            <input type="number" class="form-control ipt-service-oldprice d-none">
                            <div class="mb-5">
                                <label class="required form-label"><span data-lang="Retail Rate">Giá bán lẻ</span> <span
                                        class="show-api" style=""> | <span class="data-api"><span
                                                class="text-danger" id="rate-original-display">{{ $service->rate_original ?? '0' }}</span></span></span></label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-secondary">$</span>
                                    <input type="text" class="form-control ipt-service-price"
                                        value="{{ $service->rate_retail ?? '' }}"
                                        onkeyup="retail_rate(this.value)" inputmode="text" fdprocessedid="kknp39">
                                    <input type="text"
                                        class="form-control border-start border-2 float-end text-end ipt-service-price-percent"
                                        value="{{ $service->rate_retail_up ?? $markupConfig['markup_retail'] ?? 110 }}" onkeyup="price_percent(this.value, 0)"
                                        data-inputmask="'mask': '9{1,4}.9{1,2}', 'greedy': false, 'placeholder': '0'"
                                        inputmode="text" fdprocessedid="9sd75">
                                    <span class="input-group-text bg-secondary">%</span>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label class="required form-label" data-lang="Wholesale Rate - Child">Giá đại lý</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-secondary">$</span>
                                    <input type="number" class="form-control ipt-service-price-1" 
                                        value="{{ $service->rate_agent ?? '' }}"
                                        fdprocessedid="gdk465">
                                    <input type="text"
                                        class="form-control border-start border-2 float-end text-end ipt-service-price-1-percent"
                                        value="{{ $service->rate_agent_up ?? $markupConfig['markup_agent'] ?? 108 }}" onkeyup="price_percent(this.value, 1)"
                                        data-inputmask="'mask': '9{1,4}.9{1,2}', 'greedy': false, 'placeholder': '0'"
                                        inputmode="text" fdprocessedid="hygax">
                                    <span class="input-group-text bg-secondary">%</span>
                                </div>
                            </div>
                            <div class="">
                                <label class="required form-label" data-lang="Wholesale Rate - Reseller">Giá nhà phân
                                    phối</label>
                                <div class="input-group input-group-solid">
                                    <span class="input-group-text bg-secondary">$</span>
                                    <input type="number" class="form-control ipt-service-price-2" 
                                        value="{{ $service->rate_distributor ?? '' }}"
                                        fdprocessedid="b46wi">
                                    <input type="text"
                                        class="form-control border-start border-2 float-end text-end ipt-service-price-2-percent"
                                        value="{{ $service->rate_distributor_up ?? $markupConfig['markup_distributor'] ?? 105 }}" onkeyup="price_percent(this.value, 2)"
                                        data-inputmask="'mask': '9{1,4}.9{1,2}', 'greedy': false, 'placeholder': '0'"
                                        inputmode="text" fdprocessedid="4fpjq">
                                    <span class="input-group-text bg-secondary">%</span>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-4 col-sm-6 ">
                        <fieldset class="border border-2 rounded p-2 mb-5">
                            <legend class="float-none w-auto p-2 mb-0 show-api" style="">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-sync cb-service-sync-minmax w-30px h-20px"
                                        type="checkbox" onchange="sync()">
                                    <label class="form-check-label fs-7" data-lang="">Đồng bộ?</label>
                                </div>
                            </legend>
                            <div class="">
                                <div class="">
                                    <label class="required form-label"><span data-lang="Min/Max">SL đặt hàng: Tối
                                            thiếu-Tối đa</span> <span class="show-api" style=""> | <span
                                                class="data-api"><span class="text-danger" id="min-display">{{ $service->min ?? '' }}</span> - <span
                                                    class="text-danger" id="max-display">{{ $service->max ?? '' }}</span></span></span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-solid ipt-service-min"
                                            value="{{ $service->min ?? '' }}"
                                            data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" inputmode="text"
                                            fdprocessedid="miz0bn">
                                        <span class="input-group-text bg-secondary border-0">-</span>
                                        <input type="text" class="form-control form-control-solid ipt-service-max"
                                            value="{{ $service->max ?? '' }}"
                                            data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" inputmode="text"
                                            fdprocessedid="14tywk">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-5 ">
                            <label class="required form-label" data-lang="Total/User Limit">Giới hạn số đơn hàng: Tổng -
                                Từng khách hàng</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-solid ipt-service-tlimit"
                                    value="{{ $service->total_limit ?? '100000' }}"
                                    data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" inputmode="text" fdprocessedid="ujo56f">
                                <span class="input-group-text bg-secondary border-0">-</span>
                                <input type="text" class="form-control form-control-solid ipt-service-limit"
                                    value="{{ $service->limit ?? '100000' }}"
                                    data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" inputmode="text" fdprocessedid="n7ext">
                            </div>
                        </div>
                        <div class="">
                            <label class="required form-label"><span data-lang="Order Type">Kiểu dịch vụ</span> <span
                                    class="show-api" style=""> | <span class="data-api"><span
                                            class="text-danger" id="type-display">{{ $service->type ?? 'Default' }}</span></span></span></label>
                            <select class="form-select form-select-solid sl-service-type select2-hidden-accessible"
                                data-kt-select2="true" data-hide-search="true" onchange="handleServiceTypeChange(this.value)"
                                tabindex="-1" aria-hidden="true" data-kt-initialized="1" disabled=""
                                data-select2-id="select2-data-52-skys">
                                <option value="Default" @if ($service->type == 'Default') selected @endif>Default</option>
                                <option value="Custom Comments" @if ($service->type == 'Custom Comments') selected @endif>Custom Comments</option>
                                <option value="Package" @if ($service->type == 'Package') selected @endif>Package</option>
                                <option value="Special" @if ($service->type == 'Special') selected @endif>Special</option>
                                <option value="Special 1" @if ($service->type == 'Special 1') selected @endif>Special 1</option>
                                <option value="Mentions with Hashtags" @if ($service->type == 'Mentions with Hashtags') selected @endif>Mentions with Hashtags</option>
                                <option value="Mentions User Followers" @if ($service->type == 'Mentions User Followers') selected @endif>Mentions User Followers</option>
                                <option value="Mentions Custom List" @if ($service->type == 'Mentions Custom List') selected @endif>Mentions Custom List</option>
                                <option value="Mentions Hashtag" @if ($service->type == 'Mentions Hashtag') selected @endif>Mentions Hashtag</option>
                                <option value="Mentions Media Likers" @if ($service->type == 'Mentions Media Likers') selected @endif>Mentions Media Likers</option>
                                <option value="Comment Likes" @if ($service->type == 'Comment Likes') selected @endif>Comment Likes</option>
                                <option value="Invites from Groups" @if ($service->type == 'Invites from Groups') selected @endif>Invites from Groups</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 ">
                        <fieldset class="border border-2 rounded p-2 mb-3">
                            <legend class="float-none w-auto p-2 mb-0 show-api" style="">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-sync cb-service-sync-refill w-30px h-20px"
                                        type="checkbox" onchange="sync()">
                                    <label class="form-check-label fs-7" data-lang="">Đồng bộ?</label>
                                </div>
                            </legend>
                            <div class="">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input cb-service-refill" type="checkbox"
                                        @if ($service->refill) checked @endif
                                        @if (!$service->refill) disabled="disabled" @endif>
                                    <label class="form-check-label required"><span data-lang="">Yêu cầu bảo hành</span>
                                        <span class="show-api" style=""> | <span class="data-api"><span
                                                    class="text-danger">{{ $service->refill ? 'Có' : 'Không' }}</span></span></span></label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-2 rounded p-2">
                            <legend class="float-none w-auto p-2 mb-0 show-api" style="">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-sync cb-service-sync-cancel w-30px h-20px"
                                        type="checkbox" onchange="sync()">
                                    <label class="form-check-label fs-7" data-lang="">Đồng bộ?</label>
                                </div>
                            </legend>
                            <div class="">
                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input cb-service-cancel" type="checkbox"
                                        @if ($service->cancel) checked @endif
                                        @if (!$service->cancel) disabled="disabled" @endif>
                                    <label class="form-check-label required"><span data-lang="">Yêu cầu hủy</span> <span
                                            class="show-api" style=""> | <span class="data-api"><span
                                                    class="text-danger">{{ $service->cancel ? 'Có' : 'Không' }}</span></span></span></label>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border border-2 rounded p-2 ">
                            <legend class="float-none w-auto p-2 mb-0 show-api" style="">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input cb-sync cb-service-sync-status w-30px h-20px"
                                        type="checkbox" onchange="sync()">
                                    <label class="form-check-label fs-7" data-lang="">Đồng bộ?</label>
                                </div>
                            </legend>
                            <div class="fst-italic text-muted" data-lang="">Khi nhà cung cấp vô hiệu hóa dịch vụ, dịch
                                vụ sẽ bị vô hiệu hóa?</div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack mt-6">
            <h3 class="fw-bold my-2"><span data-lang="">Thông số dịch vụ</span> <button
                    class="btn btn-sm btn-outline btn-outline-primary ms-2 px-2 py-0 btn-copy btn-copy-summary"
                    onclick="copyFromProvider('summary')" style="display: none;" data-lang="">Sao
                    chép từ nhà cung cấp</button></h3>
        </div>
        <p class="mb-6 fst-italic" data-lang="">Dùng để hiển thị dịch vụ dưới dạng bảng cho danh mục</p>
        <div class="card shadow-sm mb-5 card-summary">
            <div class="card-body">
                <div class="row g-5">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="start_time">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label" data-lang="summary::Start time">Thời gian bắt
                                        đầu</label>
                                </div>
                            </span>
                            <input type="text" class="form-control" list="list_start_time" onkeyup="summary()"
                                fdprocessedid="d3laci">
                            <datalist id="list_start_time">
                                <option>Instant</option>
                                <option>1-2h</option>
                                <option>1-6h</option>
                                <option>6-12h</option>
                                <option>0-24h</option>
                                <option>24-48h</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="guarantee">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label" data-lang="summary::Guarantee">Bảo hành</label>
                                </div>
                            </span>
                            <input type="text" class="form-control" list="list_guarantee" onkeyup="summary()"
                                fdprocessedid="n8lr24">
                            <datalist id="list_guarantee">
                                <option>7 days refill</option>
                                <option>15 days refill</option>
                                <option>30 days refill</option>
                                <option>60 days refill</option>
                                <option>90 days refill</option>
                                <option>180 days refill</option>
                                <option>365 days refill</option>
                                <option>Lifetime</option>
                                <option>No refill</option>
                                <option>No refund</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="real_user">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label" data-lang="summary::Real user">Người dùng thật</label>
                                </div>
                            </span>
                            <input type="text" class="form-control" list="list_real_user" onkeyup="summary()"
                                fdprocessedid="03l56a">
                            <datalist id="list_real_user">
                                <option>Yes</option>
                                <option>No</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="speed">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label" data-lang="summary::Speed">Tốc độ</label>
                                </div>
                            </span>
                            <input type="text" class="form-control" onkeyup="summary()" fdprocessedid="g0svv8">
                            <span class="input-group-text bg-secondary">/</span>
                            <select class="form-select form-select-solid  bg-secondary" fdprocessedid="fbhogs">
                                <option value="hour" data-page="common" data-lang="">giờ</option>
                                <option value="day" data-page="common" data-lang="">ngày</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="source">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label"><span data-lang="summary::Source">Nguồn</span> <i
                                            class="fa-regular fa-circle-question" data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="Select multiple by using ,"
                                            data-bs-original-title="Select multiple by using ,"
                                            data-kt-initialized="1"></i></label>
                                </div>
                            </span>
                            <input type="text" class="form-control input-multi" list="list_source" multiple=""
                                onkeyup="summary()" fdprocessedid="j40ne">
                            <datalist id="list_source">
                                <option>Suggested videos</option>
                                <option>External</option>
                                <option>Browse Features</option>
                                <option>Youtube Search</option>
                                <option>Google Search</option>
                                <option>YouTube advertising</option>
                                <option>Playlists</option>
                                <option>Channel pages</option>
                                <option>Direct or unknown</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="drop_rate">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label" data-lang="summary::Drop rate">Tỉ lệ tụt</label>
                                </div>
                            </span>
                            <input type="text" class="form-control" list="list_drop_rate" onkeyup="summary()"
                                fdprocessedid="vtd9z">
                            <datalist id="list_drop_rate">
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                                <option>25</option>
                                <option>30</option>
                                <option>40</option>
                                <option>50</option>
                                <option>100</option>
                            </datalist>
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="retention">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label" data-lang="summary::Retention">Thời gian xem</label>
                                </div>
                            </span>
                            <input type="text" class="form-control" onkeyup="summary()" fdprocessedid="gsm4hh">
                            <select class="form-select form-select-solid bg-secondary" fdprocessedid="h3nf95">
                                <option value="seconds" data-page="common" data-lang="">giây</option>
                                <option value="minutes" data-page="common" data-lang="">phút</option>
                                <option value="hours" data-page="common" data-lang="">giờ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="device">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label"><span data-lang="summary::Device">Thiết bị</span> <i
                                            class="fa-regular fa-circle-question" data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="Select multiple by using ,"
                                            data-bs-original-title="Select multiple by using ,"
                                            data-kt-initialized="1"></i></label>
                                </div>
                            </span>
                            <input type="text" class="form-control input-multi" list="list_device" multiple=""
                                onkeyup="summary()" fdprocessedid="9vi7wh">
                            <datalist id="list_device">
                                <option>Mobile phone</option>
                                <option>Computer</option>
                                <option>TV</option>
                            </datalist>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="input-group input-group-solid" data-key="country">
                            <span class="input-group-text bg-secondary">
                                <div class="form-check form-check-custom">
                                    <input class="form-check-input form-check-input h-20px w-20px" type="checkbox"
                                        value="">
                                    <label class="form-check-label"><span data-lang="summary::Country">Quốc gia</span> <i
                                            class="fa-regular fa-circle-question" data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="Select multiple by using ,"
                                            data-bs-original-title="Select multiple by using ,"
                                            data-kt-initialized="1"></i></label>
                                </div>
                            </span>
                            <input type="text" class="form-control input-multi" list="list_country" multiple=""
                                onkeyup="summary()" fdprocessedid="z8p09">
                            <datalist id="list_country">
                                <option>AF</option>
                                <option>AL</option>
                                <option>DZ</option>
                                <option>AS</option>
                                <option>AD</option>
                                <option>AO</option>
                                <option>AI</option>
                                <option>AQ</option>
                                <option>AG</option>
                                <option>AR</option>
                                <option>AM</option>
                                <option>AW</option>
                                <option>AU</option>
                                <option>AT</option>
                                <option>AZ</option>
                                <option>BS</option>
                                <option>BH</option>
                                <option>BD</option>
                                <option>BB</option>
                                <option>BY</option>
                                <option>BE</option>
                                <option>BZ</option>
                                <option>BJ</option>
                                <option>BM</option>
                                <option>BT</option>
                                <option>BO</option>
                                <option>BQ</option>
                                <option>BA</option>
                                <option>BW</option>
                                <option>BV</option>
                                <option>BR</option>
                                <option>IO</option>
                                <option>BN</option>
                                <option>BG</option>
                                <option>BF</option>
                                <option>BI</option>
                                <option>CV</option>
                                <option>KH</option>
                                <option>CM</option>
                                <option>CA</option>
                                <option>KY</option>
                                <option>CF</option>
                                <option>TD</option>
                                <option>CL</option>
                                <option>CN</option>
                                <option>CX</option>
                                <option>CC</option>
                                <option>CO</option>
                                <option>KM</option>
                                <option>CD</option>
                                <option>CG</option>
                                <option>CK</option>
                                <option>CR</option>
                                <option>HR</option>
                                <option>CU</option>
                                <option>CW</option>
                                <option>CY</option>
                                <option>CZ</option>
                                <option>CI</option>
                                <option>DK</option>
                                <option>DJ</option>
                                <option>DM</option>
                                <option>DO</option>
                                <option>EC</option>
                                <option>EG</option>
                                <option>SV</option>
                                <option>GQ</option>
                                <option>ER</option>
                                <option>EE</option>
                                <option>SZ</option>
                                <option>ET</option>
                                <option>FK</option>
                                <option>FO</option>
                                <option>FJ</option>
                                <option>FI</option>
                                <option>FR</option>
                                <option>GF</option>
                                <option>PF</option>
                                <option>TF</option>
                                <option>GA</option>
                                <option>GM</option>
                                <option>GE</option>
                                <option>DE</option>
                                <option>GH</option>
                                <option>GI</option>
                                <option>GR</option>
                                <option>GL</option>
                                <option>GD</option>
                                <option>GP</option>
                                <option>GU</option>
                                <option>GT</option>
                                <option>GG</option>
                                <option>GN</option>
                                <option>GW</option>
                                <option>GY</option>
                                <option>HT</option>
                                <option>HM</option>
                                <option>VA</option>
                                <option>HN</option>
                                <option>HK</option>
                                <option>HU</option>
                                <option>IS</option>
                                <option>IN</option>
                                <option>ID</option>
                                <option>IR</option>
                                <option>IQ</option>
                                <option>IE</option>
                                <option>IM</option>
                                <option>IL</option>
                                <option>IT</option>
                                <option>JM</option>
                                <option>JP</option>
                                <option>JE</option>
                                <option>JO</option>
                                <option>KZ</option>
                                <option>KE</option>
                                <option>KI</option>
                                <option>KP</option>
                                <option>KR</option>
                                <option>KW</option>
                                <option>KG</option>
                                <option>LA</option>
                                <option>LV</option>
                                <option>LB</option>
                                <option>LS</option>
                                <option>LR</option>
                                <option>LY</option>
                                <option>LI</option>
                                <option>LT</option>
                                <option>LU</option>
                                <option>MO</option>
                                <option>MG</option>
                                <option>MW</option>
                                <option>MY</option>
                                <option>MV</option>
                                <option>ML</option>
                                <option>MT</option>
                                <option>MH</option>
                                <option>MQ</option>
                                <option>MR</option>
                                <option>MU</option>
                                <option>YT</option>
                                <option>MX</option>
                                <option>FM</option>
                                <option>MD</option>
                                <option>MC</option>
                                <option>MN</option>
                                <option>ME</option>
                                <option>MS</option>
                                <option>MA</option>
                                <option>MZ</option>
                                <option>MM</option>
                                <option>NA</option>
                                <option>NR</option>
                                <option>NP</option>
                                <option>NL</option>
                                <option>NC</option>
                                <option>NZ</option>
                                <option>NI</option>
                                <option>NE</option>
                                <option>NG</option>
                                <option>NU</option>
                                <option>NF</option>
                                <option>MP</option>
                                <option>NO</option>
                                <option>OM</option>
                                <option>PK</option>
                                <option>PW</option>
                                <option>PS</option>
                                <option>PA</option>
                                <option>PG</option>
                                <option>PY</option>
                                <option>PE</option>
                                <option>PH</option>
                                <option>PN</option>
                                <option>PL</option>
                                <option>PT</option>
                                <option>PR</option>
                                <option>QA</option>
                                <option>MK</option>
                                <option>RO</option>
                                <option>RU</option>
                                <option>RW</option>
                                <option>RE</option>
                                <option>BL</option>
                                <option>SH</option>
                                <option>KN</option>
                                <option>LC</option>
                                <option>MF</option>
                                <option>PM</option>
                                <option>VC</option>
                                <option>WS</option>
                                <option>SM</option>
                                <option>ST</option>
                                <option>SA</option>
                                <option>SN</option>
                                <option>RS</option>
                                <option>SC</option>
                                <option>SL</option>
                                <option>SG</option>
                                <option>SX</option>
                                <option>SK</option>
                                <option>SI</option>
                                <option>SB</option>
                                <option>SO</option>
                                <option>ZA</option>
                                <option>GS</option>
                                <option>SS</option>
                                <option>ES</option>
                                <option>LK</option>
                                <option>SD</option>
                                <option>SR</option>
                                <option>SJ</option>
                                <option>SE</option>
                                <option>CH</option>
                                <option>SY</option>
                                <option>TW</option>
                                <option>TJ</option>
                                <option>TZ</option>
                                <option>TH</option>
                                <option>TL</option>
                                <option>TG</option>
                                <option>TK</option>
                                <option>TO</option>
                                <option>TT</option>
                                <option>TN</option>
                                <option>TR</option>
                                <option>TM</option>
                                <option>TC</option>
                                <option>TV</option>
                                <option>UG</option>
                                <option>UA</option>
                                <option>AE</option>
                                <option>GB</option>
                                <option>UM</option>
                                <option>US</option>
                                <option>UY</option>
                                <option>UZ</option>
                                <option>VU</option>
                                <option>VE</option>
                                <option>VN</option>
                                <option>VG</option>
                                <option>VI</option>
                                <option>WF</option>
                                <option>EH</option>
                                <option>YE</option>
                                <option>ZM</option>
                                <option>ZW</option>
                                <option>AX</option>
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack my-6">
            <h3 class="fw-bold my-2"><span data-lang="">Mô tả dịch vụ</span> <button
                    class="btn btn-sm btn-outline btn-outline-primary ms-2 px-2 py-0 btn-copy btn-copy-desc"
                    onclick="copyFromProvider('desc')" style="display: none;" data-lang="">Sao chép
                    từ nhà cung cấp</button></h3>
        </div>
        
        <!-- Service Description Editor -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div id="editor-service-description" style="height: 300px;"></div>
                <input type="hidden" id="service-description-content" name="description" value="{{ $service->description }}">
            </div>
        </div>

        <!-- Service Reaction -->
        <div class="card shadow-sm mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="fw-bold" data-lang="">Loại Reaction</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-5">
                    <label class="form-label" data-lang="">Reaction (Tùy chọn)</label>
                    <div class="input-group input-group-solid">
                        <input type="text" 
                            class="form-control form-control-solid ipt-service-reaction" 
                            name="reaction" 
                            value="{{ $service->reaction ?? '' }}"
                            placeholder="VD: LOVE, HAHA, WOW, SAD, ANGRY"
                            maxlength="500"
                            pattern="[A-Z0-9\s,\-]*"
                            title="Chỉ chứa chữ cái, số, dấu phẩy và dấu gạch ngang"
                            oninput="this.value = this.value.toUpperCase(); updateReactionCounter()">
                        <span class="input-group-text bg-secondary">
                            <i class="bx bx-heart"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <small class="form-text text-muted">Nhập loại reaction sẽ được gửi tới API (VD: LOVE, HAHA, WOW, SAD, ANGRY)</small>
                        <small class="form-text text-muted reaction-counter"><span class="reaction-length">0</span>/500</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="div-card-overflow" style="">
            <div class="mt-6">
                <div class="form-check form-switch form-check-custom">
                    <input class="form-check-input cb-service-overflow" type="checkbox"
                        onchange="document.querySelector('.card-overflow').setAttribute('style', this.checked ? '' : 'display: none;')">
                    <label class="form-check-label fs-3 fw-bold text-gray-900">Overflow</label>
                </div>
            </div>
            <div class="row g-5 card-overflow mt-0" style="display: none;">
                <div class="col-xl-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="required form-label" data-lang="Value">Giá trị</label>
                                    <div class="input-group input-group-solid mb-2">
                                        <input type="text" class="form-control ipt-overflow text-end"
                                            value="10" inputmode="text">
                                        <span class="input-group-text bg-secondary">%</span>
                                    </div>
                                    <span class="fst-italic" data-lang="Overflow-desc">Nếu bạn nhập -10% thì khi khách
                                        hàng đặt hàng số lượng 1000, hệ thống sẽ gửi đặt hàng số lượng 900 cho nhà cung cấp.
                                        Nếu bạn nhập 10% thì hệ thống sẽ gửi số lượng là 1100.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack mt-6">
            <div class="form-check form-switch form-check-custom">
                <input class="form-check-input cb-service-advanced-settings" type="checkbox"
                    onchange="document.querySelector('.card-advanced-settings').setAttribute('style', this.checked ? '' : 'display: none;')">
                <label class="form-check-label fs-3 fw-bold text-gray-900" data-lang="Advanced settings">Cài đặt nâng
                    cao (Thường dùng cho những dịch vụ miễn phí)</label>
            </div>
        </div>
        <div class="row g-5 card-advanced-settings mt-0" style="display: none;">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-5">
                                    <label class="required form-label" data-lang="Advanced settings 1">Số dư tối thiểu
                                        để có thể mua</label>
                                    <input type="text"
                                        class="form-control form-control-solid ipt-advanced-min-balance">
                                </div>
                                <div class="">
                                    <label class="required form-label" data-lang="Advanced settings 2">Tối đa số đơn
                                        hàng trên từng tài khoản (Ngoại trừ: Đơn hàng HỦY)</label>
                                    <input type="text"
                                        class="form-control form-control-solid ipt-advanced-max-order mb-2"
                                        value="0" data-inputmask="'mask': '9', 'repeat': 4, 'greedy' : false"
                                        inputmode="text">
                                    <span class="text-muted" data-lang="Advanced settings 3">Để 0 nếu không muốn giới
                                        hạn</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack mt-6">
            <div class="form-check form-switch form-check-custom">
                <input class="form-check-input cb-service-quantity-discount" type="checkbox"
                    onchange="document.querySelector('.card-discount').setAttribute('style', this.checked ? '' : 'display: none;')">
                <label class="form-check-label fs-3 fw-bold text-gray-900" data-lang="Quantity discount">Giảm
                    giá</label>
            </div>
        </div>
        <div class="row g-5 card-discount mt-0" style="display: none;">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="div-conditions"></div>
                        <button type="button" class="btn btn-secondary btn-sm"
                            onclick="addConditionQuantityDiscount()" data-lang="Add condition">Thêm
                            điều kiện</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="div-card-check-count" style="display: none;">
            <div class="mt-6">
                <div class="form-check form-switch form-check-custom">
                    <input class="form-check-input cb-service-check-count" type="checkbox"
                        onchange="document.querySelector('.card-check-count').setAttribute('style', this.checked ? '' : 'display: none;')">
                    <label class="form-check-label fs-3 fw-bold text-gray-900">Check count order (Get start count and
                        complete the order) <span class="text-danger">*BETA TIME*</span></label>
                </div>
            </div>
            <div class="card card-check-count shadow-sm" style="display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-5">
                            <label class="required form-label">Type</label>
                            <select class="form-select sl-check-count-type select2-hidden-accessible"
                                data-kt-select2="true" tabindex="-1" aria-hidden="true" data-kt-initialized="1"
                                data-select2-id="select2-data-60-yqxb">
                                <option value="youtube-view" data-select2-id="select2-data-62-c2ai">Youtube - Views
                                </option>
                                <option value="youtube-like">Youtube - Likes</option>
                                <option value="youtube-comment">Youtube - Comments</option>
                                <option value="youtube-subscriber">Youtube - Subscribers</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5"
                                dir="ltr" data-select2-id="select2-data-61-viu6" style="width: 100%;"><span
                                    class="selection"><span
                                        class="select2-selection select2-selection--single form-select sl-check-count-type"
                                        role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                        aria-disabled="false" aria-labelledby="select2-zska-container"
                                        aria-controls="select2-zska-container"><span class="select2-selection__rendered"
                                            id="select2-zska-container" role="textbox" aria-readonly="true"
                                            title="Youtube - Views">Youtube - Views</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <div class="col-lg-6">
                            <label class="required form-label">Complete when over quantity <span
                                    class="ml-1 mr-1 fa fa-exclamation-circle" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    aria-label="If you set 5% and quantity is 1000. The order is will be completed when reach quantity is 1050"
                                    data-bs-original-title="If you set 5% and quantity is 1000. The order is will be completed when reach quantity is 1050"
                                    data-kt-initialized="1"></span></label>
                            <div class="input-group mb-5">
                                <input type="text" class="form-control ipt-check-count-percent text-end"
                                    data-inputmask="'mask': '9', 'repeat': 2, 'greedy' : false" value="0"
                                    inputmode="text">
                                <span class="input-group-text">%</span>
                            </div>
                            <div class="form-check form-switch form-check-solid">
                                <input class="form-check-input cb-check-count-auto-check-completion" type="checkbox">
                                <label class="form-check-label">Automatically check order completion</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack mt-6">
            <div class="form-check form-switch form-check-custom">
                <input class="form-check-input cb-service-avg-time" type="checkbox"
                    @if ($service->average_time) checked @endif
                    onchange="document.querySelector('.card-avg-time').setAttribute('style', this.checked ? '' : 'display: none;')">
                <label class="form-check-label fs-3 fw-bold text-gray-900" data-lang="">Thiết lập thời gian trung
                    bình</label>
            </div>
        </div>
        @php
            $avgTimeValue = $service->average_time ?? 0;
            $avgTimeDisplay = formatSeconds($avgTimeValue);
        @endphp
        <div class="row g-5 card-avg-time mt-0" style="@if (!$service->average_time) display: none; @endif">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                <label class="required form-label" data-lang="Time">Thời gian (Tính bằng giây)</label>
                                <div class="input-group input-group-solid mb-5">
                                    <span class="input-group-text bg-text text-avg-time">{{ $avgTimeDisplay }}</span>
                                    <input type="text" class="form-control ipt-service-avg-time"
                                        data-inputmask="'mask': '9', 'repeat': 9, 'greedy' : false" value="{{ $avgTimeValue }}"
                                        onkeyup="document.querySelector('.text-avg-time').textContent = app.timeAvg(this.value.trim())"
                                        inputmode="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack mt-6">
            <div class="form-check form-switch form-check-custom">
                <input class="form-check-input cb-hidden-api" type="checkbox">
                <label class="form-check-label fs-3 fw-bold text-gray-900" data-lang="">Hạn chế truy cập dịch vụ này
                    trong API</label>
            </div>
        </div>
        <div class="d-flex flex-wrap flex-stack mt-6">
            <div class="form-check form-switch form-check-custom">
                <input class="form-check-input cb-news" type="checkbox" checked="">
                <label class="form-check-label fs-3 fw-bold text-gray-900"><span data-lang="Update to">Cập nhật</span>
                    <a target="_blank" href="/admin/news" data-lang="NEWS">Thông báo</a></label>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-stack mt-6">
            <div class="form-check form-switch form-check-custom" style="">
                <input class="form-check-input cb-change-provider" type="checkbox" value="">
                <label class="form-check-label fs-3 fw-bold text-gray-900"><span
                        data-lang="Change provider for current orders">Thay đổi nhà cung cấp cho các đơn hàng cũ</span>:
                    <span class="text-danger text-uppercase" data-lang="status::Failed">Thất bại</span>, <span
                        class="text-uppercase" data-lang="status::Awaiting">Đang chờ</span></label>
            </div>
        </div>

        <div class="row g-5 mt-6">
            <div class="col-12">
                <button type="button" class="btn btn-primary w-100" id="updateServiceBtn" onclick="update()"
                    data-lang="button::Update">
                    <i class="bx bx-save me-1"></i>Cập nhật
                </button>
                <button type="button" class="btn btn-sm btn-danger w-100 mt-5" id="deleteServiceBtn" onclick="confirmDelete()"
                    data-lang="button::Delete">
                    <i class="bx bx-trash me-1"></i>Xóa
                </button>
            </div>
        </div>
    </div>

    <!-- CSS cho Select2 với Icon - Tối ưu cho Category, Provider, Service -->
    <style>
        .form-control:focus {
            box-shadow: none;
        }
        /* Ẩn nút clear vĩnh viễn */
        .select2-selection__clear {
            display: none !important;
        }

        /* Style cho select2 dropdown */
        .select2-container--default .select2-results__option {
            padding: 10px 14px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-results__option--highlighted {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        .select2-container--default .select2-selection--single {
            min-height: 42px;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px;
            padding-left: 12px;
            display: flex;
            align-items: center;
        }

        /* Icon alignment và spacing */
        .select2-results__option span,
        .select2-selection__rendered span {
            display: flex !important;
            align-items: center;
            gap: 8px;
        }

        .select2-results__option img,
        .select2-selection__rendered img {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            object-fit: contain;
            border-radius: 3px;
        }

        .select2-results__option i,
        .select2-selection__rendered i {
            flex-shrink: 0;
            width: 20px;
            text-align: center;
            font-size: 1rem;
        }

        /* Dark mode support */
        [data-bs-theme="dark"] .select2-dropdown {
            background-color: #1e293b;
            border-color: #334155;
        }

        [data-bs-theme="dark"] .select2-container--default .select2-results__option {
            color: #e2e8f0;
        }

        [data-bs-theme="dark"] .select2-container--default .select2-results__option--highlighted {
            background-color: #334155 !important;
            color: #ffffff !important;
        }

        [data-bs-theme="dark"] .select2-container--default .select2-selection--single {
            background-color: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }

        [data-bs-theme="dark"] .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #e2e8f0;
        }

        [data-bs-theme="dark"] .select2-search--dropdown .select2-search__field {
            background-color: #1e293b;
            border-color: #334155;
            color: #e2e8f0;
        }

        /* Hover effect */
        .select2-container--default .select2-results__option:hover {
            background-color: #f8fafc;
        }

        [data-bs-theme="dark"] .select2-container--default .select2-results__option:hover {
            background-color: #2d3748;
        }

        /* Smooth transitions */
        .select2-container--default .select2-results__option {
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        /* Specific select styling */
        .sl-category+.select2-container,
        .sl-provider+.select2-container,
        .sl-provider-sid+.select2-container {
            font-size: 0.95rem;
        }

        /* Ensure proper text wrapping for long option names */
        .select2-results__option span span {
            word-break: break-word;
            flex: 1;
        }

        /* Fullscreen Loader Styles */
        .fullscreen-loader-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            backdrop-filter: blur(3px);
            z-index: 9998;
            animation: fadeIn 0.3s ease-in-out;
        }

        .fullscreen-loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            animation: slideUp 0.5s ease-out;
        }

        .fullscreen-loader-overlay.d-none,
        .fullscreen-loader.d-none {
            display: none !important;
        }

        .fullscreen-loader-overlay.fade-out,
        .fullscreen-loader.fade-out {
            animation: fadeOut 0.3s ease-in-out forwards;
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>

    <script src="{{ asset('adminpanel/js/services/edit.js') }}"></script>
    {{-- <script src="{{ asset('js/category.js') }}"></script> --}}
    <script>
        // Placeholder functions for service edit page
        window.type = function(value) {
        };

        window.sync = function(value) {
        };

        window.copyFromProvider = function(type) {
        };

        window.retail_rate = function(value) {
        };

        window.price_percent = function(value, type = 0) {
            // Lấy giá gốc từ display
            const rateOriginalDisplay = document.getElementById('rate-original-display');
            const rateOriginal = parseFloat(rateOriginalDisplay?.textContent || 0);
            
            // Lấy giá trị phần trăm nhập vào
            const percentValue = parseFloat(value) || 0;
            
            // Tính toán: (phần trăm / 100) * giá gốc
            const calculatedPrice = (percentValue / 100) * rateOriginal;
            
            // Xác định input nào cần cập nhật dựa trên type
            let targetInput;
            if (type === 0) {
                // Giá bán lẻ (Retail Rate)
                targetInput = document.querySelector('.ipt-service-price');
            } else if (type === 1) {
                // Giá đại lý (Agent Rate)
                targetInput = document.querySelector('.ipt-service-price-1');
            } else if (type === 2) {
                // Giá nhà phân phối (Distributor Rate)
                targetInput = document.querySelector('.ipt-service-price-2');
            }
            
            // Cập nhật giá trị vào input
            if (targetInput) {
                targetInput.value = calculatedPrice.toFixed(4);
                // Trigger change event để cập nhật UI nếu cần
                targetInput.dispatchEvent(new Event('change', { bubbles: true }));
            }
        };

        window.summary = function() {
        };

        // Update reaction character counter
        window.updateReactionCounter = function() {
            const reactionInput = document.querySelector('.ipt-service-reaction');
            const counterSpan = document.querySelector('.reaction-length');
            
            if (reactionInput && counterSpan) {
                counterSpan.textContent = reactionInput.value.length;
            }
        };

        // Initialize reaction counter on page load
        document.addEventListener('DOMContentLoaded', function() {
            const reactionInput = document.querySelector('.ipt-service-reaction');
            if (reactionInput) {
                updateReactionCounter();
                reactionInput.addEventListener('input', updateReactionCounter);
            }
        });

        // Hiển thị loader toàn màn hình ngay khi trang bắt đầu load
        if (typeof showFullScreenLoader === 'function') {
            showFullScreenLoader('', '');
        }

        // Format icon + text cho tất cả các select (Category, Provider, Service, etc.)
        function formatCategoryOption(data) {
            if (!data.id) return data.text;
            
            const $element = $(data.element);
            const icon = $element.data('icon') || '';
            const image = $element.data('image') || '';
            const platform = $element.data('platform') || '';
            const category = $element.data('category') || '';
            
            let prefix = '';

            // Ưu tiên data-image trước (category image)
            if (image) {
                // Kiểm tra nếu image là URL (chứa http hoặc /)
                if (image.includes('http') || image.includes('/')) {
                    const fallbackId = 'fallback-' + Math.random().toString(36).substr(2, 9);
                    prefix = `<img src="${image}" alt="${category}" loading="lazy" class="w-15px h-15px me-2" onerror="this.style.display='none';document.getElementById('${fallbackId}').style.display='inline-block';" />` +
                        `<i id="${fallbackId}" class="fa-solid fa-image me-2" style="display:none;color:#999;"></i>`;
                } else {
                    // image là Font Awesome class
                    prefix = `<i class="${image} me-2"></i>`;
                }
            }
            // Nếu không có data-image, kiểm tra data-icon (platform icon)
            else if (icon) {
                // Kiểm tra nếu icon là URL (chứa http hoặc /)
                if (icon.includes('http') || icon.includes('/')) {
                    const fallbackId = 'fallback-' + Math.random().toString(36).substr(2, 9);
                    prefix = `<img src="${icon}" alt="${platform}" loading="lazy" class="w-15px h-15px me-2" onerror="this.style.display='none';document.getElementById('${fallbackId}').style.display='inline-block';" />` +
                        `<i id="${fallbackId}" class="fa-solid fa-image me-2" style="display:none;color:#999;"></i>`;
                } else {
                    // Icon là Font Awesome class
                    prefix = `<i class="${icon} me-2"></i>`;
                }
            }

            // Hiển thị platform name | category name
            const displayText = platform && category ? `${platform} | ${category}` : data.text;
            return $(`<div class="d-flex align-items-center">${prefix}${displayText}</div>`);
        }

        // Format selection (hiển thị khi đã chọn)
        function formatSelection(item) {
            if (!item.id) return item.text;

            const $element = $(item.element);
            const icon = $element.data('icon') || '';
            const platform = $element.data('platform') || '';
            const category = $element.data('category') || '';
            let prefix = '';

            // Kiểm tra data-icon - tự động phát hiện là link hay icon class
            if (icon) {
                // Kiểm tra nếu icon là URL (bắt đầu với http, https, hoặc chứa dấu chấm như .gif, .png, .jpg)
                const isUrl = icon.startsWith('http://') || icon.startsWith('https://') || icon.startsWith('//') || /\.(gif|png|jpg|jpeg|svg|webp)$/i.test(icon);
                
                if (isUrl) {
                    const fallbackId = 'fallback-sel-' + Math.random().toString(36).substr(2, 9);
                    prefix = `<img src="${icon}" alt="${category}" loading="lazy" class="w-15px h-15px me-2 rounded" style="object-fit:contain;" onerror="this.style.display='none';document.getElementById('${fallbackId}').style.display='inline-block';" />` +
                        `<i id="${fallbackId}" class="fa-solid fa-image me-2" style="display:none;color:#999;font-size:15px;"></i>`;
                } else {
                    // Icon là Font Awesome class
                    prefix = `<i class="${icon} me-2" style="font-size: 15px;"></i>`;
                }
            }

            // Hiển thị platform name | category name
            const displayText = platform && category ? `${platform} | ${category}` : item.text;
            return $(`<div class="d-flex align-items-center">${prefix}<span>${displayText}</span></div>`);
        }

        // Load existing translated names on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Get service name data from backend
            const serviceName = @json($service->name ?? []);
            
            // Check if serviceName is an object with multiple languages
            if (typeof serviceName === 'object' && serviceName !== null) {
                // Loop through all languages except 'en' (already displayed)
                Object.keys(serviceName).forEach(langCode => {
                    if (langCode !== 'en' && serviceName[langCode]) {
                        // Get flag code (vi -> vn for Vietnam)
                        const flagCode = langCode === 'vi' ? 'vn' : langCode;
                        
                        // Create translated name field - matching the structure
                        const container = document.getElementById('div-translated-name');
                        if (container) {
                            const fieldHtml = `
                                <div class="mb-5 div-translated-${langCode}" data-language="${langCode}">
                                    <div class="input-group input-group-solid">
                                        <span class="input-group-text bg-secondary">
                                            <span class="rounded-1 fi fi-${flagCode} fs-5 me-2"></span>
                                            <span>${langCode.toUpperCase()}</span>
                                        </span>
                                        <input type="text" 
                                               class="form-control ipt-service-translated-name" 
                                               data-lang="${langCode}"
                                               name="name[${langCode}]"
                                               value="${serviceName[langCode]}">
                                    </div>
                                </div>
                            `;
                            
                            container.insertAdjacentHTML('beforeend', fieldHtml);
                        }
                    }
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Xóa các wrapper span Select2 cũ
            document.querySelectorAll('.select2.select2-container').forEach(el => {
                el.remove();
            });

            // Xóa các class select2-hidden-accessible và các attribute cũ
            document.querySelectorAll('.select2-hidden-accessible').forEach(el => {
                el.classList.remove('select2-hidden-accessible');
                el.removeAttribute('data-select2-id');
                el.removeAttribute('tabindex');
                el.removeAttribute('aria-hidden');
                el.removeAttribute('data-kt-initialized');
            });

            // Khởi tạo Select2 cho tất cả các select có data-kt-select2="true"
            $('[data-kt-select2="true"]').each(function() {
                const $select = $(this);

                if (!$select.hasClass('ql-size') && !$select.hasClass('ql-header') && !$select.hasClass(
                        'ql-color') && !$select.hasClass('ql-background')) {

                    // Destroy Select2 cũ nếu đã tồn tại
                    if ($select.data('select2')) {
                        $select.select2('destroy');
                    }

                    let options = {
                        allowClear: false,
                        minimumResultsForSearch: 0,
                        width: '100%',
                        dropdownParent: $select.closest('.modal').length ? $select.closest(
                            '.modal') : $(document.body),
                        escapeMarkup: function(m) {
                            return m;
                        },
                        // Luôn áp dụng formatOption cho TẤT CẢ select2 (bao gồm category)
                        templateResult: formatCategoryOption,
                        templateSelection: formatSelection,
                        // Tự động đóng select sau khi chọn option
                        closeOnSelect: true
                    };

                    // Nếu có data-hide-search="true" thì ẩn search
                    if ($select.attr('data-hide-search') === 'true') {
                        options.minimumResultsForSearch = Infinity;
                    }

                    // Nếu là multiple select
                    if ($select.attr('multiple')) {
                        options.allowClear = true;
                        options.closeOnSelect = false;
                    }

                    // Khởi tạo Select2
                    $select.select2(options);

                    // Đóng select sau khi chọn option (cho single select)
                    if (!$select.attr('multiple')) {
                        $select.on('select2:select', function(e) {
                            // Tự động đóng dropdown sau khi chọn
                            setTimeout(() => {
                                $select.select2('close');
                            }, 50);
                        });
                    }

                    // Xử lý disable/enable options cho multiple select
                    if ($select.attr('multiple')) {
                        $select.on('select2:select', function(e) {
                            const selectedValue = e.params.data.id;

                            // Disable option đã chọn
                            $select.find('option[value="' + selectedValue + '"]').prop(
                                'disabled', true);

                            // Cập nhật lại dropdown
                            $select.select2('close');
                            setTimeout(() => $select.select2('open'), 10);
                        });

                        $select.on('select2:unselect', function(e) {
                            const unselectedValue = e.params.data.id;

                            // Enable lại option đã bỏ chọn
                            $select.find('option[value="' + unselectedValue + '"]').prop(
                                'disabled', false);

                            // Cập nhật lại dropdown
                            $select.select2('close');
                            setTimeout(() => $select.select2('open'), 10);
                        });
                    }
                }
            });

            // Trigger change event để cập nhật hiển thị icon cho tất cả select
            $('[data-kt-select2="true"]').trigger('change.select2');

            // Ẩn loader sau khi khởi tạo Select2 xong (nếu không phải API mode)
            const serviceType = '{{ $service->type ?? 'manual' }}';
            const providerId = '{{ $service->provider_id ?? '0' }}';

            // Chỉ ẩn loader nếu không phải API mode hoặc không có provider
            // (Nếu là API mode với provider, loader sẽ được ẩn sau khi load xong dịch vụ)
            if (serviceType !== 'api' || providerId === '0') {
                if (typeof hideFullScreenLoader === 'function') {
                    setTimeout(() => {
                        hideFullScreenLoader();
                    }, 300);
                }
            }
        });

        // Function để toggle hiển thị các phần tử dựa trên loại kết nối
        function toggleConnectionType(type) {
            const divOpriceManual = document.querySelector('.div-oprice-manual');
            const divTypeApiContainer = document.querySelector('.div-type-api-container');
            const divOprice = document.querySelector('.div-oprice');

            if (type === 'api') {
                // Hiển thị nhà cung cấp, dịch vụ, giá nhà cung cấp
                if (divTypeApiContainer) {
                    divTypeApiContainer.style.display = '';
                }
                if (divOpriceManual) {
                    divOpriceManual.style.display = 'none';
                }
            } else if (type === 'manual') {
                // Ẩn nhà cung cấp, dịch vụ, hiển thị giá nhà cung cấp (chiếm col-lg-10)
                if (divTypeApiContainer) {
                    divTypeApiContainer.style.display = 'none';
                }
                if (divOpriceManual) {
                    divOpriceManual.style.display = '';
                }
            }
        }

        // Khởi tạo trạng thái ban đầu khi trang load
        document.addEventListener('DOMContentLoaded', function() {
            const serviceType = '{{ $service->type ?? 'manual' }}';
            const providerId = '{{ $service->provider_id ?? '0' }}';

            const selectType = document.querySelector('.sl-service-add-type');

            // Set dạng kết nối từ dữ liệu service
            if (selectType && serviceType) {
                selectType.value = serviceType;
                if (window.$ && $(selectType).data('select2')) {
                    $(selectType).trigger('change');
                }
                toggleConnectionType(serviceType);
            }

            // Nếu là API và có provider được chọn, load dữ liệu service
            if (serviceType === 'api' && providerId !== '0') {
                toggleConnectionType('api');
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2 for category select with icon support
            $('.sl-category').select2({
                allowClear: true,
                width: '100%',
                templateResult: formatCategoryOption,
                templateSelection: formatCategoryOption
            });

            // Initialize Select2 for other selects
            $('.select2-hidden-accessible:not(.sl-category)').select2({
                allowClear: true,
                width: '100%'
            });

            // Auto focus search field when Select2 opens
            $(document).on('select2:open', function() {
                $('.select2-search__field').focus();
            });

            // Populate attributes from service data
            // Selected attributes for update
            const attributesSelect = document.querySelector('.sl-features');
            if (attributesSelect) {
                // Get existing attributes from service data
                // Service model casts attributes as array, so it should be an array
                const existingAttributes = <?php echo json_encode($service->attributes ?? [], JSON_UNESCAPED_UNICODE) ?>;
                let selectedAttributes = [];
                
                // Handle attributes - should be array from model
                if (existingAttributes) {
                    if (Array.isArray(existingAttributes)) {
                        // Filter out empty values
                        selectedAttributes = existingAttributes.filter(attr => attr && attr.trim && attr.trim() !== '');
                    } else if (typeof existingAttributes === 'string' && existingAttributes.trim() !== '') {
                        // If somehow it's a string, try to parse
                        try {
                            const parsed = JSON.parse(existingAttributes);
                            selectedAttributes = Array.isArray(parsed) ? parsed : [];
                        } catch (e) {
                            selectedAttributes = [];
                        }
                    }
                }
                
                // Set selected values using Select2
                if (selectedAttributes && selectedAttributes.length > 0) {
                    if (window.$ && $(attributesSelect).data('select2')) {
                        $(attributesSelect).val(selectedAttributes).trigger('change');
                    } else {
                        // Fallback for native select
                        Array.from(attributesSelect.options).forEach(option => {
                            option.selected = selectedAttributes.includes(option.value);
                        });
                    }
                }
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const providerSelect = document.querySelector('.sl-provider');
            const serviceSelect = document.querySelector('.sl-provider-sid');
            const serviceInput = document.querySelector('.ipt-provider-sid');

            if (!providerSelect) return;

            // Function to auto-select attributes based on service data
            window.autoSelectAttributes = function(serviceData) {
                const attributesSelect = document.querySelector('.sl-features');
                if (!attributesSelect) return;

                const selectedAttributes = [];

                // Xác định attributes dựa trên thông tin dịch vụ
                // 1. Kiểm tra type dịch vụ
                if (serviceData.type) {
                    const typeStr = serviceData.type.toLowerCase();
                    
                    // Nếu là Custom Reactions, Custom Comments, etc.
                    if (typeStr.includes('custom') || typeStr.includes('reaction') || typeStr.includes('comment')) {
                        selectedAttributes.push('Exclusive');
                    }
                    
                    // Nếu là Package
                    if (typeStr.includes('package')) {
                        selectedAttributes.push('Package');
                    }
                }

                // 2. Kiểm tra refill
                if (serviceData.refill) {
                    selectedAttributes.push('7 days Refill');
                }

                // 3. Kiểm tra cancel
                if (serviceData.cancel) {
                    selectedAttributes.push('Cancel Button');
                }

                // 4. Kiểm tra dripfeed
                if (serviceData.dripfeed) {
                    selectedAttributes.push('Super Fast');
                }

                // 5. Kiểm tra rate (giá gốc) - nếu giá thấp thì là "Real"
                if (serviceData.rate && parseFloat(serviceData.rate) > 0) {
                    selectedAttributes.push('Real');
                }

                // 6. Kiểm tra min/max - nếu min cao thì là "Provider Direct"
                if (serviceData.min && parseInt(serviceData.min) >= 100) {
                    selectedAttributes.push('Provider Direct');
                }

                // 7. Kiểm tra name - nếu chứa "Instant" thì thêm "Instant"
                if (serviceData.name && serviceData.name.toLowerCase().includes('instant')) {
                    selectedAttributes.push('Instant');
                }

                // Loại bỏ duplicates
                const uniqueAttributes = [...new Set(selectedAttributes)];

                // Set selected values
                if (uniqueAttributes.length > 0) {
                    $(attributesSelect).val(uniqueAttributes).trigger('change');
                }
            };

            // Xử lý khi thay đổi provider - lưu lại, chờ user click vào select dịch vụ
            providerSelect.addEventListener('change', function() {
                const providerId = this.value;

                if (providerId === '0') {
                    window.pendingProviderId = null;
                    window.providerServicesLoaded = false;
                    if (serviceSelect) {
                        serviceSelect.innerHTML = '<option value="0">Chọn</option>';
                        if (window.$ && $(serviceSelect).data('select2')) {
                            $(serviceSelect).trigger('change');
                        }
                    }
                    const displayProviderRate = document.querySelector('.ipt-service-oprice');
                    if (displayProviderRate) displayProviderRate.value = '';
                    return;
                }

                // Lưu provider id, reset flag, chờ user click vào select dịch vụ
                window.pendingProviderId = providerId;
                window.providerServicesLoaded = false;
                if (serviceSelect) {
                    serviceSelect.innerHTML = '<option value="0">Chọn</option>';
                    if (window.$ && $(serviceSelect).data('select2')) {
                        $(serviceSelect).trigger('change');
                    }
                }
            });

            // Select2 select event cho provider
            if (window.$) {
                $(providerSelect).on('select2:select', function(e) {
                    const providerId = e.params.data.id;
                    if (!providerId || providerId === '0') return;
                    window.pendingProviderId = providerId;
                    window.providerServicesLoaded = false;
                    if (serviceSelect) {
                        serviceSelect.innerHTML = '<option value="0">Chọn</option>';
                        if ($(serviceSelect).data('select2')) $(serviceSelect).trigger('change');
                    }
                });
            }

            // Xử lý khi thay đổi dịch vụ
            if (serviceSelect) {
                serviceSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    
                    if (this.value === '0') {
                        if (serviceInput) {
                            serviceInput.style.display = 'none';
                            serviceInput.value = '';
                        }
                        // Clear provider info
                        const displayProviderRate = document.querySelector('.ipt-service-oprice');
                        if (displayProviderRate) displayProviderRate.value = '';
                    } else {
                        // Hiển thị thông tin dịch vụ
                        const dataInfo = selectedOption.getAttribute('data-service-info');
                        
                        if (dataInfo && serviceInput) {
                            try {
                                const serviceData = JSON.parse(dataInfo);
                                
                                serviceInput.value = JSON.stringify(serviceData, null, 2);
                                serviceInput.style.display = 'block';

                                // Hiển thị provider info (giá gốc)
                                const displayProviderRate = document.querySelector('.ipt-service-oprice');
                                if (displayProviderRate) displayProviderRate.value = serviceData.rate;

                                // Cập nhật hidden inputs
                                document.querySelector('.ipt-service-api').value = serviceData.service;
                                document.querySelector('.ipt-provider-name').value = document.querySelector(
                                    '.sl-provider').options[document.querySelector('.sl-provider')
                                    .selectedIndex].text;

                                // Auto-select attributes dựa trên thông tin dịch vụ
                                autoSelectAttributes(serviceData);
                            } catch (e) {
                                // Error handling silently
                            }
                        }
                    }
                });
            }

            // Nếu có provider được chọn sẵn, load dịch vụ với autoSelect = true (chỉ 1 lần)
            if (providerSelect.value !== '0' && !window.providerServicesLoaded) {
                window.providerServicesLoaded = true;
                loadProviderServices(providerSelect.value, true, true);
            } else {
                // Nếu chưa có provider, init pendingProviderId = null
                window.pendingProviderId = null;
                window.providerServicesLoaded = false;
            }

            // Lazy load: khi user click vào select dịch vụ mới load (dùng cho trường hợp đổi provider thủ công)
            if (serviceSelect && window.$) {
                $(serviceSelect).on('select2:opening', function() {
                    if (window.pendingProviderId && !window.providerServicesLoaded) {
                        window.providerServicesLoaded = true;
                        loadProviderServices(window.pendingProviderId, true, false);
                        return false; // Ngăn dropdown mở ngay, chờ load xong
                    }
                });
            }
        });

        function loadProviderServices(providerId, showLoader = true, autoSelect = false) {
            const serviceSelect = document.querySelector('.sl-provider-sid');
            const serviceInput = document.querySelector('.ipt-provider-sid');
            const currentServiceApi = document.querySelector('.ipt-service-api');

            if (!serviceSelect) return Promise.reject('Service select not found');

            // Chỉ lấy service_api để auto-select nếu autoSelect = true
            const savedServiceApi = autoSelect && currentServiceApi ? currentServiceApi.value : null;

            // Hiển thị full screen loader toàn màn hình nếu cần
            if (showLoader) {
                showFullScreenLoader('', '');
            }

            // Disable select, giữ "Chọn" trong khi đang load
            serviceSelect.disabled = true;
            serviceSelect.innerHTML = '<option value="0">Chọn</option>';
            if (window.$ && $(serviceSelect).data('select2')) {
                $(serviceSelect).trigger('change');
            }

            // Lấy URL từ route
            const url = `/admin/services/provider/${providerId}/services`;

            return fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success && data.services && Array.isArray(data.services)) {
                        // Thêm oCption "Chọn" đầu tiên rồi mới thêm services
                        serviceSelect.innerHTML = '<option value="0">Chọn</option>';

                        let foundMatch = false;

                        // Thêm các dịch vụ vào select
                        data.services.forEach((service, index) => {
                            const option = document.createElement('option');
                            const serviceId = service.id || service.service;
                            option.value = serviceId;

                            // Format text hiển thị - bỏ trailing zeros
                            const rateFormatted = parseFloat(parseFloat(service.rate).toFixed(10)).toString();
                            const displayText = `${serviceId} - ${service.name} - ${rateFormatted}`;
                            option.textContent = displayText;

                            // Lưu thông tin dịch vụ dưới dạng JSON string
                            const serviceInfo = {
                                service: serviceId,
                                name: service.name,
                                type: service.type || 'Default',
                                rate: service.rate,
                                min: service.min,
                                max: service.max,
                                dripfeed: service.dripfeed || false,
                                refill: service.refill || false,
                                cancel: service.cancel || false,
                                description: service.description || '',
                                platform: service.platform || null,
                                category: service.category || null,
                                title: service.title || null,
                            };

                            // Lưu dữ liệu dưới dạng data attribute (JSON string)
                            option.setAttribute('data-service-info', JSON.stringify(serviceInfo));
                            // Thêm icon cho option (dùng cho Select2 formatting)
                            option.setAttribute('data-icon', 'fa-solid fa-cogs');

                            // Auto-select nếu trùng với service_api đã lưu (chỉ khi autoSelect = true)
                            if (savedServiceApi && String(serviceId) === String(savedServiceApi)) {
                                option.selected = true;
                                foundMatch = true;
                            }

                            serviceSelect.appendChild(option);
                        });
                        
                        serviceSelect.disabled = false;

                        // Reinitialize Select2 với formatting
                        if (window.$ && $(serviceSelect).data('select2')) {
                            $(serviceSelect).trigger('change');
                        }

                        // Nếu đã auto-select service, trigger change event để cập nhật thông tin
                        if (foundMatch) {
                            // Trigger native change event
                            serviceSelect.dispatchEvent(new Event('change', { bubbles: true }));
                        }

                        return data;
                    } else {
                        serviceSelect.innerHTML = '<option value="0">Không có dịch vụ</option>';
                        serviceSelect.disabled = false;

                        if (serviceInput) {
                            serviceInput.style.display = 'none';
                            serviceInput.value = '';
                        }

                        throw new Error('No services found');
                    }
                })
                .catch((error) => {
                    serviceSelect.innerHTML = '<option value="0">Lỗi tải dịch vụ</option>';
                    serviceSelect.disabled = false;

                    if (serviceInput) {
                        serviceInput.style.display = 'none';
                        serviceInput.value = '';
                    }
                    throw error;
                })
                .finally(() => {
                    // Ẩn loader sau khi hoàn tất (chỉ khi showLoader = true)
                    if (showLoader) {
                        hideFullScreenLoader();
                    }
                });
        }
    </script>

    <script>
        // Initialize selected attributes on page load with polling for Select2
        document.addEventListener('DOMContentLoaded', function() {
            const attributesSelect = document.querySelector('.sl-features');
            if (!attributesSelect) {

                return;
            }

            // Get current attributes from service
            const currentAttributes = @json($service->attributes ?? []);
            






            
            if (currentAttributes && currentAttributes.length > 0) {
                // Poll for Select2 initialization (max 5 seconds)
                let pollCount = 0;
                const maxPolls = 50; // 50 * 100ms = 5 seconds
                
                const pollInterval = setInterval(() => {
                    pollCount++;
                    
                    // Check if Select2 is initialized
                    if (window.$ && $(attributesSelect).data('select2')) {
                        clearInterval(pollInterval);
                        


                        
                        // Set selected values
                        $(attributesSelect).val(currentAttributes).trigger('change');
                        
                        // Verify values were set
                        const verifyValues = $(attributesSelect).val();



                        
                        // Show alert if values weren't set
                        if (!verifyValues || verifyValues.length === 0) {
                            alert('WARNING: Attributes were not set in Select2!\n\nExpected: ' + JSON.stringify(currentAttributes) + '\nActual: ' + JSON.stringify(verifyValues));
                        }
                    } else if (pollCount >= maxPolls) {
                        // Timeout - Select2 not initialized, use fallback
                        clearInterval(pollInterval);
                        

                        alert('WARNING: Select2 not initialized after 5 seconds!\n\nUsing fallback method.');
                        
                        // Fallback to native select
                        Array.from(attributesSelect.options).forEach(option => {
                            option.selected = currentAttributes.includes(option.value);
                        });
                        

                    }
                }, 100); // Poll every 100ms
            } else {


                
                // Show alert if database has no attributes
                if (currentAttributes.length === 0) {

                }
            }
        });
    </script>
@endsection
