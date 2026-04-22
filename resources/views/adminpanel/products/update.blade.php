@extends('adminpanel.layouts.app')
@section('title', 'Products')
@section('content')
    <div class="content flex-row-fluid" id="kt_content"><span class="title d-none">Edit</span>

        {{-- Card 1: Thông tin cơ bản --}}
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <div class="row g-5 mb-5">
                    {{-- Dạng kết nối --}}
                    <div class="col-lg-2">
                        <label class="required form-label">Dạng kết nối</label>
                        <select class="form-select form-select-solid sl-product-add-type" data-kt-select2="true"
                            data-placeholder="Chọn" data-hide-search="true" tabindex="-1" aria-hidden="true"
                            onchange="_products.on.change.addType(this.value)">
                            <option value="Manual" {{ ($product->type ?? 'Manual') === 'Manual' ? 'selected' : '' }}>Thủ
                                công</option>
                            <option value="Api" {{ ($product->type ?? '') === 'Api' ? 'selected' : '' }}>API</option>
                        </select>
                    </div>

                    {{-- Nhà cung cấp (API) / Giá vốn (Manual) --}}
                    <div class="col-lg-10">
                        <div class="div-add-type div-add-type-api"
                            style="{{ ($product->type ?? 'Manual') === 'Api' ? '' : 'display:none;' }}">
                            <div class="row g-5">
                                <div class="col-lg-3">
                                    <label class="required form-label">Nhà cung cấp</label>
                                    <select class="form-select form-select-solid sl-provider" data-kt-select2="true"
                                        data-placeholder="Chọn" data-allow-clear="false" tabindex="-1" aria-hidden="true"
                                        onchange="_products.on.change.provider(this.value)">
                                        <option></option>
                                        @foreach ($providers as $prov)
                                            <option value="{{ $prov->id }}" data-rate="{{ $prov->rate_api ?? 1 }}"
                                                data-fixed-decimal="{{ $prov->fixed_decimal ?? 10 }}"
                                                {{ ($product->api_provider_id ?? '') == $prov->id ? 'selected' : '' }}>
                                                {{ $prov->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-9 div-provider-product"
                                    style="{{ $product->api_provider_id ?? '' ? '' : 'display:none;' }}">
                                    <label class="required form-label">Sản phẩm</label>
                                    <select class="form-select form-select-solid sl-provider-pid" data-control="select2"
                                        data-placeholder="Chọn sản phẩm" data-allow-clear="false"
                                        onchange="_products.on.change.providerProduct(this.value)">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="div-add-type div-add-type-manual"
                            style="{{ ($product->type ?? 'Manual') === 'Manual' ? '' : 'display:none;' }}">
                            <label class="required form-label">Giá vốn</label>
                            <input type="number" class="form-control form-control-solid ipt-cost-price"
                                value="{{ $product->cost_price ?? '' }}"
                                onkeyup="_products.on.keyup.costPrice(this.value)">
                        </div>
                    </div>

                    {{-- Trạng thái --}}
                    <div class="col-lg-12">
                        <label class="required form-label">Trạng thái</label>
                        <select class="form-select form-select-solid sl-status" data-kt-select2="true"
                            data-placeholder="Chọn" data-hide-search="true" tabindex="-1" aria-hidden="true">
                            <option value="In stock" {{ ($product->status ?? '') === 'In stock' ? 'selected' : '' }}>Còn
                                hàng</option>
                            <option value="Out of stock"
                                {{ ($product->status ?? '') === 'Out of stock' ? 'selected' : '' }}>Hết hàng</option>
                            <option value="Inactive" {{ ($product->status ?? '') === 'Inactive' ? 'selected' : '' }}>Vô
                                hiệu hóa</option>
                        </select>
                    </div>
                </div>

                {{-- Tên & Slug --}}
                <div class="row g-5 mb-5">
                    <div class="col-lg-12">
                        <div class="mb-5">
                            <label class="required form-label">Tên</label>
                            <input type="text" class="form-control form-control-solid ipt-name"
                                value="{{ $product->name ?? '' }}"
                                onkeyup="document.querySelector('.ipt-slug').value = _products.slug(this.value.trim())">
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Slug</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-solid ipt-slug"
                                    value="{{ $product->slug ?? '' }}" disabled>
                                <span class="input-group-text pointer" onclick="_products.on.click.editSlug()"
                                    title="Chỉnh sửa slug">
                                    <i class="fas fa-pencil"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Danh mục & Nhóm --}}
                <div class="row g-5 mb-5">
                    <div class="col-lg-4">
                        <label class="required form-label">Danh mục</label>
                        <select class="form-select form-select-solid sl-category" data-kt-select2="true"
                            data-placeholder="Chọn danh mục" data-allow-clear="false" tabindex="-1" aria-hidden="true">
                            <option></option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ ($product->product_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Nhóm</label>
                        <select class="form-select form-select-solid sl-group" data-kt-select2="true"
                            data-placeholder="Không có nhóm" data-allow-clear="false" tabindex="-1" aria-hidden="true"
                            onchange="document.querySelector('.div-group').style.display = this.value > 0 ? '' : 'none';">
                            <option value="0">Không có nhóm</option>
                            @foreach ($groups as $grp)
                                <option value="{{ $grp->id }}"
                                    {{ ($product->product_group_id ?? 0) == $grp->id ? 'selected' : '' }}>
                                    {{ $grp->id }} - {{ $grp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 div-group"
                        style="{{ ($product->product_group_id ?? 0) > 0 ? '' : 'display:none;' }}">
                        <label class="form-label">Tên nhãn</label>
                        <input type="text" class="form-control form-control-solid ipt-group-tag"
                            value="{{ $product->group_tag ?? '' }}" placeholder="Ví dụ: 1 tháng, VIP...">
                    </div>
                </div>

                {{-- Hình ảnh --}}
                <div class="row g-5">
                    <div class="col-lg-12">
                        <label class="form-label">Hình ảnh (460x215)</label>
                        <input type="text" class="form-control form-control-solid ipt-thumbnail"
                            value="{{ $product->thumbnail ?? '' }}" placeholder="Link hình ảnh"
                            onkeyup="document.querySelector('.img-preview').src = this.value">
                        <span class="text-muted fst-italic fs-8">Hình ảnh tham khảo:
                            <a href="https://cdn.whoispanel.com/product_thumbnail/" target="_blank">Truy cập</a>
                        </span>
                        <div class="mt-2">
                            <img src="{{ $product->thumbnail ?? '' }}" class="img-preview rounded" width="300"
                                style="{{ $product->thumbnail ?? '' ? '' : 'display:none;' }}"
                                onerror="this.style.display='none'" onload="this.style.display=''">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Giá & Số lượng --}}
        <div class="card shadow-sm mb-5">
            <div class="card-header div-add-type div-add-type-api"
                style="{{ ($product->type ?? 'Manual') === 'Api' ? '' : 'display:none;' }}">
                <div class="card-title">
                    <div class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input cb-product-sync" type="checkbox"
                            {{ $product->sync ?? false ? 'checked' : '' }}
                            onchange="_products.on.change.syncprice(this.checked)">
                        <label class="form-check-label fs-6 fw-bold">Tự động đồng bộ giá</label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-5 mb-5">
                    <div class="col-lg-4">
                        <label class="required form-label">Giá bán lẻ</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary">$</span>
                            <input type="number" class="form-control ipt-product-price" step="any"
                                value="{{ $product->price ?? '' }}">
                            <input type="text" class="form-control text-end ipt-product-price-percent"
                                value="{{ $product->price_percent ?? 110 }}" style="max-width:70px;"
                                onkeyup="_products.on.keyup.pricePercent('price', this.value)">
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="required form-label">Giá đại lý</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary">$</span>
                            <input type="number" class="form-control ipt-product-price-1" step="any"
                                value="{{ $product->price_1 ?? '' }}">
                            <input type="text" class="form-control text-end ipt-product-price-1-percent"
                                value="{{ $product->price_1_percent ?? 108 }}" style="max-width:70px;"
                                onkeyup="_products.on.keyup.pricePercent('price_1', this.value)">
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label class="required form-label">Giá nhà phân phối</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary">$</span>
                            <input type="number" class="form-control ipt-product-price-2" step="any"
                                value="{{ $product->price_2 ?? '' }}">
                            <input type="text" class="form-control text-end ipt-product-price-2-percent"
                                value="{{ $product->price_2_percent ?? 105 }}" style="max-width:70px;"
                                onkeyup="_products.on.keyup.pricePercent('price_2', this.value)">
                            <span class="input-group-text bg-secondary">%</span>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-lg-6">
                        <label class="required form-label">SL đặt hàng: Tối thiểu - Tối đa</label>
                        <div class="input-group">
                            <input type="number" class="form-control ipt-product-min" value="{{ $product->min ?? 1 }}"
                                min="1">
                            <span class="input-group-text bg-secondary">-</span>
                            <input type="number" class="form-control ipt-product-max" value="{{ $product->max ?? 1 }}"
                                min="1">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-5 div-add-type div-add-type-manual " style="">
            <div class="card-body">
                <div class="row g-6">
                    <div class="col-lg-12">
                        <label class="required form-label">Kiểu xử lý</label>
                        <select class="form-select form-select-solid sl-type" data-control="select2"
                            data-hide-search="true" onchange="_products.on.change.processType(this.value)">
                            <option value="Manual"
                                {{ ($product->process_type ?? 'Manual') === 'Manual' ? 'selected' : '' }}>Thủ công</option>
                            <option value="Auto" {{ ($product->process_type ?? '') === 'Auto' ? 'selected' : '' }}>Tự
                                động</option>
                            <option value="Service" {{ ($product->process_type ?? '') === 'Service' ? 'selected' : '' }}>
                                Kết hợp dịch vụ</option>
                            <option value="Veo3" {{ ($product->process_type ?? '') === 'Veo3' ? 'selected' : '' }}>Veo3
                            </option>
                            <option value="NEW_VEO3"
                                {{ ($product->process_type ?? '') === 'NEW_VEO3' ? 'selected' : '' }}>NEW_VEO3</option>
                            <option value="VEO2_QUALITY"
                                {{ ($product->process_type ?? '') === 'VEO2_QUALITY' ? 'selected' : '' }}>VEO2_QUALITY
                            </option>
                            <option value="VEO2_FAST"
                                {{ ($product->process_type ?? '') === 'VEO2_FAST' ? 'selected' : '' }}>VEO2_FAST</option>
                            <option value="HAILUO_V2_768P_6S"
                                {{ ($product->process_type ?? '') === 'HAILUO_V2_768P_6S' ? 'selected' : '' }}>
                                HAILUO_V2_768P_6S</option>
                            <option value="HAILUO_V2_1080P_6S"
                                {{ ($product->process_type ?? '') === 'HAILUO_V2_1080P_6S' ? 'selected' : '' }}>
                                HAILUO_V2_1080P_6S</option>
                            <option value="HAILUO_V2_768P_10S"
                                {{ ($product->process_type ?? '') === 'HAILUO_V2_768P_10S' ? 'selected' : '' }}>
                                HAILUO_V2_768P_10S</option>
                            <option value="KLING_1_6_5S"
                                {{ ($product->process_type ?? '') === 'KLING_1_6_5S' ? 'selected' : '' }}>KLING_1_6_5S
                            </option>
                            <option value="KLING_1_6_10S"
                                {{ ($product->process_type ?? '') === 'KLING_1_6_10S' ? 'selected' : '' }}>KLING_1_6_10S
                            </option>
                            <option value="KLING_2_1_5S"
                                {{ ($product->process_type ?? '') === 'KLING_2_1_5S' ? 'selected' : '' }}>KLING_2_1_5S
                            </option>
                            <option value="KLING_2_1_10S"
                                {{ ($product->process_type ?? '') === 'KLING_2_1_10S' ? 'selected' : '' }}>KLING_2_1_10S
                            </option>
                            <option value="AI_IMAGE_DEFAULT"
                                {{ ($product->process_type ?? '') === 'AI_IMAGE_DEFAULT' ? 'selected' : '' }}>
                                AI_IMAGE_DEFAULT</option>
                            <option value="AI_VIDEO_DEFAULT"
                                {{ ($product->process_type ?? '') === 'AI_VIDEO_DEFAULT' ? 'selected' : '' }}>
                                AI_VIDEO_DEFAULT</option>
                            <option value="AI_VOICE_DEFAULT"
                                {{ ($product->process_type ?? '') === 'AI_VOICE_DEFAULT' ? 'selected' : '' }}>
                                AI_VOICE_DEFAULT</option>
                            <option value="GG_IMAGE_3_5"
                                {{ ($product->process_type ?? '') === 'GG_IMAGE_3_5' ? 'selected' : '' }}>GG_IMAGE_3_5
                            </option>
                            <option value="GG_IMAGE_3_1"
                                {{ ($product->process_type ?? '') === 'GG_IMAGE_3_1' ? 'selected' : '' }}>GG_IMAGE_3_1
                            </option>
                            <option value="HAILUO_IMAGE_01"
                                {{ ($product->process_type ?? '') === 'HAILUO_IMAGE_01' ? 'selected' : '' }}>
                                HAILUO_IMAGE_01</option>
                            <option value="KLING_COLORS_2_1"
                                {{ ($product->process_type ?? '') === 'KLING_COLORS_2_1' ? 'selected' : '' }}>
                                KLING_COLORS_2_1</option>
                            <option value="KLING_COLORS_2_0"
                                {{ ($product->process_type ?? '') === 'KLING_COLORS_2_0' ? 'selected' : '' }}>
                                KLING_COLORS_2_0</option>
                            <option value="KLING_COLORS_1_5"
                                {{ ($product->process_type ?? '') === 'KLING_COLORS_1_5' ? 'selected' : '' }}>
                                KLING_COLORS_1_5</option>
                            <option value="AI_IMAGE_OLD"
                                {{ ($product->process_type ?? '') === 'AI_IMAGE_OLD' ? 'selected' : '' }}>AI_IMAGE_OLD
                            </option>
                            <option value="AI_VIDEO_OLD"
                                {{ ($product->process_type ?? '') === 'AI_VIDEO_OLD' ? 'selected' : '' }}>AI_VIDEO_OLD
                            </option>
                            <option value="AI_VIDEO_VIETAUTO"
                                {{ ($product->process_type ?? '') === 'AI_VIDEO_VIETAUTO' ? 'selected' : '' }}>
                                AI_VIDEO_VIETAUTO</option>
                            <option value="AI_IMAGE_VIETAUTO"
                                {{ ($product->process_type ?? '') === 'AI_IMAGE_VIETAUTO' ? 'selected' : '' }}>
                                AI_IMAGE_VIETAUTO</option>
                            <option value="ANS" {{ ($product->process_type ?? '') === 'ANS' ? 'selected' : '' }}>ANS
                            </option>
                        </select>
                        <input type="hidden" class="ipt-inventory-api" value="0">
                    </div>
                    <div class="col-lg-12 div-process-type div-warehouse" style="display: none;">
                        <label class="required form-label" data-lang="">Kho sản phẩm</label>
                        <select class="form-select form-select-solid sl-warehouse select2-hidden-accessible"
                            data-control="select2" data-hide-search="true" data-select2-id="select2-data-23-h1pd"
                            tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                            <option value="0" data-page="common" data-lang=""
                                data-select2-id="select2-data-25-qy55">Chọn</option>
                            <option value="1">Nhóm zalo</option>
                        </select>
                    </div>
                    <div class="col-lg-12 div-process-type div-service" style="display: none;">
                        <div class="row g-6">
                            <div class="col-lg-8 col-12">
                                <select class="form-select form-select-solid sl-service select2-hidden-accessible"
                                    data-control="select2" data-placeholder="Chọn dịch vụ"
                                    data-select2-id="select2-data-26-s2r7" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option data-select2-id="select2-data-28-ua75"></option>
                                    <option data-min="10" data-max="500000" value="1531" data-rate="0.1207">1531 -
                                        Facebook Post Reaction | Love ❤️ | Max 100k | Instant | No refill | 5k/Day - $0.1207
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1532" data-rate="0.088">1532 -
                                        Facebook Post Reaction | Care 🥰 | Max 100k | Instant | No refill | 5k/Day - $0.088
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="100000" value="1533" data-rate="0.1498">1533 -
                                        Facebook Post Reaction | WoW 😮 | Max 100k | Instant | No refill | 5k/Day - $0.1498
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1534" data-rate="0.1498">1534 -
                                        Facebook Post Reaction | HaHa 😂 | Max 100k | Instant | No refill | 5k/Day - $0.1498
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1535" data-rate="0.1498">1535 -
                                        Facebook Post Reaction | Sad 😥 | Max 100k | Instant | No refill | 5k/Day - $0.1498
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1536" data-rate="0.1498">1536 -
                                        Facebook Post Reaction | Angry 😡 | Max 100k | Instant | No refill | 5k/Day -
                                        $0.1498 (Min-Max: 10 - 100000)</option>
                                    <option data-min="1" data-max="1" value="1749" data-rate="0.0001">1749 - test
                                        - $0.0001 (Min-Max: 1 - 1)</option>
                                    <option data-min="10" data-max="10" value="1819" data-rate="0.01">1819 - TEST -
                                        $0.01 (Min-Max: 10 - 10)</option>
                                    <option data-min="10" data-max="30000" value="1537" data-rate="0.4116">1537 -
                                        Facebook Post Likes | Max 30K | Super High Quality | Non Drop | Refill 30 Day |
                                        Instant Start | 30K/Day ♻️ - $0.4116 (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="300000" value="1538" data-rate="0.77">1538 -
                                        Facebook Profile Followers Max 30K | Super High Quality | Non Drop | Refill 30 Day |
                                        Instant Start | 5K - 10K/Day♻️ - $0.77 (Min-Max: 10 - 300000)</option>
                                    <option data-min="10" data-max="30000" value="1539" data-rate="0.5388">1539 -
                                        Facebook Page Followers | Max 30K | Super High Quality | Non Drop | Refill 30 Day |
                                        Instant Start | 30K/Day♻️ - $0.5388 (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="100000" value="1540" data-rate="0.56">1540 -
                                        Facebook Page Likes + Followers | Max 1M | | High Quality | Low Drop | 30 Days ♻️ |
                                        Instant Start | Day 50K - $0.56 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="30000" value="1541" data-rate="0.6889">1541 -
                                        Facebook Group Members | Max 30K | Super High Quality | Non Drop | Refill 30 Day |
                                        Instant Start | 30K/Day♻️ - $0.6889 (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="10" value="1558" data-rate="0.1">1558 - TEST -
                                        $0.1 (Min-Max: 10 - 10)</option>
                                    <option data-min="10" data-max="1000000" value="1522" data-rate="0.46">1522 -
                                        TikTok Followers | Max 1M | HQ &amp;amp;amp;amp; Real Profiles | Instant | No Refill
                                        | 50K/Day - $0.46 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1523" data-rate="0.6365">1523 -
                                        TikTok Followers | Max 5M | HQ Real Profiles | Few Drop | Instant | No refill |
                                        100K/Day - $0.6365 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1524" data-rate="0.905">1524 -
                                        TikTok Followers | Max 5M | HQ Real Profiles | Few Drop | Instant | No refill |
                                        100k/Day - $0.905 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1525" data-rate="0.6365">1525 -
                                        TikTok Followers | Max 500k | %100 Real Profiles | Instant | No refill | 20k/day -
                                        $0.6365 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1526" data-rate="0.702">1526 -
                                        TikTok - Followers | Max 5M | WW 🌎| %100 Real Profiles | 50k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.702 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="1527" data-rate="0.75">1527 -
                                        TikTok - Followers | Max 5M | WW 🌎| %100 Real Profiles | 50k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.75 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="20" value="1320" data-rate="0.0875">1320 -
                                        Tiktok Follower | Max 1K | Start 0-1 Hour | 1K/Day⛔ - $0.0875 (Min-Max: 10 - 20)
                                    </option>
                                    <option data-min="20" data-max="20" value="1315" data-rate="0.0875">1315 -
                                        Facebook Post Like [Max: 1K] [Start Time: 0-1 Hr] [Speed: 1K/D] ⛔ - $0.0875
                                        (Min-Max: 20 - 20)</option>
                                    <option data-min="500" data-max="500" value="1316" data-rate="0.004375">1316 -
                                        Facebook Video View [Max: 10K] [Start Time: 0-1 Hr] [Speed: 10K/D] ⛔ - $0.004375
                                        (Min-Max: 500 - 500)</option>
                                    <option data-min="1000000" data-max="100000000" value="1373" data-rate="0.0001">
                                        1373 - TikTok View Video Saller | Instant | Max 100M | No Refill | 10M - 50M/Day -
                                        $0.0001 (Min-Max: 1000000 - 100000000)</option>
                                    <option data-min="10" data-max="30" value="1317" data-rate="0.004375">1317 -
                                        Tiktok Like | Max 1K | Start 0 - 1 Hour | 1K/Day ⛔ - $0.004375 (Min-Max: 10 - 30)
                                    </option>
                                    <option data-min="1000" data-max="1000" value="1318" data-rate="4.38E-5">1318 -
                                        Tiktok View Video | Max 10K | Start 0 - 1 Hour | 10K/Day ⛔ - $4.38E-5 (Min-Max: 1000
                                        - 1000)</option>
                                    <option data-min="10" data-max="50" value="1319" data-rate="0.004375">1319 -
                                        Tiktok Share | Max 1K | Start 0 - 1 Hour | 1K/Day ⛔ - $0.004375 (Min-Max: 10 - 50)
                                    </option>
                                    <option data-min="10000000" data-max="100000000" value="1375" data-rate="0.0001">
                                        1375 - TikTok View Video Saller | Instant | Min 10M | No Refill | 10M - 50M/Day -
                                        $0.0001 (Min-Max: 10000000 - 100000000)</option>
                                    <option data-min="10" data-max="1000000" value="1449" data-rate="0.2274">1449 -
                                        TikTok - Followers | Max 1M | HQ Real People | 20k/Days ~ Instant ~ 𝗥𝗘𝗙𝗜𝗟𝗟 30D
                                        | 🔴 Open Live Stream Before Ordering - $0.2274 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1474" data-rate="0.205">1474 -
                                        TikTok Followers | Max 1M | HQ Real People | Instant | Refill 30 Day | 20K/Day | 🔴
                                        Open Live Stream Before Ordering - $0.205 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="20" data-max="20" value="1321" data-rate="0.0875">1321 -
                                        Facebook Post Like | Max 1K | Start 0-1 Hour | 1K/Day ⛔ - $0.0875 (Min-Max: 20 - 20)
                                    </option>
                                    <option data-min="500" data-max="500" value="1322" data-rate="0.004375">1322 -
                                        Facebook Video View | Max 10K | Start 0 - 1 Hour | 10K/Day⛔ - $0.004375 (Min-Max:
                                        500 - 500)</option>
                                    <option data-min="10000000" data-max="100000000" value="1374" data-rate="0.0001">
                                        1374 - TikTok View Video Saller | Instant | Min 10M | No Refill | 10M - 50M/Day -
                                        $0.0001 (Min-Max: 10000000 - 100000000)</option>
                                    <option data-min="5000" data-max="1000000000" value="1475" data-rate="0.00012">
                                        1475 - TikTok Video Views | Non Drop | Min 5K | 10K/Hour | No Refill | Slow -
                                        $0.00012 (Min-Max: 5000 - 1000000000)</option>
                                    <option data-min="100" data-max="2147483647" value="1470" data-rate="0.0008775">
                                        1470 - TikTok View Video | Max Unlimited | Instant | Refill 7 Day | 10M/Day -
                                        $0.0008775 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1547" data-rate="0.0008775">
                                        1547 - TikTok Views | Instant | 1M/Day | Drop 0 - 5% | Refill 15 Day ⚡ - $0.0008775
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1471" data-rate="0.0057">1471
                                        - TikTok View Video | Max Unlimited | Instant | Refill 7 Day | 10M/Day - $0.0057
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="1000" data-max="100000000" value="1472" data-rate="0.0051975">
                                        1472 - TikTok View Video | Max Unlimited | Instant | 𝐋𝐢𝐟𝐞𝐓𝐢𝐦𝐞 | 10M/Day -
                                        $0.0051975 (Min-Max: 1000 - 100000000)</option>
                                    <option data-min="500" data-max="100000" value="1450" data-rate="0.4">1450 -
                                        Facebook Follow Profile/Page Global | Page Pro5 | Start: 0 - 24 Hour | Refill 30 Day
                                        | 50K/Day - $0.4 (Min-Max: 500 - 100000)</option>
                                    <option data-min="10" data-max="30000" value="1516" data-rate="0.81">1516 -
                                        Facebook Followers Profile/Page | Max 5M | Instant | Refill 30 Day | 50K/Day ♻️ -
                                        $0.81 (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="5000000" value="1517" data-rate="0.45">1517 -
                                        Facebook Followers [ Worldwide 🌍 ] [ Max 500K ] | All Type Profile &amp; Page | Non
                                        Drop | No Refill ⚠️ | Instant Start | Day 100K - $0.45 (Min-Max: 10 - 5000000)
                                    </option>
                                    <option data-min="10" data-max="45000" value="1518" data-rate="0.786">1518 -
                                        Facebook Page Likes + Followers [ Worldwide 🌍 ] [ Max 20K ] | High Quality | No
                                        Refill ⚠️ | Instant Start | Day 20K - $0.786 (Min-Max: 10 - 45000)</option>
                                    <option data-min="10" data-max="100000" value="1519" data-rate="0.62">1519 -
                                        Facebook Page Likes + Followers [ Worldwide 🌍 ] [ Max 100K ] | High Quality | No
                                        Refill ⚠️ | Instant Start | Day 100K - $0.62 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1505" data-rate="0.67">1505 -
                                        TikTok Followers | Max 5M | 100% Real Accounts | No Refill | Instant Start | 20K/Day
                                        - $0.67 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1506" data-rate="0.55">1506 -
                                        TikTok Followers | Max 100K | Real People | Cancel Enable | No Refill | Instant
                                        Start | 2K/Day ⚡ - $0.55 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="10000000" value="1451" data-rate="1500">1451 -
                                        TikTok Follow Vietnam | Max 10K | Instant | 500 - 2K/Day | (Read description) -
                                        $1500 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="5000000" value="1499" data-rate="0.77">1499 -
                                        TikTok Followers | Max 1M | 100% Real | Active Profiles | No Refill | Super fast |
                                        200K/Day - $0.77 (Min-Max: 50 - 5000000)</option>
                                    <option data-min="100" data-max="5000" value="1464" data-rate="0.88">1464 - TikTok
                                        Followers | Max 5K | No refill | Super Fast | 1K/Minutes 🔥 - $0.88 (Min-Max: 100 -
                                        5000)</option>
                                    <option data-min="50" data-max="50000" value="1465" data-rate="0.7785">1465 -
                                        TikTok Followers | Max 1M | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | Instant | 3K - 5K/Day -
                                        $0.7785 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="1000000" value="1466" data-rate="0.9107">1466 -
                                        TikTok Followers | Max 1M | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | Instant | Refill 30 Day
                                        | 3K - 5K/Day - $0.9107 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="200000" value="1467" data-rate="0.88">1467 -
                                        TikTok Followers | Max 200K | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | Instant | 5K/Day -
                                        $0.88 (Min-Max: 50 - 200000)</option>
                                    <option data-min="10" data-max="1000000" value="1468" data-rate="1.45">1468 -
                                        TikTok Followers | Max 1M | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | Instant | 20K/Day -
                                        $1.45 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1469" data-rate="1.55">1469 -
                                        TikTok Followers | Max 1M | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | Instant | Refill 30 Day
                                        | 20K/Day - $1.55 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1452" data-rate="0.011">1452 -
                                        TikTok Likes [ Max 1M ] | Low Quality | Cancel Enable | No Refill ⚠️ | Instant Start
                                        | Day 50K 🚀 - $0.011 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="1453" data-rate="0.027">1453 -
                                        TikTok Likes [ Max 5M ] | Low Quality | Cancel Enable | No Refill ⚠️ | Instant Start
                                        | Day 200K 🚀 - $0.027 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="1454" data-rate="0.028">1454 -
                                        TikTok Likes [ Max 5M ] | Low Quality | Cancel Enable | 60 Days ♻️ | Instant Start |
                                        Day 200K 🚀 - $0.028 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="1455" data-rate="0.03">1455 -
                                        TikTok Likes [ Max 5M ] | Low Quality | Cancel Enable | 365 Days ♻️ | Instant Start
                                        | Day 200K 🚀 - $0.03 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="1456" data-rate="0.032">1456 -
                                        TikTok Likes [ Max 5M ] | Low Quality | Cancel Enable | Lifetime ♻️ | Instant Start
                                        | Day 200K 🚀 - $0.032 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="50000" value="1362" data-rate="0.85">1362 -
                                        TikTok Followers | Non Drop | Fast | HQ &amp;amp;amp;amp;amp;amp;amp; Data Real |
                                        Refill 7 Day | 2K/Day - $0.85 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="1371" data-rate="0.85">1371 -
                                        TikTok Followers | Non Drop | Fast | HQ &amp;amp;amp; Data Real | Refill 15 Day |
                                        10K/Day - $0.85 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="1372" data-rate="0.85">1372 -
                                        TikTok Followers | Non Drop | Fast | HQ &amp;amp; Data Real | Refill 3 Day | 20K -
                                        50K/Day - $0.85 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="1000000" value="1390" data-rate="1.109">1390 -
                                        TikTok Followers VIP | Fast | Instant | No Refill| Data Real | 50K/Day - $1.109
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="100000" value="1611" data-rate="1.25">1611 -
                                        TikTok Followers (Non drop) (Real)(Refill 30 Day)(Instant) - $1.25 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="500" data-max="600000" value="728" data-rate="0.46">728 -
                                        Facebook bot profile/page follow per day 100k - $0.46 (Min-Max: 500 - 600000)
                                    </option>
                                    <option data-min="1" data-max="1" value="1176" data-rate="0">1176 - Facebook
                                        Up Blue Tick Fanpage | Time 0 - 1 Hour | VIP - $0 (Min-Max: 1 - 1)</option>
                                    <option data-min="1000" data-max="10000000" value="576" data-rate="0.48">576 -
                                        YouTube Views | Non Drop | Instant | Fast / Day 10K | Lifetime Guaranteed ⚡🔥♻️ -
                                        $0.48 (Min-Max: 1000 - 10000000)</option>
                                    <option data-min="10" data-max="20000" value="1178" data-rate="0.5556">1178 -
                                        Facebook Story View | Instant | Super Fast | 5K/Day⚡ - $0.5556 (Min-Max: 10 - 20000)
                                    </option>
                                    <option data-min="50" data-max="1000000" value="613" data-rate="1.0146">613 -
                                        TikTok Followers [ Max 5M ] | 𝐋𝐐 | Cancel Enable | NR ⚠️ | Day 500K &gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.0146 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="10" data-max="10000000" value="727" data-rate="4.1952">727 -
                                        TikTok Followers [ Max 10M ] | LQ | No Refill ⚠️ | Instant Start | Day 50K ⚡ -
                                        $4.1952 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="50" data-max="100000" value="1153" data-rate="0.84">1153 -
                                        TikTok Follow Vietnam Sale | Support single stack | Instant | | LQ + Avatar |
                                        2000/Day - $0.84 (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="610" data-rate="3582.27">610 -
                                        TikTok - Người theo dõi | Tối đa 1M | Không bảo hành - $3582.27 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="300000" value="354" data-rate="0.176">354 -
                                        TikTok Likes [Global] [Cancel Enable] [Speed: Day 10K] [Refill: No] - $0.176
                                        (Min-Max: 10 - 300000)</option>
                                    <option data-min="11" data-max="300000" value="349" data-rate="0.0494">349 -
                                        TikTok Likes [Max 300k] [Instant] [Speed: Day 20K] [Refill: No] - $0.0494 (Min-Max:
                                        11 - 300000)</option>
                                    <option data-min="10" data-max="500000" value="344" data-rate="0.0327">344 -
                                        TikTok Likes [Max 500K] [Fast &amp; Instant] [Speed: Day 20k] [Refill: No] - $0.0327
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="50" data-max="100000" value="1081" data-rate="0.84">1081 -
                                        TikTok Follow Vietnamese | Instant | Refill 3 Day | QH + Avatar | 1000 - 2000/Day -
                                        $0.84 (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="10000000" value="351" data-rate="0.0453">351 -
                                        TikTok Likes [Max 100K] [Instant] [Speed: Day 10K] [Refill: No] - $0.0453 (Min-Max:
                                        10 - 10000000)</option>
                                    <option data-min="10" data-max="1000000" value="346" data-rate="0.1045">346 -
                                        TikTok Likes [Max 500K] [Speed: Day 20K] [Refill:No] - $0.1045 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="50" data-max="100000" value="1082" data-rate="0.84">1082 -
                                        TikTok Follow Vn | Instant | Refill 7 Day | 1000 - 2000/Day - $0.84 (Min-Max: 50 -
                                        100000)</option>
                                    <option data-min="50" data-max="5000000" value="604" data-rate="0.125">604 -
                                        Tiktok Followers [Max 5M] [MQ] [Cancel Enable] [20K/D] [No Refill] - $0.125
                                        (Min-Max: 50 - 5000000)</option>
                                    <option data-min="10" data-max="1000000" value="614" data-rate="0.119">614 -
                                        TikTok Followers | Instant | 𝗨𝗹𝘁𝗿𝗮 𝗙𝗮𝘀𝘁 &amp; 𝗨𝗻𝘀𝘁𝗮𝗯𝗹𝗲 | 50K Per
                                        Day ⚡ - $0.119 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="605" data-rate="0.16">605 -
                                        TikTok Followers | Instant | 𝗩𝗜𝗣 𝗨𝗹𝘁𝗿𝗮 𝗙𝗮𝘀𝘁 &amp; 𝗦𝘁𝗮𝗯𝗹𝗲 | 300K
                                        Per Day ⚡⛔ - $0.16 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="11" data-max="100000000" value="353" data-rate="0.0647">353 -
                                        TikTok Likes [Max: 1K] [Cancel Enable] [Speed: Day 20K ] [Refill: No] - $0.0647
                                        (Min-Max: 11 - 100000000)</option>
                                    <option data-min="10" data-max="500000" value="348" data-rate="0.0356">348 -
                                        TikTok Likes [Max 500K] [Cancel Enabled] [Speed: Day 20K] [Refill: No] - $0.0356
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="11" data-max="300000" value="350" data-rate="0.0517">350 -
                                        TikTok Likes [Max 100K] [Instant] [Speed: Day 10K] [Refill: No] - $0.0517 (Min-Max:
                                        11 - 300000)</option>
                                    <option data-min="10" data-max="100000000" value="345" data-rate="0.0365">345 -
                                        Tiktok Likes [Max 10M] [Fast &amp; Instant] [Speed: Day 50K] [Refill: No] - $0.0365
                                        (Min-Max: 10 - 100000000)</option>
                                    <option data-min="10" data-max="10000000" value="352" data-rate="0.0937">352 -
                                        TikTok Likes [Max 1M] [Instant] [Speed: Day 20K] [Refill: 30 Days ♻️] - $0.0937
                                        (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="100000000" value="347" data-rate="0.0393">347 -
                                        TikTok Likes [Max 10M] [Fast &amp; Instant] [Speed: Day 100K ] [Refill: No] -
                                        $0.0393 (Min-Max: 10 - 100000000)</option>
                                    <option data-min="1000" data-max="100000" value="842" data-rate="0">842 - TikTok
                                        - View Video | Non Drop | Start: 0 - 2 Hour | 1M - 5M/Day ⚡⛔ - $0 (Min-Max: 1000 -
                                        100000)</option>
                                    <option data-min="50000" data-max="1000000" value="779" data-rate="0">779 -
                                        TikTok - Video Views | Start: 0 - 24 Hour | Max 500M | 10M - 20M/Day⛔ - $0 (Min-Max:
                                        50000 - 1000000)</option>
                                    <option data-min="100" data-max="200000000" value="815" data-rate="0">815 -
                                        TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M [ Cheap ] - $0
                                        (Min-Max: 100 - 200000000)</option>
                                    <option data-min="1000" data-max="1000000" value="768" data-rate="0">768 -
                                        TikTok - Views Video | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 | Max 500M | Instant | 1M-10M/Days ⚡ - $0
                                        (Min-Max: 1000 - 1000000)</option>
                                    <option data-min="1000" data-max="1000000" value="671" data-rate="0">671 -
                                        TikTok - Views Providers | Start Instant | Max Unlimited | 200M/Day - $0 (Min-Max:
                                        1000 - 1000000)</option>
                                    <option data-min="100" data-max="10000000" value="589" data-rate="0">589 -
                                        TikTok World King Views | 𝟏𝟎𝟎% 𝐎𝐰𝐞𝐫𝐟𝐥𝐨𝐰 | Max 50M | 10M/Day⚡ - $0
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="2147483647" value="612" data-rate="0.0002">612 -
                                        TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M 💥💥𝐂𝐡𝐞𝐚𝐩𝐞𝐬𝐭
                                        💥💥 - $0.0002 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="1000" data-max="975000000" value="478" data-rate="0.0002">478 -
                                        TikTok Views | Unlimited | Instant | 𝗟𝗢𝗪𝗘𝗦𝗧 𝗣𝗥𝗜𝗖𝗘𝗦 –
                                        𝗚𝗨𝗔𝗥𝗔𝗡𝗧𝗘𝗘𝗗 | 100M/Day - $0.0002 (Min-Max: 1000 - 975000000)</option>
                                    <option data-min="100" data-max="2147483647" value="405" data-rate="0.0003">405 -
                                        TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M [ Cheap ] 𝐔𝐋𝐓𝐑𝐀
                                        𝐅𝐀𝐒𝐓 🚀 - $0.0003 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="1000" data-max="975000000" value="404" data-rate="0.0003">404 -
                                        TikTok Video Views | Max: Unlimited | 20M/Day - $0.0003 (Min-Max: 1000 - 975000000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="832" data-rate="2.85696">832 -
                                        TikTok Followers [ Max 5M ] | HQ | Cancel Enable | Non Drop | No Refill ⚠️ | Instant
                                        | Day 50K 𝗨𝗟𝗧𝗥𝗔 𝗙𝗔𝗦𝗧 𝗦𝗣𝗘𝗘𝗗 𝟬-𝟭 𝗠İ𝗡 𝗦𝗧𝗔𝗥𝗧 - $2.85696 (Min-Max:
                                        10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="833" data-rate="1.24992">833 -
                                        TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp; Refill Enable | 30 Days
                                        ♻️| 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.24992 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="834" data-rate="0.08437">834 -
                                        TikTok Likes [ Max 10M ] | LQ Profiles | Cancel Enable | Instant | Day 50K
                                        𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 🚀 - $0.08437 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="500000" value="835" data-rate="0.07142">835 -
                                        TikTok Likes [ Max 10M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | No Refill ⚠️ | Instant Start | Day 100K
                                        🚀 - $0.07142 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="831" data-rate="1.32134">831 -
                                        TikTok Followers [ Max 10M ] | LQ Profiles | Cancel Enable | Day 100K ⚡&gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.32134 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="100000" value="1090" data-rate="0.865">1090 -
                                        TikTok Follow Vietnamese | Instant | QH + Avatar | 300 - 1K/Day - $0.865 (Min-Max:
                                        50 - 100000)</option>
                                    <option data-min="10" data-max="50000" value="771" data-rate="0.07">771 - TikTok
                                        Likes | Instant | Ultra Fast | 50K Per Day ⚡️ - $0.07 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="100000" value="772" data-rate="0.07684">772 -
                                        TikTok Likes | HQ | Cancel Enable | Non Drop | No Refill ⚠️ | Instant | Max 10M |
                                        Day 200K - $0.07684 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="300000" value="675" data-rate="0.0629">675 -
                                        TikTok Likes | NR | Instant | 0-10 Minute | 50K/Day ⛔⚡ - $0.0629 (Min-Max: 10 -
                                        300000)</option>
                                    <option data-min="100" data-max="50000000" value="488" data-rate="0">488 -
                                        TikTok Views | Max 5B | Instant | 100M/Day - $0 (Min-Max: 100 - 50000000)</option>
                                    <option data-min="10" data-max="10000000" value="607" data-rate="0.0335">607 -
                                        TikTok Likes Slow | NR | Cancel Enable | 15K/Day - $0.0335 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="300000" value="609" data-rate="2092.82">609 -
                                        TikTok - Thích | Tối đa 500k | 𝗨𝗣𝗗𝗔𝗧𝗘𝗗 - $2092.82 (Min-Max: 10 - 300000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="608" data-rate="0.055">608 -
                                        TikTok Likes Slow | HQ Real Profiles | NR | 10-30K/Day - $0.055 (Min-Max: 10 -
                                        10000000)</option>
                                    <option data-min="10" data-max="500000" value="606" data-rate="0.1">606 - TikTok
                                        Likes | Instant | 𝗦𝘁𝗮𝗯𝗹𝗲 &amp; 𝗘𝘅𝗰𝗲𝗹𝗹𝗲𝗻𝘁 𝗤𝘂𝗮𝗹𝗶𝘁𝘆 | 10K Per Day
                                        | Refill 7 Days ⚡️♻️ - $0.1 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="588" data-rate="3880.22">588 -
                                        TikTok - Người theo dõi | Tối đa 10M - $3880.22 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000000" value="590" data-rate="0.139">590 -
                                        TikTok Followers [ Max 10M ] | 𝐋𝐐 | Cancel Enable | NR ⚠️ | Day 500K &gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.139 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="1000000" value="573" data-rate="0.1363">573 -
                                        TikTok - Followers | Max 500k | LQ Profile | 20k/day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.1363 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="417" data-rate="0.1363">417 -
                                        TikTok - Followers | Max 500k | LQ Profile | 20k/day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.1363 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="500000" value="359" data-rate="0.1596">359 -
                                        TikTok Followers [Max 500K] [INSTANT] [Speed: Day 10K] [Refill: No] - $0.1596
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="402" data-rate="3815.28">402 -
                                        TikTok - Người theo dõi | Tối đa 10M - $3815.28 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="361" data-rate="0.1957">361 -
                                        TikTok Followers [Max 500k] [INSTANT] [Speed: Day 10K] [Refill: No] - $0.1957
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="356" data-rate="0.1568">356 -
                                        TikTok Followers [Max 10M] [Fast &amp; Instant] [Speed: Day 20K] [Refill: No] -
                                        $0.1568 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="363" data-rate="0.2099">363 -
                                        TikTok Followers [Max 200K] [INSTANT] [Speed: Day 5K] [Refill: No] - $0.2099
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="358" data-rate="0.2">358 -
                                        TikTok Followers [Max 500K] [Cancel &amp; Refill Enable] [Speed: Day 50K] [Refill:
                                        30 Days ♻️] - $0.2 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="50000000" value="360" data-rate="0.1861">360 -
                                        TikTok Followers [Max 10M] [Speed: Day 10K] [Refill: No] - $0.1861 (Min-Max: 10 -
                                        50000000)</option>
                                    <option data-min="10" data-max="500000" value="355" data-rate="0.1412">355 -
                                        TikTok Followers [Max 500K] [Speed: Day 50K] [Refill: No] - $0.1412 (Min-Max: 10 -
                                        500000)</option>
                                    <option data-min="10" data-max="500000" value="362" data-rate="0.2">362 - TikTok
                                        Followers [Max 500K] [INSTANT] [Speed: Day 10K] [Refill: No] - $0.2 (Min-Max: 10 -
                                        500000)</option>
                                    <option data-min="10" data-max="10000000" value="357" data-rate="0.1617">357 -
                                        TikTok Followers [Max 10M] [Fast &amp; Instead] [Speed: Day 10K] [Refill: No] -
                                        $0.1617 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="1000" data-max="1000" value="1125" data-rate="0.0336">1125 -
                                        Canva - Premium one Membership Account | Paid Subscription Unlock Service⚡ - $0.0336
                                        (Min-Max: 1000 - 1000)</option>
                                    <option data-min="1" data-max="1" value="807" data-rate="4000">807 - Facebook
                                        Report Profile | Start: 0 - 6 Hour | Guarantee: 30 minutes | VIP - $4000 (Min-Max: 1
                                        - 1)</option>
                                    <option data-min="1000" data-max="1000" value="330" data-rate="0.0336">330 -
                                        Canva - Premium one Membership Account | Paid Subscription Unlock Service⚡ - $0.0336
                                        (Min-Max: 1000 - 1000)</option>
                                    <option data-min="1000" data-max="1000" value="331" data-rate="24">331 - Canva
                                        Pro Owner Account | Get 500 Membership Account | Validity 3Year | Cheapset Price -
                                        $24 (Min-Max: 1000 - 1000)</option>
                                    <option data-min="100" data-max="50000" value="380" data-rate="0">380 - Facebook
                                        Follow Profile/Page Real | Start: 0 - 60 minutes | Bonus 0 - 10% |100 - 500/Day - $0
                                        (Min-Max: 100 - 50000)</option>
                                    <option data-min="5" data-max="200" value="381" data-rate="0">381 - Facebook
                                        Comments Real Vietnamese | Start: 0 - 60 minutes | Bonus 0 - 5% | 50 - 200/Day - $0
                                        (Min-Max: 5 - 200)</option>
                                    <option data-min="50" data-max="2000" value="379" data-rate="0">379 - Facebook
                                        Like Post Real Vietnamese | Start: 0 - 60 minutes | Bonus 5 - 40% | 1K/Day - $0
                                        (Min-Max: 50 - 2000)</option>
                                    <option data-min="10" data-max="10000" value="1352" data-rate="0.3994">1352 -
                                        Facebook | Post Likes | Global Name | Max 10K | Instant | 10K/Day - $0.3994
                                        (Min-Max: 10 - 10000)</option>
                                    <option data-min="50" data-max="10000" value="1255" data-rate="0.3">1255 -
                                        Facebook Post Like | Instant | No Refill | 5K - 10K/Day ⛔ - $0.3 (Min-Max: 50 -
                                        10000)</option>
                                    <option data-min="100" data-max="50000" value="1237" data-rate="0.67">1237 -
                                        Facebook Post Likes | Instant | 500K Per Day | Refill 7 Days ⚡♻️⛔ - $0.67 (Min-Max:
                                        100 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1164" data-rate="0.4375">1164 -
                                        Facebook Post Likes | Instant | 500K Per Day | Refill 7 Days ⚡♻️⛔ - $0.4375
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1179" data-rate="0.4375">1179 -
                                        Facebook Post Like | Max 50K| Instant | 2K/Day ⛔⚡ - $0.4375 (Min-Max: 50 - 50000)
                                    </option>
                                    <option data-min="50" data-max="50000" value="970" data-rate="0.4375">970 -
                                        Facebook Post Like | Instant | 100% Bot Data &amp; Old Data | 5K/Day - $0.4375
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="20" data-max="100000" value="773" data-rate="0.6938">773 -
                                        Facebook Post Likes [ Max 10K ] | Non Drop | NR ⚠️ | Instant | 100 - 500/Day -
                                        $0.6938 (Min-Max: 20 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1083" data-rate="0.3999">1083 -
                                        Facebook Post Likes | HQ | | Instant | NR | 5K/Day - $0.3999 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="10000" value="720" data-rate="0.45">720 -
                                        Facebook Post Likes | Instant | Non Drop | No Refill | Max 100K | Day 5K - $0.45
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="20" data-max="100000" value="676" data-rate="0.44625">676 -
                                        Facebook Post Like [Max: 100K] [Start Time: 0-15 Mins] [Speed: 1-5K/Day] - $0.44625
                                        (Min-Max: 20 - 100000)</option>
                                    <option data-min="20" data-max="10000" value="579" data-rate="0">579 - Facebook
                                        - Like Post Sale | Instant | No Refill | 5K - 10K/Day - $0 (Min-Max: 20 - 10000)
                                    </option>
                                    <option data-min="20" data-max="10000" value="328" data-rate="0.21">328 -
                                        Facebook Post Likes | Instant | 500 - 2K Per Day - $0.21 (Min-Max: 20 - 10000)
                                    </option>
                                    <option data-min="20" data-max="100000" value="726" data-rate="0.44625">726 -
                                        Facebook Post Like [Max: 100K] [Start Time: 0-15 Mins] [Speed: 1-5K/Day] - $0.44625
                                        (Min-Max: 20 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="721" data-rate="0.1155">721 -
                                        TikTok Likes | HQ - Real Profiles | No Refill | Instant Start | Fast | Max 1M | Day
                                        100K - $0.1155 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="50000" value="650" data-rate="0.39375">650 -
                                        Facebook Post Like [Max: 50K] [Start Time: 0-10 Mins] [Speed: 1-10K/Day] ⛔ -
                                        $0.39375 (Min-Max: 10 - 50000)</option>
                                    <option data-min="500" data-max="10000000" value="1408" data-rate="0.0418">1408 -
                                        Facebook Likes | Max 500K | Video/Reels - All Link | Non Drop | No Refill ⚠️ | Day
                                        50K 🚀 - $0.0418 (Min-Max: 500 - 10000000)</option>
                                    <option data-min="100" data-max="100000" value="1628" data-rate="0.0688">1628 -
                                        Facebook Post React | Like 👍 | Page Data | Instant | No refill | 50K/Day - $0.0688
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="1477" data-rate="0.108">1477 -
                                        Facebook Like post Vietnam | Max 500K | Instant | 20K - 50K/Day - $0.108 (Min-Max:
                                        100 - 50000)</option>
                                    <option data-min="20" data-max="10000" value="1280" data-rate="0.1944">1280 -
                                        Facebook Post Reaction Vietnam | Like 👍| Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="1269" data-rate="0.1944">1269 -
                                        Facebook Post Reaction Vietnam | Love❤️ | Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="1270" data-rate="0.1944">1270 -
                                        Facebook Post Reaction Vietnam | Haha 😂 | Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="1271" data-rate="0.1944">1271 -
                                        Facebook Post Reaction Vietnam | Wow 😯 | Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="1272" data-rate="0.1944">1272 -
                                        Facebook Post Reaction Vietnam | Sad 😢 | Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="1273" data-rate="0.1944">1273 -
                                        Facebook Post Reaction Vietnam | Angry😡 | Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="1274" data-rate="0.1944">1274 -
                                        Facebook Post Reaction Vietnam | Care😊 | Instant | 5K - 10K/Day ⚡ - $0.1944
                                        (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="20000" value="1275" data-rate="0.699">1275 -
                                        Facebook Reaction 🤬| Max 20k | 1k-2k/Day ~ Instant ~𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 | 𝗖𝗛𝗘𝗔𝗣
                                        - $0.699 (Min-Max: 20 - 20000)</option>
                                    <option data-min="100" data-max="50000" value="677" data-rate="0.67">677 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp; Old Data | Like 👍 -
                                        $0.67 (Min-Max: 100 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="678" data-rate="0.4375">678 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp; Old Data | Love ❤️ -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="679" data-rate="0.4375">679 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp;amp; Old Data | Care 🥰 -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="680" data-rate="0.4375">680 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp; Old Data | Haha 😆 -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="681" data-rate="0.4375">681 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp;amp;amp; Old Data | Sad
                                        😢 - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="682" data-rate="0.4375">682 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp; Old Data | Wow 😲 -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="683" data-rate="0.4375">683 -
                                        Facebook Post Reactions | Instant | 100% Bot Data &amp;amp; Old Data | Angry 😡 -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="630" data-rate="0.30625">630 -
                                        Facebook Post Reaction [Max: 50K] [Start Time: 0-5 Mins] [Speed: 1-2K/Day] ⛔ [LOVE
                                        ❤️] - $0.30625 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="635" data-rate="0.30625">635 -
                                        Facebook Post Reaction [Max: 50K] [Start Time: 0-5 Mins] [Speed: 1-2K/Day] ⛔ [CARE
                                        😊] - $0.30625 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="631" data-rate="0.30625">631 -
                                        Facebook Post Reaction [Max: 50K] [Start Time: 0-5 Mins] [Speed: 1-2K/Day] ⛔ [HAHA
                                        😂] - $0.30625 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="632" data-rate="0.30625">632 -
                                        Facebook Post Reaction [Max: 50K] [Start Time: 0-5 Mins] [Speed: 1-2K/Day] ⛔ [WOW
                                        😯] - $0.30625 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="633" data-rate="0.30625">633 -
                                        Facebook Post Reaction [Max: 50K] [Start Time: 0-5 Mins] [Speed: 1-2K/Day] ⛔ [SAD
                                        😢] - $0.30625 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="634" data-rate="0.30625">634 -
                                        Facebook Post Reaction [Max: 50K] [Start Time: 0-5 Mins] [Speed: 1-2K/Day] ⛔ [ANGRY
                                        😡] - $0.30625 (Min-Max: 10 - 50000)</option>
                                    <option data-min="50" data-max="100000" value="1165" data-rate="0.1918">1165 -
                                        Facebook Post Reaction ❤️ | Max: 50K| Start: 0- 30 Minutes | 1-5K/Day⛔⚡ - $0.1918
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="983" data-rate="0.4375">983 -
                                        Facebook Post React [ Haha😂 ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1166" data-rate="0.1918">1166 -
                                        Facebook Post Reaction 😂 | Max: 50K | Start: 0- 30 Minutes | 1-5K/Day⛔⚡ - $0.1918
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1167" data-rate="0.1918">1167 -
                                        Facebook Post Reaction 😯 | Max: 50K | Start: 0- 30 Minutes | 1-5K/Day⛔⚡ - $0.1918
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1168" data-rate="0.1918">1168 -
                                        Facebook Post Reaction 😢 | Max: 50K | Start: 0- 30 Minutes | 1-5K/Day⛔⚡ - $0.1918
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1169" data-rate="0.1918">1169 -
                                        Facebook Post Reaction 😡 | Max: 50K | Start: 0- 30 Minutes | 1-5K/Day⛔⚡ - $0.1918
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="985" data-rate="0.4375">985 -
                                        Facebook Post React [ Angry😡 ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="980" data-rate="0.4375">980 -
                                        Facebook Post React [ Love❤️ ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="982" data-rate="0.4375">982 -
                                        Facebook Post React [ Wow😲 ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="984" data-rate="0.4375">984 -
                                        Facebook Post React [ Sad😥 ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="979" data-rate="0.4375">979 -
                                        Facebook Post React [ Like👍 ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="10000" value="791" data-rate="0.62">791 -
                                        Facebook Post Reaction 👍 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="50" data-max="100000" value="1170" data-rate="0.1918">1170
                                        - Facebook Post Reaction 😊 | Max: 50K | Start: 0- 30 Minutes | 1-5K/Day⛔⚡ - $0.1918
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="981" data-rate="0.4375">981 -
                                        Facebook Post React [ Care🤗 ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="50000" value="852" data-rate="0.4375">852 -
                                        Facebook Post Reactions ❤️ | Instant | 100% Bot Data &amp;amp; Old Data | 5K/Day -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="100000" value="853" data-rate="0.4375">853 -
                                        Facebook Post React [ Love❤️ ] [ 1-20k/D ] [ No Refill ] [ Instant ] - $0.4375
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="50000" value="858" data-rate="0.4375">858 -
                                        Facebook Post Reactions 😊| Instant | 100% Bot Data &amp; Old Data | 5K/Day -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="854" data-rate="0.4375">854 -
                                        Facebook Post Reactions 😂| Instant | 100% Bot Data &amp;amp; Old Data | 5K/Day -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="855" data-rate="0.4375">855 -
                                        Facebook Post Reactions 😢| Instant | 100% Bot Data &amp; Old Data | 5K/Day -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="857" data-rate="0.4375">857 -
                                        Facebook Post Reactions 😡| Instant | 100% Bot Data &amp; Old Data | 5K/Day -
                                        $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="10000" value="792" data-rate="0.62">792 -
                                        Facebook Post Reaction 💖 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="797" data-rate="0.62">797 -
                                        Facebook Post Reaction 🥰 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="793" data-rate="0.62">793 -
                                        Facebook Post Reaction 😂 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="795" data-rate="0.62">795 -
                                        Facebook Post Reaction 😦 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="794" data-rate="0.62">794 -
                                        Facebook Post Reaction 😥 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000000" value="796" data-rate="0.62">796 -
                                        Facebook Post Reaction 😡 | Max 10K | Start 1 - 3 Hour | 500 - 3K/Day⚡ - $0.62
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="500000" value="1781" data-rate="0.0558">1781
                                        - Facebook Post React | Like 👍 | Instant | Non Drop | No refill | 10K/Day - $0.0558
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1782" data-rate="0.0558">1782
                                        - Facebook Post React | Love ❤️ | Instant | Non Drop | No refill | 10K/Day - $0.0558
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1783" data-rate="0.0558">1783
                                        - Facebook Post React | Care 🤗 | Instant | Non Drop | No refill | 10K/Day - $0.0558
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1784" data-rate="0.0558">1784
                                        - Facebook Post React | Haha 😆 | Instant | Non Drop | No refill | 10K/Day - $0.0558
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="856" data-rate="0.0558">856 -
                                        Facebook Post React | Wow 😯 | Instant | Non Drop | No refill | 10K/Day - $0.0558
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1785" data-rate="0.0558">1785
                                        - Facebook Post React | Sad😥 | Instant | Non Drop | No refill | 10K/Day - $0.0558
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1786" data-rate="0.0558">1786
                                        - Facebook Post React | Angry 😡 | Instant | Non Drop | No refill | 10K/Day -
                                        $0.0558 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000000" value="1326" data-rate="500">1326 -
                                        Facebook Post Reaction | Like👍 | Max 100K | Instant | No Refill | 5K - 10K/Day -
                                        $500 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1327" data-rate="500">1327 -
                                        Facebook Post Reaction | Love 💖| Max 100K | Instant | No Refill | 5K - 10K/Day -
                                        $500 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1328" data-rate="500">1328 -
                                        Facebook Post Reaction | Care 🤗 | Max 100K | Instant | No Refill | 5K - 10K/Day -
                                        $500 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1329" data-rate="500">1329 -
                                        Facebook Post Reaction | Wow 😮 | Max 100K | Instant | No Refill | 5K - 10K/Day -
                                        $500 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1330" data-rate="500">1330 -
                                        Facebook Post Reaction | Haha 😂 | Max 100K | Instant | No Refill | 5K - 10K/Day -
                                        $500 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1331" data-rate="500">1331 -
                                        Facebook Post Reaction | Sad 😭 | Max 100K | Instant | No Refill | 5K - 10K/Day -
                                        $500 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="50" data-max="50000" value="798" data-rate="0.4375">798 -
                                        Facebook Post Reactions 👍 | Instant | 100% Real Data &amp;amp; Old Data| 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="10" data-max="10000000" value="1332" data-rate="500">1332 -
                                        Tăng ANGRY (TỨC GIẬN) bài viết Facebook Việt giá rẻ - $500 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="50" data-max="50000" value="799" data-rate="0.4375">799 -
                                        Facebook Post Reactions ❤️ | Instant | 100% Real Data &amp;amp; Old Data| 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="800" data-rate="0.4375">800 -
                                        Facebook Post Reactions 🥰 | Instant | 100% Real Data &amp;amp; Old Data| 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="801" data-rate="0.4375">801 -
                                        Facebook Post Reactions 😆 | Instant | 100% Real Data &amp;amp; Old Data| 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="802" data-rate="0.4375">802 -
                                        Facebook Post Reactions 😢 | Instant | 100% Real Data &amp;amp; Old Data | 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="803" data-rate="0.4375">803 -
                                        Facebook Post Reactions 😲 | Instant | 100% Real Data &amp;amp; Old Data| 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="804" data-rate="0.4375">804 -
                                        Facebook Post Reactions 😢 | Instant | 100% Real Data &amp;amp;amp; Old Data| 500 -
                                        3K/Day - $0.4375 (Min-Max: 50 - 50000)</option>
                                    <option data-min="10" data-max="1000" value="1798" data-rate="0.25">1798 -
                                        Facebook Post Reaction Vietnam | Like 👍| Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="1000" value="1799" data-rate="0.25">1799 -
                                        Facebook Post Reaction Vietnam | Love❤️ | Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="1000" value="1800" data-rate="0.25">1800 -
                                        Facebook Post Reaction Vietnam | Haha 😂 | Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="1000" value="1801" data-rate="0.25">1801 -
                                        Facebook Post Reaction Vietnam | Wow 😯 | Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="1000" value="1802" data-rate="0.25">1802 -
                                        Facebook Post Reaction Vietnam | Sad 😢 | Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="1000" value="1803" data-rate="0.25">1803 -
                                        Facebook Post Reaction Vietnam | Angry😡 | Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="1000" value="1804" data-rate="0.25">1804 -
                                        Facebook Post Reaction Vietnam | Care😊 | Instant | 1K/Day ⚡ - $0.25 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="100000" value="1854" data-rate="0.0493">1854
                                        - Facebook Post React | Like 👍 | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1851" data-rate="0.0493">1851
                                        - Facebook Post React | Love ❤️ | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1853" data-rate="0.0493">1853
                                        - Facebook Post React | Care 🤗 | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1848" data-rate="0.0493">1848
                                        - Facebook Post React | Haha 😆 | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1852" data-rate="0.0493">1852
                                        - Facebook Post React | Wow 😯 | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1849" data-rate="0.0493">1849
                                        - Facebook Post React | Sad 😥 | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1850" data-rate="0.0493">1850
                                        - Facebook Post React | Angry 😡 | Page Data | Instant | 50K/Day - $0.0493 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="808" data-rate="0.4375">808 -
                                        Facebook Post Reaction [Max: 100K] [Start Time: 0-5 Mins] [Speed: 1-5K/Day] ⛔⚡ [LOVE
                                        ❤️] - $0.4375 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="50000" value="1192" data-rate="0.3978">1192 -
                                        Facebook Reaction Post 👍| Max 20K | Instant | No Refill | 2K/Day - $0.3978
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1193" data-rate="0.7339">1193 -
                                        Facebook Reaction Post ❤️ | Max 20K | Instant | No Refill | 2K/Day - $0.7339
                                        (Min-Max: 20 - 50000)</option>
                                    <option data-min="50" data-max="20000" value="1194" data-rate="0.6499">1194 -
                                        Facebook Reaction Post 😲 | Max 20K | Instant | No Refill | 2K/Day - $0.6499
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="20000" value="1195" data-rate="0.6499">1195 -
                                        Facebook Reaction Post 🤗 | Max 20K | Instant | No Refill | 2K/Day - $0.6499
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="20000" value="1196" data-rate="0.6499">1196 -
                                        Facebook Reaction Post 😂 | Max 20K | Instant | No Refill | 2K/Day - $0.6499
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="20000" value="1197" data-rate="0.6499">1197 -
                                        Facebook Reaction Post 😥 | Max 20K | Instant | No Refill | 2K/Day - $0.6499
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="20000" value="1198" data-rate="0.6499">1198 -
                                        Facebook Reaction Post 🤬 | Max 20K | Instant | No Refill | 2K/Day - $0.6499
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="100000" value="810" data-rate="0.4375">810 -
                                        Facebook Post Reaction [Max: 100K] [Start Time: 0-5 Mins] [Speed: 1-5K/Day] ⛔⚡ [WOW
                                        😯] - $0.4375 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="812" data-rate="0.4375">812 -
                                        Facebook Post Reaction [Max: 100K] [Start Time: 0-5 Mins] [Speed: 1-5K/Day] ⛔⚡
                                        [ANGRY 😡] - $0.4375 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="809" data-rate="0.4375">809 -
                                        Facebook Post Reaction [Max: 100K] [Start Time: 0-5 Mins] [Speed: 1-5K/Day] ⛔⚡ [HAHA
                                        😂] - $0.4375 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="811" data-rate="0.4375">811 -
                                        Facebook Post Reaction [Max: 100K] [Start Time: 0-5 Mins] [Speed: 1-5K/Day] ⛔⚡ [SAD
                                        😢] - $0.4375 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="813" data-rate="0.4375">813 -
                                        Facebook Post Reaction [Max: 100K] [Start Time: 0-5 Mins] [Speed: 1-5K/Day] ⛔⚡ [CARE
                                        😊] - $0.4375 (Min-Max: 50 - 100000)</option>
                                    <option data-min="30" data-max="30000" value="1393" data-rate="0.29">1393 -
                                        Facebook Post Reactions [👍] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="30" data-max="30000" value="1394" data-rate="0.29">1394 -
                                        Facebook Post Reactions [❤️] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="30" data-max="30000" value="1395" data-rate="0.29">1395 -
                                        Facebook Post Reactions [🤗] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="30" data-max="30000" value="1396" data-rate="0.29">1396 -
                                        Facebook Post Reactions [😆] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="30" data-max="30000" value="1397" data-rate="0.29">1397 -
                                        Facebook Post Reactions [😲] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="30" data-max="30000" value="1398" data-rate="0.29">1398 -
                                        Facebook Post Reactions [😢] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="30" data-max="30000" value="1399" data-rate="0.29">1399 -
                                        Facebook Post Reactions [😡] | Instant | Global Resources | 10K+ Daily | No Refill
                                        ⚡⛔ - $0.29 (Min-Max: 30 - 30000)</option>
                                    <option data-min="20" data-max="50000" value="1824" data-rate="0.0739">1824 -
                                        Facebook Post/Comment Reaction | Hidden | LIKE 👍 | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1825" data-rate="0.0739">1825 -
                                        Facebook Post/Comment Reaction | Hidden | LOVE ❤️ | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1826" data-rate="0.0739">1826 -
                                        Facebook Post/Comment Reaction | Hidden | WOW 😲 | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1827" data-rate="0.0739">1827 -
                                        Facebook Post/Comment Reaction | Hidden | HAHA 😀 | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1828" data-rate="0.0739">1828 -
                                        Facebook Post/Comment Reaction | Hidden | CARE 🤗 | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1829" data-rate="0.0739">1829 -
                                        Facebook Post/Comment Reaction | Hidden | SAD 😢 | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1830" data-rate="0.0739">1830 -
                                        Facebook Post/Comment Reaction | Hidden | ANGRY 😡 | Max 50K | Instant | 5K/Day -
                                        $0.0739 (Min-Max: 20 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1344" data-rate="10000000000">
                                        1344 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Sad 😢⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1345" data-rate="10000000000">
                                        1345 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Angry 😡⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1346" data-rate="10000000000">
                                        1346 - Facebook Post Reactions | [Mixed: 👍❤️] | Instant | Old &amp; Real HQ ⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1339" data-rate="10000000000">
                                        1339 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Like 👍⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1347" data-rate="10000000000">
                                        1347 - Facebook Post Reactions | [Mixed: 👍❤️🥰] | Instant | Old &amp; Real HQ ⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1340" data-rate="10000000000">
                                        1340 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Love ❤️⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1348" data-rate="10000000000">
                                        1348 - Facebook Post Reactions | [Mixed: 👍❤️🥰😆] | Instant | Old &amp; Real HQ ⚡⛔
                                        - $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1341" data-rate="10000000000">
                                        1341 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Care 🥰⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1349" data-rate="10000000000">
                                        1349 - Facebook Post Reactions | [Mixed: 👍❤️🥰😆😲] | Instant | Old &amp; Real HQ
                                        ⚡⛔ - $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1342" data-rate="10000000000">
                                        1342 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Haha 😆⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1350" data-rate="10000000000">
                                        1350 - Facebook Post Reactions | [Mixed: 👍❤️🥰😆😲😢] | Instant | Old &amp; Real HQ
                                        ⚡⛔ - $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1343" data-rate="10000000000">
                                        1343 - Facebook Post Reactions | Instant | Old &amp; Real HQ | Wow 😲⚡⛔ -
                                        $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1351" data-rate="10000000000">
                                        1351 - Facebook Post Reactions | [Mixed: 👍❤️🥰😆😲😢😡] | Instant | Old &amp; Real
                                        HQ ⚡⛔ - $10000000000 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="100000" value="1417" data-rate="0.2672">1417
                                        - Facebook - 𝗣𝗼𝘀𝘁 Likes 👍| Max 10k | 5k/day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 -
                                        $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1418" data-rate="0.2672">1418
                                        - Facebook - 𝗣𝗼𝘀𝘁 Reaction | Love 💖 | Max 10k | 5k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1419" data-rate="0.2672">1419
                                        - Facebook - 𝗣𝗼𝘀𝘁 Reaction | Care 🤗| Max 10k | 5k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1420" data-rate="0.2672">1420
                                        - Facebook - 𝗣𝗼𝘀𝘁 Reaction | Wow 😮| Max 10k | 5k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1421" data-rate="0.2672">1421
                                        - Facebook - 𝗣𝗼𝘀𝘁 Reaction | Haha 😂| Max 10k | 5k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1422" data-rate="0.2672">1422
                                        - Facebook - 𝗣𝗼𝘀𝘁 Reaction | Sad 😭| Max 10k | 5k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1423" data-rate="0.2672">1423
                                        - Facebook - 𝗣𝗼𝘀𝘁 Reaction | Angry 😡| Max 10k | 5k/day ~ Instant ~ 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 - $0.2672 (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="1805" data-rate="0.0771">1805
                                        - Facebook Post React | Like 👍 | Page Data | Instant | No refill | 50K/Day -
                                        $0.0771 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1806" data-rate="0.0771">1806
                                        - Facebook Post React | Haha 😆 | Page Data | Instant | No refill | 50K/Day -
                                        $0.0771 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1807" data-rate="0.0771">1807
                                        - Facebook Post React | Care 🤗 | Page Data | Instant | No refill | 50K/Day -
                                        $0.0771 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1808" data-rate="0.0771">1808
                                        - Facebook Post React | Sad 😥 | Page Data | Instant | No refill | 50K/Day - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1809" data-rate="0.0771">1809
                                        - Facebook Post React | Angry 😡 | Page Data | Instant | No refill | 50K/Day -
                                        $0.0771 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1810" data-rate="0.0771">1810
                                        - Facebook Post React | Love ❤️ | Page Data | Instant | No refill | 50K/Day -
                                        $0.0771 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1811" data-rate="0.0771">1811
                                        - Facebook Post React | Wow 😯 | Page Data | Instant | No refill | 50K/Day - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1457" data-rate="0.088">1457 -
                                        Facebook Post Reaction | Love 👍 | Max 100k | Instant | No refill | 5k/Day - $0.088
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1458" data-rate="0.088">1458 -
                                        Facebook Post Reactions (Love ❤️) [ Max 100K ] | High Quality | No Refill ⚠️ |
                                        Instant Start | Day 20K - $0.088 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1459" data-rate="0.088">1459 -
                                        Facebook Post Reactions (Care 🤗) [ Max 100K ] | High Quality | No Refill ⚠️ |
                                        Instant Start | Day 20K - $0.088 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="100000" value="1460" data-rate="0.2353">1460
                                        - Facebook Post Reaction WoW 😮| Max 100k | 5k/Day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.2353 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1461" data-rate="0.2353">1461
                                        - Facebook Post Reaction HaHa 😂| Max 100k | 5k/Day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.2353 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1462" data-rate="0.2353">1462
                                        - Facebook Post Reaction SAD 😥| Max 100k | 5k/Day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.2353 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1463" data-rate="0.2353">1463
                                        - Facebook Post Reaction Angry 😡 | Max 100k | 5k/Day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟
                                        | 𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.2353 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="1766" data-rate="0.0493">1766
                                        - Facebook Post Reaction | Like 👍 | Data Page | Max 500K | Instant | 5K/Day -
                                        $0.0493 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1742" data-rate="0.0828">1742
                                        - Facebook Post Reaction | Love ❤️ | Data Page | Max 500K | Instant | 5K/Day -
                                        $0.0828 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1743" data-rate="0.0828">1743
                                        - Facebook Post Reaction | Wow 😯 | Max 500K | Instant | 5K/Day - $0.0828 (Min-Max:
                                        10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1744" data-rate="0.0828">1744
                                        - Facebook Post Reaction | Care 🤗 | Data Page | Max 500K | Instant | 5K/Day -
                                        $0.0828 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1745" data-rate="0.0828">1745
                                        - Facebook Post Reaction | Haha 😆| Data Page | Max 500K | Instant | 5K/Day -
                                        $0.0828 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1746" data-rate="0.0828">1746
                                        - Facebook Post Reaction | Sad 😥 | Data Page | Max 500K | Instant | 5K/Day -
                                        $0.0828 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1747" data-rate="0.0828">1747
                                        - Facebook Post Reaction | Angry 😡 | Data Page | Max 500K | Instant | 5K/Day -
                                        $0.0828 (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="100000" value="1508" data-rate="0.0518">1508
                                        - Facebook Post Reaction Vietnam | Like 👍| Instant | 1K - 3K/Day ⚡ - $0.0518
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="10000" value="1509" data-rate="0.067">1509 -
                                        Facebook Post Reaction Vietnam | Love ❤️ | Instant | 1K - 3K/Day ⚡ - $0.067
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1510" data-rate="0.067">1510 -
                                        Facebook Post Reaction Vietnam | Care😊 | Instant | 1K - 3K/Day ⚡ - $0.067 (Min-Max:
                                        100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1511" data-rate="0.067">1511 -
                                        Facebook Post Reaction Vietnam | Haha 😂| Instant | 1K - 3K/Day ⚡ - $0.067 (Min-Max:
                                        100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1512" data-rate="0.067">1512 -
                                        Facebook Post Reaction Vietnam | Wow😯| Instant | 1K - 3K/Day ⚡ - $0.067 (Min-Max:
                                        100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1513" data-rate="0.067">1513 -
                                        Facebook Post Reaction Vietnam | Sad 😢 | Instant | 1K - 3K/Day ⚡ - $0.067 (Min-Max:
                                        100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1514" data-rate="0.067">1514 -
                                        Facebook Post Reaction Vietnam | Angry😡| Instant | 1K - 3K/Day ⚡ - $0.067 (Min-Max:
                                        100 - 10000)</option>
                                    <option data-min="10" data-max="1000000" value="1774" data-rate="0.066">1774
                                        - Facebook Post/Comment Reaction | Hidden | Like 👍 | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1775" data-rate="0.066">1775
                                        - Facebook Post/Comment Reaction | Hidden | LOVE ❤️ | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1776" data-rate="0.066">1776
                                        - Facebook Post/Comment Reaction | Hidden | HAHA 😂 | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1777" data-rate="0.066">1777
                                        - Facebook Post/Comment Reaction | Hidden | WOW 😲 | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1778" data-rate="0.066">1778
                                        - Facebook Post/Comment Reaction | Hidden | SAD 😢 | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1779" data-rate="0.066">1779
                                        - Facebook Post/Comment Reaction | Hidden | ANGRY 😡 | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1780" data-rate="0.066">1780
                                        - Facebook Post/Comment Reaction | Hidden | CARE 🤗 | Max 50K | Instant | 5K -
                                        10K/Day - $0.066 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="50000" value="859" data-rate="0.45">859 -
                                        Facebook Post Reactions | Instant | 100% Real Data &amp;amp; Old Data | 👍❤️ - $0.45
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="860" data-rate="0.2437">860 -
                                        Facebook Post Reactions | Instant | 100% Real Data &amp;amp;amp; Old Data | 👍❤️ -
                                        $0.2437 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="861" data-rate="0.2437">861 -
                                        Facebook Post Reactions | Instant | 100% Real Data &amp;amp;amp; Old Data | 👍❤️🤗 -
                                        $0.2437 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="862" data-rate="0.2437">862 -
                                        Facebook Post Reactions | Instant | 100% Real Data &amp;amp;amp; Old Data | 👍❤️🤗😀
                                        - $0.2437 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="863" data-rate="0.2437">863 -
                                        Facebook Post Reactions | Instant | 100% Real Data &amp;amp;amp; Old Data |
                                        👍❤️🥰😆😢😲 - $0.2437 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="864" data-rate="0.2437">864 -
                                        Facebook Post Reactions | Instant | 100% Real Data &amp;amp;amp; Old Data |
                                        👍❤️🤗😀😲😢 - $0.2437 (Min-Max: 100 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1184" data-rate="0.3704">1184 -
                                        Facebook Post Reaction |👍❤️😀🤗😲 | Max 100K | Instant | 5K/Day ⛔⚡ - $0.3704
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1185" data-rate="0.3704">1185 -
                                        Facebook Post Reaction |👍❤️ | Max 100K | Instant | 5K/Day ⛔⚡ - $0.3704 (Min-Max: 50
                                        - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1186" data-rate="0.3704">1186 -
                                        Facebook Post Reaction |👍❤️😀 | Max 100K | Instant | 5K/Day ⛔⚡ - $0.3704 (Min-Max:
                                        50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1187" data-rate="0.3704">1187 -
                                        Facebook Post Reaction |👍❤️😀🤗 | Max 100K | Instant | 5K/Day ⛔⚡ - $0.3704
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1188" data-rate="0.3704">1188 -
                                        Facebook Post Reaction |👍❤️😀🤗😲 | Max 100K | Instant | 5K/Day ⛔⚡ - $0.3704
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="5000" value="1136" data-rate="1.0983">1136 -
                                        Facebook Reaction | Sad 😭 | 𝕭angladesh 🇧🇩 𝕭est Quality | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 + 60D
                                        𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="1137" data-rate="1.0983">1137 -
                                        Facebook Reaction | Angry 🤬 | 𝕭angladesh 🇧🇩 𝕭est Quality | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 +
                                        60D 𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="1131" data-rate="1.0983">1131 -
                                        Facebook Reaction | Like 👍 | 𝕭angladesh 🇧🇩 𝕭est Quality | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 + 60D
                                        𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="1132" data-rate="1.0983">1132 -
                                        Facebook Reaction | Love ❤️ | 𝕭angladesh 🇧🇩 𝕭est Quality | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 + 60D
                                        𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="1133" data-rate="1.0983">1133 -
                                        Facebook Reaction | Care 🥰 | 𝕭angladesh 🇧🇩 𝕭est Quality | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 + 60D
                                        𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="1134" data-rate="1.0983">1134 -
                                        Facebook Reaction | Wow 😮 | 𝕭angladesh 🇧🇩 𝕭est Quality | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 + 60D
                                        𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="1135" data-rate="1.0983">1135 -
                                        Facebook Reaction | HaHa 😂 | 𝕭angladesh 🇧🇩 𝕭est Quaity | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 + 60D
                                        𝗥𝗘𝗙𝗜𝗟𝗟 ♻️⚡ 1K-5K Days - $1.0983 (Min-Max: 100 - 5000)</option>
                                    <option data-min="50" data-max="100000" value="624" data-rate="0.55">624 -
                                        Facebook Post Reaction (Care 🤗) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ - $0.55
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="593" data-rate="0.69">593 -
                                        Facebook Post Reaction [Like 👍 ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="625" data-rate="0.55">625 -
                                        Facebook Post Reaction (Wow 😮) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ - $0.55
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="626" data-rate="0.55">626 -
                                        Facebook Post Reaction (Sad 😢) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ - $0.55
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="627" data-rate="0.55">627 -
                                        Facebook Post Reaction (Angry 😡) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ -
                                        $0.55 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="621" data-rate="0.55">621 -
                                        Facebook Post Reaction (Likes 👍) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ -
                                        $0.55 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="622" data-rate="0.55">622 -
                                        Facebook Post Reaction (Haha 😄) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ - $0.55
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="623" data-rate="0.55">623 -
                                        Facebook Post Reaction (Love ❤️) | Non Drop | 3K/Day | 30 Days Guaranteed ♻️ - $0.55
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="1000000" value="594" data-rate="0.69">594 -
                                        Facebook Post Reaction [ Love ❤️ ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="598" data-rate="0.69">598 -
                                        Facebook Post Reaction [ Care 🤗 ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="599" data-rate="0.69">599 -
                                        Facebook Post Reaction [ Haha 😄 ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="596" data-rate="0.69">596 -
                                        Facebook Post Reaction [ Wow 😮 ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="50" data-max="10000" value="370" data-rate="0.4">370 -
                                        Facebook - Reaction Love VN | Instant | 10K Per Day - $0.4 (Min-Max: 50 - 10000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="597" data-rate="0.69">597 -
                                        Facebook Post Reaction [ Sad 😢 ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="5000000" value="595" data-rate="0.69">595 -
                                        Facebook Post Reaction [ Angry 😡 ] (Vietnamese) | Non Drop | Day 10K ♻️ - $0.69
                                        (Min-Max: 100 - 5000000)</option>
                                    <option data-min="50" data-max="10000" value="371" data-rate="0.4">371 -
                                        Facebook - Reaction Care VN | Instant | 10K Per Day - $0.4 (Min-Max: 50 - 10000)
                                    </option>
                                    <option data-min="200" data-max="100000" value="374" data-rate="0.4">374 -
                                        Facebook - Reaction Sad VN | Instant | 10K Per Day - $0.4 (Min-Max: 200 - 100000)
                                    </option>
                                    <option data-min="50" data-max="10000" value="372" data-rate="0.4">372 -
                                        Facebook - Reaction Wow VN | Instant | 10K Per Day - $0.4 (Min-Max: 50 - 10000)
                                    </option>
                                    <option data-min="50" data-max="10000" value="373" data-rate="0.4">373 -
                                        Facebook - Reaction Angry VN | Instant | 10K Per Day - $0.4 (Min-Max: 50 - 10000)
                                    </option>
                                    <option data-min="10" data-max="5000" value="1223" data-rate="5.031">1223 -
                                        Facebook Comments Global | Max 5K | MQ Profiles | No Refill | 5K/Day - $5.031
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="10000000" value="375" data-rate="2500">375 -
                                        Facebook Comment Vietnam | Instant | Max 10M | 5 - 100/Day - $2500 (Min-Max: 10 -
                                        10000000)</option>
                                    <option data-min="5" data-max="300000" value="1486" data-rate="3.5">1486 -
                                        Facebook Comments Vienam | Instant | No Refill | 50K/Day⚡ - $3.5 (Min-Max: 5 -
                                        300000)</option>
                                    <option data-min="5" data-max="1000" value="1487" data-rate="3.0625">1487 -
                                        Facebook Post Comment | Max 100K | Instant | 50 - 1K/Day - $3.0625 (Min-Max: 5 -
                                        1000)</option>
                                    <option data-min="10" data-max="100000000" value="1635" data-rate="0.1792">
                                        1635 - Facebook Comment | Hidden | Instant | No refill | 10K/Day - $0.1792 (Min-Max:
                                        10 - 100000000)</option>
                                    <option data-min="10" data-max="100000000" value="1671" data-rate="0.1344">
                                        1671 - Facebook Comment | Hidden Data | Instant | 5K/Day - $0.1344 (Min-Max: 10 -
                                        100000000)</option>
                                    <option data-min="10" data-max="1000000000" value="1617" data-rate="0.162">
                                        1617 - Facebook Hidden Comments | Instant | 100K+ Daily | No Refill ⛔⚡ - $0.162
                                        (Min-Max: 10 - 1000000000)</option>
                                    <option data-min="100000" data-max="9999999" value="1770" data-rate="0.0554">
                                        1770 - Facebook Hidden Comments | Instant | 200K+ Daily | No Refill ⛔⚡ - $0.0554
                                        (Min-Max: 100000 - 9999999)</option>
                                    <option data-min="50" data-max="9999999" value="1768" data-rate="0.0924">1768
                                        - Facebook Hidden Comments | Instant | 100K+ Daily | No Refill ⛔⚡ - $0.0924
                                        (Min-Max: 50 - 9999999)</option>
                                    <option data-min="5" data-max="1000" value="1797" data-rate="0.9091">1797 -
                                        Facebook - Comments | Data Page | Instant | 10K/Day - $0.9091 (Min-Max: 5 - 1000)
                                    </option>
                                    <option data-min="1" data-max="9999999" value="1701" data-rate="0.6281">1701
                                        - Facebook Comments Post | Data Vietnam | Instant | No refill | 500 -1K/Day -
                                        $0.6281 (Min-Max: 1 - 9999999)</option>
                                    <option data-min="10" data-max="100000" value="1787" data-rate="1">1787 -
                                        Facebook Comments Post | Max 100K | Super Fast | 20K - 50K/Day - $1 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="100" data-max="500000" value="1086" data-rate="0.35">1086 -
                                        Facebook Follower Fanpage | Non Drop | Instant | 10K - 50K/Day - 𝗣𝗿𝗼𝘃𝗶𝗱𝗲
                                        𝗺𝗮𝗶𝗻 - $0.35 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="500000" value="583" data-rate="0.2563">583 -
                                        Facebook Page Followers | Non Drop | NR ⚠️ | Max 500K | Day 10K - $0.2563 (Min-Max:
                                        100 - 500000)</option>
                                    <option data-min="100" data-max="500000" value="582" data-rate="0.3019">582 -
                                        Facebook Page Followers | Max 500k | 𝐍𝐨𝐧 𝐃𝐫𝐨𝐩 ~ 20k/Day ~ Instant ~
                                        𝗥𝗘𝗙𝗜𝗟𝗟 30D | 𝗣𝗥𝗢𝗩𝗜𝗗𝗘𝗥 - $0.3019 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="50000" value="577" data-rate="0.2614">577 -
                                        Facebook - Page 𝗙𝗼𝗹𝗹𝗼𝘄𝗲𝗿𝘀 | Any Type Page | 50k/days | Instant | 𝗥30D♻️ -
                                        $0.2614 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="500000" value="383" data-rate="0.2573">383 -
                                        Facebook Page Followers [Speed: Day 10K] [Refill: 30 Days ♻️] - $0.2573 (Min-Max:
                                        100 - 500000)</option>
                                    <option data-min="100" data-max="100000" value="382" data-rate="0.2454">382 -
                                        Facebook Page Followers [Speed: Day 5K] [Refill: No] - $0.2454 (Min-Max: 100 -
                                        100000)</option>
                                    <option data-min="100" data-max="10000" value="1425" data-rate="0.315">1425 -
                                        Facebook Follower All Type Page | ND | R30 | Instant | 2K - 5K/Day - $0.315
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="100000" value="1402" data-rate="0.6866">1402
                                        - Facebook Followers | Max 100K | Only Page | Instant | Refill 30 Day | 2K - 5K/Day
                                        - $0.6866 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="814" data-rate="0.72">814 -
                                        Facebook Follow Profile/Page Via| Refill 7 Day | Start: 0 - 1 Hour | 5K - 10K/Day -
                                        $0.72 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="1000" value="769" data-rate="0.79">769 -
                                        Facebook Follow Profile Via + Page Pro5 | Refill 30 Day | Start: 0 - 6 Hour |
                                        50k/Day - $0.79 (Min-Max: 100 - 1000)</option>
                                    <option data-min="100" data-max="20000" value="770" data-rate="0.79">770 -
                                        Facebook Follow Profile Via + Page Pro5 | Refill 30 Day | Start: 0 - 1 Hour |
                                        20K/Day - $0.79 (Min-Max: 100 - 20000)</option>
                                    <option data-min="500" data-max="50000" value="1642" data-rate="0.48">1642 -
                                        Facebook Follow Profile | Vietnam | Instant | Max 50K | 3K - 10K/Day - $0.48
                                        (Min-Max: 500 - 50000)</option>
                                    <option data-min="100" data-max="1000000" value="1739" data-rate="0.2176">1739
                                        - Facebook Follow PRofile/Page | Vietnam + Avatar | Không Bảo Hành | Max 1M |
                                        Instant | 300 - 2K/Day - $0.2176 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1672" data-rate="0.1349">1672
                                        - Facebook Follow Vietnam | Instant | Refill 30 Day | 1K - 5K/Day - $0.1349
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="50" data-max="10000000" value="1555" data-rate="1100">1555
                                        - Facebook Follow Profile/Page | Instant | Max 10K | 100% Real | 1K - 5K/Day - $1100
                                        (Min-Max: 50 - 10000000)</option>
                                    <option data-min="100" data-max="10000" value="1358" data-rate="0.56328">1358
                                        - Facebook Followers Profile/Page Global | Max 500K | Cancel Enabled | NR |
                                        10K/Day⚠️ - $0.56328 (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="500" value="1313" data-rate="0.389963">1313 -
                                        Facebook Follow Profile New | Max 200K | Instant | No Refill | 10K/Day - $0.389963
                                        (Min-Max: 100 - 500)</option>
                                    <option data-min="100" data-max="2000000" value="1363" data-rate="0.52">1363 -
                                        Facebook Followers Vietnam &amp; Global | Instant | Cancel Fast | Refill 30 Day |
                                        10K/Day ♻️⛔ - $0.52 (Min-Max: 100 - 2000000)</option>
                                    <option data-min="100" data-max="2000" value="1333" data-rate="0.374207">1333
                                        - Facebook Follow Profile/Page | Max 5K/Order | Max 10K | Instant | No refill |
                                        5K/Day - $0.374207 (Min-Max: 100 - 2000)</option>
                                    <option data-min="100" data-max="7000" value="1391" data-rate="0.374207">1391
                                        - Facebook Follow Profile/Page | Max 50K | Instant | No Refill | 10K/Day - $0.374207
                                        (Min-Max: 100 - 7000)</option>
                                    <option data-min="100" data-max="9000" value="1543" data-rate="0.189073">1543
                                        - Facebook Follow Profile/Page | 100% Bot | Instant | No Refil | 3K/Day ( Mua bằng
                                        UID) - $0.189073 (Min-Max: 100 - 9000)</option>
                                    <option data-min="100" data-max="10000000" value="1544" data-rate="0.25">1544
                                        - Facebook Follow Profile/Page | Hidden | Start 0 - 1 Hour | Max 10M | 10K - 30K/Day
                                        - $0.25 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="1000" data-max="500000" value="1613" data-rate="0.22">1613 -
                                        Facebook Follow Profile/Page | Hidden | Instant | 50K/Day - $0.22 (Min-Max: 1000 -
                                        500000)</option>
                                    <option data-min="100" data-max="500000" value="1616" data-rate="0.18">1616 -
                                        Theo dõi Facebook Sale | Không hiển thị | Tốc độ nhanh | 50K - 100K/Ngày - $0.18
                                        (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="5000" value="1821" data-rate="0.001">1821 -
                                        TEST122131 - $0.001 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="100000" value="1622" data-rate="0.034">1622 -
                                        Facebook Follow Profile | Vietnam + Avatar | Instant | Refill 30 Day | Max 100K |
                                        5K/Day - $0.034 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="10000" value="1640" data-rate="0.0975">1640 -
                                        Facebook Follow | Bot Vietnam | No refill | Max 4M | 10K/Day - $0.0975 (Min-Max: 100
                                        - 10000)</option>
                                    <option data-min="100" data-max="3000" value="1741" data-rate="0.0501">1741 -
                                        Facebook Follow Profile/Page | Hidden Data | Max 2M | 10K/Day - $0.0501 (Min-Max:
                                        100 - 3000)</option>
                                    <option data-min="100" data-max="5000" value="1845" data-rate="0.135">1845 -
                                        Facebook Follow Sale | Bot Data | Instant | Slow | 5K/Day - $0.135 (Min-Max: 100 -
                                        5000)</option>
                                    <option data-min="10" data-max="500000" value="1847" data-rate="0.1302">1847
                                        - Facebook Follow Profile/Page | Global | Instant | No refill | 20K/Day - $0.1302
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="10000" value="1817" data-rate="0.1266">1817 -
                                        Facebook Profile/Page Follow | BOT | Max 500K | Instant | 10K/Day - $0.1266
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1772" data-rate="0.1479">1772 -
                                        Facebook Followers | Hidden | Instant | 10K/Day - $0.1479 (Min-Max: 100 - 10000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="1392" data-rate="0.1302">1392
                                        - Facebook Follow Profile/Page | BOT Data | Instant | Refill 30 Day | 10K - 30K/Day
                                        - $0.1302 (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="5000" value="1823" data-rate="0.15">1823 -
                                        Facebook Follow Profile/Page | Data BOT | Max 10M | 10K - 20K/Day - $0.15 (Min-Max:
                                        100 - 5000)</option>
                                    <option data-min="100" data-max="10000" value="1818" data-rate="0.1306">1818 -
                                        Facebook Profile/Page Followers | Hidden | Max 3M | Instant | 20K/Day - $0.1306
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1822" data-rate="0.1301">1822 -
                                        Facebook Followers | Hidden | Instant | 10K/Day - $0.1301 (Min-Max: 100 - 10000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="1649" data-rate="0.1693">1649
                                        - Facebook Followers | Hidden Data | Max 4M | Instant | Refill 30 Day | 500K -
                                        1M/Day - $0.1693 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="10000" value="1624" data-rate="0.069">1624 -
                                        Facebook Profile/Page Follow | Bot Vietnam | Instant | Max 10M | Refill 30 Day |
                                        10K/Day - $0.069 (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="100000" value="1666" data-rate="0.1088">1666
                                        - Facebook Profile/Page Followers | Max 1M | Instant | 10K/Day - $0.1088 (Min-Max:
                                        100 - 100000)</option>
                                    <option data-min="100" data-max="10000" value="1502" data-rate="0.069">1502 -
                                        Facebook Followers | Hidden Data | Instant | Non Drop | 20K/Day | No Refill 🔥⚡⚠️ ❎
                                        - $0.069 (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1638" data-rate="0.0927">1638 -
                                        Facebook Profile/Page Followers | Refill 30Day | Max 5M | Instsnt | 50K/Day -
                                        $0.0927 (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="500000" value="1639" data-rate="0.125">1639 -
                                        Faceook Follow Profile/Page | Bot Vietnam | Max 100K | Instant | 10K - 20K/Day -
                                        $0.125 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="100000" value="1542" data-rate="0.1088">1542
                                        - Facebook Profile/Page Followers | Bot Vietnam| Max 10M | Instant | Refill 30 Day |
                                        20K - 50K/Day - $0.1088 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="1000000" value="1612" data-rate="0.1739">1612
                                        - Facebook Follow Profile/Page | Hidden | Instant | Max 2M | Refill 30 Day | 20K -
                                        50K/Day - $0.1739 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="10000" value="1664" data-rate="0.13">1664 -
                                        Facebook Followers Profile/Page | Max 2M | Bot Vietnam No Avatar | Instant | Refill
                                        30 Day | 10K/Day - $0.13 (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="200000" value="1618" data-rate="0.1083">1618
                                        - Facebook Follow Profile | Bot Vietnam | Instant| Max 100K | 10K/Day - $0.1083
                                        (Min-Max: 100 - 200000)</option>
                                    <option data-min="100" data-max="2000000" value="1637" data-rate="7400">1637 -
                                        Facebook Follow Profile/Page | Bot Vietnam + Avatar | Instant | Max 1M | 5K/Day -
                                        $7400 (Min-Max: 100 - 2000000)</option>
                                    <option data-min="100" data-max="200000" value="1610" data-rate="0.1043">1610
                                        - Facebook Follow Profile/Page Vietnam | Instant | Max 1M | 5K/Day - $0.1043
                                        (Min-Max: 100 - 200000)</option>
                                    <option data-min="100" data-max="10000" value="1602" data-rate="0.466">1602 -
                                        Facebook Follow Profile/Page Vietnam | HQ Avatar | Instant | 10K/Day - $0.466
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="1000000" value="1603" data-rate="0.352">1603
                                        - Facebook Follow Profile/Page | Vietnam + Avatar | Instant | 10K - 20K/Day - $0.352
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="500" data-max="50000" value="1479" data-rate="0.56">1479 -
                                        Facebook Follow Profile/Page Facebook Vietnam | Instant | Resource Page Pro5 |
                                        Refill 30 Day | 5K - 10K/Day - $0.56 (Min-Max: 500 - 50000)</option>
                                    <option data-min="500" data-max="100000" value="1334" data-rate="0.4">1334 -
                                        Facebook Follow Profile/Page New | Account Full Pro5 | Start 0 - 24 Hour | Refill 30
                                        Day | 50K/Day - $0.4 (Min-Max: 500 - 100000)</option>
                                    <option data-min="100" data-max="7000" value="1416" data-rate="0.374207">1416
                                        - Facebook Follow Profile/Page New Form | Max 30K | Start: 0 - 12 hour | Refill 30
                                        Day | Drop 0 - 10% | 5K/Day - $0.374207 (Min-Max: 100 - 7000)</option>
                                    <option data-min="100" data-max="10000" value="1413" data-rate="0.441171">1413
                                        - Facebook Follow Profile/Page VIP | Max 8K| Fast| No Refill | 10K/Hour - $0.441171
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1094" data-rate="0.56328">1094
                                        - Facebook Follow Profile/Page New | Super Fast | Refill 7 Day | 10K/Day - $0.56328
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1279" data-rate="0.56328">1279
                                        - Facebook Follow Profile/Page Vietnam | Instant or Start 0 - 30 minutes | NR |
                                        10K/Day - $0.56328 (Min-Max: 100 - 10000)</option>
                                    <option data-min="1000" data-max="1000" value="1095" data-rate="0.4">1095 -
                                        Facebook Follow Profile/Page Vietnamese Sale | Instant | Max 1K | 1K/Day - $0.4
                                        (Min-Max: 1000 - 1000)</option>
                                    <option data-min="5000" data-max="1000000" value="1226" data-rate="0.2">1226 -
                                        Facebook Follow Profile Vietnam | Start 0 - 24 Hour | No Refill | 3K - 10K/Day -
                                        $0.2 (Min-Max: 5000 - 1000000)</option>
                                    <option data-min="100" data-max="500000" value="1144" data-rate="0.46">1144 -
                                        Facebook Followers Profile/Page | Non Drop | Instant | Refill 30 Day | 20K/Day ♻️ -
                                        $0.46 (Min-Max: 100 - 500000)</option>
                                    <option data-min="10" data-max="100000" value="1225" data-rate="0.4601">1225
                                        - Facebook Followers Profile/Page Global | Instant | Cancel Enable | No Refill|
                                        50K/Day♻️(bonus 0 - 50%) - $0.4601 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1147" data-rate="0.4999">1147
                                        - Facebook Follow Profile/Page Global | Cancel Enable | Instant | No Refill |
                                        30K/Day - $0.4999 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="50000" value="1181" data-rate="0.6097">1181 -
                                        Facebook Follow Profile Global | Instant | Refill 30 Day | 50K/Day - $0.6097
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="1000" data-max="10000000" value="1143" data-rate="0.425">
                                        1143 - Facebook Follow 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 Bot | Non Drop | Instant Or Start 0 - 24 hour
                                        | 𝗥𝗘𝗙𝗜𝗟𝗟 30Day | 100K/Day - $0.425 (Min-Max: 1000 - 10000000)</option>
                                    <option data-min="10000" data-max="10000000" value="1102" data-rate="0.54">
                                        1102 - Facebook Follow Profile/Page Global | Instant | R30 Day | Non Drop | Min 10K
                                        | 500K/Day - $0.54 (Min-Max: 10000 - 10000000)</option>
                                    <option data-min="500" data-max="100000" value="572" data-rate="0.5">572 -
                                        Facebook Follow Bot Profile/Fanpage Global | Start: 0 - 24 hour | QH | Bonus: 0 - 2%
                                        | 200K/Day - $0.5 (Min-Max: 500 - 100000)</option>
                                    <option data-min="50" data-max="1000" value="1311" data-rate="0.769">1311 -
                                        Facebook Follow Clone Vietnam | Instant | No Refill | No Cancel | 1K - 5K/Day -
                                        $0.769 (Min-Max: 50 - 1000)</option>
                                    <option data-min="100" data-max="1000000" value="1336" data-rate="0.8554">1336
                                        - Facebook Follow Vietnam Profile/Page | Instant | Refill 30 Day | 3K- 5K/Day -
                                        $0.8554 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="50000000" value="1180" data-rate="0.825">1180
                                        - Facebook Follow Profile Vietnam | Max 5M | Instant | 5K - 10K/Day - $0.825
                                        (Min-Max: 100 - 50000000)</option>
                                    <option data-min="100" data-max="10000000" value="1337" data-rate="0.8669">
                                        1337 - Facebook Follow Vietnam Profile/Page | Instant | Refil 30 Day | 3K - 10K/Day
                                        - $0.8669 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="50000" value="1099" data-rate="0.6169">1099 -
                                        Facebook Followers Profile | Start 0 - 10 Minutes | Refill 7 Day | 20K/Day - $0.6169
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="100000" value="1139" data-rate="0.5928">1139
                                        - Facebook Follow Profile/Page Clone Global | Max 100K | Refill 7 Day | Cancel
                                        Enable | Instant | Day 50K - $0.5928 (Min-Max: 10 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="841" data-rate="0.72">841 -
                                        Facebook - Follow Clone Page | Start 0 - 12 Hour | Max 20K | 1K - 5K/Day⚡ - $0.72
                                        (Min-Max: 100 - 50000)</option>
                                    <option data-min="500" data-max="600000" value="743" data-rate="0.4">743 -
                                        Facebook Follow Bot Profile/Fanpage | Start: 6 - 24 hour | QH | Bonus: 0 - 50% |
                                        50K/Day - $0.4 (Min-Max: 500 - 600000)</option>
                                    <option data-min="500" data-max="600000" value="729" data-rate="0.4">729 -
                                        Facebook Follow Bot Profile/Fanpage | Start: 6 - 24 hour | QH |50K/Day - $0.4
                                        (Min-Max: 500 - 600000)</option>
                                    <option data-min="1000" data-max="500000" value="719" data-rate="0.5866">719
                                        - Facebook Followers | 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲 𝗣𝗮𝗴𝗲/𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | 5K/Day -
                                        $0.5866 (Min-Max: 1000 - 500000)</option>
                                    <option data-min="500" data-max="500000" value="327" data-rate="0.38">327 -
                                        Facebook 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 Follower | 500k | Non Drop | 15k/day | 𝗥30D♻️ [ Own ] -
                                        $0.38 (Min-Max: 500 - 500000)</option>
                                    <option data-min="100" data-max="100000" value="718" data-rate="0.6895">718 -
                                        Facebook Followers | 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲 𝗣𝗮𝗴𝗲/𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | 10K/Day -
                                        $0.6895 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="672" data-rate="0.8117">672 -
                                        Facebook Followers Profile/Page| Non Drop | QH | Instant| 50K/Day - $0.8117
                                        (Min-Max: 100 - 50000)</option>
                                    <option data-min="500" data-max="300000" value="326" data-rate="0.33">326 -
                                        Facebook Followers | Max 300k | 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 Follower | Bot Quality | Non Drop |
                                        10k/day | 𝗥30D♻️ [ Own ] - $0.33 (Min-Max: 500 - 300000)</option>
                                    <option data-min="1000" data-max="100000" value="325" data-rate="0.3">325 -
                                        Facebook Followers | Max 100k | 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲 𝗣𝗮𝗴𝗲/𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Bot
                                        Quality | Non Drop | 5k/day | 𝗥30D♻️ [ Own ] - $0.3 (Min-Max: 1000 - 100000)
                                    </option>
                                    <option data-min="50" data-max="200000" value="1405" data-rate="0.781">1405 -
                                        Facebook Follow Profile/Page VIP | Instant | Refill 30 Day | Max 100K | 5K - 10K/Day
                                        - $0.781 (Min-Max: 50 - 200000)</option>
                                    <option data-min="100" data-max="500000" value="1605" data-rate="0.1925">1605
                                        - Theo dõi Facebook Độc quyền | Tài khoản Việt Nam | Không giới hạn số lượng | Huỷ
                                        trợ huỷ/hoàn | Tốc độ 10K/ngày - $0.1925 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="1000000" value="1812" data-rate="0.1743">1812
                                        - Facebook Follow Profile/Page | Hidden Data | Max 4M | 50K/Day - $0.1743 (Min-Max:
                                        100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1478" data-rate="0.1743">1478
                                        - Facebook Followers Profile/Page | Hidden | Instant | Refill 30 Day | 500K+/Day⚡ -
                                        $0.1743 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="100000" value="1080" data-rate="0.1433">1080
                                        - Facebook Follow Profile/Page | Vietnam | Instant | Cancel/Refund | No refill |
                                        10K/Day - $0.1433 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="8000" value="1598" data-rate="0.1875">1598 -
                                        Theo dõi Facebook Độc quyền | Tài khoản Việt Nam | Không giới hạn số lượng | Bảo
                                        hành 7 ngày | Tốc độ 10K/ngày - $0.1875 (Min-Max: 100 - 8000)</option>
                                    <option data-min="1000" data-max="5000" value="1607" data-rate="1.75849E-5">
                                        1607 - Facebook Follow Profile/Page | Max 100K | Start 0 - 1 Hour | 10K/Day -
                                        $1.75849E-5 (Min-Max: 1000 - 5000)</option>
                                    <option data-min="100" data-max="100000" value="1623" data-rate="0.034">1623 -
                                        Theo Dõi Trang Facebook - Tốc Độ Nhanh - Bảo Hành 30 Ngày - Max 100K | Tốc Độ
                                        5-10K/Ngày - $0.034 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="1000000" value="1695" data-rate="0.1818">1695
                                        - Sub facebook giá siêu rẻ tốc độ 500K/Ngày Max 3M - $0.1818 (Min-Max: 100 -
                                        1000000)</option>
                                    <option data-min="100" data-max="10000" value="1696" data-rate="0.0618">1696 -
                                        Facebook Follow Profile/Page Hidden Data 50K/ Day Slow Data (Own Server) - $0.0618
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="20000" value="1820" data-rate="0.01">1820 -
                                        TEST - $0.01 (Min-Max: 100 - 20000)</option>
                                    <option data-min="10" data-max="500000" value="1490" data-rate="0.7325">1490
                                        - Facebook - Page Likes + Followers | Max 500k | HQ Real Accounts | Instant | No
                                        refill | 50k/Day - $0.7325 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1480" data-rate="0.77">1480 -
                                        Facebook Page Likes + Followers [ Max 500K ] | HQ &amp; Real Profiles | No Refill ⚠️
                                        | Instant Start | Day 100K 🚀 - $0.77 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1481" data-rate="0.85">1481 -
                                        Facebook Page Likes + Followers [ Max 500K ] | HQ &amp; Real Profiles | 30 Days ♻️ |
                                        Instant Start | Day 100K 🚀 - $0.85 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1482" data-rate="0.9">1482 -
                                        Facebook Page Likes + Followers [ Max 500K ] | HQ &amp; Real Profiles | 90 Days ♻️ |
                                        Instant Start | Day 100K 🚀 - $0.9 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1483" data-rate="0.95">1483 -
                                        Facebook Page Likes + Followers [ Max 500K ] | HQ &amp; Real Profiles | 365 Days ♻️
                                        | Instant Start | Day 100K 🚀 - $0.95 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1484" data-rate="1.1">1484 -
                                        Facebook Page Likes + Followers [ Max 500K ] | HQ &amp; Real Profiles | Lifetime ♻️
                                        | Instant Start | Day 100K 🚀 - $1.1 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1504" data-rate="0.32">1504 -
                                        Facebook Page Likes + Followers | Max 500K | MQ Accounts | Low Drop | No Refill |
                                        Instant Start | Day 50K⚠️ - $0.32 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1084" data-rate="0.34">1084 -
                                        Facebook Page Likes + Followers | Max 500K | MQ Accounts | Low Drop | 30 Days |
                                        Instant Start | Day 50K♻️ - $0.34 (Min-Max: 10 - 500000)</option>
                                    <option data-min="50" data-max="20000" value="1400" data-rate="0.95">1400 -
                                        Facebook Like/Follow Page Vietnam | Instant | Max 200K | No Refill | 2K - 5K/Day -
                                        $0.95 (Min-Max: 50 - 20000)</option>
                                    <option data-min="100" data-max="500000" value="1308" data-rate="1.292">1308 -
                                        Facebook Like Page Vietnam &amp;amp; Global VIP | Account Quality High &amp;amp; BOT
                                        | Instant | Refill 7 Day | 10K - 20K/Day - $1.292 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="5000000" value="1357" data-rate="1.38">1357 -
                                        Facebook Page Like + Followers | Max 1M | Instant | Refill 30 Days | 20K/Day ♻️ -
                                        $1.38 (Min-Max: 100 - 5000000)</option>
                                    <option data-min="10" data-max="500000" value="1262" data-rate="0.8968">1262
                                        - Facebook Likes + Follower Fanpage Global | Instant | Refill 30 Day | 50K/Day -
                                        $0.8968 (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="5000000" value="1229" data-rate="0.9499">1229
                                        - Facebook Page Like + Follow | Instant | Refill 30 Day | 10K/Day - $0.9499
                                        (Min-Max: 100 - 5000000)</option>
                                    <option data-min="100" data-max="1000000" value="1228" data-rate="0.96">1228 -
                                        Facebook Likes + Followers Page | Instant | Refill 30 Day | 20K - 50K/Day - $0.96
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="10" data-max="100000" value="1175" data-rate="0.6147">1175
                                        - Facebook Likes + Follow Fanpage | Real Data | Instant | Refill 7 Day | 20K/Day -
                                        $0.6147 (Min-Max: 10 - 100000)</option>
                                    <option data-min="50" data-max="50000" value="866" data-rate="1.1">866 -
                                        Facebook Page Likes | Instant | 100% Real &amp; Old Data | 2K Per Day ⚡⛔ - $1.1
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="10" data-max="100000" value="1142" data-rate="0.58">1142 -
                                        Facebook Page Like + Followers | Cancel Enable | Super Instant | Refill 30 Day |
                                        50K/Day♻️ - $0.58 (Min-Max: 10 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="1595" data-rate="0.1674">1595
                                        - Facebook Page Like + Followers | Max 100K | Instant | 10K/Day - $0.1674 (Min-Max:
                                        100 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1335" data-rate="0.3444">1335
                                        - Facebook Like Page/Follow| Instant | Max 200K | No Refill | 10K/Day - $0.3444
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="500" data-max="50000" value="1485" data-rate="1.1">1485 -
                                        Facebook Like/Follow Page Vietnam | Instant | No refill | Max 50K | 5K - 20K/Day -
                                        $1.1 (Min-Max: 500 - 50000)</option>
                                    <option data-min="10" data-max="1000000" value="1261" data-rate="0.6">1261 -
                                        Facebook Like/Follow Fanpage Global | Instant | No refill | 10K/Day - $0.6 (Min-Max:
                                        10 - 1000000)</option>
                                    <option data-min="100" data-max="5000000" value="1104" data-rate="0.84">1104 -
                                        Facebook Page Like + Follow | Non Drop | R30 | Instant complete | 10K/Day - $0.84
                                        (Min-Max: 100 - 5000000)</option>
                                    <option data-min="50" data-max="50000" value="905" data-rate="1.32">905 -
                                        Facebook Page Like + Follow [ 10k-20k/D ] [ Non Drop ] [ R30 ] [ working on Market
                                        💫 ] [ Instant ] - $1.32 (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="5000000" value="619" data-rate="0.8674">619
                                        - Facebook 𝗣age Likes + Follower | Max 200K | Instant | Non Drop | 10k-50k/ Days -
                                        $0.8674 (Min-Max: 100 - 5000000)</option>
                                    <option data-min="100" data-max="50000" value="584" data-rate="1.1">584 -
                                        Facebook Page Likes | Instant | 3K Per Day | 30 Day Refill ⚡♻️⛔ - $1.1 (Min-Max: 100
                                        - 50000)</option>
                                    <option data-min="100" data-max="50000" value="865" data-rate="1.1">865 -
                                        Facebook Page Likes | Instant | 10K Per Day | 30 Day Refill ⚡♻️⛔ - $1.1 (Min-Max:
                                        100 - 50000)</option>
                                    <option data-min="10" data-max="10000000" value="892" data-rate="0.71">892 -
                                        Facebook 𝗣age Likes + Follower Vietnam | Max 10M | Start: 1 - 3 Hour | Non Drop |
                                        5K/ Days - $0.71 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="100" data-max="5000000" value="904" data-rate="0.84">904 -
                                        Facebook Page Like + Follow | Non Drop | Refill 30 Day | Instant | 10K/Day -
                                        𝗣𝗿𝗼𝘃𝗶𝗱𝗲 𝗠𝗮𝗶𝗻 - $0.84 (Min-Max: 100 - 5000000)</option>
                                    <option data-min="10" data-max="1000000" value="1410" data-rate="0.3714">1410
                                        - Facebook Page Like + Follow | Super Fast | Less Drop | No Refill | 5K - 10K/Day⛔ -
                                        $0.3714 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1406" data-rate="0.768">1406
                                        - Facebook Like Page VIP | Instant | Max 100K | 20K - 30K/Day - $0.768 (Min-Max: 50
                                        - 1000000)</option>
                                    <option data-min="500" data-max="100000" value="1446" data-rate="0.992">1446 -
                                        Facebook Page Likes + Follower | Max 100k | High Quality | Start 0 - 12 hour |
                                        Refill 90 Day | 5K - 10K/Day - $0.992 (Min-Max: 500 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1447" data-rate="1.169">1447 -
                                        Facebook Page Likes + Follower | Max 100k | Instant | No Refill |🌎 Worldwide | 10k/
                                        Day - $1.169 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1448" data-rate="1.26">1448 -
                                        Facebook Page Likes + Follower | Max 100k | Instant | Refill 30 Day | 🌎 Worldwide |
                                        10k/ Day - $1.26 (Min-Max: 10 - 100000)</option>
                                    <option data-min="50" data-max="200000" value="1491" data-rate="0.95">1491 -
                                        Facebook Like Page + Follow | Slow | Instant | Max 200K | 100 - 500/Day - $0.95
                                        (Min-Max: 50 - 200000)</option>
                                    <option data-min="10" data-max="100000" value="1594" data-rate="0.3444">1594
                                        - Facebook Page Likes + Follower | Max 500K | Instant | 𝗛𝗤 𝗔𝗰𝗰𝗼𝘂𝗻𝘁𝘀 |
                                        100K/ Day - $0.3444 (Min-Max: 10 - 100000)</option>
                                    <option data-min="50" data-max="5000" value="1215" data-rate="0.625625">1215
                                        - Facebook Story View | Max 10K | Instant | Super Fast | 10K/Day⚡ - $0.625625
                                        (Min-Max: 50 - 5000)</option>
                                    <option data-min="30" data-max="20000" value="1473" data-rate="0.1852">1473 -
                                        Facebook Story View | Lifetime | Max 20K | Instant | 20K/Day 🔥 - $0.1852 (Min-Max:
                                        30 - 20000)</option>
                                    <option data-min="50" data-max="20000" value="1257" data-rate="0.185">1257 -
                                        Facebook Story Views | Instant | 1K Per Hour | No Refill ⛔ - $0.185 (Min-Max: 50 -
                                        20000)</option>
                                    <option data-min="100" data-max="100000" value="1364" data-rate="0.189073">
                                        1364 - Facebook Story Views | UltraFast Completed | Max 100K | Lifetime ♻️⛔ -
                                        $0.189073 (Min-Max: 100 - 100000)</option>
                                    <option data-min="50" data-max="5000" value="1219" data-rate="1.347255">1219
                                        - Facebook Story View | Refill: Lifetime | Instant | 5K/Day ♻️ - $1.347255 (Min-Max:
                                        50 - 5000)</option>
                                    <option data-min="50" data-max="5000" value="1182" data-rate="0.625625">1182
                                        - Facebook Story View | Max 10K | Instant | Super Fast | 10K/Day⚡ - $0.625625
                                        (Min-Max: 50 - 5000)</option>
                                    <option data-min="1" data-max="1000000000" value="1368" data-rate="0.0005">
                                        1368 - Facebook Plays | Instant | 10K+ Daily | Cancel Fast | 30 Days Automatic
                                        Refill Button ♻️⛔ - $0.0005 (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="1" data-max="1000000000" value="1324" data-rate="0.0007">
                                        1324 - Facebook View Video/Reel/Play | Instant | Refill 30 Day | 100K/Day - $0.0007
                                        (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="1" data-max="1000000000" value="1129" data-rate="0.0007">
                                        1129 - Facebook Reels | Max Unlimited | Views/Plays | Non Drop | Instant | 10k/Day -
                                        $0.0007 (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="500" data-max="10000000" value="1029" data-rate="0.0155">
                                        1029 - Facebook Views I All Link | Non Drop | 100K/Day ⚡ | 30 Days Guaranteed ♻️ -
                                        $0.0155 (Min-Max: 500 - 10000000)</option>
                                    <option data-min="500" data-max="10000000" value="1030" data-rate="0.0011">
                                        1030 - Facebook Views | Reels/Video | Non Drop | 5K/Day ⚡ - $0.0011 (Min-Max: 500 -
                                        10000000)</option>
                                    <option data-min="500" data-max="10000000" value="1032" data-rate="0.03">1032
                                        - Facebook Views | Reels/Video | Non Drop | Day 50K ⚡ - $0.03 (Min-Max: 500 -
                                        10000000)</option>
                                    <option data-min="100" data-max="10000000" value="376" data-rate="0.0318">376
                                        - Facebook Views | Max 10M | Video/Reels | Non Drop | 5k-50k/Day - $0.0318 (Min-Max:
                                        100 - 10000000)</option>
                                    <option data-min="100" data-max="1000000" value="1031" data-rate="0.072">1031
                                        - Facebook Video/Reel Views | Non Drop | UltraFast / Day 100K ⚡ | Lifetime
                                        Guaranteed ♻️ - $0.072 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000000" value="1033" data-rate="0.0351">
                                        1033 - Facebook Video Views | Max: Unlimited | Non Drop | Day 20K | No Refill ⚡ [
                                        𝗨𝗣𝗗𝗔𝗧𝗘 💣 ] - $0.0351 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="500" data-max="2147483647" value="1305" data-rate="0.0914">
                                        1305 - Facebook Reels | Max Unlimited | Views/Plays | Non Drop | Instant | 20K -
                                        100K/Day - $0.0914 (Min-Max: 500 - 2147483647)</option>
                                    <option data-min="500" data-max="10000000" value="1306" data-rate="0.0446">
                                        1306 - Facebook Reels | Max Unlimited | Views/Plays | Non Drop | Instant | 20K -
                                        50K/Day - $0.0446 (Min-Max: 500 - 10000000)</option>
                                    <option data-min="500" data-max="2147483647" value="1307" data-rate="0.06">
                                        1307 - Facebook Views | Max Unlimited | Video/Reels | Non Drop | Instant | 20K -
                                        50K/Day - $0.06 (Min-Max: 500 - 2147483647)</option>
                                    <option data-min="100" data-max="10000000" value="673" data-rate="0.0318">673
                                        - Facebook Views | Max 10M | Video/Reels | Non Drop | 5k-50k/Day | Instant ~
                                        𝐋𝐢𝐟𝐞𝐓𝐢𝐦𝐞 | 𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.0318 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="377" data-rate="0.0087">377
                                        - Facebook Reels | Max 10M | Views/Plays | Non Drop | 50k/Day - $0.0087 (Min-Max:
                                        100 - 10000000)</option>
                                    <option data-min="1" data-max="1000000000" value="1376" data-rate="0.0007">
                                        1376 - Facebook Plays | Instant | 30K+ Daily | Cancel Fast | 30 Days Automatic
                                        Refill Button ♻️⛔ - $0.0007 (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="1" data-max="1000000000" value="1377" data-rate="0.0019">
                                        1377 - Facebook Plays | Instant | 60K+ Daily | Cancel Fast | 30 Days Automatic
                                        Refill Button ♻️⛔ - $0.0019 (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="1" data-max="1000000000" value="1378" data-rate="0.015">
                                        1378 - Facebook Plays | Instant | 100K+ Daily | Cancel Fast | 30 Days Automatic
                                        Refill Button ♻️⛔ - $0.015 (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="1" data-max="1000000000" value="1379" data-rate="0.019">
                                        1379 - Facebook Plays | Instant | 5K+ Daily | Refill 30 Days ♻️⛔ ( Often Overloaded
                                        ) - $0.019 (Min-Max: 1 - 1000000000)</option>
                                    <option data-min="10" data-max="1000000000" value="1380" data-rate="0.03">
                                        1380 - Facebook Plays | Instant | 500K+ Daily | Cancel Fast | 30 Days Automatic
                                        Refill Button ♻️⛔ - $0.03 (Min-Max: 10 - 1000000000)</option>
                                    <option data-min="10" data-max="1000000000" value="1381" data-rate="0.1">1381
                                        - Facebook Reel/Video Plays | Instant | 100K+ Daily | Refill 30 Days ♻️⛔ - $0.1
                                        (Min-Max: 10 - 1000000000)</option>
                                    <option data-min="1000" data-max="1000000000" value="1614" data-rate="0.015">
                                        1614 - Facebook Reel/Video Plays | Instant | 1K+ Daily | Refill 30 Days ♻️ - $0.015
                                        (Min-Max: 1000 - 1000000000)</option>
                                    <option data-min="1000" data-max="1000000000" value="1615" data-rate="0.02">
                                        1615 - Facebook Reel/Video Plays | Instant | 10K+ Daily | Refill 30 Days ♻️ - $0.02
                                        (Min-Max: 1000 - 1000000000)</option>
                                    <option data-min="100" data-max="1000000000" value="1619" data-rate="0.0079">
                                        1619 - Facebook Reel/Video Plays | Instant | 10K+ Daily | Refill 30 Days ♻️ -
                                        $0.0079 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="500" data-max="10000000" value="664" data-rate="0.065">664
                                        - Facebook Reels/Video Views | Non Drop | 20K/Day ⚡ | Lifetime Guaranteed ♻️ -
                                        $0.065 (Min-Max: 500 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="665" data-rate="0.3278">665
                                        - Facebook Reel Views | Non Drop | UltraFast / Day 20K ⚡ | Lifetime Guaranteed ♻️ -
                                        $0.3278 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="674" data-rate="0.0087">674
                                        - Facebook Reels | Max 10M | Views/Plays | Non Drop | 5k-50k/Day | Instant ~
                                        𝐋𝐢𝐟𝐞𝐓𝐢𝐦𝐞 | 𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.0087 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="2147483647" value="661" data-rate="0.0118">
                                        661 - Facebook Reel Views | Non Drop | UltraFast / Day 200K ⚡ | 30 Days Guaranteed
                                        ♻️ - $0.0118 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="662" data-rate="0.0118">
                                        662 - Facebook Reel Views | Non Drop | UltraFast / Day 50K ⚡ | 30 Days Guaranteed ♻️
                                        - $0.0118 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="5000000" value="663" data-rate="0.0108">663
                                        - Facebook Reels Views I Non Drop | UltraFast / Day 20K ⚡ [ 𝗣𝗥𝗢𝗩𝗜𝗗𝗘𝗥 ] -
                                        $0.0108 (Min-Max: 100 - 5000000)</option>
                                    <option data-min="20" data-max="5000" value="926" data-rate="0.525">926 -
                                        SMM Facebook LiveStream View - 15 Min - $0.525 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="978" data-rate="1.05">978 - SMM
                                        Facebook LiveStream View - 30 Min - $1.05 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="977" data-rate="2.1">977 - SMM
                                        Facebook LiveStream View - 60 Min - $2.1 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="976" data-rate="3.15">976 - SMM
                                        Facebook LiveStream View - 90 Min - $3.15 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="975" data-rate="4.2">975 - SMM
                                        Facebook LiveStream View - 120 Min - $4.2 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="974" data-rate="5.25">974 - SMM
                                        Facebook LiveStream View - 180 Min - $5.25 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="973" data-rate="6.3">973 - SMM
                                        Facebook LiveStream View - 210 Min - $6.3 (Min-Max: 20 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="971" data-rate="8.4">971 - SMM
                                        Facebook LiveStream View - 300 Min - $8.4 (Min-Max: 20 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="972" data-rate="14.16">972 -
                                        SMM Facebook LiveStream View - 240 Min - $14.16 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="925" data-rate="1.77">925 - SMM
                                        Facebook LiveStream View - 30 Min - $1.77 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="924" data-rate="3.54">924 - SMM
                                        Facebook LiveStream View - 60 Min - $3.54 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="923" data-rate="5.31">923 - SMM
                                        Facebook LiveStream View - 90 Min - $5.31 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="922" data-rate="7.08">922 - SMM
                                        Facebook LiveStream View - 120 Min - $7.08 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="921" data-rate="10.62">921 -
                                        SMM Facebook LiveStream View - 180 Min - $10.62 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="920" data-rate="12.39">920 -
                                        SMM Facebook LiveStream View - 210 Min - $12.39 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="919" data-rate="14.16">919 -
                                        SMM Facebook LiveStream View - 240 Min - $14.16 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="918" data-rate="17.7">918 - SMM
                                        Facebook LiveStream View - 300 Min - $17.7 (Min-Max: 30 - 5000)</option>
                                    <option data-min="30" data-max="5000" value="893" data-rate="0.073">893 -
                                        Kênh 3 [Tốc Độ Nhanh][ Ổn Định Nhất][Nên Dùng] - $0.073 (Min-Max: 30 - 5000)
                                    </option>
                                    <option data-min="20" data-max="5000" value="894" data-rate="5.0E-5">894 -
                                        Kênh 2 [Tốc Độ Nhanh][ Tỷ Lệ Giữ View: 80-120%] - $5.0E-5 (Min-Max: 20 - 5000)
                                    </option>
                                    <option data-min="30" data-max="5000" value="895" data-rate="0.05">895 -
                                        Kênh 1 [Không Ổn Định][ Tỷ Lệ Giữ View: 70-120%] - $0.05 (Min-Max: 30 - 5000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1673" data-rate="0.279">1673 -
                                        Facebook Live Stream | Max 3K | Instant | 15 minutes - $0.279 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1674" data-rate="0.558">1674 -
                                        Facebook Live Stream | Max 3K | Instant | 30 minutes - $0.558 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1675" data-rate="1.116">1675 -
                                        Facebook Live Stream | Max 3K | Instant | 60 minutes - $1.116 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1676" data-rate="1.674">1676 -
                                        Facebook Live Stream | Max 3K | Instant | 90 minutes - $1.674 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1677" data-rate="2.232">1677 -
                                        Facebook Live Stream | Max 3K | Instant | 120 minutes - $2.232 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1678" data-rate="2.79">1678 -
                                        Facebook Live Stream | Max 3K | Instant | 150 minutes - $2.79 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1679" data-rate="3.348">1679 -
                                        Facebook Live Stream | Max 3K | Instant | 180 minutes - $3.348 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1680" data-rate="3.906">1680 -
                                        Facebook Live Stream | Max 3K | Instant | 210 minutes - $3.906 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1681" data-rate="4.464">1681 -
                                        Facebook Live Stream | Max 3K | Instant | 240 minutes - $4.464 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1682" data-rate="5.022">1682 -
                                        Facebook Live Stream | Max 3K | Instant | 270 minutes - $5.022 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1683" data-rate="5.58">1683 -
                                        Facebook Live Stream | Max 3K | Instant | 300 minutes - $5.58 (Min-Max: 20 - 3000)
                                    </option>
                                    <option data-min="20" data-max="3000" value="1684" data-rate="0.3105">1684 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 15 mins]
                                        - $0.3105 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1685" data-rate="0.621">1685 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 30 mins]
                                        - $0.621 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1686" data-rate="1.242">1686 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 60 mins]
                                        - $1.242 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1687" data-rate="1.863">1687 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 90 mins]
                                        - $1.863 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1688" data-rate="2.484">1688 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 120 mins]
                                        - $2.484 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1689" data-rate="3.105">1689 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 150 mins]
                                        - $3.105 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1690" data-rate="3.726">1690 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 180 mins]
                                        - $3.726 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1691" data-rate="4.347">1691 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 210 mins]
                                        - $4.347 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1692" data-rate="4.968">1692 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 240 mins]
                                        - $4.968 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1693" data-rate="5.589">1693 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 270 mins]
                                        - $5.589 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1694" data-rate="6.21">1694 -
                                        Facebook Live Stream | Max: 3K | Start: 0-5 Mins | Speed: 1-10K/D ❎ [Stay: 300 mins]
                                        - $6.21 (Min-Max: 20 - 3000)</option>
                                    <option data-min="1000" data-max="2147483647" value="1424" data-rate="0.003">
                                        1424 - Facebook Share | Post/Photo/Article | Instant | Refill 30 Day | 1M/Day -
                                        $0.003 (Min-Max: 1000 - 2147483647)</option>
                                    <option data-min="50000" data-max="2147483647" value="1310" data-rate="0.002">
                                        1310 - Facebook Share Post/Article | Fast | No Refill | 10M/Day - $0.002 (Min-Max:
                                        50000 - 2147483647)</option>
                                    <option data-min="50000" data-max="2147483647" value="1122"
                                        data-rate="0.00336">1122 - Facebook Share Post /Photo | Work Good | Start 0 - 24
                                        Hour | Refill 30 Day | 200K/Day - $0.00336 (Min-Max: 50000 - 2147483647)</option>
                                    <option data-min="100" data-max="1000000000" value="424" data-rate="0.0035">
                                        424 - Facebook Share [ Post /Photo ] [ HQ ] [ Fast Speed ] [ R30 ] [ Instant ] -
                                        $0.0035 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="50000" data-max="100000000" value="329"
                                        data-rate="0.13125">329 - Facebook Share Post/Photo Only | Ultra Stable | Fast |
                                        Refill 30 day | 20M/Day - $0.13125 (Min-Max: 50000 - 100000000)</option>
                                    <option data-min="100" data-max="10000000" value="1740" data-rate="0">1740 -
                                        Facebook Share Post Virtual | Only Post/Photo | Fast | Stable | Best Seller |
                                        50K/Hour| Provider - $0 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1748" data-rate="0">1748 -
                                        Facebook Share Post Virtual | Only Post/Photo | Fast | Stable | Best Seller |
                                        100K/Hour (Provider) - $0 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="30" data-max="100000000" value="1411" data-rate="0.6667">
                                        1411 - Facebook Share Post | All Link | Stable | Fast | Refill 30 Day | Instant |
                                        10M/Day - $0.6667 (Min-Max: 30 - 100000000)</option>
                                    <option data-min="50" data-max="20000" value="1034" data-rate="0.4375">1034 -
                                        Facebook Group Member | Max 20K | Instant or Start 1-3 hour | 3K - 10K/Day ⛔⚡ -
                                        $0.4375 (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="10000" value="1036" data-rate="0.689">1036 -
                                        Facebook Group Members | Non Drop | 30K/Day ⚡ | 30 Days Guaranteed ♻️ - $0.689
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="50" data-max="20000" value="1323" data-rate="0.4">1323 -
                                        Facebook Group Members | Instant or 0 - 24 Hour | 100% Real &amp; Old Data
                                        |&nbsp;500 - 2K Per Day ⚡⛔ - $0.4 (Min-Max: 50 - 20000)</option>
                                    <option data-min="100" data-max="3000" value="1507" data-rate="0.464805">1507
                                        - Facebook Member Group Clone | Max 50K | Instant | No refill | 10K/Day - $0.464805
                                        (Min-Max: 100 - 3000)</option>
                                    <option data-min="100" data-max="10000" value="1788" data-rate="0.173">1788 -
                                        Facebook Group Member | Global | Max 500K | Instant | 5K - 10K/Day - $0.173
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="100" data-max="1000000" value="1703" data-rate="0.2443">1703
                                        - Facebook Group Member | Vietnam | Max 1M | Instant | 5K/Day - $0.2443 (Min-Max:
                                        100 - 1000000)</option>
                                    <option data-min="500" data-max="50000" value="1625" data-rate="0.2115">1625 -
                                        Facebook Group Member | Bot Vietnam &amp;amp;amp; Global | Max 500K | Instant |
                                        5K/Day - $0.2115 (Min-Max: 500 - 50000)</option>
                                    <option data-min="500" data-max="50000" value="1503" data-rate="0.2188">1503 -
                                        Facebook Group Members | Max 100K | No Refill | Instant | 10K - 20K/Day - $0.2188
                                        (Min-Max: 500 - 50000)</option>
                                    <option data-min="500" data-max="50000" value="1528" data-rate="0.1848">1528 -
                                        Facebook Member Group Vietnam | Max 10M | Instant | No refill | 10K/Day - $0.1848
                                        (Min-Max: 500 - 50000)</option>
                                    <option data-min="500" data-max="100000" value="1489" data-rate="1.132">1489 -
                                        Facebook Group Member Vietnam | Page Pro5 + Clone | Max 100K | Instant | 100 -
                                        500/Day⚡ - $1.132 (Min-Max: 500 - 100000)</option>
                                    <option data-min="200" data-max="100000" value="1493" data-rate="1.132">1493 -
                                        Facebook Member Group Vietnam | Page Pro5 | Instant | Max 100K | No refill | 1K -
                                        3K/Day - $1.132 (Min-Max: 200 - 100000)</option>
                                    <option data-min="500" data-max="5000000" value="1407" data-rate="1.13">1407 -
                                        Facebook Member Group | Instant | Max 100K | Refill 7 Day | 20K - 30K/Day - $1.13
                                        (Min-Max: 500 - 5000000)</option>
                                    <option data-min="100" data-max="5000000" value="1369" data-rate="1.05">1369 -
                                        Facebook Member Group Vietnam | Max 5M | Refill 7 Day | 5K/Day - $1.05 (Min-Max: 100
                                        - 5000000)</option>
                                    <option data-min="50" data-max="10000" value="1361" data-rate="1.14">1361 -
                                        Facebook Member Group Vietnam | Max 30K | Instant | Non Drop | 1K - 3K/Day - $1.14
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="1000" data-max="100000" value="1370" data-rate="1.077">1370
                                        - Facebook Member Group Vietnam VIP | Max 100K | Instant | Refill 7 Day | 5K -
                                        20K/Day - $1.077 (Min-Max: 1000 - 100000)</option>
                                    <option data-min="50" data-max="20000" value="422" data-rate="0.5016">422 -
                                        Facebook Group Members | Max 20k | 100% Real &amp; Old Data |&nbsp;10k/Day - $0.5016
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="100" data-max="20000" value="1035" data-rate="1.4535">1035 -
                                        Facebook Group Members | Non Drop | 30K/Day ⚡ | 30 Days Guaranteed ♻️ - $1.4535
                                        (Min-Max: 100 - 20000)</option>
                                    <option data-min="50" data-max="10000" value="418" data-rate="0.583">418 -
                                        Facebook Group Members | Non Drop | 10K/Day ⚡ | 30 Days Guaranteed ♻️ - $0.583
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="50" data-max="50000" value="419" data-rate="0.968">419 -
                                        Facebook Group Members | Non Drop | 50K/Day ⚡ | 30 Days Guaranteed ♻️ - $0.968
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="1000000000" value="423" data-rate="0.0035">
                                        423 - Facebook Share [ Post /Photo ] [ HQ ] [ Fast Speed ] [ R30 ] [ Instant ] -
                                        $0.0035 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="100" data-max="20000" value="420" data-rate="1.4535">420 -
                                        Facebook Group Members | Non Drop | 30K/Day ⚡ | 30 Days Guaranteed ♻️ - $1.4535
                                        (Min-Max: 100 - 20000)</option>
                                    <option data-min="100" data-max="300000" value="421" data-rate="1.045">421 -
                                        Facebook Group Members | Non Drop | 50K/Day ⚡ | 30 Days Guaranteed ♻️ - $1.045
                                        (Min-Max: 100 - 300000)</option>
                                    <option data-min="50" data-max="10000" value="378" data-rate="0.4375">378 -
                                        Facebook Group Members [ High Quality ] [ 5-10k/D ] [ Non Drop ] [ Instant ] -
                                        $0.4375 (Min-Max: 50 - 10000)</option>
                                    <option data-min="500" data-max="100000" value="1401" data-rate="1.132">1401 -
                                        Facebook Group Member | Instant | Button Cancel | 2K/Day - $1.132 (Min-Max: 500 -
                                        100000)</option>
                                    <option data-min="100" data-max="500000" value="1409" data-rate="1.0164">1409
                                        - Facebook Member Group | Max 500K | Instant | Refill 30 Day | 20K - 50K/Day -
                                        $1.0164 (Min-Max: 100 - 500000)</option>
                                    <option data-min="200" data-max="100000" value="1442" data-rate="1.132">1442 -
                                        Facebook Membar Group | Page Pro5 | Max 100K | Refill 30 Day | Instant | 2K -
                                        10K/Day - $1.132 (Min-Max: 200 - 100000)</option>
                                    <option data-min="10" data-max="10000" value="1412" data-rate="0.39">1412 -
                                        Facebook Group Members Global | High Quality | Non Drop | Instant | Refill 30 Day |
                                        10K/Day ⛔ - $0.39 (Min-Max: 10 - 10000)</option>
                                    <option data-min="500" data-max="100000" value="1492" data-rate="1.132">1492 -
                                        Facebook Member Group Vietnam | Instant | Max 10M | 1K-5K/Day - $1.132 (Min-Max: 500
                                        - 100000)</option>
                                    <option data-min="100" data-max="500000" value="1549" data-rate="0.19">1549 -
                                        Facebook Join Group | Random | Max 2M | No Drop | 200K/Day (Own Service) - $0.19
                                        (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="50000" value="1764" data-rate="0.173">1764 -
                                        Facebook Join Group | Random | Max 200K | No Drop | 100K/Day (Own Service) - $0.173
                                        (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="1773" data-rate="0.2727">1773 -
                                        Facebook Group Members | Vietnam Data | Instant | 50K/Ngày| Refill 30 Days ♻️⛔⚡ -
                                        $0.2727 (Min-Max: 100 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1769" data-rate="0.3694">1769 -
                                        Facebook Member Group | Vietnam | Instant | No refill | 50K/Day - $0.3694 (Min-Max:
                                        50 - 50000)</option>
                                    <option data-min="100" data-max="1000000000" value="1767" data-rate="0.1463">
                                        1767 - Facebook Join Group | Vietnam| Max 1M | No Drop | 5K - 20K/Day (Own Service)
                                        - $0.1463 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="500" data-max="100000" value="1765" data-rate="1.132">1765 -
                                        Facebook Member Group | Vietnam | Instant | No Refill | 1K - 5K/Day - $1.132
                                        (Min-Max: 500 - 100000)</option>
                                    <option data-min="500" data-max="1000000000" value="1840" data-rate="0.1618">
                                        1840 - 🇻🇳 Facebook Group Member | Max: 2M | Start: 0-1 Hr | Speed: 1-5K/D ❎ -
                                        $0.1618 (Min-Max: 500 - 1000000000)</option>
                                    <option data-min="100" data-max="10000" value="1117" data-rate="15">1117 -
                                        Facebook Vip Like 7 Day | Max 4 Post/Day | Provide Main - $15 (Min-Max: 100 - 10000)
                                    </option>
                                    <option data-min="100" data-max="10000" value="1118" data-rate="30">1118 -
                                        Facebook Vip Like 15 Day | Max 4 Post/Day | Provide Main - $30 (Min-Max: 100 -
                                        10000)</option>
                                    <option data-min="30" data-max="10000" value="1119" data-rate="50">1119 -
                                        Facebook Vip Like 30 Day | 5 Post/Day | Provide Main - $50 (Min-Max: 30 - 10000)
                                    </option>
                                    <option data-min="25" data-max="500" value="472" data-rate="7.8">472 -
                                        Facebook Post Reaction (Care 🤗) [ Pakistan 🇵🇰 ] | 500/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="25" data-max="500" value="464" data-rate="7.8">464 -
                                        Facebook Page/Profile Followers [ Pakistan 🇵🇰 ] | 1K/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="25" data-max="500" value="465" data-rate="7.8">465 -
                                        Facebook Page/Profile Followers [ Pakistan 🇵🇰 - Female ] | 1K/Day - $7.8 (Min-Max:
                                        25 - 500)</option>
                                    <option data-min="1" data-max="1" value="466" data-rate="1">466 -
                                        ˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣ - $1 (Min-Max: 1 - 1)</option>
                                    <option data-min="25" data-max="500" value="467" data-rate="7.8">467 -
                                        Facebook Post Reaction (Love ❤️) [ Pakistan 🇵🇰 ] | 500/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="25" data-max="500" value="468" data-rate="7.8">468 -
                                        Facebook Post Reaction (Wow 😮) [ Pakistan 🇵🇰 ] | 500/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="25" data-max="500" value="469" data-rate="7.8">469 -
                                        Facebook Post Reaction (Sad 😢) [ Pakistan 🇵🇰 ] | 500/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="25" data-max="500" value="470" data-rate="7.8">470 -
                                        Facebook Post Reaction (Angry 😡) [ Pakistan 🇵🇰 ] | 500/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="25" data-max="500" value="471" data-rate="7.8">471 -
                                        Facebook Post Reaction (Haha 😄) [ Pakistan 🇵🇰 ] | 500/Day - $7.8 (Min-Max: 25 -
                                        500)</option>
                                    <option data-min="4000" data-max="10000" value="394" data-rate="0.625">394 -
                                        Facebook Follow 🇧🇩 Profile/Page | Max 10K | Different | Speed 5K Day | Non Drop |
                                        30 Day Refill - $0.625 (Min-Max: 4000 - 10000)</option>
                                    <option data-min="1000" data-max="3000" value="1124" data-rate="0.888">1124 -
                                        Facebook Any Type Page Like + Follow 🇧🇩 | Max 3K | Speed 1K - 2K Day | Non Drop |
                                        30 Day Refill - $0.888 (Min-Max: 1000 - 3000)</option>
                                    <option data-min="1000" data-max="10000" value="1123" data-rate="0.917372">
                                        1123 - Facebook Public/Private Group Member🇧🇩 | Max 10k | High Quality | Speed
                                        2k-4k Day | Non Drop | 30 Day Refill - $0.917372 (Min-Max: 1000 - 10000)</option>
                                    <option data-min="200" data-max="1000" value="401" data-rate="0.4368">401 -
                                        Facebook Bd🇧🇩 Post Reaction 🤣 | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="200" data-max="1000" value="396" data-rate="0.4368">396 -
                                        Facebook Bd🇧🇩 Post Reaction ❤️ | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="200" data-max="1000" value="398" data-rate="0.4368">398 -
                                        Facebook Bd🇧🇩 Post Reaction 😡 | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="500" data-max="10000" value="393" data-rate="0.642816">393
                                        - Facebook Public/Private Group Member🇧🇩 | [Max 10k ] | High Quality | Speed 2k-4k
                                        Day | Non Drop | 365 Day Refill - $0.642816 (Min-Max: 500 - 10000)</option>
                                    <option data-min="200" data-max="1000" value="400" data-rate="0.4368">400 -
                                        Facebook Bd🇧🇩 Post Reaction 😥 | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="200" data-max="1000" value="395" data-rate="0.4368">395 -
                                        Facebook Bd🇧🇩 Post Reaction 👍 | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="200" data-max="1000" value="397" data-rate="0.4368">397 -
                                        Facebook Bd🇧🇩 Post Reaction 🥰 | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="200" data-max="1000" value="399" data-rate="0.4368">399 -
                                        Facebook Bd🇧🇩 Post Reaction 😱 | Speed 2-5k Day | Low Drop | No Refill - $0.4368
                                        (Min-Max: 200 - 1000)</option>
                                    <option data-min="500" data-max="1000" value="392" data-rate="0.4656">392 -
                                        Facebook Followers🇧🇩 | Page+Profile | [Max 3k] | [Own Provider] | Speed 1-3k Day |
                                        Non Drop | 30 Day Refill - $0.4656 (Min-Max: 500 - 1000)</option>
                                    <option data-min="50" data-max="1500" value="432" data-rate="6.3113">432 -
                                        Facebook Post Reaction (Likes 👍) [ Thailand 🇹🇭 ] | Real Quality | Day 5K | No
                                        Refill - $6.3113 (Min-Max: 50 - 1500)</option>
                                    <option data-min="50" data-max="500000" value="425" data-rate="1.29">425 -
                                        Facebook Emoticons (Like 👍) [ Thailand 🇹🇭 ] [Max 20K] | Slow / Day 500-2K | No
                                        Refill - $1.29 (Min-Max: 50 - 500000)</option>
                                    <option data-min="50" data-max="1500" value="433" data-rate="6.3113">433 -
                                        Facebook Post Reaction (Love ❤️) [ Thailand 🇹🇭 ] | Real Quality | Day 5K | No
                                        Refill - $6.3113 (Min-Max: 50 - 1500)</option>
                                    <option data-min="50" data-max="500000" value="426" data-rate="1.29">426 -
                                        Facebook Emoticons (Love ❤️) [ Thailand 🇹🇭 ] [Max 20K] | Slow / Day 500-2K | No
                                        Refill - $1.29 (Min-Max: 50 - 500000)</option>
                                    <option data-min="50" data-max="1500" value="434" data-rate="6.3113">434 -
                                        Facebook Post Reaction (Wow 😮) [ Thailand 🇹🇭 ] | Real Quality | 500/Day | No
                                        Refill - $6.3113 (Min-Max: 50 - 1500)</option>
                                    <option data-min="50" data-max="500000" value="427" data-rate="1.29">427 -
                                        Facebook Emoticons (Haha 😄) [ Thailand 🇹🇭 ] [Max 20K] | Slow / Day 500-2K | No
                                        Refill - $1.29 (Min-Max: 50 - 500000)</option>
                                    <option data-min="50" data-max="1500" value="435" data-rate="6.3113">435 -
                                        Facebook Post Reaction (Haha 😄) [ Thailand 🇹🇭 ] | Real Quality | Day 5K | No
                                        Refill - $6.3113 (Min-Max: 50 - 1500)</option>
                                    <option data-min="50" data-max="500000" value="428" data-rate="1.29">428 -
                                        Facebook Emoticons (Wow 😮) [ Thailand 🇹🇭 ] [Max 20K] | Slow / Day 500-2K | No
                                        Refill - $1.29 (Min-Max: 50 - 500000)</option>
                                    <option data-min="50" data-max="1500" value="436" data-rate="6.3113">436 -
                                        Facebook Post Reaction (Sad 😢) [ Thailand 🇹🇭 ] | Real Quality | Day 5K | No
                                        Refill - $6.3113 (Min-Max: 50 - 1500)</option>
                                    <option data-min="50" data-max="500000" value="429" data-rate="1.29">429 -
                                        Facebook Emoticons (Sad 😢) [ Thailand 🇹🇭 ] [Max 20K] | Slow / Day 500-2K | No
                                        Refill - $1.29 (Min-Max: 50 - 500000)</option>
                                    <option data-min="50" data-max="1500" value="437" data-rate="6.3113">437 -
                                        Facebook Post Reaction (Angry 😡) [ Thailand 🇹🇭 ] | Real Quality | Day 5K | No
                                        Refill - $6.3113 (Min-Max: 50 - 1500)</option>
                                    <option data-min="50" data-max="500000" value="430" data-rate="1.29">430 -
                                        Facebook Emoticons (Angry 😡) [ Thailand 🇹🇭 ] [Max 20K] | Slow / Day 500-2K | No
                                        Refill - $1.29 (Min-Max: 50 - 500000)</option>
                                    <option data-min="5" data-max="3000" value="431" data-rate="38.4689">431 -
                                        Facebook Custom Comments [ Thailand 🇹🇭 ] | 500/Day | 30 Days Guaranteed ♻️ -
                                        $38.4689 (Min-Max: 5 - 3000)</option>
                                    <option data-min="50" data-max="150" value="440" data-rate="1.764">440 -
                                        Facebook Reaction (Haha 😄) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="448" data-rate="2.74">448 -
                                        Facebook Post React (Care 🤗) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️
                                        - $2.74 (Min-Max: 100 - 5000)</option>
                                    <option data-min="10" data-max="500" value="456" data-rate="2.53">456 -
                                        Facebook Profile Followers [ Philippines 🇵🇭 ] | 500/Day | 30 Days Guaranteed ♻️ -
                                        $2.53 (Min-Max: 10 - 500)</option>
                                    <option data-min="50" data-max="150" value="441" data-rate="1.764">441 -
                                        Facebook Reaction (Sad 😢) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="449" data-rate="2.74">449 -
                                        Facebook Post React (Wow 😮) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️
                                        - $2.74 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="457" data-rate="3.6">457 -
                                        Facebook Group Members [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️ - $3.6
                                        (Min-Max: 100 - 5000)</option>
                                    <option data-min="50" data-max="150" value="442" data-rate="1.764">442 -
                                        Facebook Reaction (Wow 😮) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="450" data-rate="2.74">450 -
                                        Facebook Post React (Haha 😄) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️
                                        - $2.74 (Min-Max: 100 - 5000)</option>
                                    <option data-min="1" data-max="1" value="458" data-rate="1">458 -
                                        ˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣ - $1 (Min-Max: 1 - 1)</option>
                                    <option data-min="50" data-max="150" value="443" data-rate="1.764">443 -
                                        Facebook Reaction (Care 🤗) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="451" data-rate="2.74">451 -
                                        Facebook Post React (Sad 😢) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️
                                        - $2.74 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="10000" value="459" data-rate="3.1">459 -
                                        Facebook Post Share [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️ - $3.1
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="50" data-max="150" value="444" data-rate="1.764">444 -
                                        Facebook Reaction (Angry 😡) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="452" data-rate="2.7348">452 -
                                        Facebook Post React (Angry 😠) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed
                                        ♻️ - $2.7348 (Min-Max: 100 - 5000)</option>
                                    <option data-min="30" data-max="150" value="460" data-rate="7.56">460 -
                                        Facebook Random Comments | Philippines 🇵🇭 | 200/Day - $7.56 (Min-Max: 30 - 150)
                                    </option>
                                    <option data-min="1" data-max="1" value="445" data-rate="1">445 -
                                        ˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣ - $1 (Min-Max: 1 - 1)</option>
                                    <option data-min="1" data-max="1" value="453" data-rate="1">453 -
                                        ˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣˣ - $1 (Min-Max: 1 - 1)</option>
                                    <option data-min="30" data-max="150" value="461" data-rate="9.24">461 -
                                        Facebook Custom Comments [ Philippines 🇵🇭 ] | 200/Day | 15 Days Guaranteed ♻️ -
                                        $9.24 (Min-Max: 30 - 150)</option>
                                    <option data-min="50" data-max="150" value="438" data-rate="1.764">438 -
                                        Facebook Post (Likes 👍) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="446" data-rate="2.74">446 -
                                        Facebook Post React (Likes👍) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️
                                        - $2.74 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="454" data-rate="3.45">454 -
                                        Facebook Page Likes + Followers [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed
                                        ♻️ - $3.45 (Min-Max: 100 - 5000)</option>
                                    <option data-min="20" data-max="5000" value="462" data-rate="24.42">462 -
                                        Facebook Poll Votes [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️ - $24.42
                                        (Min-Max: 20 - 5000)</option>
                                    <option data-min="50" data-max="150" value="439" data-rate="1.764">439 -
                                        Facebook Reaction (Love ❤️) | Philippines 🇵🇭 | 30 Days Guaranteed ♻️ - $1.764
                                        (Min-Max: 50 - 150)</option>
                                    <option data-min="100" data-max="5000" value="447" data-rate="2.74">447 -
                                        Facebook Post React (Love ❤️) [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️
                                        - $2.74 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="5000" value="455" data-rate="3.6">455 -
                                        Facebook Followers | All Type Profile &amp; Page [ Philippines 🇵🇭 ] | 500/Day | 15
                                        Days Guaranteed ♻️ - $3.6 (Min-Max: 100 - 5000)</option>
                                    <option data-min="10" data-max="100" value="463" data-rate="55.04">463 -
                                        Facebook Page Reviews [ Philippines 🇵🇭 ] | 500/Day | 15 Days Guaranteed ♻️ -
                                        $55.04 (Min-Max: 10 - 100)</option>
                                    <option data-min="10" data-max="500000" value="840" data-rate="0.0714">840 -
                                        TikTok Likes [ Max 10M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | No Refill ⚠️ | Instant Start | Day 100K
                                        🚀 - $0.0714 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="836" data-rate="1.32134">836
                                        - TikTok Followers [ Max 10M ] | LQ Profiles | Cancel Enable | Day 100K ⚡&gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.32134 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="837" data-rate="1.2499">837
                                        - TikTok Followers [ Max 5M ] | HQ | Cancel Enable | Non Drop | No Refill ⚠️ |
                                        Instant | Day 50K 𝗨𝗟𝗧𝗥𝗔 𝗙𝗔𝗦𝗧 𝗦𝗣𝗘𝗘𝗗 𝟬-𝟭 𝗠İ𝗡 𝗦𝗧𝗔𝗥𝗧 - $1.2499
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="1000000" value="838" data-rate="1.5178">838
                                        - TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp; Refill Enable | 30 Days
                                        ♻️| 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.5178 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="100000000" value="839" data-rate="0.0696">
                                        839 - TikTok Likes [ Max 10M ] | LQ Profiles | Cancel Enable | Instant | Day 50K
                                        𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 🚀 - $0.0696 (Min-Max: 10 - 100000000)</option>
                                    <option data-min="50" data-max="20000" value="1309" data-rate="7000">1309 -
                                        TikTok Like Vietnam | Instant | No Refill | 5K - 20K/Day - $7000 (Min-Max: 50 -
                                        20000)</option>
                                    <option data-min="100" data-max="1000000000" value="1276" data-rate="0.274">
                                        1276 - TikTok Like Vietnam | IÍntant | No Refill | 10K/Day⚡ - $0.274 (Min-Max: 100 -
                                        1000000000)</option>
                                    <option data-min="1000" data-max="10000" value="907" data-rate="0.15">907 -
                                        TikTok Like 🇻🇳 || Start Slow | 50 - 500/Day ⛔ - $0.15 (Min-Max: 1000 - 10000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="881" data-rate="0.23">881 -
                                        TikTok Likes Việt Nam 🇻🇳 | Provider | Max 20K | 2K/Ngày | ⚡⛔ - $0.23 (Min-Max: 100
                                        - 10000000)</option>
                                    <option data-min="1000" data-max="2000" value="755" data-rate="0.196">755 -
                                        TikTok Likes Vietnamese 🇻🇳 | Slow| 500 Per Day⚡⛔ - $0.196 (Min-Max: 1000 - 2000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="868" data-rate="0.24">868 -
                                        TikTok Likes 🇻🇳| Providers | Max 20K | 1-2K/Day⚡⛔ - $0.24 (Min-Max: 100 -
                                        10000000)</option>
                                    <option data-min="100" data-max="1000000" value="869" data-rate="0.282">869 -
                                        TikTok Likes 🇻🇳 | Providers | Max 20K | 10K/Day⚡⛔ (1K = 5 minutes) - $0.282
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="50" data-max="20000" value="969" data-rate="7000">969 -
                                        TikTok Like Vietnamese | Instant | Account Real | Super Fast | 5K - 10K/Day - $7000
                                        (Min-Max: 50 - 20000)</option>
                                    <option data-min="100" data-max="10000000" value="756" data-rate="0.23">756 -
                                        TikTok Likes Vietnamese 🇻🇳 | Instant | 1K Per Day⚡⛔ - $0.23 (Min-Max: 100 -
                                        10000000)</option>
                                    <option data-min="100" data-max="10000000" value="757" data-rate="0.24">757 -
                                        TikTok Likes Vietnamese 🇻🇳 | Instant | Max 20K | 1K - 2K Per Day - $0.24 (Min-Max:
                                        100 - 10000000)</option>
                                    <option data-min="100" data-max="1000000" value="758" data-rate="0.282">758 -
                                        TikTok Likes Vietnamese 🇻🇳 | Max 20K | LQ | Instant | 1K - 5K Per Day - $0.282
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="10000000" value="759" data-rate="0.35">759 -
                                        TikTok Likes Vietnamese 🇻🇳 | QH Real | Super Instant | 50K Per Day⚡ - $0.35
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="1000000" value="762" data-rate="0.4">762 -
                                        TikTok Likes Vietnamese 🇻🇳 | Instant | 20K - 50K Per Day⚡ - $0.4 (Min-Max: 100 -
                                        1000000)</option>
                                    <option data-min="50" data-max="50000" value="761" data-rate="0.43">761 -
                                        TikTok Likes Vietnamese 🇻🇳 | Instant | 20K Per Day⚡ - $0.43 (Min-Max: 50 - 50000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="763" data-rate="0.645">763 -
                                        TikTok Likes Vietnamese 🇻🇳 | Avatar QH | Instant | 20K Per Day⚡ - $0.645 (Min-Max:
                                        100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="760" data-rate="0.645">760 -
                                        TikTok Likes Vietnamese 🇻🇳 | Super Instant | Max 100K |20K Per Day⚡ - $0.645
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1556" data-rate="0.0084">1556
                                        - TikTok Like Vietnam | Hidden | Instant | No refill | 5K - 10K/Day - $0.0084
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="500" data-max="1000000" value="1662" data-rate="0.063">1662
                                        - Tiktok Like 🇻🇳 | Max 50K | Instant | No refill | 10K/Day - $0.063 (Min-Max: 500
                                        - 1000000)</option>
                                    <option data-min="200" data-max="1000000" value="1670" data-rate="0.095">1670
                                        - TikTok Likes 🇻🇳 | Max 50K | Instant | No refill | 10K/Day - $0.095 (Min-Max: 200
                                        - 1000000)</option>
                                    <option data-min="50" data-max="20000" value="1669" data-rate="0.1556">1669 -
                                        Tiktok Like 🇻🇳 | Max 20K | Instant | No refill | 5K/Day - $0.1556 (Min-Max: 50 -
                                        20000)</option>
                                    <option data-min="50" data-max="20000" value="1415" data-rate="0.1556">1415 -
                                        TikTok Like Video 🇻🇳 | Instant | Max 20K | No Refill | 10K/Day | RECONMEMD -
                                        $0.1556 (Min-Max: 50 - 20000)</option>
                                    <option data-min="10" data-max="5000000" value="1557" data-rate="0.0110175">
                                        1557 - Tiktok Like Video | Max 100K | Instant | 10K/Day - $0.0110175 (Min-Max: 10 -
                                        5000000)</option>
                                    <option data-min="10" data-max="1000000" value="1254" data-rate="0.26">1254 -
                                        TikTok Followers | 𝗥𝗲𝗮𝗹 - %𝟭𝟬𝟬 𝗔𝗰𝘁ı𝘃𝗲 𝗨𝘀𝗲𝗿𝘀 | Followers From Live |
                                        SuperFast | No Refill ⚠️ | Non Drop | Max 1M | Day 50K - $0.26 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1404" data-rate="0.2098">1404
                                        - TikTok Followers [ Max 1M ] | Open Live Stream Before Ordering | 30 Days ♻️ |
                                        Instant Start | Day 200K 🚀❗Read Description❗ - $0.2098 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="1172" data-rate="0.5891">1172
                                        - TikTok - Followers | Max 1M | HQ Real People | Instant | Refill 30 Day | 50k/Days
                                        | Open Live Stream Before Ordering - $0.5891 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1403" data-rate="0.255">1403
                                        - TikTok - Followers | Max 1M | HQ Real People | 10k/Days | Instant | 𝗥𝗘𝗙𝗜𝗟𝗟
                                        30D | Open Live Stream Before Ordering - $0.255 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1227" data-rate="0.2539">1227
                                        - TikTok Followers | Max 1M | High Quality Accounts | Instant | 30 Days Refill ♻️ |
                                        Speed: 20K/Day | OPEN the account`s live stream UNTIL the order is COMPLETED -
                                        $0.2539 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1171" data-rate="0.179">1171
                                        - TikTok Followers | HQ Profiles | No Refill ⚠️ | Instant Start | Open Livestream |
                                        Day 200K 🚀 - $0.179 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="2147483647" value="1173" data-rate="0.0008">
                                        1173 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 5M [ Cheap ]
                                        𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 🚀 - $0.0008 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="10" data-max="1000000" value="1668" data-rate="1.431">1668
                                        - TikTok Followers | USA Profiles | Instant | Low Drop | 15 Days Refill | 20K/Day ♻️
                                        - $1.431 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="1000" value="1277" data-rate="0.5495">1277 -
                                        TikTok Followers Vietnam | Max 10K | Instant | Refill 30 Day | 3K - 5K/Day - $0.5495
                                        (Min-Max: 100 - 1000)</option>
                                    <option data-min="100" data-max="25000" value="1314" data-rate="0.545">1314 -
                                        TikTok Followers Vietnam | Instant | Slow | Refil 30 Day | 500 - 2K/Day ♻️ - $0.545
                                        (Min-Max: 100 - 25000)</option>
                                    <option data-min="1000" data-max="10000" value="1338" data-rate="0.6978125">
                                        1338 - Tiktok Follow Vietnam | Max 10K | Instant | 500 - 2K/Day⛔ - $0.6978125
                                        (Min-Max: 1000 - 10000)</option>
                                    <option data-min="1000" data-max="5000" value="1221" data-rate="0.8">1221 -
                                        TikTok Follow Vietnam Best Saller | Start 0 - 6 Hour | 50 - 200/Day - $0.8 (Min-Max:
                                        1000 - 5000)</option>
                                    <option data-min="100" data-max="12000" value="1278" data-rate="0.864">1278 -
                                        TikTok Followers VietNam Sale | QH &amp;amp; Avatar | Real Data| 30 Days Refill |
                                        500 - 1K/Day - $0.864 (Min-Max: 100 - 12000)</option>
                                    <option data-min="100" data-max="50000" value="1360" data-rate="0.480561">1360
                                        - TikTok Follow Vietnam | Instart or Start 0 - 3 hour | No refill | 500 - 3K/Day -
                                        $0.480561 (Min-Max: 100 - 50000)</option>
                                    <option data-min="50" data-max="5000" value="1529" data-rate="0.567">1529 -
                                        TikTok Follow Vietnam | Instant | No refill | Slow | 500/Day - $0.567 (Min-Max: 50 -
                                        5000)</option>
                                    <option data-min="10" data-max="50000" value="1546" data-rate="0.6">1546 -
                                        TikTok Follower Vietnam | Real | Instant | No refill | 500 - 1K/Day - $0.6 (Min-Max:
                                        10 - 50000)</option>
                                    <option data-min="50" data-max="10000" value="1106" data-rate="0.35">1106 -
                                        TikTok Follow Vietnam | Instant | Max 10K | No refill | 5K - 10K/Day - $0.35
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="50" data-max="100000" value="1648" data-rate="0.4481">1648
                                        - TikTok Follower 🇻🇳 | Max 100K | No refill | Instant | 2K/Day - $0.4481 (Min-Max:
                                        50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="1190" data-rate="0.4481">1190
                                        - TikTok Follow Vietnam | Max 100K | Instant | No refill | 5K/Day - $0.4481
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="5000" value="1665" data-rate="0.361">1665 -
                                        TikTok Follower | Max 5K | Real | No refill | 20K/Day - $0.361 (Min-Max: 100 - 5000)
                                    </option>
                                    <option data-min="50" data-max="5000" value="1220" data-rate="1100">1220 -
                                        TikTok Follow Vietnam | Max 5K | Instant | No refill | 200 - 500/Day - $1100
                                        (Min-Max: 50 - 5000)</option>
                                    <option data-min="50" data-max="10000000" value="1191" data-rate="1500">1191
                                        - TikTok Follow Vietnam | Max 10K | Instant | No refill | 3K - 5K/Day - $1500
                                        (Min-Max: 50 - 10000000)</option>
                                    <option data-min="500" data-max="10000" value="1116" data-rate="0.9">1116 -
                                        TikTok Followers TET | Max 10K | Start: 0 - 12 hour | 200 - 2K/Day ⚡⛔ - $0.9
                                        (Min-Max: 500 - 10000)</option>
                                    <option data-min="100" data-max="10000000" value="1114" data-rate="0.675">1114
                                        - TikTok Follow Vietnamese Sellers | Instant or 0 - 3 hour | NR | Cancel Button | 3K
                                        - 5K/Day - $0.675 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1079" data-rate="0.51">1079
                                        - TikTok Follow Vietnamese | Start: 0 - 3 Hour | 50 - 300/Day - $0.51 (Min-Max: 100
                                        - 10000000)</option>
                                    <option data-min="100" data-max="100000" value="1091" data-rate="0.56">1091 -
                                        TikTok - Follow Vn | Max 100K | Very slow | 50 - 500/Day - $0.56 (Min-Max: 100 -
                                        100000)</option>
                                    <option data-min="50" data-max="10000000" value="1107" data-rate="1500">1107
                                        - TikTok Follow Vietnam | Max 10K | Instant | No refill | 5K/Day - $1500 (Min-Max:
                                        50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="1113" data-rate="1500">1113
                                        - TikTok Follow Vietnam | Max 10K | Instant | Refil 15 Day | 5K - 10K/Day⚡ - $1500
                                        (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="1120" data-rate="1500">1120
                                        - TikTok Follow Vietnam VIP | Instant | Refill 7 Day | Button Cancel | 20K - 50K/Day
                                        | Main Provider - $1500 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1138" data-rate="0.7">1138 -
                                        TikTok Followers Vietnam VIP | Instant | High Quality Real + Avatar/Video | Refill 7
                                        Day | 500 - 2K/Day ⛔♻️⚡️ - $0.7 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1000" data-rate="0.51">1000
                                        - TikTok Follow Vietnamese | Start: 0 - 30 Minutes | 100 - 1K/Day - $0.51 (Min-Max:
                                        100 - 10000000)</option>
                                    <option data-min="1000" data-max="20000" value="928" data-rate="15.7">928 -
                                        TikTok Follow Vietnamese | Start: 0 - 24 Hour | 100 - 500/Day (Order 20K -&gt; done
                                        1K - 2K/Day) - $15.7 (Min-Max: 1000 - 20000)</option>
                                    <option data-min="100" data-max="10000000" value="778" data-rate="0.709">778
                                        - TikTok Follow Vietnamese 🇻🇳 | Max 100K | Start 0 - 2 Hour | QH Real | | 5K -
                                        10K/Day - $0.709 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="20000" value="987" data-rate="0.984375">987
                                        - TikTok Follow Vietnamese | Max 20K | Account Avatar + QH | 500 - 3K/Day -
                                        $0.984375 (Min-Max: 100 - 20000)</option>
                                    <option data-min="100" data-max="100000" value="927" data-rate="0.91">927 -
                                        TikTok Follow Vietnamese | Instant | Refill 7 Day | 300 - 5K/Day⚡|
                                        𝐑𝐞𝐜𝐨𝐦𝐦𝐞𝐧𝐝𝐞𝐝 - $0.91 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="917" data-rate="0.91">917 -
                                        TikTok Follow Vietnamese | Max 150K | QH | Refill 120 Day | 5K/Day⚡ - $0.91
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="10000000" value="819" data-rate="0.74">819 -
                                        TikTok Follow Vietnam | QH Profile Avatar | 5K/Day - $0.74 (Min-Max: 100 - 10000000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="816" data-rate="0.785">816
                                        - TikTok Follow Vietnamese 🇻🇳 | Max 50K | | QH Real | | 5K/Day - $0.785 (Min-Max:
                                        100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="782" data-rate="0.68">782 -
                                        TikTok Follow Vietnamese 🇻🇳 | Max 200K | Speed | QH Real | | 500 - 2K/Day - $0.68
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="1000000" value="777" data-rate="0.69">777 -
                                        TikTok Follow Vietnamese 🇻🇳 | Max 50K | Start: 0 - 24 Hour | QH Real | | 50K/Day -
                                        $0.69 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="100000" value="820" data-rate="0.91">820 -
                                        TikTok Follow Vietnamese | Super Fast | Max 150K | R30 | 10K/Day - $0.91 (Min-Max:
                                        100 - 100000)</option>
                                    <option data-min="100" data-max="1000" value="767" data-rate="0.66">767 -
                                        TikTok Followers | việt dạng mới nhanh tài max 50k -( có thể bị chậm 12-24h )⚡bảo
                                        hành 5-7 ngày 🍀 ( 16.76 VND ) - $0.66 (Min-Max: 100 - 1000)</option>
                                    <option data-min="50" data-max="50000" value="764" data-rate="1.043">764 -
                                        TikTok Follow Vietnamese 🇻🇳 | Max 50K | | QH Real | | 1K/Day - $1.043 (Min-Max: 50
                                        - 50000)</option>
                                    <option data-min="100" data-max="10000000" value="776" data-rate="0.87">776 -
                                        TikTok Follow Vietnamese 🇻🇳 | Max 100K | Start: 5 - 20 minutes | QH Real | 5K -
                                        20K/Day - $0.87 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="3000" value="766" data-rate="0.59">766 -
                                        TikTok Follow Vietnamese 🇻🇳 | Start: 1 - 24 Hour| 5 - 20K Per Day⚡ - $0.59
                                        (Min-Max: 100 - 3000)</option>
                                    <option data-min="100" data-max="1000" value="765" data-rate="0.66">765 -
                                        TikTok Follow Vietnamese 🇻🇳 | Start: 1 - 24 Hour | Max 200K | 5K - 20K Per Day⚡ -
                                        $0.66 (Min-Max: 100 - 1000)</option>
                                    <option data-min="10" data-max="100000" value="1627" data-rate="0.7623">1627
                                        - Tiktok Follower | Max 100K | Instant | 3K/Day - $0.7623 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1789" data-rate="0.4074">1789
                                        - Tiktok Follow | Vietnam | Max 50K | Instant | No refill | 2K/Day - $0.4074
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="10000" value="1149" data-rate="0.85">1149 -
                                        🇻🇳 TikTok Followers | Instant | 5000 Per Day | Real &amp; Bot Data ⚡⛔ - $0.85
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="100" data-max="10000000" value="781" data-rate="0.63">781 -
                                        TikTok Follow Vietnamese | Max 10K | Start: 0 - 3 Hour | QH | 3K - 5K/Day - $0.63
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="50" data-max="10000" value="710" data-rate="0.304">710 -
                                        TikTok Like Vietnamese | Instant | QH | NR | 20K/Day - $0.304 (Min-Max: 50 - 10000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="774" data-rate="0.709">774
                                        - TikTok Follow Vietnamese 🇻🇳 | Instant | Drop 3 - 5%| 20K Per Day⚡ - $0.709
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="780" data-rate="0.87">780 -
                                        Sub Via Tốc độ cực nhanh lên rất tốt ⚡🍀 Tài nguyên 100k - ( 21.5 VND ) - $0.87
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="775" data-rate="0.74">775 -
                                        TikTok Follow Vietnamese 🇻🇳 | Instant | Drop 3 - 5%| 50K Per Day⚡ - $0.74
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="709" data-rate="0.51">709 -
                                        TikTok Follow Vietnamese | Start: 0 - 1 Hour | QH | 500 - 1K/Day - $0.51 (Min-Max:
                                        100 - 10000000)</option>
                                    <option data-min="1000" data-max="1000000000" value="711" data-rate="0">711
                                        - TiKTok Views Video Vietnamese | Instant | QH | 100K - 500K/Day - $0 (Min-Max: 1000
                                        - 1000000000)</option>
                                    <option data-min="50" data-max="1000000" value="637" data-rate="11.6">637 -
                                        TikTok Follow Vietnamese | Instant | QH | NR | 500 - 2K/Day - $11.6 (Min-Max: 50 -
                                        1000000)</option>
                                    <option data-min="50" data-max="50000" value="620" data-rate="0.504">620 -
                                        TikTok Follow Vietnamese | Instant [ Slow ] | QH | 100 - 500/Day - $0.504 (Min-Max:
                                        50 - 50000)</option>
                                    <option data-min="1000" data-max="20000" value="618" data-rate="13.5">618 -
                                        TikTok Follow Vietnamese | Instant | QH | 10K/Day - $13.5 (Min-Max: 1000 - 20000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="1160" data-rate="1.9">1160 -
                                        TikTok Followers | HQ Profiles | 120 Days ♻️ | Instant Start | SuperFast | Max 500K
                                        | Day 100K 🚀 - $1.9 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="688" data-rate="0.8624">688
                                        - TikTok Followers [ Max 1M ] | 𝗛𝗤 | Cancel Enable | NR ⚠️ | Day 10K ⚡️𝗦𝗟𝗢𝗪 -
                                        $0.8624 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="500000" value="1161" data-rate="2.1">1161 -
                                        TikTok Followers | HQ Profiles | 365 Days ♻️ | Instant Start | SuperFast | Max 500K
                                        | Day 100K 🚀 - $2.1 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1154" data-rate="1.6">1154 -
                                        TikTok Followers | HQ Profiles | No Refill ⚠️ | Instant Start | SuperFast | Max 500K
                                        | Day 100K 🚀 - $1.6 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1155" data-rate="1.63">1155 -
                                        TikTok Followers | HQ Profiles | 7 Days ♻️ | Instant Start | SuperFast | Max 500K |
                                        Day 100K 🚀 - $1.63 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1156" data-rate="1.66">1156 -
                                        TikTok Followers | HQ Profiles | 15 Days ♻️ | Instant Start | SuperFast | Max 500K |
                                        Day 100K 🚀 - $1.66 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1157" data-rate="1.7">1157 -
                                        TikTok Followers | HQ Profiles | 30 Days ♻️ | Instant Start | SuperFast | Max 500K |
                                        Day 100K 🚀 - $1.7 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1158" data-rate="1.75">1158 -
                                        TikTok Followers | HQ Profiles | 60 Days ♻️ | Instant Start | SuperFast | Max 500K |
                                        Day 100K 🚀 - $1.75 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1159" data-rate="1.85">1159 -
                                        TikTok Followers | HQ Profiles | 90 Days ♻️ | Instant Start | SuperFast | Max 500K |
                                        Day 100K 🚀 - $1.85 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000000" value="687" data-rate="0.9035">687
                                        - TikTok Followers [ Max 10M ] | HQ Profiles | Instant Start | Day 100K ⚡&gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.9035 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="690" data-rate="0.9035">690
                                        - TikTok Followers | 10M | Refill: Cancel Enable | NR | 0-10 Min | 50K/Day | HQ+REAL
                                        🌍⚡ - $0.9035 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="691" data-rate="0.9117">691
                                        - TikTok Followers | 10M | Refill: Cancel Enable | NR | 0-10 Min | 50K/Day | HQ+REAL
                                        🌍⚡ - $0.9117 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="692" data-rate="0.9199">692
                                        - TikTok Followers | 10M | Refill: 7 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.9199 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="693" data-rate="0.9282">693
                                        - TikTok Followers | 10M | Refill: 15 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.9282 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="694" data-rate="0.9364">694
                                        - TikTok Followers | 10M | Refill: 30 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.9364 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="695" data-rate="0.9446">695
                                        - TikTok Followers | 10M | Refill: 60 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.9446 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="686" data-rate="0.9464">686
                                        - TikTok Followers [ Max 10M ] | HQ Profiles | Instant Start | Day 100K ⚡&gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.9464 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="696" data-rate="0.9528">696
                                        - TikTok Followers | 10M | Refill: 90 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.9528 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="697" data-rate="0.961">697
                                        - TikTok Followers | 10M | Refill: 365 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.961 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="100000" value="698" data-rate="0.9821">698 -
                                        TikTok Followers [ Max 100K ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel Enable | Instant Start | Day
                                        40K 𝗙𝗮𝘀𝘁 - $0.9821 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="702" data-rate="1.0032">702 -
                                        TikTok Followers [ Max 100K ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel Enable | Instant Start | Day
                                        40K 𝗙𝗮𝘀𝘁 - $1.0032 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="689" data-rate="1.0267">689 -
                                        TikTok Followers | 500K | NR | 0-10 Min | 50K/Day | INSTANT 𝐕𝐈𝐏 𝐒𝐄𝐑𝐕𝐈𝐂𝐄 ✨
                                        𝟭 𝗠İ𝗡 𝗖𝗢𝗠𝗣𝗟𝗘𝗧𝗘𝗗 - $1.0267 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000000" value="684" data-rate="2.4512">684
                                        - TikTok Followers [ Max 10M ] | HQ &amp; Profiles With Photo | Cancel Enable |
                                        Instant Start | No Refill ⚠️ | Day 50K - $2.4512 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="100000000" value="685" data-rate="2.4998">
                                        685 - TikTok Followers [ Max 10M ] | HQ &amp; Profiles With Photo | Cancel Enable |
                                        Instant Start | No Refill ⚠️ | Day 100K 🚀 - $2.4998 (Min-Max: 10 - 100000000)
                                    </option>
                                    <option data-min="10" data-max="50000" value="699" data-rate="1.2053">699 -
                                        TikTok Followers [ Max 50K ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 𝐏𝐄𝐎𝐏𝐋𝐄 | Cancel Enable | Non Drop
                                        | Instant Start | Day 50K - $1.2053 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="50000" value="703" data-rate="1.2312">703 -
                                        TikTok Followers [ Max 50K ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 𝐏𝐄𝐎𝐏𝐋𝐄 | Cancel Enable | Non Drop
                                        | Instant Start | Day 50K - $1.2312 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="1000000" value="700" data-rate="1.2946">700
                                        - TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp; Refill Enable | 30 Days
                                        ♻️| 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.2946 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="704" data-rate="1.3224">704
                                        - TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp; Refill Enable | 30 Days
                                        ♻️| 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $1.3224 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="701" data-rate="1.5713">701
                                        - ⚡𝐓𝐎𝐏 𝐒𝐏𝐄𝐄𝐃⚡TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp;
                                        Refill Enable | Non Drop | 30 Days ♻️| Day 100K - $1.5713 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="705" data-rate="1.6051">705
                                        - ⚡𝐓𝐎𝐏 𝐒𝐏𝐄𝐄𝐃⚡TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp;
                                        Refill Enable | Non Drop | 30 Days ♻️| Day 100K - $1.6051 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="5000000" value="1325" data-rate="0.0324">1325
                                        - TikTok Like | Max 5M | Instant | No Refill | 20K/Day - $0.0324 (Min-Max: 10 -
                                        5000000)</option>
                                    <option data-min="10" data-max="1000000" value="1443" data-rate="0.0102">1443
                                        - TikTok Likes | Max 100K | Bot | | Instant | No refill | 20K/Day - $0.0102
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1217" data-rate="0.0117">1217
                                        - TikTok Likes | Max 1M | Low Drop | No refill | Instant Start | Day 10K 🚀 -
                                        $0.0117 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1216" data-rate="0.0502">1216
                                        - TikTok Like | Max 1K | LQ | Instant | No Refill | 1K/Day - $0.0502 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="100000" value="909" data-rate="0.0727">909 -
                                        TikTok Likes | Max 100K | LQ Profiles | Instant | NR ⚠️ | Day 20K ⚡ - $0.0727
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1152" data-rate="0.0519">1152
                                        - TikTok Likes | Max 1M | HQ Profiles | 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 | 20K/Day |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.0519 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="50000000" value="1218" data-rate="0.0703">
                                        1218 - TikTok Likes | Max 5M | Instant | High Quality | Refill 30 Day | 30K/Day -
                                        $0.0703 (Min-Max: 10 - 50000000)</option>
                                    <option data-min="10" data-max="1000000" value="1103" data-rate="0.0519">1103
                                        - TikTok Likes | HQ | NR | Instant | 5K/Day - $0.0519 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="880" data-rate="0.23">880 -
                                        TikTok Likes Việt Nam 🇻🇳| Tài nguyên nuôi | Max 20K | 1-2K/Ngày | ⚡⛔ - ( 5.2 VND )
                                        - $0.23 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="100000" value="1148" data-rate="0.04">1148 -
                                        TikTok Likes | Instant | High Quality | No Refill | 3K Per Day⚡⛔ - $0.04 (Min-Max:
                                        10 - 100000)</option>
                                    <option data-min="50" data-max="1000000" value="1115" data-rate="0.043329">
                                        1115 - TikTok Like Seller | Instant | NR | 1K 5K/Day - $0.043329 (Min-Max: 50 -
                                        1000000)</option>
                                    <option data-min="10" data-max="20000" value="1088" data-rate="0.03">1088 -
                                        TikTok Like | Max 20K | NR | 1K - 5K/Day - $0.03 (Min-Max: 10 - 20000)</option>
                                    <option data-min="10" data-max="30000" value="1089" data-rate="0.05">1089 -
                                        TikTok Like | Max 100K | NR | 3K - 10K/Day - $0.05 (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="500000" value="867" data-rate="0.0714">867 -
                                        TikTok Likes [ Max 10M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | No Refill ⚠️ | Instant Start | Day 100K
                                        🚀 - $0.0714 (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="10000000" value="916" data-rate="0.106">916
                                        - TikTok Likes + Views| Max 1M | Refill 14 Day | 50K/Ngày ♻️⛔ - $0.106 (Min-Max: 100
                                        - 10000000)</option>
                                    <option data-min="10" data-max="50000" value="851" data-rate="0.05">851 -
                                        TikTok Likes | Instant | Ultra Fast | 20K Per Day ⚡️ - $0.05 (Min-Max: 10 - 50000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="908" data-rate="0.04">908 -
                                        TikTok Likes World King |Max 10M | No Refill | Instant Start | Fast | ⛔⚡ - $0.04
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="915" data-rate="0.04">915 -
                                        TikTok Likes World King |Max 10M | No Refill | Instant Start | Fast | ⛔⚡ - $0.04
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="731" data-rate="0.0902">731
                                        - TikTok Likes [ Worldwide 🌎] [ Max 10M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel Enable | 30 Days
                                        ♻️ | Day 100K ⚡️𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 🚀 - $0.0902 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="100000" value="723" data-rate="0.0483">723 -
                                        TikTok Likes [ Max 100K ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel Enable | NR ⚠️ | Day 50K ⚡️ -
                                        $0.0483 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="708" data-rate="0.0886">708
                                        - TikTok - Like | Max 500k | LQ Profile | 50k/days | Instant | 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        𝗨𝗣𝗗𝗔𝗧𝗘𝗗 - $0.0886 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="100000" value="722" data-rate="0.0676">722 -
                                        TikTok Likes | HQ - Real Profiles | No Refill | Instant Start | Fast | Max 100K |
                                        Day 10K - $0.0676 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="602" data-rate="0.049">602 -
                                        TikTok Likes | Max 500K | Instant Slow | Cancel Enabled | Day 10K | NR ⚠️ - $0.049
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="659" data-rate="0.0912">659 -
                                        TikTok Likes [ Max 500K ] | HQ Profiles | Cancel Enable | Days 20K ⚡𝐔𝐋𝐓𝐑𝐀
                                        𝐅𝐀𝐒𝐓 🚀 - $0.0912 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="611" data-rate="0.0759">611 -
                                        TikTok Likes | Max 500K | INSTANT | Day 10K | No Refill - $0.0759 (Min-Max: 10 -
                                        500000)</option>
                                    <option data-min="10" data-max="500000" value="658" data-rate="0.0775">658 -
                                        TikTok Likes | 𝐋𝐐 𝐏𝐫𝐨𝐟𝐢𝐥𝐞𝐬 | Instant Start | NR ⚠️ | 100K/Day - $0.0775
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="100000000" value="580" data-rate="0.034">580
                                        - TikTok Likes | Max 10M | Instant | 10K - 20K/Day - $0.034 (Min-Max: 10 -
                                        100000000)</option>
                                    <option data-min="11" data-max="10000000" value="317" data-rate="0.06">317 -
                                        TikTok Likes | Max 10M | INSTANT | NR ⚠️ | Day 100K - $0.06 (Min-Max: 11 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="50000" value="585" data-rate="0.08">585 -
                                        TikTok Likes | Instant | Profile Without Avatar &amp; With Avatar | No Refill ⚡ -
                                        $0.08 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="500000" value="581" data-rate="0.1">581 -
                                        TikTok Likes | Instant | High Quality | 10K Per Day | Refill 7 Days ⚡️♻️ - $0.1
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="100000" value="586" data-rate="0.049">586 -
                                        TikTok Likes | Worldwide 🌎| 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel Enable | NR ⚠️ | Max 10M | Day
                                        100K ⚡️𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 🚀 - $0.049 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="601" data-rate="0.0808">601 -
                                        TikTok Likes [ Max 500K ] | 𝐋𝐐 𝐏𝐫𝐨𝐟𝐢𝐥𝐞𝐬 | Instant | NR ⚠️ | Day 100K -
                                        $0.0808 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000000" value="587" data-rate="0.114">587
                                        - TikTok Likes + Views | HQ - Real Profiles | Worldwide 🌍 | SuperFast | Non Drop |
                                        Max 10M | Day 100K - $0.114 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="150000" value="600" data-rate="0.12">600 -
                                        TikTok Likes | MQ | Cancel Enable | Instant | 50K/Day - $0.12 (Min-Max: 10 - 150000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="318" data-rate="0.145">318 -
                                        TikTok Likes | Instant | High Quality | 10K Per Day | Refill 30 Days ⚡️♻️ - $0.145
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="1552" data-rate="0.0147">1552
                                        - TikTok Likes [ Max 5M ] | HQ Profiles | Cancel Enable | No Refill ⚠️ | Instant
                                        Start | Day 100K - $0.0147 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1501" data-rate="0.0147">1501
                                        - TikTok Likes | Max 1M | LQ Profiles | Instant | No refill | 100K/Day - $0.0147
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1553" data-rate="0.0494">1553
                                        - TikTok Likes [ Max 5M ] | HQ Profiles | Cancel Enable | No refill | Instant Start
                                        | Day 20K - $0.0494 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="10000000" value="1641" data-rate="0.019">1641
                                        - TikTok Likes | Max 10M | Real&amp; Bot Accounts | Instant | 100k/Day - $0.019
                                        (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1843" data-rate="0.06">1843
                                        - TikTok Likes [ Max 10M ] | Non Drop | Cancel Enable | No Refill ⚠️ | Instant Start
                                        | Day 200K 🚀 - $0.06 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1844" data-rate="0.062">1844
                                        - TikTok Likes [ Max 10M ] | Non Drop | Cancel Enable | 30 Days ♻️ | Instant Start |
                                        Day 200K 🚀 - $0.062 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="50" data-max="500000" value="989" data-rate="0.1">989 -
                                        TikTok Likes [ Max 500K ] | HQ + Real | Cancel Enable | No Refill ⚠️ | Instant | Day
                                        50K - $0.1 (Min-Max: 50 - 500000)</option>
                                    <option data-min="50" data-max="10000000" value="994" data-rate="0.11">994 -
                                        TikTok Likes [ Max 10M ] | HQ Real People | Cancel Enable | Non Drop | 60 Day ♻️ |
                                        Instant Start | Day 100K - $0.11 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="996" data-rate="0.125">996
                                        - TikTok Likes [ Max 10M ] | HQ Real People | Cancel Enable | Non Drop | 365 Day ♻️
                                        | Instant Start | Day 100K - $0.125 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="991" data-rate="0.11">991 -
                                        TikTok Likes [ Max 10M ] | HQ Real People | Cancel Enable | Non Drop | 7 Day ♻️ |
                                        Instant Start | Day 100K - $0.11 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="993" data-rate="0.13">993 -
                                        TikTok Likes [ Max 10M ] | HQ Real People | Cancel Enable | Non Drop | 30 Day ♻️ |
                                        Instant Start | Day 100K - $0.13 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="995" data-rate="0.12">995 -
                                        TikTok Likes [ Max 10M ] | HQ Real People | Cancel Enable | Non Drop | 90 Day ♻️ |
                                        Instant Start | Day 100K - $0.12 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="10000000" value="990" data-rate="0.105">990
                                        - TikTok Likes [ Max 10M ] | HQ + Real | Cancel Enable | Non Drop | No Refill ⚠️ |
                                        Instant | Day 200K - $0.105 (Min-Max: 50 - 10000000)</option>
                                    <option data-min="50" data-max="500000" value="992" data-rate="0.12">992 -
                                        TikTok Likes [ Max 10M ] | HQ Real People | Cancel Enable | Non Drop | 15 Day ♻️ |
                                        Instant Start | Day 100K - $0.12 (Min-Max: 50 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="1583" data-rate="0.0093">1583
                                        - TikTok Likes | Max 1M | Low Quality | Instant | No refill | 50K/Day - $0.0093
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1584" data-rate="0.0094">1584
                                        - TikTok Likes | Max 1M | Low Quality | Instant | Refill 30 Day | 100K/Day - $0.0094
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1585" data-rate="0.0096">1585
                                        - TikTok Likes | Max 1M | Low Quality | Instant | Refill 60 Day | 100K/Day - $0.0096
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1586" data-rate="0.0097">1586
                                        - TikTok Likes | Max 1M | Low Quality | Instant | Refill 90 Day | 150K/Day - $0.0097
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1587" data-rate="0.0098">1587
                                        - TikTok Likes | Max 1M | Low Quality | Instant | Refill 365 Day | 200K/Day -
                                        $0.0098 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1588" data-rate="0.0099">1588
                                        - TikTok Likes | Max 1M | Low Quality | Instant | LifeTime | 50K/Day - $0.0099
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="10000000" value="1650" data-rate="0.12">1650
                                        - TikTok Likes + Views 🌎 | Max 10M | Non Drop | Cancel Enable | No Refill⚠️ | Day
                                        100K ⚡️ - $0.12 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1651" data-rate="0.125">1651
                                        - TikTok Likes + Views 🌎 | Max 10M | Non Drop | Cancel Enable | 30 Days ♻️ | Day
                                        100K ⚡️ - $0.125 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1652" data-rate="0.13">1652
                                        - TikTok Likes + Views 🌎 | Max 10M | Non Drop | Cancel Enable | 60 Days ♻️ | Day
                                        100K ⚡️ - $0.13 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1653" data-rate="0.135">1653
                                        - TikTok Likes + Views 🌎 | Max 10M | Non Drop | Cancel Enable | 90 Days ♻️ | Day
                                        100K ⚡️ - $0.135 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1654" data-rate="0.14">1654
                                        - TikTok Likes + Views [ Worldwide 🌎] [ Max 10M ] | HQ + REAL | Non Drop | Cancel
                                        Enable | 365 Days ♻️ | Day 100K ⚡️ - $0.14 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1655" data-rate="0.145">1655
                                        - TikTok Likes + Views [ Worldwide 🌎] [ Max 10M ] | HQ + REAL | Non Drop | Cancel
                                        Enable | Lifetime ♻️ | Day 100K ⚡️ - $0.145 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="100" data-max="1000000" value="1177" data-rate="0.179">1177
                                        - TikTok Followers | Max 1M | HQ Real People | Instant | Refill 30 Day | Need to
                                        open the live streaming room of the account Until the order is completed | 10K/Day -
                                        $0.179 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="10" data-max="500" value="1312" data-rate="0.3399">1312 -
                                        TikTok Followers | Max 500/Order | High Quality | Instant | No Refill | 5K/Day -
                                        $0.3399 (Min-Max: 10 - 500)</option>
                                    <option data-min="50" data-max="100000" value="1162" data-rate="0.785">1162 -
                                        TikTok Followers | Max 50K | High Quality | Instant | NR | 10K/Day - $0.785
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1146" data-rate="2.7197">1146
                                        - TikTok Followers | Max 100k | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 𝗣𝗶𝗰𝘁𝘂𝗿𝗲 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 |
                                        No Refill | Instant | 50K/Day - $2.7197 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1256" data-rate="2.5549">1256
                                        - TikTok Followers | Max 1M | High Quality | 50k/Day | Instant | 𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 -
                                        $2.5549 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1224" data-rate="2.5549">1224
                                        - TikTok Followers | HQ Profiles | Refilll 7 Day | Instant Start | 100K/Day 🚀 -
                                        $2.5549 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1163" data-rate="2.3077">1163
                                        - TikTok Followers | Max 1M | Instant | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 |
                                        100k/Day - $2.3077 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="200" data-max="500000" value="1150" data-rate="1">1150 -
                                        TikTok Followers [ Max 500K ] | HQ Real People | Cancel Enable | Non Drop | No
                                        Refill ⚠️ | Instant | Day 50K - $1 (Min-Max: 200 - 500000)</option>
                                    <option data-min="100" data-max="10000000" value="1151" data-rate="1.8752">
                                        1151 - TikTok Followers | Max 10M | HQ Real People | No Refill | Instant Start | Day
                                        100K 🚀 - $1.8752 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="50" data-max="100000" value="628" data-rate="0.5578">628 -
                                        TikTok Followers [ Max 5M ] | 𝐋𝐐 | Cancel Enable | NR ⚠️ | Day 500K &gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.5578 (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1140" data-rate="1.75">1140 -
                                        TikTok Followers [ Max 1M ] | HQ Real People | 30 Days ♻️ | Instant Start | Day 50K
                                        （1: Need to open the live streaming room of the account! Until the order is
                                        completed.）（Please check the service details） - $1.75 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="997" data-rate="3.162">997 -
                                        TikTok Followers | Max 500K | Super Instant | Day 5K | No Refill ⚠️ - $3.162
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="100000" value="667" data-rate="0.8482">667 -
                                        TikTok Followers [ Max 100K ] | HQ | Cancel Enable | Non Drop | 30 Day ♻️ | Instant
                                        Start | Day 50K - $0.8482 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="666" data-rate="0.839">666 -
                                        TikTok Followers [ Max 100K ] | HQ | Cancel Enable | Non Drop | No Refill ⚠️ |
                                        Instant | Day 20K - $0.839 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="783" data-rate="0.8846">783
                                        - TikTok Followers | 5M | Refill: 30 Days ♻️ | Instant | 0-10 Min | 50K/Day | HQ
                                        Real Profiles 🌍⚡ - $0.8846 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="668" data-rate="0.8892">668
                                        - TikTok Followers [ Max 5M ] | HQ Real People | Cancel Enable | Non Drop | 30 Day
                                        ♻️ | Instant Start | Day 200K ⚡️ - $0.8892 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="10000000" value="669" data-rate="0.8938">669
                                        - TikTok Followers [ Max 10M ] | HQ | Cancel Enable | Non Drop | 30 Day ♻️ | Instant
                                        Start | Day 40K - $0.8938 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="1000000" value="670" data-rate="1.0032">670
                                        - TikTok Followers [ Max 1M ] | HQ Real People | Cancel Enable | Non Drop | 30 Day
                                        ♻️ | Instant Start | Day 200K ⚡️ - $1.0032 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="50000" value="660" data-rate="0.72">660 -
                                        TikTok Followers | HQ - 𝐀𝐥𝐥 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐀𝐯𝐚𝐭𝐚𝐫𝐬 | Cancel
                                        Enable | Non Drop | No Refill ⚠️ | Instant | Max 50K | Day 10K - $0.72 (Min-Max: 100
                                        - 50000)</option>
                                    <option data-min="10" data-max="1000000" value="617" data-rate="0.5299">617
                                        - TikTok Followers [ Max 1M ] | 𝗛𝗤+𝗥𝗘𝗔𝗟 | Cancel &amp; Refill Enable | Non
                                        Drop | 30 Days ♻️| Day 100K - $0.5299 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="20" data-max="5000000" value="615" data-rate="0.8479">615
                                        - TikTok Followers | 𝐋𝐐 + Avatar | Cancel Enable | NR | 5K/Day⚡ - $0.8479
                                        (Min-Max: 20 - 5000000)</option>
                                    <option data-min="10" data-max="1000000" value="616" data-rate="0.69">616 -
                                        ⚡𝐓𝐎𝐏 𝐒𝐏𝐄𝐄𝐃⚡TikTok Followers | Max 1M | 𝐇𝐐 𝐏𝐫𝐨𝐟𝐢𝐥𝐞𝐬 | INSTANT | Day
                                        100K | 30 Days Refill ♻️ - $0.69 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="5000000" value="603" data-rate="0.1152">603
                                        - TikTok Followers | LQ | No Refill ⚠️ | Instant Start | Max 1M | Day 50K ⚡ -
                                        $0.1152 (Min-Max: 50 - 5000000)</option>
                                    <option data-min="50" data-max="5000000" value="592" data-rate="0.125">592 -
                                        Tiktok Followers [Max 5M] [MQ] [Cancel Enable] [20K/D] [No Refill] - $0.125
                                        (Min-Max: 50 - 5000000)</option>
                                    <option data-min="50" data-max="100000" value="591" data-rate="0.1301">591 -
                                        TikTok Followers | Max 100K | INSTANT | UltraFast / Day 20K | No Refill - $0.1301
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="320" data-rate="0.1263">320
                                        - TikTok Followers | Max 500K | INSTANT | UltraFast / Day 20K | No Refill - $0.1263
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="319" data-rate="0.1428">319
                                        - TikTok Followers | Max 10M | INSTANT | UltraFast / Day 10K | No Refill - $0.1428
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="500000" value="321" data-rate="0.9278">321 -
                                        TikTok Followers | Max 500K | INSTANT | UltraFast / Day 50K | No Refill - $0.9278
                                        (Min-Max: 50 - 500000)</option>
                                    <option data-min="10" data-max="2000000" value="322" data-rate="0.9788">322
                                        - TikTok Followers | Max 200K | INSTANT | Day 50K | 30 Days Guaranteed ♻️ - $0.9788
                                        (Min-Max: 10 - 2000000)</option>
                                    <option data-min="10" data-max="1000000" value="323" data-rate="0.2035">323
                                        - TikTok Followers | Max 500K | Cancel &amp; Refill Enabled | UltraFast / Day 50K ⚡
                                        | 30 Days Guaranteed ♻️ - $0.2035 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="50" data-max="100000" value="1414" data-rate="0.74">1414 -
                                        TikTok Follow | Max 100K | 𝐇𝐐 𝗣𝗿𝗼𝗳𝗶𝗹𝗲 | Non Drop | Instant | No refill | 1K
                                        - 3K/day - $0.74 (Min-Max: 50 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1494" data-rate="0.46">1494 -
                                        TikTok Followers | Max 1M | MQ Profiles | Cancel Enable | No Refill ⚠️ | Instant
                                        Start | Day 50K - $0.46 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1495" data-rate="0.85">1495 -
                                        TikTok Followers | Max 1M | HQ &amp;amp;amp; Real People | Refill 30 Day | Instant
                                        Start | 10K/Day 🚀 - $0.85 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1436" data-rate="1.35">1436 -
                                        TikTok - Followers | Max 1M | 🌎 Worldwide | 𝟭𝟬𝟬% 𝗥𝗲𝗮𝗹 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 |
                                        Cancel Enable | Drop %0-2 | 20k/Days ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 - $1.35 (Min-Max:
                                        10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1437" data-rate="0.775">1437
                                        - TikTok - Followers | Max 1M | 🌎 Worldwide | 𝟭𝟬𝟬% 𝗥𝗲𝗮𝗹 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 |
                                        Cancel Enable | Drop %0-2 | 20k/Days ~ Instant ~ 𝗥𝗘𝗙𝗜𝗟𝗟 30D - $0.775 (Min-Max:
                                        10 - 5000000)</option>
                                    <option data-min="10" data-max="1000000" value="1438" data-rate="1.62">1438 -
                                        TikTok - Followers | Max 1M | 𝟭𝟬𝟬% 𝗥𝗲𝗮𝗹 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 ~ 100k/Days ~ Instant
                                        ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 | 𝗙𝗔𝗦𝗧 - $1.62 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1439" data-rate="1.68">1439 -
                                        TikTok - Followers | Max 1M | 𝟭𝟬𝟬% 𝗥𝗲𝗮𝗹 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 ~ 100k/Days ~ Instant
                                        ~ 𝗥𝗘𝗙𝗜𝗟𝗟 30D | 𝗙𝗔𝗦𝗧 - $1.68 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1440" data-rate="1.835">1440
                                        - TikTok - Followers | Max 1M | 🌎 Worldwide | 𝟭𝟬𝟬% 𝗥𝗲𝗮𝗹 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 ~
                                        5k-10k/Days ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 | 𝗡𝗘𝗩𝗘𝗥 𝗦𝗧𝗨𝗖𝗞 - $1.835 (Min-Max:
                                        10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1441" data-rate="1.939">1441
                                        - TikTok - Followers | Max 1M | 🌎 Worldwide | 𝟭𝟬𝟬% 𝗥𝗲𝗮𝗹 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 ~
                                        5k-10k/Days ~ Instant ~ 𝗥𝗘𝗙𝗜𝗟𝗟 30D | 𝗡𝗘𝗩𝗘𝗥 𝗦𝗧𝗨𝗖𝗞 - $1.939 (Min-Max:
                                        10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1570" data-rate="0.77">1570 -
                                        TikTok Followers [ Max 1M ] | %100 Real Profiles | Cancel Enable | 30 Days ♻️ |
                                        Instant Start | Day 300K 🚀🚀 - $0.77 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1571" data-rate="0.79">1571 -
                                        TikTok Followers [ Max 1M ] | %100 Real Profiles | Cancel Enable | 60 Days ♻️ |
                                        Instant Start | Day 300K 🚀🚀 - $0.79 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1572" data-rate="0.81">1572 -
                                        TikTok Followers [ Max 1M ] | %100 Real Profiles | Cancel Enable | 90 Days ♻️ |
                                        Instant Start | Day 300K 🚀🚀 - $0.81 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1573" data-rate="0.83">1573 -
                                        TikTok Followers [ Max 1M ] | %100 Real Profiles | Cancel Enable | 365 Days ♻️ |
                                        Instant Start | Day 300K 🚀🚀 - $0.83 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1574" data-rate="0.85">1574 -
                                        TikTok Followers [ Max 1M ] | %100 Real Profiles | Cancel Enable | Lifetime ♻️ |
                                        Instant Start | Day 300K 🚀🚀 - $0.85 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1590" data-rate="0.8323">1590
                                        - TikTok Followers | Max 50K | HQ Account | Instant | Refill 30 Day | 10K - 20K/Day
                                        - $0.8323 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1591" data-rate="0.9285">1591
                                        - TikTok Followers | Max 1M | HQ Account | Instant | Refill 30 Day | 20K - 30K/Day -
                                        $0.9285 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="10000000" value="1592" data-rate="1.391">1592
                                        - TikTok Followers | Max 1M | 🌎 | Không tụt | Fast | Instant | 100k/day - $1.391
                                        (Min-Max: 10 - 10000000)</option>
                                    <option data-min="150" data-max="100000" value="1644" data-rate="0.2">1644 -
                                        TikTok Followers | Max 200K | LQ Accounts | No Refill ⚠️ | Instant Start | Day 50K
                                        🚀 - $0.2 (Min-Max: 150 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1667" data-rate="1.4">1667 -
                                        TikTok Followers | Max 1M | Instant | No Refill | Cheapest in The World | 1K -
                                        3K/Day - $1.4 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1645" data-rate="0.1089">1645
                                        - TikTok Followers | Max 1M | Accounts with a Profile Photo | Cancel Enable | No
                                        Refill ⚠️ | Instant Start | Day 100K 🚀 - $0.1089 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="10000000" value="1596" data-rate="0.63">1596
                                        - TikTok Followers | Max 10M | %100 Real Profiles | Instant | Non drop | Refill 7
                                        Day | 100K/Day ♻️ - $0.63 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="1000000" value="1597" data-rate="0.865">1597
                                        - TikTok Followers | Max 500k | 100% Real Use | No refill | 20k/Day - $0.865
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1599" data-rate="0.6048">1599
                                        - TikTok Followers | Max 10M | %100 Real Profiles | Instant | Refill 30 Day |
                                        100K/Day - $0.6048 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="1000000" value="1661" data-rate="0.1872">1661
                                        - Tiktok Follower | Max 100K | Instant | No refill | 10K/Day - $0.1872 (Min-Max: 10
                                        - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1702" data-rate="1.1981">1702
                                        - TikTok Followers | 100% Real Users | Max 1M | Instant | No refill | 100K/Day -
                                        $1.1981 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="500000000" value="1110" data-rate="0.0001">
                                        1110 - TikTok Video Views | Max Unlimited | Super Fast | Cancel Enable | Instant
                                        Start | 20M/Day 🚀 - $0.0001 (Min-Max: 100 - 500000000)</option>
                                    <option data-min="10000" data-max="2147483647" value="1281"
                                        data-rate="0.0001">1281 - TikTok View Video | Max Unlimited | Instant| No Refill |
                                        10M/ Day - $0.0001 (Min-Max: 10000 - 2147483647)</option>
                                    <option data-min="1000000" data-max="2147483647" value="1284"
                                        data-rate="8.0E-5">1284 - TikTok Video Views Sale | No refill | Instant | 10M/Day
                                        - $8.0E-5 (Min-Max: 1000000 - 2147483647)</option>
                                    <option data-min="100000" data-max="100000" value="1496" data-rate="1.0E-6">
                                        1496 - TikTok View Video Free | Instant | 100K/Day - $1.0E-6 (Min-Max: 100000 -
                                        100000)</option>
                                    <option data-min="1000" data-max="2147483647" value="1488" data-rate="0.001">
                                        1488 - TikTok - Views | Max Unlimited | 5M/ Day | INSTANT | 𝗖𝗛𝗘𝗔𝗣 𝗙𝗔𝗦𝗧 -
                                        $0.001 (Min-Max: 1000 - 2147483647)</option>
                                    <option data-min="50000" data-max="2147483647" value="1282"
                                        data-rate="0.0007">1282 - TikTok - Views | Max Unlimited | 10M/ Day | INSTANT |
                                        𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 | 𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.0007 (Min-Max: 50000 - 2147483647)
                                    </option>
                                    <option data-min="50000" data-max="2147483647" value="1283"
                                        data-rate="0.0008">1283 - TikTok - Views | Max Unlimited | 10M/ Day | INSTANT |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.0008 (Min-Max: 50000 - 2147483647)</option>
                                    <option data-min="10000" data-max="1000000000" value="1476" data-rate="0.04">
                                        1476 - TikTok View Video Vietnam | Slow | Instant | No refill | 100K-1M/Day - $0.04
                                        (Min-Max: 10000 - 1000000000)</option>
                                    <option data-min="500" data-max="2147483647" value="1121" data-rate="0.0007">
                                        1121 - TikTok - Views Video | Max Unlimited | 500M/Day | 𝗠𝗮𝗶𝗻 𝗣𝗿𝗼𝘃𝗶𝗱𝗲 -
                                        $0.0007 (Min-Max: 500 - 2147483647)</option>
                                    <option data-min="100" data-max="1000000000" value="1264" data-rate="0.00039">
                                        1264 - TikTok Views Video | Always Working | Max 10M | Bonus 0 - 300% | Instant | 1M
                                        - 10M/Day⛔⚡ - $0.00039 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="100" data-max="1000000000" value="1266"
                                        data-rate="0.000138">1266 - TikTok Views Video | Start Slow | NR | 100K - 500K/Day
                                        ⛔ - $0.000138 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="100" data-max="1000000000" value="1265"
                                        data-rate="0.000199">1265 - (ID: 87) - TikTok - Video Views ~ Max 100M ~ 10M/Days
                                        ~ INSTANT⚡⚡ - $0.000199 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="100" data-max="10000000" value="1260" data-rate="0">1260 -
                                        TikTok Video Views | Instant | NR | 10M/Day - $0 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="2147483647" value="1141"
                                        data-rate="0.0002494">1141 - TikTok View Video | Max 10M | Instant or Start: 0-1
                                        hour | 10M/Day - $0.0002494 (Min-Max: 10 - 2147483647)</option>
                                    <option data-min="100" data-max="1000000000" value="1174"
                                        data-rate="0.000691">1174 - TikTok Video Views | Normal Speed | Start 0 - 3 Hours
                                        | 500k/Day | Cheapest - $0.000691 (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="100" data-max="10000000" value="1130" data-rate="0.0006">
                                        1130 - TikTok Views | Instant | Ultra Fast &amp; Stable | 50M Per Day ⚡️ - $0.0006
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="1000" data-max="1000000000" value="1112" data-rate="0.001">
                                        1112 - TikTok - Views Video | Instant | 𝔅𝗲𝙨𝘁 - 𝐒𝐩𝐞𝐞𝐝 | 5B/Day⚡- Update
                                        26/12/2024 - $0.001 (Min-Max: 1000 - 1000000000)</option>
                                    <option data-min="500" data-max="2147483647" value="1111" data-rate="0.0007">
                                        1111 - TikTok Video Views | Max Unlimited | 5M/Day | 𝐋𝐢𝐟𝐞𝐓𝐢𝐦𝐞 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 - $0.0007 (Min-Max: 500 - 2147483647)</option>
                                    <option data-min="1000" data-max="1000000000" value="1101" data-rate="0.001">
                                        1101 - TikTok - Views World King ~ 5B /days ~ [ 𝔅𝗲𝙨𝘁 - 𝐒𝐩𝐞𝐞𝐝 ] ⚡ - $0.001
                                        (Min-Max: 1000 - 1000000000)</option>
                                    <option data-min="100" data-max="1000000" value="1105" data-rate="0.001">1105
                                        - TikTok View Video | Instant | Max 1M | 1M/ 0 -3 Hour - $0.001 (Min-Max: 100 -
                                        1000000)</option>
                                    <option data-min="500" data-max="2147483647" value="1100" data-rate="0.0009">
                                        1100 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M
                                        💥💥𝐂𝐡𝐞𝐚𝐩𝐞𝐬𝐭 💥💥 - $0.0009 (Min-Max: 500 - 2147483647)</option>
                                    <option data-min="49" data-max="2147483647" value="817" data-rate="0.0002">
                                        817 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M [ Cheap ] -
                                        $0.0002 (Min-Max: 49 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1097"
                                        data-rate="0.0010019">1097 - TikTok View Video | Max: Unlimited | Instant or 30
                                        Minutes | 1M - 5M/Day⛔ - $0.0010019 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="50" data-max="2147483647" value="1098" data-rate="0.001">
                                        1098 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M [ Cheap ]
                                        𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 🚀 - $0.001 (Min-Max: 50 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1096" data-rate="0.0015">
                                        1096 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M ⚡ - $0.0015
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="5000000" data-max="2147483647" value="1092"
                                        data-rate="5.0E-5">1092 - TikTok View Video | Instant | Max 5B | 10M/Day - $5.0E-5
                                        (Min-Max: 5000000 - 2147483647)</option>
                                    <option data-min="1000" data-max="1000000" value="1085" data-rate="0">1085 -
                                        TikTok - Views Video | Instant slow | Max 500M | 1M - 5M/Day ⛔ - $0 (Min-Max: 1000 -
                                        1000000)</option>
                                    <option data-min="100" data-max="10000000" value="1087" data-rate="0.01">1087
                                        - TikTok Views | Max: Unlimited | Day 1M &amp;gt; 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭
                                        𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.01 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="49" data-max="30000000" value="988" data-rate="0.0001137">
                                        988 - TikTok View Video | Start Time: 0- 10 Minutes or Instant | 10M/Day |
                                        𝗣𝗿𝗼𝘃𝗶𝗱𝗲𝗿 - $0.0001137 (Min-Max: 49 - 30000000)</option>
                                    <option data-min="49" data-max="30000000" value="843" data-rate="0.0001137">
                                        843 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M [ Cheap ] -
                                        $0.0001137 (Min-Max: 49 - 30000000)</option>
                                    <option data-min="49" data-max="30000000" value="906" data-rate="0.0001137">
                                        906 - TikTok Views Video | Max: Unlimited | Instant | 50M/Day - 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭
                                        𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.0001137 (Min-Max: 49 - 30000000)</option>
                                    <option data-min="1000000" data-max="2147483647" value="636"
                                        data-rate="8.085E-5">636 - Tiktok Video Views Sallers | Min 1M | Instant | 10M/Day
                                        - $8.085E-5 (Min-Max: 1000000 - 2147483647)</option>
                                    <option data-min="100" data-max="200000000" value="818" data-rate="0">818 -
                                        TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M [ Cheap ] - $0
                                        (Min-Max: 100 - 200000000)</option>
                                    <option data-min="100" data-max="100000000" value="324" data-rate="0.00012">
                                        324 - TikTok Views | Max 5B | Instant | 100M/Day - $0.00012 (Min-Max: 100 -
                                        100000000)</option>
                                    <option data-min="100" data-max="50000000" value="578" data-rate="0">578 -
                                        TikTok Views | Max: Unlimited | Day 1M 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0
                                        (Min-Max: 100 - 50000000)</option>
                                    <option data-min="100" data-max="2147483647" value="403" data-rate="0.0001">
                                        403 - TikTok Video Views [ Max Unlimited ] | Instant Start | Day 10M
                                        💥💥𝐂𝐡𝐞𝐚𝐩𝐞𝐬𝐭 💥💥 - $0.0001 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="5000" data-max="100000000" value="1498" data-rate="0.0001">
                                        1498 - TikTok View Video | Instant | Min 5K | No Refill | 10M/Day - $0.0001
                                        (Min-Max: 5000 - 100000000)</option>
                                    <option data-min="5000" data-max="100000000" value="1497" data-rate="0.0001">
                                        1497 - TikTok Video Views | Fast | Lifetime | Instant | 1M/Day - $0.0001 (Min-Max:
                                        5000 - 100000000)</option>
                                    <option data-min="5000" data-max="1000000000" value="1500"
                                        data-rate="0.00012">1500 - TikTok Views Video | Min 5K | Instant | No refill |
                                        1M/Day - $0.00012 (Min-Max: 5000 - 1000000000)</option>
                                    <option data-min="5000" data-max="2147483647" value="1562"
                                        data-rate="0.01417">1562 - TikTok Views | Max 1M | BestPrice | No refill | 1M/Day
                                        - $0.01417 (Min-Max: 5000 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1563" data-rate="0.01536">
                                        1563 - TikTok Views | Max 1M | Instant | No Refill | 1M/Day - $0.01536 (Min-Max: 100
                                        - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1589" data-rate="0.0002">
                                        1589 - TikTok Video Views | Max Unlimited | Instant Start | Day 10M 🚀 - $0.0002
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="50" data-max="2147483647" value="1643" data-rate="0.0075">
                                        1643 - TikTok Video Views [ Max Unlimited ] | Cancel Enable | 30 Days ♻️ | Instant
                                        Start | Day 10M 🚀🚀 - $0.0075 (Min-Max: 50 - 2147483647)</option>
                                    <option data-min="1000" data-max="1000000000" value="1548"
                                        data-rate="0.00312">1548 - TikTok Video Views | Max Unlimited | Low Drop | Cancel
                                        Enable | No Refill ⚠️ | Instant Start | Day 10M 🚀🚀 - $0.00312 (Min-Max: 1000 -
                                        1000000000)</option>
                                    <option data-min="100" data-max="100000000" value="1763" data-rate="0.046">
                                        1763 - TikTok Video Views | Low Drop | No Refill | Instant Start | 1M/Day 🚀 -
                                        $0.046 (Min-Max: 100 - 100000000)</option>
                                    <option data-min="100" data-max="217545811" value="1626" data-rate="0.0031">
                                        1626 - TikTok Video Views | Max Unlimited | Instant | No refill | 10K - 100K/Day -
                                        $0.0031 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="100" data-max="2147483647" value="1530"
                                        data-rate="0.0006825">1530 - TikTok Views Video | Instant | No refill | 1M/Day -
                                        $0.0006825 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1545" data-rate="0.0008">
                                        1545 - TikTok View Video | Instant | No refill | 1M/Day - $0.0008 (Min-Max: 100 -
                                        2147483647)</option>
                                    <option data-min="10" data-max="217545811" value="1560"
                                        data-rate="0.0066267">1560 - TikTok Views | Instant | Non Drop | 50M/Day | Refill
                                        7 Day 🔥 - $0.0066267 (Min-Max: 10 - 217545811)</option>
                                    <option data-min="5000" data-max="2147483647" value="1561" data-rate="0.1">
                                        1561 - TikTok Views | Instant | Non Drop | 50M/Day | Refill 3 Day 🔥 - $0.1
                                        (Min-Max: 5000 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1646" data-rate="0.0002">
                                        1646 - TikTok Video Views [ Max Unlimited ] | Low Drop | Cancel Enable | No Refill
                                        ⚠️ | Instant Start | Day 10M 🚀🚀 - $0.0002 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1647" data-rate="0.0002">
                                        1647 - TikTok Video Views [ Max Unlimited ] | Low Drop | Cancel Enable | No Refill
                                        ⚠️ | Instant Start | Day 10M 🚀🚀 - $0.0002 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="100000000" value="1816" data-rate="0.046">
                                        1816 - TikTok Video Views | Non Drop | No Refill | Instant Start | 10M/Day - $0.046
                                        (Min-Max: 100 - 100000000)</option>
                                    <option data-min="10" data-max="1000000" value="998" data-rate="0.165">998 -
                                        TikTok Story Likes + Views | INSTANT | UltraFast / Day 20K | No Refill - $0.165
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="50000" value="999" data-rate="0.3">999 -
                                        TikTok Story Views | Max 50K | No Refill ⚠️ | Day 50K ⚡ - $0.3 (Min-Max: 100 -
                                        50000)</option>
                                    <option data-min="1" data-max="100000" value="1367" data-rate="0.25">1367 -
                                        TikTok Custom Comments [ Max 100K ] | HQ &amp;amp; Real Profiles | Cancel Enable |
                                        No Refill ⚠️ | Instant Start | Day 200K 🚀 - $0.25 (Min-Max: 1 - 100000)</option>
                                    <option data-min="1" data-max="100000" value="1366" data-rate="0.25">1366 -
                                        TikTok Emoji Comments [ Max 100K ] | HQ &amp;amp; Real Profiles | Cancel Enable | No
                                        Refill ⚠️ | Instant Start | Day 200K 🚀 - $0.25 (Min-Max: 1 - 100000)</option>
                                    <option data-min="10" data-max="300" value="1515" data-rate="4.6">1515 -
                                        TikTok Comment Video Vietnam | Instant | No Refill | 50 - 200/Day - $4.6 (Min-Max:
                                        10 - 300)</option>
                                    <option data-min="25" data-max="10000000" value="1554" data-rate="3000">1554
                                        - TikTok Comments Vietnam | Max 10M | Instant | No Refill | 100 - 500/Day - $3000
                                        (Min-Max: 25 - 10000000)</option>
                                    <option data-min="25" data-max="10000000" value="1365" data-rate="3000">1365
                                        - TikTok Custom Comments Vietnam | HQ &amp;amp; Real Profiles | Cancel Enable | No
                                        Refill | Instant Start | 1K/Day - $3000 (Min-Max: 25 - 10000000)</option>
                                    <option data-min="10" data-max="2147483647" value="730" data-rate="0.0082">
                                        730 - TikTok Video Saves | Max Unlimited | Instant Start | No Refill | 500K/Day ⚡⚠️
                                        - $0.0082 (Min-Max: 10 - 2147483647)</option>
                                    <option data-min="10" data-max="1000000" value="364" data-rate="0.0105">364
                                        - TikTok Video Save [Speed : 500K] [30 Days Guaranteed ♻️] - $0.0105 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="100" data-max="10000" value="365" data-rate="0.0412">365 -
                                        TikTok Video Save [Speed : Day 1M] [30 Days Guaranteed ♻️] - $0.0412 (Min-Max: 100 -
                                        10000)</option>
                                    <option data-min="10" data-max="50000" value="366" data-rate="0.1234">366 -
                                        TikTok Video Save [Speed : Day 100K] [Refill No] - $0.1234 (Min-Max: 10 - 50000)
                                    </option>
                                    <option data-min="100" data-max="2147483647" value="1697" data-rate="0.0037">
                                        1697 - TikTok Video Saves [ Max Unlimited ] | HQ | Non Drop | Instant Start | No
                                        Refill ⚠️ | Day 500K &gt; 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.0037
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="1698" data-rate="0.0039">
                                        1698 - TikTok Video Saves [ Max Unlimited ] | HQ | Non Drop | Instant Start |
                                        Lifetime ♻️ | Day 500K &gt; 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ - $0.0039
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="10" data-max="2147483647" value="1699" data-rate="0.005">
                                        1699 - TikTok Video Saves [ Max: Unlimited ] | HQ | Non Drop | Cancel Enable | No
                                        Refill ⚠️ | Superİnstant | Day 500K &gt; 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ -
                                        $0.005 (Min-Max: 10 - 2147483647)</option>
                                    <option data-min="10" data-max="2147483647" value="1700" data-rate="0.0055">
                                        1700 - TikTok Video Saves [ Max: Unlimited ] | HQ | Non Drop | Cancel Enable |
                                        Lifetime ♻️ | Superİnstant | Day 500K &gt; 𝐔𝐥𝐭𝐫𝐚𝐟𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞𝐝 ⚡ -
                                        $0.0055 (Min-Max: 10 - 2147483647)</option>
                                    <option data-min="100" data-max="1000000" value="369" data-rate="0.175">369 -
                                        Tiktok PK Battle Points [Super Instant] [Speed : Day 500K] [Refill No] - $0.175
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="500" data-max="1000000000" value="1037" data-rate="0.1989">
                                        1037 - TikTok PK Battle Points [ Max 1M ] | Super Instant | Day 500K ⚡ - $0.1989
                                        (Min-Max: 500 - 1000000000)</option>
                                    <option data-min="100" data-max="10000000" value="368" data-rate="0.1441">368
                                        - Tiktok PK Battle Points [Super Instant] [Speed : Day 1M] [Refill No] - $0.1441
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="500" data-max="2147483647" value="1038" data-rate="0.09">
                                        1038 - Tiktok PK Battle Points | Super Instant | Day 500K ⚡ - $0.09 (Min-Max: 500 -
                                        2147483647)</option>
                                    <option data-min="10" data-max="2147483647" value="1039" data-rate="0.1">1039
                                        - Tiktok PK Battle Points | Super Instant | Day 10M ⚡ - $0.1 (Min-Max: 10 -
                                        2147483647)</option>
                                    <option data-min="100" data-max="1000000000" value="367" data-rate="0.1277">
                                        367 - TikTok PK Battle Point | Max 100M | ⚡ 𝙁𝘼𝙎𝙏 𝘾𝙊𝙈𝙋𝙇𝙀𝙏𝙀𝘿 - $0.1277
                                        (Min-Max: 100 - 1000000000)</option>
                                    <option data-min="50" data-max="100000" value="1040" data-rate="0.23">1040 -
                                        TikTok Live Stream Views | Max 100K | 15 Minutes - $0.23 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1041" data-rate="0.46">1041 -
                                        TikTok Live Stream Views | Max 100K | 30 Minutes - $0.46 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1042" data-rate="0.92">1042 -
                                        TikTok Live Stream Views | Max 100K | 60 Minutes - $0.92 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1043" data-rate="1.38">1043 -
                                        TikTok Live Stream Views | Max 100K | 90 Minutes - $1.38 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1044" data-rate="1.84">1044 -
                                        TikTok Live Stream Views | Max 100K | 120 Minutes - $1.84 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="824" data-rate="1.2586">824 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 90 Minutes ✨ -
                                        $1.2586 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="829" data-rate="5.0342">829 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 360 Minutes ✨ -
                                        $5.0342 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="25000" value="343" data-rate="3.36">343 -
                                        TikTok Live Stream Views | Max 25K | 240 Mins - $3.36 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="25000" value="338" data-rate="0.42">338 -
                                        TikTok Live Stream Views | Max 25K | 30 Mins - $0.42 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="100000" value="1045" data-rate="2.8968">1045
                                        - TikTok Live Stream Views | Max 100K | 180 Minutes - $2.8968 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1046" data-rate="3.8624">1046
                                        - TikTok Live Stream Views | Max 100K | 240 Minutes - $3.8624 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1047" data-rate="4.8279">1047
                                        - TikTok Live Stream Views | Max 100K | 300 Minutes - $4.8279 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="826" data-rate="2.5171">826 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 180 Minutes ✨ -
                                        $2.5171 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="821" data-rate="0.2098">821 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 15 Minutes ✨ -
                                        $0.2098 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="25000" value="340" data-rate="1.26">340 -
                                        TikTok Live Stream Views | Max 25K | 90 Mins - $1.26 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="100000" value="1048" data-rate="5.7935">1048
                                        - TikTok Live Stream Views | Max 100K | 360 Minutes - $5.7935 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="823" data-rate="0.839">823 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 60 Minutes ✨ -
                                        $0.839 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="828" data-rate="4.1952">828 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 300 Minutes ✨ -
                                        $4.1952 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="25000" value="342" data-rate="2.52">342 -
                                        TikTok Live Stream Views | Max 25K | 180 Mins - $2.52 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="25000" value="337" data-rate="0.21">337 -
                                        TikTok Live Stream Views | Max 25K | 15 Mins - $0.21 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="100000" value="825" data-rate="1.6781">825 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 120 Minutes ✨ -
                                        $1.6781 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="830" data-rate="20.137">830 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 24 Hours ✨ -
                                        $20.137 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="25000" value="339" data-rate="0.84">339 -
                                        TikTok Live Stream Views | Max 25K | 60 Mins - $0.84 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="100000" value="822" data-rate="0.4195">822 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 30 Minutes ✨ -
                                        $0.4195 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="100000" value="827" data-rate="3.3562">827 -
                                        TikTok Live Stream Views [ Max 100K ] | 𝐀𝐋𝐖𝐀𝐘𝐒 𝐖𝐎𝐑𝐊𝐒 | 240 Minutes ✨ -
                                        $3.3562 (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="25000" value="341" data-rate="1.68">341 -
                                        TikTok Live Stream Views | Max 25K | 120 Mins - $1.68 (Min-Max: 50 - 25000)</option>
                                    <option data-min="50" data-max="100000" value="1049" data-rate="23.18">1049 -
                                        TikTok Live Stream Views | Max 100K | 1440 Minutes - $23.18 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="50000" value="1382" data-rate="0.298">1382 -
                                        TikTok Live Stream Views | Instant⚡️| 15 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $0.298 (Min-Max: 50 -
                                        50000)</option>
                                    <option data-min="50" data-max="50000" value="1383" data-rate="0.592">1383 -
                                        TikTok Live Stream Views | Instant⚡️| 30 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $0.592 (Min-Max: 50 -
                                        50000)</option>
                                    <option data-min="100" data-max="20000" value="1384" data-rate="1.72">1384 -
                                        TikTok Live Stream Views | Instant⚡️| 60 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $1.72 (Min-Max: 100 -
                                        20000)</option>
                                    <option data-min="100" data-max="20000" value="1385" data-rate="2.32">1385 -
                                        TikTok Live Stream Views | Instant⚡️| 90 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $2.32 (Min-Max: 100 -
                                        20000)</option>
                                    <option data-min="100" data-max="20000" value="1386" data-rate="3.09">1386 -
                                        TikTok Live Stream Views | Instant⚡️| 120 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $3.09 (Min-Max: 100
                                        - 20000)</option>
                                    <option data-min="50" data-max="50000" value="1387" data-rate="4.75">1387 -
                                        TikTok Live Stream Views | Instant⚡️| 240 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $4.75 (Min-Max: 50 -
                                        50000)</option>
                                    <option data-min="50" data-max="50000" value="1388" data-rate="8.932">1388 -
                                        TikTok Live Stream Views | Instant⚡️| 300 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $8.932 (Min-Max: 50
                                        - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1389" data-rate="10.1017">1389
                                        - TikTok Live Stream Views | Instant⚡️| 360 Mins | 𝗦𝗧𝗔𝗕𝗟𝗘 - $10.1017 (Min-Max:
                                        50 - 50000)</option>
                                    <option data-min="50" data-max="100000" value="1630" data-rate="4.992">1630 -
                                        TikTok Live Stream Views | Max 100K | 15 Minutes - $4.992 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1631" data-rate="19.968">1631
                                        - TikTok Live Stream Views | Max 100K | 60 Minutes - $19.968 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1632" data-rate="29.952">1632
                                        - TikTok Live Stream Views | Max 100K | 90 Minutes - $29.952 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1633" data-rate="39.936">1633
                                        - TikTok Live Stream Views | Max 100K | 120 Minutes - $39.936 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1634" data-rate="59.904">1634
                                        - TikTok Live Stream Views | Max 100K | 180 Minutes - $59.904 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="20" data-max="10000" value="902" data-rate="1.155">902 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 15 Minutes -
                                        $1.155 (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="901" data-rate="2.31">901 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 30 Minutes -
                                        $2.31 (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="900" data-rate="3.465">900 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 45 Minutes -
                                        $3.465 (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="899" data-rate="4.62">899 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 60 Minutes -
                                        $4.62 (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="898" data-rate="6.93">898 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 90 Minutes -
                                        $6.93 (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="897" data-rate="9.24">897 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 120 Minutes -
                                        $9.24 (Min-Max: 20 - 10000)</option>
                                    <option data-min="20" data-max="10000" value="896" data-rate="11.55">896 -
                                        Tiktok - LiveStream View Vietnam | Start: 1 - 15 minutes | Provider | 150 Minutes -
                                        $11.55 (Min-Max: 20 - 10000)</option>
                                    <option data-min="10" data-max="30000" value="1069" data-rate="0.4956">1069 -
                                        TikTok Live Stream Viewers | Max 100K | 15 Minutes Watching - $0.4956 (Min-Max: 10 -
                                        30000)</option>
                                    <option data-min="10" data-max="100000" value="1070" data-rate="1.0395">1070
                                        - TikTok Live Stream Viewers | Max 100K | 30 Minutes Watching - $1.0395 (Min-Max: 10
                                        - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1071" data-rate="2.079">1071 -
                                        TikTok Live Stream Viewers | Max 100K | 60 Minutes Watching - $2.079 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="10" data-max="100000" value="1072" data-rate="3.1185">1072
                                        - TikTok Live Stream Viewers | Max 100K | 90 Minutes Watching - $3.1185 (Min-Max: 10
                                        - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1073" data-rate="4.158">1073 -
                                        TikTok Live Stream Viewers | Max 100K | 120 Minutes Watching - $4.158 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="20" data-max="100000" value="789" data-rate="2.12">789 -
                                        TikTok Live Stream Viewers | Max 100K | 180 Minutes Watching - $2.12 (Min-Max: 20 -
                                        100000)</option>
                                    <option data-min="10" data-max="30000" value="784" data-rate="0.1765">784 -
                                        TikTok Live Stream Viewers | Max 100K | 15 Minutes Watching - $0.1765 (Min-Max: 10 -
                                        30000)</option>
                                    <option data-min="10" data-max="100000" value="786" data-rate="0.7058">786 -
                                        TikTok Live Stream Viewers | Max 100K | 60 Minutes Watching - $0.7058 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="20" data-max="200000" value="1074" data-rate="6.237">1074 -
                                        TikTok Live Stream Viewers | Max 100K | 180 Minutes Watching - $6.237 (Min-Max: 20 -
                                        200000)</option>
                                    <option data-min="10" data-max="200000" value="1075" data-rate="8.316">1075 -
                                        TikTok Live Stream Viewers | Max 100K | 240 Minutes Watching - $8.316 (Min-Max: 10 -
                                        200000)</option>
                                    <option data-min="10" data-max="100000" value="788" data-rate="1.4115">788 -
                                        TikTok Live Stream Viewers | Max 100K | 120 Minutes Watching - $1.4115 (Min-Max: 10
                                        - 100000)</option>
                                    <option data-min="10" data-max="100000" value="790" data-rate="2.831">790 -
                                        TikTok Live Stream Viewers | Max 100K | 240 Minutes Watching - $2.831 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="10" data-max="100000" value="785" data-rate="0.3529">785 -
                                        TikTok Live Stream Viewers | Max 100K | 30 Minutes Watching - $0.3529 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="10" data-max="100000" value="787" data-rate="1.0587">787 -
                                        TikTok Live Stream Viewers | Max 100K | 90 Minutes Watching - $1.0587 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="50" data-max="500" value="1704" data-rate="1.875">1704 -
                                        Mắt live Tiktok Việt Nam( 15 phút ) - $1.875 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1705" data-rate="3.75">1705 - Mắt
                                        live Tiktok Việt Nam( 30 phút ) - $3.75 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1706" data-rate="7.5">1706 - Mắt
                                        live Tiktok Việt Nam( 60 phút ) - $7.5 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1707" data-rate="11.25">1707 -
                                        Mắt live Tiktok Việt Nam( 90 phút ) - $11.25 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1708" data-rate="15">1708 - Mắt
                                        live Tiktok Việt Nam( 120 phút ) - $15 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1709" data-rate="18.75">1709 -
                                        Mắt live Tiktok Việt Nam( 150 phút ) - $18.75 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1710" data-rate="22.5">1710 - Mắt
                                        live Tiktok Việt Nam( 180 phút ) - $22.5 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1711" data-rate="30">1711 - Mắt
                                        live Tiktok Việt Nam( 240 phút ) - $30 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1712" data-rate="37.5">1712 - Mắt
                                        live Tiktok Việt Nam( 300 phút ) - $37.5 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="100" value="1727" data-rate="3.15">1727 - Mắt
                                        live Tiktok Việt Nam( 15 phút ) - $3.15 (Min-Max: 50 - 100)</option>
                                    <option data-min="50" data-max="100" value="1728" data-rate="6.3">1728 - Mắt
                                        live Tiktok Việt Nam( 30 phút ) - $6.3 (Min-Max: 50 - 100)</option>
                                    <option data-min="50" data-max="500" value="1729" data-rate="0.124615">1729 -
                                        Mắt live Tiktok Việt Nam( 60 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1730" data-rate="0.124615">1730 -
                                        Mắt live Tiktok Việt Nam( 90 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1731" data-rate="0.124615">1731 -
                                        Mắt live Tiktok Việt Nam( 120 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1732" data-rate="0.124615">1732 -
                                        Mắt live Tiktok Việt Nam( 150 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1733" data-rate="0.124615">1733 -
                                        Mắt live Tiktok Việt Nam( 180 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1734" data-rate="0.124615">1734 -
                                        Mắt live Tiktok Việt Nam( 240 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="50" data-max="500" value="1735" data-rate="0.124615">1735 -
                                        Mắt live Tiktok Việt Nam( 300 phút ) - $0.124615 (Min-Max: 50 - 500)</option>
                                    <option data-min="20" data-max="3000" value="1426" data-rate="0.81">1426 - 15
                                        view with avatars | instant - $0.81 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1427" data-rate="1.62">1427 - 30
                                        view with avatars | instant - $1.62 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1428" data-rate="2.43">1428 - 45
                                        view with avatars | instant - $2.43 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1429" data-rate="3.24">1429 - 60
                                        view with avatars | instant - $3.24 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1430" data-rate="4.8">1430 - 90
                                        view with avatars | instant - $4.8 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1431" data-rate="6.4">1431 - 120
                                        view with avatars | instant - $6.4 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1432" data-rate="8.05">1432 -
                                        150 view with avatars | instant - $8.05 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1433" data-rate="9.66">1433 -
                                        180 view with avatars | instant - $9.66 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1434" data-rate="11.28">1434 -
                                        210 view with avatars | instant - $11.28 (Min-Max: 20 - 3000)</option>
                                    <option data-min="20" data-max="3000" value="1435" data-rate="16.5">1435 -
                                        300 view with avatars | instant - $16.5 (Min-Max: 20 - 3000)</option>
                                    <option data-min="10" data-max="1000" value="1726" data-rate="1.65">1726 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 15 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $1.65 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1725" data-rate="3.3">1725 - SMM
                                        Tiktok Live Stream [Vượt Bão] - 30 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $3.3 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1724" data-rate="6.6">1724 - SMM
                                        Tiktok Live Stream [Vượt Bão] - 60 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $6.6 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1723" data-rate="9.9">1723 - SMM
                                        Tiktok Live Stream [Vượt Bão] - 90 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $9.9 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1722" data-rate="13.2">1722 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 120 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $13.2 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1721" data-rate="19.8">1721 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 180 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $19.8 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1720" data-rate="26.4">1720 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 240 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $26.4 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1719" data-rate="33">1719 - SMM
                                        Tiktok Live Stream [Vượt Bão] - 300 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $33 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="1000" value="1718" data-rate="39.6">1718 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 360 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $39.6 (Min-Max: 10 - 1000)</option>
                                    <option data-min="50" data-max="1000" value="1717" data-rate="42.9">1717 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 390 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $42.9 (Min-Max: 50 - 1000)</option>
                                    <option data-min="50" data-max="1000" value="1716" data-rate="46.2">1716 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 420 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $46.2 (Min-Max: 50 - 1000)</option>
                                    <option data-min="50" data-max="1000" value="1715" data-rate="52.8">1715 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 480 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $52.8 (Min-Max: 50 - 1000)</option>
                                    <option data-min="50" data-max="1000" value="1714" data-rate="59.4">1714 -
                                        SMM Tiktok Live Stream [Vượt Bão] - 540 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $59.4 (Min-Max: 50 - 1000)</option>
                                    <option data-min="50" data-max="1000" value="1713" data-rate="66">1713 - SMM
                                        Tiktok Live Stream [Vượt Bão] - 600 [ View Việt Có Avatar ][ Tỷ Lệ Giữ View:
                                        70-80%][Lên Sau 3-5 Phút] - $66 (Min-Max: 50 - 1000)</option>
                                    <option data-min="100" data-max="5000000" value="408" data-rate="0.04">408 -
                                        Tiktok Live Likes | Max: 100M | Instant | 500K/D - $0.04 (Min-Max: 100 - 5000000)
                                    </option>
                                    <option data-min="50" data-max="10000000" value="416" data-rate="0.1">416 -
                                        Tiktok | Live Stream Shares |Max: 100K | 250K/Day - $0.1 (Min-Max: 50 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="409" data-rate="0.075">409
                                        - Tiktok Live Likes | Max: 10M | 100K/Day - $0.075 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="2147483647" value="410" data-rate="0.1">410
                                        - TikTok Live Stream Likes | Max 500 K | SuperFast | 50K/D - $0.1 (Min-Max: 10 -
                                        2147483647)</option>
                                    <option data-min="10" data-max="10000" value="411" data-rate="3">411 -
                                        Tiktok Live Comments | Emoji | Max: 5K | 5K/Day 💬 - $3 (Min-Max: 10 - 10000)
                                    </option>
                                    <option data-min="10" data-max="5000" value="412" data-rate="1.6">412 -
                                        Tiktok Live Comments | Random | Max: 5K | 5K/Day 💬 - $1.6 (Min-Max: 10 - 5000)
                                    </option>
                                    <option data-min="5" data-max="5000" value="413" data-rate="1.5">413 -
                                        Tiktok Live Comments | Custom | Max: 5K | 5K/Day 💬 - $1.5 (Min-Max: 5 - 5000)
                                    </option>
                                    <option data-min="100" data-max="10000000" value="406" data-rate="0.05">406 -
                                        Tiktok Live Stream | Like | Instant - $0.05 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="5000" value="414" data-rate="25.2">414 -
                                        TikTok Livestream Comment | Vietnamese | Instant👁‍🗨🔥🔥 - $25.2 (Min-Max: 10 -
                                        5000)</option>
                                    <option data-min="10" data-max="10000000" value="407" data-rate="0.06">407 -
                                        TikTok Live Stream Likes | Max 100M |500K/D - $0.06 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="50" data-max="10000" value="415" data-rate="0.21819">415 -
                                        TikTok | Live Stream Shares Vietnamese 🇻🇳| Max 10K | Instant🔥🔥 - $0.21819
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="10" data-max="1000" value="473" data-rate="14">473 -
                                        TikTok Like Vietnamese | 1 video/day | Time 30 Day - $14 (Min-Max: 10 - 1000)
                                    </option>
                                    <option data-min="10" data-max="1000" value="474" data-rate="28">474 -
                                        TikTok Like Vietnamese | 2 video/day | Time 30 Day - $28 (Min-Max: 10 - 1000)
                                    </option>
                                    <option data-min="10" data-max="1000" value="475" data-rate="42">475 -
                                        TikTok Like Vietnamese | 3 video/day | Time 30 Day - $42 (Min-Max: 10 - 1000)
                                    </option>
                                    <option data-min="10" data-max="1000" value="476" data-rate="70">476 -
                                        TikTok Like Vietnamese | 5 video/day |Time 30 Day - $70 (Min-Max: 10 - 1000)
                                    </option>
                                    <option data-min="10" data-max="1000" value="477" data-rate="98">477 -
                                        TikTok Like Vietnamese | 7 video/day | Time 30 Day - $98 (Min-Max: 10 - 1000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="1128" data-rate="0.0158">1128
                                        - Instagram Likes [ Old Account ] [ 50-100k/Day ] [ ND ] [ Instant ] - $0.0158
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="200000" value="875" data-rate="0.0123">875 -
                                        Instagram Likes [ Max 200K ] | LQ Profiles | Instant Start | Day 200K ⚡ - $0.0123
                                        (Min-Max: 10 - 200000)</option>
                                    <option data-min="10" data-max="500000" value="876" data-rate="0.0146">876 -
                                        Instagram Likes [ Max 500K ] | Mixed Quality | NR ⚠️ | SuperFast | Day 500K ⚡ -
                                        $0.0146 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="877" data-rate="0.0182">877 -
                                        Instagram Likes [ Max 500K ] | HQ Real Quality | Non Drop | 30 Days ♻️ | Hours 200K
                                        - $0.0182 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="1126" data-rate="0.0166">1126
                                        - Instagram Likes [ Old Account ] [ 100k+/D ] [ ND ] [ R365 ] [ Instant ] - $0.0166
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="300000" value="878" data-rate="0.0274">878 -
                                        Instagram Likes [ Max 300K ] | Mixed Quality | NR ⚠️ | Day 150K ⚡ - $0.0274
                                        (Min-Max: 10 - 300000)</option>
                                    <option data-min="10" data-max="1000000" value="1127" data-rate="0.0125">1127
                                        - Instagram Likes [ Mix Quality ] [ 20k+/Day ] [ Non Drop ] [ No Refill ] [ Instant
                                        ] - $0.0125 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="879" data-rate="0.0182">879
                                        - Instagram Likes [ Max 1M ] | Mixed Quality | NR ⚠️ | SuperFast | Day 200K ⚡ -
                                        $0.0182 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="1575" data-rate="0.324">1575
                                        - Instagram Likes | Max 5M | Real | Instant | No refill | 50k/Day - $0.324 (Min-Max:
                                        10 - 5000000)</option>
                                    <option data-min="50" data-max="1000000" value="1576" data-rate="0.3377">1576
                                        - Instagram Likes | Max 5M | Real | Instant | Refill 30 Day | 50k/Day - $0.3377
                                        (Min-Max: 50 - 1000000)</option>
                                    <option data-min="10" data-max="500000" value="1577" data-rate="0.1584">1577
                                        - Instagram Likes | Max 500K | Real | Instant | No Refill | 50K/Day - $0.1584
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="300000" value="1578" data-rate="0.55">1578 -
                                        Instagram Likes | Max 300K | Real | Instant | no refill | 20K/Day - $0.55 (Min-Max:
                                        100 - 300000)</option>
                                    <option data-min="10" data-max="500000" value="1579" data-rate="0.4397">1579
                                        - Instagram - Likes | Max 500k | 𝗥𝗲𝗮𝗹 𝗠𝗶𝘅𝗲𝗱 | 50k/Days ~ Instant ~
                                        𝗥𝗘𝗙𝗜𝗟𝗟 30D - $0.4397 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="500000" value="1580" data-rate="0.4649">1580
                                        - Instagram - Likes | Max 500k | 𝗥𝗲𝗮𝗹 𝗠𝗶𝘅𝗲𝗱 | 50k/Days ~ Instant ~
                                        𝗥𝗘𝗙𝗜𝗟𝗟 365D - $0.4649 (Min-Max: 10 - 500000)</option>
                                    <option data-min="50" data-max="50000" value="1581" data-rate="0.5472">1581 -
                                        Instagram - Likes | Max 50k | 𝗢𝗹𝗱 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 𝗪𝗶𝘁𝗵 𝗣𝗼𝘀𝘁 ~ 20k/Days ~
                                        Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 - $0.5472 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="50000" value="1582" data-rate="0.576">1582 -
                                        Instagram - Likes | Max 50k | 𝗢𝗹𝗱 𝗔𝗰𝗰𝗼𝘂𝗻𝘁 𝗪𝗶𝘁𝗵 𝗣𝗼𝘀𝘁 ~ 20k/Days ~
                                        Instant ~ 𝗥𝗘𝗙𝗜𝗟𝗟 30D - $0.576 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="10000" value="912" data-rate="0.38">912 -
                                        Sv6 ( Like Instagram Việt ) ( Kbh ) - $0.38 (Min-Max: 50 - 10000)</option>
                                    <option data-min="50" data-max="50000" value="913" data-rate="0.8">913 - Sv4
                                        ( Like Instagram Việt ) ( KBH ) - $0.8 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="100000" value="914" data-rate="0.4">914 -
                                        Instagram Like 🇻🇳 | Instant | Refill 7 Day | Max 100K | 5K - 10K/Day - $0.4
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="50" data-max="10000" value="910" data-rate="0.2072">910 -
                                        Sv7 ( Like Instagram Việt ) ( Giữ like lâu dài tốt ) ( Bảo Hành 60 Ngày ) - $0.2072
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="50" data-max="5000" value="911" data-rate="0.1532">911 -
                                        Sv8 ( Like Instagram Việt ) ( Chậm ) ( KBH ) - $0.1532 (Min-Max: 50 - 5000)</option>
                                    <option data-min="10" data-max="2000000" value="1355" data-rate="0.032">1355
                                        - Instagram Likes | QH &amp;amp; Old Account | Max 1M | Instant | 50K - 200K/Day -
                                        $0.032 (Min-Max: 10 - 2000000)</option>
                                    <option data-min="10" data-max="1000000" value="1359" data-rate="0.729">1359
                                        - Instagram Likes Global | Instant | BOT | NR ⚠️ | 100K - 500K/Day - $0.729
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1356" data-rate="0.0169">1356
                                        - Instagram Likes | QH &amp; Old Account | Max 1M | Instant | 100K - 200K/Day -
                                        $0.0169 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="500000" value="481" data-rate="0.021">481 -
                                        Instagram Likes | LQ Accounts | Cancel &amp; Refill Enabled | UltraFast / Day 50K |
                                        60 Days Guaranteed ♻️ - $0.021 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="874" data-rate="0.0182">874
                                        - Instagram Likes [ Max 1M ] | Mixed Quality | NR ⚠️ | SuperFast | Day 200K ⚡ -
                                        $0.0182 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="500000" value="871" data-rate="0.0146">871 -
                                        Instagram Likes [ Max 500K ] | Mixed Quality | NR ⚠️ | SuperFast | Day 500K ⚡ -
                                        $0.0146 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="480" data-rate="0.0128">480
                                        - Instagram Likes | LQ Accounts | Cancel &amp; Refill Enabled | UltraFast / Day 50K
                                        | 30 Days Guaranteed ♻️ - $0.0128 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="300000" value="873" data-rate="0.0274">873 -
                                        Instagram Likes [ Max 300K ] | Mixed Quality | NR ⚠️ | Day 150K ⚡ - $0.0274
                                        (Min-Max: 10 - 300000)</option>
                                    <option data-min="10" data-max="500000" value="482" data-rate="0.022">482 -
                                        Instagram Likes | LQ Accounts | Cancel &amp; Refill Enabled | UltraFast / Day 50K |
                                        90 Days Guaranteed ♻️ - $0.022 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="200000" value="870" data-rate="0.0123">870 -
                                        Instagram Likes [ Max 200K ] | LQ Profiles | Instant Start | Day 200K ⚡ - $0.0123
                                        (Min-Max: 10 - 200000)</option>
                                    <option data-min="10" data-max="500000" value="479" data-rate="0.02">479 -
                                        Instagram Likes [ Low Quality ] | INSTANT | NR ⚠️ | Day 100K - $0.02 (Min-Max: 10 -
                                        500000)</option>
                                    <option data-min="10" data-max="500000" value="872" data-rate="0.0182">872 -
                                        Instagram Likes [ Max 500K ] | HQ Real Quality | Non Drop | 30 Days ♻️ | Hours 200K
                                        - $0.0182 (Min-Max: 10 - 500000)</option>
                                    <option data-min="50" data-max="1000000" value="1564" data-rate="0.42">1564 -
                                        Instagram Real Likes [ Max 1M ] | High Quality | No Refill ⚠️ | Instant Start | Day
                                        200K 🚀 - $0.42 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1565" data-rate="0.44">1565 -
                                        Instagram Real Likes [ Max 1M ] | High Quality | 30 Days ♻️ | Instant Start | Day
                                        200K 🚀 - $0.44 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1566" data-rate="0.45">1566 -
                                        Instagram Real Likes [ Max 1M ] | High Quality | 60 Days ♻️ | Instant Start | Day
                                        200K 🚀 - $0.45 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1567" data-rate="0.46">1567 -
                                        Instagram Real Likes [ Max 1M ] | High Quality | 90 Days ♻️ | Instant Start | Day
                                        200K 🚀 - $0.46 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1568" data-rate="0.47">1568 -
                                        Instagram Real Likes [ Max 1M ] | High Quality | 365 Days ♻️ | Instant Start | Day
                                        200K 🚀 - $0.47 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1569" data-rate="0.48">1569 -
                                        Instagram Real Likes [ Max 1M ] | High Quality | Lifetime ♻️ | Instant Start | Day
                                        200K 🚀 - $0.48 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="50" data-max="500000" value="986" data-rate="0.618427">986
                                        - Instagram Follow Vietnamese | Instant | Max 500K | 200 - 1K/Day - $0.618427
                                        (Min-Max: 50 - 500000)</option>
                                    <option data-min="10" data-max="15000" value="484" data-rate="0.4888">484 -
                                        Instagram Followers (Real Mixed) | Max 500K | Cancel Enabled | Day 10K | No Refill -
                                        $0.4888 (Min-Max: 10 - 15000)</option>
                                    <option data-min="50" data-max="10000" value="1109" data-rate="31">1109 -
                                        Follow Tây |⚡ Nhanh⚡| Hoạt Động Trong Mùa Quét - $31 (Min-Max: 50 - 10000)</option>
                                    <option data-min="100" data-max="100000" value="1093" data-rate="0.693268">
                                        1093 - Instagram Follow Vietnamese | Instant | Max 100K | 500 - 3k/Day - $0.693268
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="50" data-max="50000" value="1108" data-rate="0.5556">1108 -
                                        🇻🇳 Instagram Follower | Max 50K | Instant | 10K/Day - $0.5556 (Min-Max: 50 -
                                        50000)</option>
                                    <option data-min="50" data-max="10000" value="1222" data-rate="0.5533">1222 -
                                        Instagram Followers Vietnam | Data Real | Instant | 100 - 500/Day - $0.5533
                                        (Min-Max: 50 - 10000)</option>
                                    <option data-min="10" data-max="15000" value="629" data-rate="0.4888">629 -
                                        Instagram Followers (Real Mixed) | Max 10M | Cancel Enabled | Day 10K | No Refill -
                                        $0.4888 (Min-Max: 10 - 15000)</option>
                                    <option data-min="10" data-max="15000" value="645" data-rate="0.912">645 -
                                        Instagram Followers MAX 15K - Super Fast Speed - NR - 15K SPEED PER MINUTE🚀 -
                                        $0.912 (Min-Max: 10 - 15000)</option>
                                    <option data-min="50" data-max="50000" value="646" data-rate="1.14">646 -
                                        Instagram Followers MAX 50K - Super Fast Speed - NR - 50K SPEED PER MINUTE🚀 - $1.14
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="10" data-max="1000000" value="647" data-rate="1.2768">647
                                        - Instagram Followers MAX 1M - Super Fast Speed - NR - 60K SPEED PER MINUTE🚀 -
                                        $1.2768 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="649" data-rate="0.7752">649
                                        - Instagram Followers MAX 5M - Super Fast Speed - R365 ♻️ - 30K SPEED PER MINUTE🚀 -
                                        $0.7752 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="50000" value="483" data-rate="0.19">483 -
                                        Instagram Followers [Real] [Refill: No Refill] [Max: 100K] [Start Time: 0-10 Min]
                                        [Speed: 50K/Day] 💧⚡ - $0.19 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="100000" value="648" data-rate="1.5504">648 -
                                        Instagram Followers MAX 1M - Super Fast Speed - R30 ♻️ - 100K SPEED PER MINUTE🚀 -
                                        $1.5504 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="5000000" value="485" data-rate="0.5759">485
                                        - Instagram Followers (High Quality + Posts) | Flag Disabled | INSTANT | Day 100K ⚡
                                        - $0.5759 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="100" data-max="5000" value="1846" data-rate="0.77">1846 -
                                        Instagram Follow | Vietnam | Instant | No Refill | 10K/Day - $0.77 (Min-Max: 100 -
                                        5000)</option>
                                    <option data-min="10" data-max="1000000" value="1145" data-rate="0.6">1145 -
                                        Instagram Follower | Old &amp; Real Account | NR | Instant | 5K - 10K/Day - $0.6
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="10000" value="1445" data-rate="0.675">1445 -
                                        Instagram Followers | Max 10k | All type flag working | No Refill | 10K/Day ⭐ -
                                        $0.675 (Min-Max: 10 - 10000)</option>
                                    <option data-min="10" data-max="10000000" value="1183" data-rate="0.841">1183
                                        - Instagram Followers | Max 100K | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝟭𝟱+ 𝗣𝗼𝘀𝘁 | 𝐍𝐎
                                        𝗥𝗘𝗙𝗜𝗟𝗟 | 50k/Day - $0.841 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="50" data-max="50000" value="1550" data-rate="0.65625">1550
                                        - Instagram Follower | Max 50K | Instant | No Refill | 3K - 5K/Day - $0.65625
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="300000" value="1621" data-rate="0.8779">1621
                                        - Instagram Follower | Max 100K | Instant | 5K/Day - $0.8779 (Min-Max: 100 - 300000)
                                    </option>
                                    <option data-min="100" data-max="20000" value="1593" data-rate="0.3">1593 -
                                        Instagram Followers | Max 20K | Instant | No refill | 20K/Day - $0.3 (Min-Max: 100 -
                                        20000)</option>
                                    <option data-min="10" data-max="50000" value="1600" data-rate="0.1471">1600 -
                                        Instagram Followers | Max 200K | QH Real | Instant | 5K/day - $0.1471 (Min-Max: 10 -
                                        50000)</option>
                                    <option data-min="100" data-max="1000000" value="1601" data-rate="0.85">1601 -
                                        Instagram Followers | Max 1M | HQ Real | Start 30 minutes | 20k-50k/day - $0.85
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="500" data-max="50000" value="1606" data-rate="0.4905">1606 -
                                        Instagram Followers | Max 50k | Real quality | No refill | Start 0 - 3 Hour |
                                        20k/day - $0.4905 (Min-Max: 500 - 50000)</option>
                                    <option data-min="100" data-max="9000" value="1620" data-rate="0.2087867">1620
                                        - Facebook Profile/Page Followers | Max: 5K | Start: 0-1 Hr | Speed: 1-5K/D ❎ -
                                        $0.2087867 (Min-Max: 100 - 9000)</option>
                                    <option data-min="10" data-max="150000" value="1771" data-rate="0.12">1771 -
                                        Instagram Followers | Max 100K | Old Accounts +Posts | No refill | Instant Start |
                                        No refill | 10K/Day - $0.12 (Min-Max: 10 - 150000)</option>
                                    <option data-min="100" data-max="1000000" value="1736" data-rate="0.2046">1736
                                        - Instagram Followers [ Max 1M ] | 100% Old Accounts +Posts | Low Drop | No Refill
                                        ⚠️ | Instant Start | Day 200K 🚀 - $0.2046 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="50" data-max="1000000" value="1737" data-rate="0.54">1737 -
                                        Instagram Followers [ Max 1M ] | 100% Old Accounts +Posts | Low Drop | 30 Days ♻️ |
                                        Instant Start | Day 200K 🚀 - $0.54 (Min-Max: 50 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="735" data-rate="0.5299">735
                                        - Instagram Followers [ Max 1M ] | 𝐑𝐞𝐚𝐥 𝐏𝐞𝐨𝐩𝐥𝐞 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 100K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.5299
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="739" data-rate="0.5472">739
                                        - Instagram Followers [ Max 1M ] | 𝐑𝐞𝐚𝐥 𝐏𝐞𝐨𝐩𝐥𝐞 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 100K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.5472
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000000" value="736" data-rate="0.5741">736
                                        - Instagram Followers [ Max 5M ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 100K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.5741
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="740" data-rate="0.5928">740
                                        - Instagram Followers [ Max 5M ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 100K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.5928
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="737" data-rate="0.6359">737
                                        - Instagram Followers [ Max 5M ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 200K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.6359
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="200" data-max="100000" value="738" data-rate="0.6447">738 -
                                        Instagram Followers [ Max 100K ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 200K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.6447
                                        (Min-Max: 200 - 100000)</option>
                                    <option data-min="10" data-max="5000000" value="741" data-rate="0.6566">741
                                        - Instagram Followers [ Max 5M ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 200K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.6566
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="200" data-max="100000" value="742" data-rate="0.6658">742 -
                                        Instagram Followers [ Max 100K ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 200K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $0.6658
                                        (Min-Max: 200 - 100000)</option>
                                    <option data-min="10" data-max="5000000" value="732" data-rate="1.316">732 -
                                        Instagram Followers [ Max 5M ] | 𝐎𝐥𝐝 𝐀𝐜𝐜𝐨𝐮𝐧𝐭𝐬 𝐖𝐢𝐭𝐡 𝐏𝐨𝐬𝐭𝐬 | Low
                                        Drop | Day 100K ❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ - $1.316
                                        (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="733" data-rate="1.7664">733
                                        - Instagram Followers [ Max 5M ] | 𝗛𝗤 𝗥𝗘𝗔𝗟 𝟭𝟱+ 𝗣𝗢𝗦𝗧𝗦 | Cancel Enable |
                                        30 Days ♻️ | Day 100K ⚡️❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ -
                                        $1.7664 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="10" data-max="5000000" value="734" data-rate="1.8989">734
                                        - Instagram Followers [ Max 5M ] | 𝗛𝗤 𝗥𝗘𝗔𝗟 𝟭𝟱+ 𝗣𝗢𝗦𝗧𝗦 | Cancel Enable |
                                        60 Days ♻️ | Day 100K ⚡️❌ 𝐃𝐢𝐬𝐚𝐛𝐥𝐞 𝐓𝐡𝐞 𝐅𝐥𝐚𝐠 𝐅𝐨𝐫 𝐑𝐞𝐯𝐢𝐞𝐰 ❌ -
                                        $1.8989 (Min-Max: 10 - 5000000)</option>
                                    <option data-min="100" data-max="2147483647" value="1444" data-rate="0.0009">
                                        1444 - Instagram Video Views | Max Unlimited | All Link | Video+ Reel + IGTV |
                                        Instant | 10M/Day - $0.0009 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="50000000" value="1078" data-rate="0.01">1078
                                        - Instagram Video Views | Max: Unlimited | All Link Accepted | Day 500K | Ultrafast
                                        ⚡ - $0.01 (Min-Max: 100 - 50000000)</option>
                                    <option data-min="100" data-max="100000000" value="1077" data-rate="0.001">
                                        1077 - Instagram Video Views | Max: Unlimited | All Link Accepted | Day 200K |
                                        Ultrafast ⚡ - $0.001 (Min-Max: 100 - 100000000)</option>
                                    <option data-min="100" data-max="2147483647" value="1076" data-rate="0.01">
                                        1076 - Instagram Video Views | Max: Unlimited | All Link Accepted | Slow - $0.01
                                        (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="100000000" value="487" data-rate="0.26">487
                                        - Instagram Video Views | Max: Unlimited | Instant | Day 200K &gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐅𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞 ⚡ - $0.26 (Min-Max: 100 - 100000000)</option>
                                    <option data-min="100" data-max="2147483647" value="486" data-rate="0.22">486
                                        - Instagram Video Views | Max: Unlimited | Instant | Day 500K &gt;
                                        𝐔𝐥𝐭𝐫𝐚𝐅𝐚𝐬𝐭 𝐂𝐨𝐦𝐩𝐥𝐞𝐭𝐞 ⚡ - $0.22 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="848" data-rate="0.0759">
                                        848 - Instagram Video Views + [ Reach ] [ Max Unlimited ] | All Link | Cancel Enable
                                        | Instant Start - $0.0759 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="849" data-rate="0.0893">
                                        849 - Instagram Video Views + [ Reach + Impressions ] [ Max Unlimited ] | All Link |
                                        Cancel Enable | Instant Start - $0.0893 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="2147483647" value="850" data-rate="0.0072">
                                        850 - Instagram Video Views | Max Unlimited | All Link | 𝗨𝗣𝗗𝗔𝗧𝗘𝗗 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 𝗜𝗡 𝗧𝗛𝗘 𝗠𝗔𝗥𝗞𝗘𝗧 - $0.0072 (Min-Max: 100 - 2147483647)
                                    </option>
                                    <option data-min="100" data-max="2147483647" value="844" data-rate="0.0072">
                                        844 - Instagram Video Views | Max Unlimited | All Link | 𝗨𝗣𝗗𝗔𝗧𝗘𝗗 |
                                        𝗖𝗛𝗘𝗔𝗣𝗘𝗦𝗧 𝗜𝗡 𝗧𝗛𝗘 𝗠𝗔𝗥𝗞𝗘𝗧 - $0.0072 (Min-Max: 100 - 2147483647)
                                    </option>
                                    <option data-min="100" data-max="2147483647" value="845" data-rate="0.0095">
                                        845 - Instagram Video Views All Link | Unlimited | Video+ Reel + IGTV ⚡
                                        𝐒𝐞𝐫𝐯𝐞𝐫𝐬 𝐂𝐡𝐞𝐚𝐩 - $0.0095 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="100000000" value="846" data-rate="0.0234">
                                        846 - Instagram Video Views [ Max Unlimited ] | All Link | 𝐒𝐔𝐏𝐄𝐑 𝐅𝐀𝐒𝐓
                                        𝐒𝐏𝐄𝐄𝐃 ⚡️ - $0.0234 (Min-Max: 100 - 100000000)</option>
                                    <option data-min="100" data-max="2147483647" value="847" data-rate="0.0759">
                                        847 - Instagram Video Views + [ Impressions ] [ Max Unlimited ] | All Link | Cancel
                                        Enable | Instant Start - $0.0759 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="10" data-max="1000000" value="332" data-rate="0.1">332 -
                                        YouTube Likes | UltraFast / Day 20K ⚡ | No Warranty ⚠️ - $0.1 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1207" data-rate="0.1632">1207
                                        - YouTube Likes | Max 20K | High Drop | UltraFast / Day 20K | 30 Days Guaranteed ♻️
                                        - $0.1632 (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000" value="575" data-rate="0.5437003061">
                                        575 - YouTube Likes | Instant | 100k/Day - $0.5437003061 (Min-Max: 10 - 5000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="1208" data-rate="0.1632">1208
                                        - YouTube Likes | Max 1M | Instant | Day 20K | 30 Days Guaranteed ♻️ - $0.1632
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="10000" value="1205" data-rate="0.0396">1205 -
                                        YouTube Real Likes | 5K/Day | No refill | Max 10K | 10K/Day - $0.0396 (Min-Max: 10 -
                                        10000)</option>
                                    <option data-min="10" data-max="300000" value="1209" data-rate="0.264">1209 -
                                        YouTube Likes | Max 300K | High Drop | UltraFast / Day 20K | 60 Days Guaranteed ♻️ -
                                        $0.264 (Min-Max: 10 - 300000)</option>
                                    <option data-min="10" data-max="10000" value="1210" data-rate="0.33">1210 -
                                        YouTube Likes | Non Drop | 10K/Day ⚡ | 30 Days Guaranteed ♻️ - $0.33 (Min-Max: 10 -
                                        10000)</option>
                                    <option data-min="10" data-max="10000" value="1206" data-rate="0.4389">1206 -
                                        YouTube Likes | Low Drop | Day 50K ⚡ | 30 Days Guaranteed ♻️ - $0.4389 (Min-Max: 10
                                        - 10000)</option>
                                    <option data-min="100" data-max="10000000" value="334" data-rate="0.9644">334
                                        - YouTube Views | INSTANT | Non Drop | Fast / Day 15K | Lifetime Guaranteed ⚡🔥♻️ -
                                        $0.9644 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="10" data-max="300000" value="336" data-rate="0.27">336 -
                                        YouTube Likes | Max 20K | High Drop | UltraFast / Day 20K | 60 Days Guaranteed ♻️ -
                                        $0.27 (Min-Max: 10 - 300000)</option>
                                    <option data-min="100" data-max="1000000" value="333" data-rate="0.69">333 -
                                        YouTube Views | INSTANT | Non Drop | Fast / Day 10K | Lifetime Guaranteed ⚡🔥♻️ -
                                        $0.69 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="10" data-max="100000" value="335" data-rate="0.2">335 -
                                        YouTube Likes | Max 20K | High Drop | UltraFast / Day 20K | 30 Days Guaranteed ♻️ -
                                        $0.2 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="1000000" value="1657" data-rate="0.6167">1657
                                        - Youtube Likes | Instant | 100K Per Day | No Refill ⚡ - $0.6167 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="1000000" value="1658" data-rate="0.6667">1658
                                        - Youtube Likes | Instant | 200K Per Day | No Refill ⚡ - $0.6667 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="10000000" value="1659" data-rate="0.8167">
                                        1659 - Youtube Likes | Instant | 100K Per Day | 30 Days Refill ♻️⚡ - $0.8167
                                        (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1660" data-rate="0.9167">
                                        1660 - Youtube Likes | Instant | 200K Per Day | 30 Days Refill ♻️⚡ - $0.9167
                                        (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="20000" value="1353" data-rate="3.1">1353 -
                                        YouTube Subscribers | Max 20K | HQ Accounts | Low Drop | 7 Days ♻️ | Start: 0-1
                                        Hours | Day 20K - $3.1 (Min-Max: 10 - 20000)</option>
                                    <option data-min="100" data-max="1000000" value="386" data-rate="2.6088">386
                                        - YouTube Subscribers | Non Drop | 100/Day | 30 Days Guaranteed ♻️ - $2.6088
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="20000" value="1267" data-rate="13.2">1267 -
                                        YouTube Subscribers | Max 20K | HQ Accounts | Non Drop | 30 Days ♻️ | Start: 0-1
                                        Hours | Day 2K - $13.2 (Min-Max: 100 - 20000)</option>
                                    <option data-min="100" data-max="20000" value="1268" data-rate="12.7">1268 -
                                        YouTube Subscribers | Max 20K | HQ Accounts | Non Drop | 30 Days ♻️ | Start: 0-1
                                        Hours | Day 1K - $12.7 (Min-Max: 100 - 20000)</option>
                                    <option data-min="50" data-max="100000" value="706" data-rate="7.128">706 -
                                        YouTube Subscribers | Max 50K | HQ Profiles | Refill &amp; Cancel Button Active |
                                        Refill 15 Day | 50 - 100/Day ♻️ - $7.128 (Min-Max: 50 - 100000)</option>
                                    <option data-min="5" data-max="50000" value="574" data-rate="8.5">574 -
                                        YouTube Subscribers Global | Non Drop | Guaranteed 365 Day | 800+/Day♻️ - $8.5
                                        (Min-Max: 5 - 50000)</option>
                                    <option data-min="100" data-max="1000000" value="707" data-rate="1.5178">707
                                        - YouTube Subscribers [ Max 1M ] | HQ Profiles | Refill &amp; Cancel Button Active |
                                        Lifetimee ♻️ | SuperInstant | Day 500 - $1.5178 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="50" data-max="50000" value="388" data-rate="3.3134">388 -
                                        YouTube Subscribers | Non Drop | 400/Day | 30 Days Guaranteed ♻️ - $3.3134 (Min-Max:
                                        50 - 50000)</option>
                                    <option data-min="200" data-max="100000" value="390" data-rate="3.9886">390 -
                                        YouTube Subscribers | Super HQ | Non Drop | 2K/Day | 30 Days Guaranteed ♻️ - $3.9886
                                        (Min-Max: 200 - 100000)</option>
                                    <option data-min="50" data-max="15000" value="385" data-rate="2.3716">385 -
                                        YouTube Subscribers | Non Drop | 100 - 200/Day | 30 Days Guaranteed ♻️ - $2.3716
                                        (Min-Max: 50 - 15000)</option>
                                    <option data-min="100" data-max="30000" value="387" data-rate="2.7273">387 -
                                        YouTube Subscribers | Non Drop | 500 - 1K/Day | 30 Days Guaranteed ♻️ - $2.7273
                                        (Min-Max: 100 - 30000)</option>
                                    <option data-min="100" data-max="100000" value="389" data-rate="4.1934">389 -
                                        YouTube Subscribers | Non Drop | 500 - 1K/Day | 30 Days Guaranteed ♻️ - $4.1934
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="384" data-rate="1.5798">384 -
                                        YouTube Subscribers | Low Drop | 50/Day | 30 Days Guaranteed ♻️ - $1.5798 (Min-Max:
                                        100 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="391" data-rate="7.8204">391 -
                                        YouTube Subscribers | Non Drop | 5K/Day ⚡ | 30 Days Guaranteed ♻️ - $7.8204
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="20000" value="1608" data-rate="21.6">1608 -
                                        Youtube Real Subscribers | Max 100k | Speed 5000/day | ♻️ 30 Days Refill - $21.6
                                        (Min-Max: 100 - 20000)</option>
                                    <option data-min="500" data-max="268999" value="1609" data-rate="20.25">1609 -
                                        Youtube Subscribes | Max 200k | Speed 1k-2k/day | ♻️ 30 Days Refill - $20.25
                                        (Min-Max: 500 - 268999)</option>
                                    <option data-min="50" data-max="20000" value="1230" data-rate="1.47">1230 -
                                        YouTube Subscribers Vietnam 🇻🇳 | Non Drop | 200/Day | Lifetime Guaranteed ♻️ -
                                        $1.47 (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="20000" value="1232" data-rate="1.575">1232 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 100 - 200/Day | Lifetime
                                        Guaranteed ♻️ - $1.575 (Min-Max: 50 - 20000)</option>
                                    <option data-min="50" data-max="50000" value="1231" data-rate="3.04">1231 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 200/Day | Lifetime Guaranteed ♻️ -
                                        $3.04 (Min-Max: 50 - 50000)</option>
                                    <option data-min="50" data-max="1000" value="1234" data-rate="3.675">1234 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 200/Day | Lifetime Guaranteed ♻️ -
                                        $3.675 (Min-Max: 50 - 1000)</option>
                                    <option data-min="100" data-max="50000" value="1233" data-rate="3.79">1233 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 100 - 200/Day | Lifetime
                                        Guaranteed ♻️ - $3.79 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="20000" value="1235" data-rate="1.89">1235 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 300 - 500/Day | Lifetime
                                        Guaranteed ♻️ - $1.89 (Min-Max: 100 - 20000)</option>
                                    <option data-min="100" data-max="150000" value="1236" data-rate="3.22">1236 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 𝗥𝗘𝗙𝗜𝗟𝗟 𝐁𝐮𝐭𝐭𝐨𝐧
                                        𝐄𝐧𝐚𝐛𝐥𝐞𝐝 🔥 | 1K - 3K/Day | Lifetime Guaranteed ♻️ - $3.22 (Min-Max: 100 -
                                        150000)</option>
                                    <option data-min="100" data-max="100000" value="1253" data-rate="1">1253 -
                                        YouTube Subscribers [ Vietnam 🇻🇳 ] | Non Drop | 50 - 100/Day | Lifetime Guaranteed
                                        ♻️ - $1 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="1263" data-rate="13.5">1263 -
                                        Youtube Subscribers | Refill 30 Days | 1000/Day ♻️ - $13.5 (Min-Max: 100 - 100000)
                                    </option>
                                    <option data-min="1000" data-max="1000000" value="1200" data-rate="0.4725">
                                        1200 - YouTube Views | INSTANT | Non Drop | Fast / Day 15K | Lifetime Guaranteed
                                        ⚡🔥♻️ - $0.4725 (Min-Max: 1000 - 1000000)</option>
                                    <option data-min="100" data-max="100000" value="1201" data-rate="1.1088">1201
                                        - YouTube Views | INSTANT | Non Drop | UltraFast / Day 10K | Lifetime Guaranteed
                                        ⚡🔥♻️ - $1.1088 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="10000000" value="638" data-rate="0.87">638 -
                                        Youtube Views | Instant | 10K Per Day | Non Drop | Lifetime Guaranteed ♻️ - $0.87
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="1000" data-max="10000000" value="1199" data-rate="0.48">1199
                                        - YouTube Views | INSTANT | Non Drop | Fast / Day 10K | Lifetime Guaranteed ⚡🔥♻️ -
                                        $0.48 (Min-Max: 1000 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1656" data-rate="0.7">1656 -
                                        Youtube Views | Instant | Non Drop | 300+ Daily | 365 Days Refill ♻️ - $0.7
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1354" data-rate="0.61">1354
                                        - YouTube Video Views | Max 10M | Inatant | Lifetime ♻️ | 500 - 1K Day - $0.61
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1202" data-rate="1.04">1202
                                        - Youtube Views | Instant | Non Drop | Refill 365 Day | 300 - 800/Day♻️ - $1.04
                                        (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000000" value="1203" data-rate="0.9644">
                                        1203 - Youtube Views | Instant | Non Drop | Lifetime Guaranteed | 15K Per Day⚡🔥♻️ -
                                        $0.9644 (Min-Max: 100 - 10000000)</option>
                                    <option data-min="100" data-max="10000" value="1204" data-rate="1.1275">1204 -
                                        Youtube Views | Instant | Non Drop | Lifetime Guaranteed | 10K Per Day ⚡♻️ - $1.1275
                                        (Min-Max: 100 - 10000)</option>
                                    <option data-min="1000" data-max="100000" value="1249" data-rate="0.7188">1249
                                        - YouTube Views [ Vietnam 🇻🇳 ] | Source: YouTube Search/Browse Features | 3 - 5
                                        Minutes Retention | Day 10K ⚡ - $0.7188 (Min-Max: 1000 - 100000)</option>
                                    <option data-min="1000" data-max="100000" value="1250" data-rate="0.9584">1250
                                        - YouTube Views [ Vietnam 🇻🇳 ] | Source: YouTube Suggested (Trending/Random) | 3 -
                                        5 Minutes Retention | Day 10K ⚡ - $0.9584 (Min-Max: 1000 - 100000)</option>
                                    <option data-min="1000" data-max="100000" value="1251" data-rate="1.1979">1251
                                        - YouTube Views [ Vietnam 🇻🇳 ] | Source: YouTube Search By Keywords | 3 - 5
                                        Minutes Retention | Day 10K ⚡ - $1.1979 (Min-Max: 1000 - 100000)</option>
                                    <option data-min="1000" data-max="100000" value="1252" data-rate="1.1979">1252
                                        - YouTube Views [ Vietnam 🇻🇳 ] | Source: YouTube Random (Suggest/Search/Browse
                                        Features) By Keywords | 3 - 5 Minutes Retention | Day 10K ⚡ - $1.1979 (Min-Max: 1000
                                        - 100000)</option>
                                    <option data-min="5000" data-max="20000000" value="640" data-rate="1.6335">
                                        640 - Youtube View Native Ads [Real Users] NON DROP | Min 5k | Speed 200k/Day -
                                        $1.6335 (Min-Max: 5000 - 20000000)</option>
                                    <option data-min="200000" data-max="10000000" value="641" data-rate="0.7965">
                                        641 - Youtube View Native Ads [Real Users] NON DROP | Min 200k | Speed 3M+/Day -
                                        $0.7965 (Min-Max: 200000 - 10000000)</option>
                                    <option data-min="500000" data-max="10000000" value="642" data-rate="0.7695">
                                        642 - Youtube View Native Ads [Real Users] NON DROP | Min 500k | Speed 3M+/Day -
                                        $0.7695 (Min-Max: 500000 - 10000000)</option>
                                    <option data-min="1000000" data-max="10000000" value="643"
                                        data-rate="0.7425">643 - Youtube View Native Ads [Real Users] NON DROP | Min 1M |
                                        Speed 3M+/Day - $0.7425 (Min-Max: 1000000 - 10000000)</option>
                                    <option data-min="3000" data-max="100000000" value="639"
                                        data-rate="1.167075">639 - Youtube View Native Ads [Real Users] NON DROP | Min 3k
                                        | Speed 100k/Day - $1.167075 (Min-Max: 3000 - 100000000)</option>
                                    <option data-min="100" data-max="4000" value="1258" data-rate="0.641">1258 -
                                        YouTube Watchtime [ 60 Min video ] [ 1000-4000/Day ] [ ND ] [ R30 ] [ Instant ] -
                                        $0.641 (Min-Max: 100 - 4000)</option>
                                    <option data-min="4000" data-max="4000" value="1259" data-rate="12.1052">1259
                                        - YouTube Watchtime [ 6 Min+ video ] [ 12000 Real view = 1000/Day ] [ Extra ] [ ND ]
                                        [ R30 ] [ Instant ] - $12.1052 (Min-Max: 4000 - 4000)</option>
                                    <option data-min="4000" data-max="4000" value="1211" data-rate="27.72">1211 -
                                        YouTube Watchtime [ Max 4K ] | Required +45 Minutes Video | 1000 = 1000 Hours | 500
                                        Hours/Day | 30 Days Guaranteed ♻️ - $27.72 (Min-Max: 4000 - 4000)</option>
                                    <option data-min="100" data-max="4000" value="1213" data-rate="25.3">1213 -
                                        YouTube Watchtime [ Max 4K ] | Required +25 Minutes Video | 1000 = 1000 Hours | 500
                                        Hours/Day | 30 Days Guaranteed ♻️ - $25.3 (Min-Max: 100 - 4000)</option>
                                    <option data-min="500" data-max="50000" value="644" data-rate="2.08">644 -
                                        4000H Watchtime | 7-30 min video request | Real Views | 12.000 Views = 1000 Hours -
                                        $2.08 (Min-Max: 500 - 50000)</option>
                                    <option data-min="500" data-max="4000" value="1212" data-rate="31.19">1212 -
                                        YouTube Watchtime [ Max 4K ] | Required +45 Minutes Video | 1000 = 1000 Hours | 1K
                                        Hours/Day | 30 Days Guaranteed ♻️ - $31.19 (Min-Max: 500 - 4000)</option>
                                    <option data-min="100" data-max="4000" value="1214" data-rate="28.89">1214 -
                                        YouTube Watchtime [ Max 4K ] | Required +25 Minutes Video | 1000 = 1000 Hours | 1K
                                        Hours/Day | 30 Days Guaranteed ♻️ - $28.89 (Min-Max: 100 - 4000)</option>
                                    <option data-min="10" data-max="50000" value="968" data-rate="1.056">968 -
                                        Twitter Likes | Max 50K | SuperInstant | Speed: 50K/Day | No Refill - $1.056
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="100" data-max="2000" value="1056" data-rate="0.9702">1056 -
                                        Twitter Likes | Mix Profiles | Day 10K ⚡ | No Warranty ⚠️ - $0.9702 (Min-Max: 100 -
                                        2000)</option>
                                    <option data-min="50" data-max="50000" value="560" data-rate="0.15">560 -
                                        Twitter Retweet | MQ Profiles | Instant | NO Refill | Max 50K | Day 50K - $0.15
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="936" data-rate="0.792">936 -
                                        Twitter Followers | Max 50K | INSTANT | Speed: 30K/Day&nbsp;|&nbsp;Refill: 30 Days
                                        ♻️ - $0.792 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="217545811" value="1064" data-rate="0.0072">
                                        1064 - Twitter Random Engagement [ Follow/Profile/Expand/Link ] | UltraFast / Day
                                        500K ⚡ | 365 Days Guaranteed ♻️ - $0.0072 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="100" data-max="100000000" value="952" data-rate="0.0164">
                                        952 - Twitter Tweet - Video Views [ Max Unlimited ] | 𝐏𝐫𝐞𝐦𝐢𝐮𝐦
                                        𝐒𝐞𝐫𝐯𝐢𝐜𝐞𝐬 | 𝐔𝐋𝐓𝐑𝐀 𝐅𝐀𝐒𝐓 - 𝐏𝐫𝐨𝐯𝐢𝐝𝐞𝐫 𝐒𝐞𝐫𝐯𝐢𝐜𝐞𝐬 - $0.0164
                                        (Min-Max: 100 - 100000000)</option>
                                    <option data-min="50" data-max="50000" value="960" data-rate="0.4975">960 -
                                        Twitter Likes | [ Max 50K ] | SuperFast | No Warranty ⚠️ | Day 50K - $0.4975
                                        (Min-Max: 50 - 50000)</option>
                                    <option data-min="10" data-max="5000" value="961" data-rate="0.5808">961 -
                                        Twitter Turkish Likes [Max: 5K] [Refill: No] [Start Time: İnstantStart] [Speed
                                        5K/Day] - $0.5808 (Min-Max: 10 - 5000)</option>
                                    <option data-min="100" data-max="217545811" value="1057" data-rate="0.0048">
                                        1057 - Twitter Impressions | UltraFast / Day 500K ⚡ | 365 Days Guaranteed ♻️ -
                                        $0.0048 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="50" data-max="100000" value="561" data-rate="0.2">561 -
                                        Twitter Retweet | MQ Profiles | Instant | NO Refill | Max 100K | Day 100K - $0.2
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="20000" value="953" data-rate="0.1056">953 -
                                        Twitter Likes/Favorites Max 20K | 0-30 Min - $0.1056 (Min-Max: 100 - 20000)</option>
                                    <option data-min="10" data-max="5000" value="962" data-rate="0.5808">962 -
                                        Twitter Real Like | Max: 10K | No Refill | SuperInstant | Speed: 10K/Day - $0.5808
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="50" data-max="50000" value="554" data-rate="0.4711">554 -
                                        Twitter Likes | SuperFast | No Refill | Max 50K | Day 50K - $0.4711 (Min-Max: 50 -
                                        50000)</option>
                                    <option data-min="100" data-max="217545811" value="1058" data-rate="0.0058">
                                        1058 - Twitter Impressions | UltraFast / Day 1M ⚡ | 365 Days Guaranteed ♻️ - $0.0058
                                        (Min-Max: 100 - 217545811)</option>
                                    <option data-min="10" data-max="40000" value="954" data-rate="0.301">954 -
                                        Twitter Likes | Max 40K | SuperInstant | Speed: 20K/Day | No Refill - $0.301
                                        (Min-Max: 10 - 40000)</option>
                                    <option data-min="100" data-max="20000" value="963" data-rate="0.5808">963 -
                                        Twitter Likes [Max: 20K] [Refill: No] [Start Time: İnstantStart] [Speed 10K/Day] -
                                        $0.5808 (Min-Max: 100 - 20000)</option>
                                    <option data-min="50" data-max="1000" value="555" data-rate="0.075">555 -
                                        Twitter Likes | MQ Profiles | Instant | NO Refill | Max 1K | Day 1K - $0.075
                                        (Min-Max: 50 - 1000)</option>
                                    <option data-min="100" data-max="217545811" value="1059" data-rate="0.0072">
                                        1059 - Twitter New Followers Engagement | UltraFast / Day 500K ⚡ | 365 Days
                                        Guaranteed ♻️ - $0.0072 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="20" data-max="50000" value="955" data-rate="0.3274">955 -
                                        Twitter Like - Fav Max 50K | Days 10K | 0-3 Mİn - $0.3274 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="964" data-rate="0.6864">964 -
                                        Twitter Likes| Max 500K | SuperInstant | Speed: 300K/Day | No Refill - $0.6864
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="50" data-max="100000" value="556" data-rate="0.09">556 -
                                        Twitter Likes | MQ Profiles | Instant | NO Refill | Max 50K | Day 50K - $0.09
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="217545811" value="1060" data-rate="0.0072">
                                        1060 - Twitter Hashtag Engagement | UltraFast / Day 500K ⚡ | 365 Days Guaranteed ♻️
                                        - $0.0072 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="10" data-max="40000" value="956" data-rate="0.396">956 -
                                        Twitter Real Likes | Max: 40K | No Refill | SuperInstant | Speed: 25K/Day - $0.396
                                        (Min-Max: 10 - 40000)</option>
                                    <option data-min="10" data-max="3000" value="965" data-rate="0.961">965 -
                                        Twitter Likes | Max 3K | SuperInstant | Speed: 3K/Day | No Refill - $0.961 (Min-Max:
                                        10 - 3000)</option>
                                    <option data-min="50" data-max="500000" value="557" data-rate="0.1">557 -
                                        Twitter Likes | MQ Profiles | Instant | NO Refill | Max 100K | Day 100K - $0.1
                                        (Min-Max: 50 - 500000)</option>
                                    <option data-min="100" data-max="217545811" value="1061" data-rate="0.0058">
                                        1061 - Twitter Tweet Profile Visits | UltraFast / Day 500K ⚡ | 365 Days Guaranteed
                                        ♻️ - $0.0058 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="10" data-max="1000000" value="957" data-rate="0.396">957 -
                                        Twitter Likes | 1M | No Refill | ULTRAFAST | 0-10 Min | 200K/Day 🕵⚡ - $0.396
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="5000" value="966" data-rate="0.9715">966 -
                                        Twitter Likes | Max 5K | SuperInstant | Speed: 5K/Day | No Refill - $0.9715
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="50" data-max="25000" value="558" data-rate="0.468">558 -
                                        Twitter Retweet | SuperFast | No Refill | Max 50K | Day 50K - $0.468 (Min-Max: 50 -
                                        25000)</option>
                                    <option data-min="100" data-max="217545811" value="1062" data-rate="0.0058">
                                        1062 - Twitter Expand Engagement | UltraFast / Day 500K ⚡ | 365 Days Guaranteed ♻️ -
                                        $0.0058 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="10" data-max="50000" value="958" data-rate="0.4013">958 -
                                        Twitter Like | 50K | INSTANT | 0-5 Min | 25K/Day ⚡ - $0.4013 (Min-Max: 10 - 50000)
                                    </option>
                                    <option data-min="10" data-max="20000" value="967" data-rate="1.0349">967 -
                                        Twitter Likes | Max 20K | SuperInstant | Speed: 20K/Day | No Refill - $1.0349
                                        (Min-Max: 10 - 20000)</option>
                                    <option data-min="50" data-max="1000" value="543" data-rate="0.0855">543 -
                                        Twitter Likes | Mix Profiles | Day 10K ⚡ | No Warranty ⚠️ - $0.0855 (Min-Max: 50 -
                                        1000)</option>
                                    <option data-min="50" data-max="1000" value="559" data-rate="0.11">559 -
                                        Twitter Retweet | MQ Profiles | Instant | NO Refill | Max 1K | Day 1K - $0.11
                                        (Min-Max: 50 - 1000)</option>
                                    <option data-min="100" data-max="217545811" value="1063" data-rate="0.0072">
                                        1063 - Twitter Link Engagement | UltraFast / Day 500K ⚡ | 365 Days Guaranteed ♻️ -
                                        $0.0072 (Min-Max: 100 - 217545811)</option>
                                    <option data-min="10" data-max="50000" value="959" data-rate="0.4752">959 -
                                        Twitter Likes [Max: 50K] [Refill: No] [Start Time: İnstantStart] [Speed 10K/Day] -
                                        $0.4752 (Min-Max: 10 - 50000)</option>
                                    <option data-min="100" data-max="2000000" value="931" data-rate="0.528">931 -
                                        Twitter Followers | Max 100K | INSTANT | Speed: 250K/Day | Refill: 30 Days ♻️ -
                                        $0.528 (Min-Max: 100 - 2000000)</option>
                                    <option data-min="100" data-max="100000000" value="1068" data-rate="0.004">
                                        1068 - Twitter Video Views | INSTANT | UltraFast / Day 1M ⚡ - $0.004 (Min-Max: 100 -
                                        100000000)</option>
                                    <option data-min="100" data-max="2147483647" value="1066" data-rate="0.0055">
                                        1066 - Twitter Tweet Views | Day 50K ⚡ - $0.0055 (Min-Max: 100 - 2147483647)
                                    </option>
                                    <option data-min="100" data-max="500000" value="947" data-rate="1.3728">947 -
                                        Twitter Followers | Max 600K | INSTANT | Speed: 400K/Day&nbsp;|&nbsp;Refill: 30 Days
                                        ♻️ - $1.3728 (Min-Max: 100 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="553" data-rate="0.8101">553
                                        - Twitter Followers | SuperFast | No Refill | Max 50K | Day 50K - $0.8101 (Min-Max:
                                        10 - 1000000)</option>
                                    <option data-min="250" data-max="100000000" value="949" data-rate="0.0091">
                                        949 - Twitter Tweet Views | Max 100M [ PROVIDER ] - $0.0091 (Min-Max: 250 -
                                        100000000)</option>
                                    <option data-min="11" data-max="10000000" value="545" data-rate="0.0001">545
                                        - Twitter Video Views | Max 10M | Day 5M - $0.0001 (Min-Max: 11 - 10000000)</option>
                                    <option data-min="10" data-max="1000" value="548" data-rate="4.464">548 -
                                        Twitter Followers | Real Account | 7 Days ♻️| Low Drop | Max 1K | Day 1K - $4.464
                                        (Min-Max: 10 - 1000)</option>
                                    <option data-min="100" data-max="2147483647" value="540" data-rate="0.008">
                                        540 - Twitter Video Views | Day 500K ⚡ - $0.008 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="1000000" value="943" data-rate="0.8976">943
                                        - Twitter Real Followers | Max:1M | 30 Days Refill ♻️| SuperInstant | Speed: 50K/Day
                                        🔥 ♻️ 𝗥𝗘𝗙𝗜𝗟𝗟 𝗕𝗨𝗧𝗧𝗢𝗡 𝗘𝗡𝗔𝗕𝗟𝗘 - $0.8976 (Min-Max: 100 - 1000000)
                                    </option>
                                    <option data-min="100" data-max="2500" value="1050" data-rate="0.6875">1050 -
                                        Twitter Followers | NFT Accounts | Day 2K ⚡ | 7 Days Guaranteed ♻️ - $0.6875
                                        (Min-Max: 100 - 2500)</option>
                                    <option data-min="25" data-max="100000000" value="951" data-rate="0.0073">
                                        951 - Twitter Tweet Views [ Max 100M ] | Start: 0-5 Minutes | Day 500K - $0.0073
                                        (Min-Max: 25 - 100000000)</option>
                                    <option data-min="100" data-max="2147483647" value="1065" data-rate="0.0033">
                                        1065 - Twitter Video Views | Day 500K ⚡ - $0.0033 (Min-Max: 100 - 2147483647)
                                    </option>
                                    <option data-min="100" data-max="5000" value="1051" data-rate="4.4194">1051 -
                                        Twitter Followers | NFT Accounts | Day 500 ⚡ | 15 Days Guaranteed ♻️ - $4.4194
                                        (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="100000" value="938" data-rate="0.8554">938 -
                                        Twitter Real Followers | Max:1M | 30 Days Refill ♻️ | SuperInstant | Speed: 50K/Day
                                        🔥 ♻️ - $0.8554 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="10000000" value="542" data-rate="0.003">542
                                        - Twitter Video Views | INSTANT | UltraFast / Day 1M ⚡ - $0.003 (Min-Max: 100 -
                                        10000000)</option>
                                    <option data-min="100" data-max="2147483647" value="544" data-rate="0.009">
                                        544 - Twitter Tweet Views | Max 10M | Day 5M - $0.009 (Min-Max: 100 - 2147483647)
                                    </option>
                                    <option data-min="100" data-max="500000" value="933" data-rate="0.6336">933 -
                                        Twitter Followers | Max 500K | INSTANT | Speed: 50K/Day&nbsp;|&nbsp;Refill: 30 Days
                                        - $0.6336 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="1000000000" value="1067" data-rate="0.0002">
                                        1067 - Twitter Video Views | INSTANT | UltraFast / Day 1M ⚡ - $0.0002 (Min-Max: 100
                                        - 1000000000)</option>
                                    <option data-min="10" data-max="50000" value="550" data-rate="4.968">550 -
                                        Twitter Followers | Real Account | 30 Days ♻️| Low Drop | Max 50K | Day 10K - $4.968
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="200000" value="945" data-rate="4.1184">945 -
                                        Twitter Followers | Max 200K | INSTANT | Speed: 60K/Day&nbsp;|&nbsp;Refill: 30 Days
                                        ♻️ - $4.1184 (Min-Max: 10 - 200000)</option>
                                    <option data-min="100" data-max="2147483647" value="950" data-rate="0.0062">
                                        950 - Twitter Tweet Views | Max: Unlimited - $0.0062 (Min-Max: 100 - 2147483647)
                                    </option>
                                    <option data-min="250" data-max="500000000" value="546" data-rate="0.0095">
                                        546 - Twitter Video Views | Max: 500M | Day 10M/20M - $0.0095 (Min-Max: 250 -
                                        500000000)</option>
                                    <option data-min="10" data-max="100000" value="1052" data-rate="5.1322">1052
                                        - Twitter Followers | NFT Female Accounts | Day 500 ⚡ | No Refill - $5.1322
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="100" data-max="2147483647" value="541" data-rate="0.0042">
                                        541 - Twitter Tweet Views | Day 50K ⚡ - $0.0042 (Min-Max: 100 - 2147483647)</option>
                                    <option data-min="100" data-max="50000" value="1054" data-rate="7.6314">1054 -
                                        Twitter Followers | NFT Accounts Real | Day 5K ⚡ | 30 Days Guaranteed ♻️ - $7.6314
                                        (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="100000" value="1189" data-rate="0">1189 -
                                        Twitter Followers | NFT Accounts | Day 10K ⚡ | 30 Days Guaranteed ♻️ - $0 (Min-Max:
                                        100 - 100000)</option>
                                    <option data-min="100" data-max="100000" value="1053" data-rate="5.93">1053 -
                                        Twitter Followers | NFT Accounts | Day 500 ⚡ | 30 Days Guaranteed ♻️ - $5.93
                                        (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="300000" value="940" data-rate="4.1184">940 -
                                        Twitter Followers | Max 100K | INSTANT | Speed: 80K/Day&nbsp;|&nbsp;Refill: 30 Days
                                        ♻️ - $4.1184 (Min-Max: 100 - 300000)</option>
                                    <option data-min="10" data-max="1000000" value="935" data-rate="0.8765">935
                                        - Twitter Followers [ Max 50K ] | Quality Accounts | 30 Days ♻️ | Day 50K - $0.8765
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="500000" value="930" data-rate="0.5069">930 -
                                        Twitter Followers | Max 500K | INSTANT | Speed: 250K/Day | Refill: 30 Days ♻️ -
                                        $0.5069 (Min-Max: 100 - 500000)</option>
                                    <option data-min="10" data-max="1000000" value="552" data-rate="0.83">552 -
                                        Twitter Followers | Quality Accounts | 30 Days ♻️ | Max 50K | Day 50K - $0.83
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="10" data-max="50000" value="547" data-rate="0.1">547 -
                                        Twitter Followers | Low Drop | No Refill | Max 50K | Day 50K - $0.1 (Min-Max: 10 -
                                        50000)</option>
                                    <option data-min="10" data-max="100000" value="1055" data-rate="8.4942">1055
                                        - Twitter Followers | Real Quality | Day 10K ⚡ | 30 Days Guaranteed ♻️ - $8.4942
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="942" data-rate="5.3011">942 -
                                        Twitter EN/US Real Followers | Max: 50K | Very Low Drop | 30 Days Refill | HQ
                                        Accounts - $5.3011 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="2000000" value="937" data-rate="0.8448">937
                                        - Twitter Followers | Max 2M | INSTANT | Speed: 250K/Day&nbsp;|&nbsp;Refill: 30 Days
                                        ♻️ - $0.8448 (Min-Max: 100 - 2000000)</option>
                                    <option data-min="10" data-max="200000" value="948" data-rate="4.1184">948 -
                                        Twitter Females Followers | Max 200K | SuperInstant | Speed: 70K/Day | R30 ♻️ -
                                        $4.1184 (Min-Max: 10 - 200000)</option>
                                    <option data-min="100" data-max="100000" value="932" data-rate="0.528">932 -
                                        Twitter Followers | Max 100K | INSTANT | Speed: 250K/Day | Refill: 30 Days ♻️ -
                                        $0.528 (Min-Max: 100 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="549" data-rate="4.1">549 -
                                        Twitter Followers | Real Account | 15 Days ♻️| Low Drop | Max 50K | Day 10K - $4.1
                                        (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="500000" value="944" data-rate="5.3856">944 -
                                        Twitter Followers [ Max 500K ] | Quality Accounts | 30 Days ♻️ | Day 10K
                                        𝗥𝗲𝗳𝗶𝗹𝗹 𝗕𝘂𝘁𝘁𝗼𝗻 𝗘𝗻𝗮𝗯𝗹𝗲𝗱 - $5.3856 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="1000000" value="939" data-rate="5.3856">939
                                        - Twitter Followers [ Max 1M ] | Quality Accounts | 30 Days ♻️ | Day 5K 𝗥𝗲𝗳𝗶𝗹𝗹
                                        𝗕𝘂𝘁𝘁𝗼𝗻 𝗘𝗻𝗮𝗯𝗹𝗲𝗱 - $5.3856 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="10" data-max="1000000" value="934" data-rate="0.6547">934
                                        - Twitter Followers [ Max 50K ] | Quality Accounts | 30 Days ♻️ | Day 100K - $0.6547
                                        (Min-Max: 10 - 1000000)</option>
                                    <option data-min="100" data-max="500000" value="929" data-rate="0.3859">929 -
                                        Twitter Followers | Max 500K | INSTANT | Speed: 250K/Day | Refill: 30 Days ♻️ -
                                        $0.3859 (Min-Max: 100 - 500000)</option>
                                    <option data-min="100" data-max="50000" value="551" data-rate="6.8244">551 -
                                        Twitter Followers | Real Account | 60 Days ♻️| Low Drop | Max 50K | Day 15K -
                                        $6.8244 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="946" data-rate="5.3856">946 -
                                        Twitter Followers [ Max 50K ] | Quality Accounts | 30 Days ♻️ | Day 30K 𝗥𝗲𝗳𝗶𝗹𝗹
                                        𝗕𝘂𝘁𝘁𝗼𝗻 𝗘𝗻𝗮𝗯𝗹𝗲𝗱 - $5.3856 (Min-Max: 100 - 50000)</option>
                                    <option data-min="100" data-max="50000" value="941" data-rate="5.3011">941 -
                                        Twitter East Asia (Japanese, Korea, Hong Kong) | Max: 50K | Very Low Drop | 30 Days
                                        Refill | HQ Accounts - $5.3011 (Min-Max: 100 - 50000)</option>
                                    <option data-min="10" data-max="1000000" value="496" data-rate="0.117">496 -
                                        Telegram Reaction | 😱 + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="500" data-max="40000" value="489" data-rate="0.074">489 -
                                        Telegram | Positive Reactions + Free Views [👍 ❤️ 🔥 🎉 👏] - $0.074 (Min-Max: 500 -
                                        40000)</option>
                                    <option data-min="10" data-max="200000" value="497" data-rate="0.067">497 -
                                        Telegram Reaction | 👍 + Views | Max 10K | 10K/D - $0.067 (Min-Max: 10 - 200000)
                                    </option>
                                    <option data-min="5" data-max="50000" value="490" data-rate="0.132">490 -
                                        Telegram Positive Reactions + Free Views [👍 ❤️ 🔥 🎉 👏] | S2 - $0.132 (Min-Max: 5
                                        - 50000)</option>
                                    <option data-min="10" data-max="200000" value="498" data-rate="0.117">498 -
                                        Telegram Reaction | ❤️ + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 200000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="491" data-rate="0.022">491 -
                                        Telegram | Negative Reactions + Views| 👎 😱 💩 😢 🤮 - $0.022 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="10" data-max="1000000" value="499" data-rate="0.117">499 -
                                        Telegram Reaction | 🔥 + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="300000" value="492" data-rate="0.044">492 -
                                        Telegram Reaction | 🤮 + Views | Max 10K | 10K/D - $0.044 (Min-Max: 10 - 300000)
                                    </option>
                                    <option data-min="10" data-max="200000" value="500" data-rate="0.117">500 -
                                        Telegram Reaction | 🤩 + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 200000)
                                    </option>
                                    <option data-min="10" data-max="300000" value="493" data-rate="0.044">493 -
                                        Telegram Reaction | 💩 + Views | Max 10K | 10K/D - $0.044 (Min-Max: 10 - 300000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="501" data-rate="0.117">501 -
                                        Telegram Reaction | 🎉 + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="300000" value="494" data-rate="0.044">494 -
                                        Telegram Reaction | 😢 + Views | Max 10K | 10K/D - $0.044 (Min-Max: 10 - 300000)
                                    </option>
                                    <option data-min="10" data-max="5000000" value="502" data-rate="0.117">502 -
                                        Telegram Reaction | 👎 + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 5000000)
                                    </option>
                                    <option data-min="10" data-max="1000000" value="495" data-rate="0.117">495 -
                                        Telegram Reaction | 😁 + Views | Max 10K | 10K/D - $0.117 (Min-Max: 10 - 1000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="1002" data-rate="0.04">1002
                                        - Telegram Post Views | Last 5 Post - $0.04 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1003" data-rate="0.07">1003
                                        - Telegram Post Views | Last 10 Post - $0.07 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="500000" value="1001" data-rate="0.01">1001 -
                                        Telegram Post Views | Last 1 Post - $0.01 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000000" value="1006" data-rate="0.61">1006
                                        - Telegram Post Views | Last 100 Post - $0.61 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1004" data-rate="0.12">1004
                                        - Telegram Post Views | Last 20 Post - $0.12 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="886" data-rate="0.1768">886
                                        - Telegram Post / Link View - LAST 30 POST [10M] - $0.1768 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="891" data-rate="1.1785">891
                                        - Telegram Post / Link View - LAST 200 POST [10M] - $1.1785 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="883" data-rate="0.0295">883
                                        - Telegram Post / Link View - LAST 5 POST [10M] - $0.0295 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="888" data-rate="0.2946">888
                                        - Telegram Post / Link View - LAST 50 POST [10M] - $0.2946 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="885" data-rate="0.1178">885
                                        - Telegram Post / Link View - LAST 20 POST [10M] - $0.1178 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="1005" data-rate="0.32">1005
                                        - Telegram Post Views | Last 50 Post - $0.32 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="1007" data-rate="0.8614">
                                        1007 - Telegram Post Views | Last 200 Post - $0.8614 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="1008" data-rate="1.9">1008 -
                                        Telegram Post Views | Last 500 Post - $1.9 (Min-Max: 10 - 10000000)</option>
                                    <option data-min="10" data-max="10000000" value="890" data-rate="0.5892">890
                                        - Telegram Post / Link View - LAST 100 POST [10M] - $0.5892 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="882" data-rate="0.0059">882
                                        - Telegram Post / Link View - LAST 1 POST [10M] - $0.0059 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="887" data-rate="0.2357">887
                                        - Telegram Post / Link View - LAST 40 POST [10M] - $0.2357 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="884" data-rate="0.0589">884
                                        - Telegram Post / Link View - LAST 10 POST [10M] - $0.0589 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="889" data-rate="0.4419">889
                                        - Telegram Post / Link View - LAST 75 POST [10M] - $0.4419 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="50000000" value="506" data-rate="0.025">506
                                        - Telegram Last Post Views | Auto Start |5 Post - $0.025 (Min-Max: 10 - 50000000)
                                    </option>
                                    <option data-min="50" data-max="20000" value="505" data-rate="0.001">505 -
                                        Telegram Last Post Views | 1 Post - $0.001 (Min-Max: 50 - 20000)</option>
                                    <option data-min="10" data-max="50000000" value="507" data-rate="0.049">507
                                        - Telegram Last Post Views | Auto Start | 10 Post - $0.049 (Min-Max: 10 - 50000000)
                                    </option>
                                    <option data-min="10" data-max="10000000" value="513" data-rate="10">513 -
                                        Telegram Last Post Views | Auto Start | 1000 Post - $10 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="50000000" value="508" data-rate="0.098">508
                                        - Telegram Last Post Views | Auto Start | 20 Post - $0.098 (Min-Max: 10 - 50000000)
                                    </option>
                                    <option data-min="100" data-max="500000" value="503" data-rate="0.01077">503
                                        - Telegram | Post Views | MQ 100K | 1 Post | Cheapest🔥🔥 - $0.01077 (Min-Max: 100 -
                                        500000)</option>
                                    <option data-min="10" data-max="10000000" value="512" data-rate="7.8">512 -
                                        Telegram Last Post Views | Auto Start | 750 Post - $7.8 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="50000000" value="509" data-rate="0.25">509 -
                                        Telegram Last Post Views | Auto Start | 50 Post - $0.25 (Min-Max: 10 - 50000000)
                                    </option>
                                    <option data-min="10" data-max="2147483647" value="510" data-rate="0.18">510
                                        - Telegram Last Post Views | Auto Start | 100 Post - $0.18 (Min-Max: 10 -
                                        2147483647)</option>
                                    <option data-min="10" data-max="500000" value="504" data-rate="0.01167">504
                                        - Telegram | Post Views | 𝗖𝗵𝗲𝗮𝗽 Views | Non Drop🔥🔥 - $0.01167 (Min-Max: 10 -
                                        500000)</option>
                                    <option data-min="10" data-max="10000000" value="511" data-rate="5.4">511 -
                                        Telegram Last Post Views | Auto Start | 500 Post - $5.4 (Min-Max: 10 - 10000000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="752" data-rate="0.1056">752 -
                                        Telegram Channel/Group Members [ Max 500K ] | 3 Days ♻️ | Day 100K - $0.1056
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="1" data-max="100000" value="1009" data-rate="0.03">1009 -
                                        Telegram Channel/Group Members [ Max 10K ] | Instant | Day 10K ⚡ | No Warranty ⚠️ -
                                        $0.03 (Min-Max: 1 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="754" data-rate="0.2784">754 -
                                        Telegram Channel/Group Members [ Max 500K ] | 30 Days ♻️ | Day 100K - $0.2784
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="1" data-max="100000" value="1010" data-rate="0.09">1010 -
                                        Telegram Channel/Group Members | Cancel Enabled | High Drop | NR ⚠️ | Day 5K - $0.09
                                        (Min-Max: 1 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1011" data-rate="0.1263">1011
                                        - Telegram Channel/Group Members | Cancel Enabled | High Drop | NR ⚠️ | Day 10K -
                                        $0.1263 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="753" data-rate="0.1728">753 -
                                        Telegram Channel/Group Members [ Max 100K ] | 7 Days ♻️ | Day 25K - $0.1728
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="20" data-max="100000" value="1012" data-rate="0.2683">1012
                                        - Telegram Channel/Group Members | Cancel Enabled | High Drop | NR ⚠️ | Day 20K -
                                        $0.2683 (Min-Max: 20 - 100000)</option>
                                    <option data-min="500" data-max="10000" value="805" data-rate="0.081">805 -
                                        Telegram Bot Members | Max 5K | Instant | 1K - 5K/Day - $0.081 (Min-Max: 500 -
                                        10000)</option>
                                    <option data-min="500" data-max="10000" value="806" data-rate="0.06">806 -
                                        Telegram Bot Members | Max 3K | Instant | 1K/Day - $0.06 (Min-Max: 500 - 10000)
                                    </option>
                                    <option data-min="100" data-max="250000" value="519" data-rate="1.305">519 -
                                        Telegram Member | +50k/Day | 𝗙𝗔𝗦𝗧 | 𝗖𝗵𝗲𝗮𝗽/ 𝗦𝘁𝗮𝗯𝗹𝗲🚀🚀 - $1.305
                                        (Min-Max: 100 - 250000)</option>
                                    <option data-min="10" data-max="500000" value="514" data-rate="0.165">514 -
                                        Telegram Members | Mix | [𝐂𝐡𝐞𝐚𝐩𝐞𝐬𝐭 𝐢𝐧 𝐭𝐡𝐞 𝐖𝐨𝐫𝐥𝐝] 💯 - $0.165
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="500" data-max="35000" value="521" data-rate="1.2825">521 -
                                        Telegram | Channel/Group Members | Max 25K | 100% Real - $1.2825 (Min-Max: 500 -
                                        35000)</option>
                                    <option data-min="10" data-max="100000" value="516" data-rate="0.663">516 -
                                        Telegram Members | Max:100K - $0.663 (Min-Max: 10 - 100000)</option>
                                    <option data-min="500" data-max="50000" value="523" data-rate="1.5">523 -
                                        Telegram Members | Max 50K | Online User From App - $1.5 (Min-Max: 500 - 50000)
                                    </option>
                                    <option data-min="100" data-max="250000" value="518" data-rate="1.23975">518
                                        - Telegram Members | Max: 50K | Speed: 10K/Day - $1.23975 (Min-Max: 100 - 250000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="520" data-rate="0.93">520 -
                                        Telegram Member | Max 100K | Instant 🚀🚀 - $0.93 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="515" data-rate="0.3">515 -
                                        Telegram Members | Max 100K | 5K/D - $0.3 (Min-Max: 10 - 100000)</option>
                                    <option data-min="500" data-max="35000" value="522" data-rate="1.35">522 -
                                        Telegram Members | Max 30K | Online User From App - $1.35 (Min-Max: 500 - 35000)
                                    </option>
                                    <option data-min="500" data-max="80000" value="517" data-rate="0.525">517 -
                                        Telegram Members l Max 200K | Fast🔥🚀 - $0.525 (Min-Max: 500 - 80000)</option>
                                    <option data-min="50" data-max="250000" value="724" data-rate="0.2313">724 -
                                        Telegram Bot Members | Max 250K | Instant | 10K/Day - $0.2313 (Min-Max: 50 - 250000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="725" data-rate="0.54">725 -
                                        Telegram Members | Max 100K| LQ | Cancel Button | 10K/Day♻️ - $0.54 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="100" data-max="100000" value="534" data-rate="1.185">534 -
                                        Telegram Members| 30 Days NonDrop| English Names - $1.185 (Min-Max: 100 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="527" data-rate="1.2">527 -
                                        Telegram Members | Max 60K | 30 Days Non-Drop |Cheapest - $1.2 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="500" data-max="30000" value="536" data-rate="1.32">536 -
                                        Telegram 0% Drop| Members [Best Quality] [+40/Day] [Instant] 😍 - $1.32 (Min-Max:
                                        500 - 30000)</option>
                                    <option data-min="500" data-max="200000" value="531" data-rate="1.425">531 -
                                        Telegram Members | 250K | 50K/Day| 90 Days Non Drop 🔥🔥 - $1.425 (Min-Max: 500 -
                                        200000)</option>
                                    <option data-min="10" data-max="500000" value="524" data-rate="0.27">524 -
                                        Telegram Members | Max 10K - $0.27 (Min-Max: 10 - 500000)</option>
                                    <option data-min="500" data-max="80000" value="538" data-rate="1.935">538 -
                                        Telegram Channel/Group Members| Max 250K |180 day Nondrops - $1.935 (Min-Max: 500 -
                                        80000)</option>
                                    <option data-min="500" data-max="400000" value="533" data-rate="0.855">533 -
                                        Telegram Members [100K] 60 day NonDrops 🚀 - $0.855 (Min-Max: 500 - 400000)</option>
                                    <option data-min="500" data-max="200000" value="528" data-rate="1.125">528 -
                                        Telegram Members | 30Days Non-Drop | 20K/Day | Super Fast 🚀 - $1.125 (Min-Max: 500
                                        - 200000)</option>
                                    <option data-min="10" data-max="500000" value="526" data-rate="0.435">526 -
                                        Telegram Member | Max 100K - $0.435 (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="150000" value="535" data-rate="1.15129">535
                                        - Telegram Members | English Names | Public &amp; Private | 0% Drop🔥 - $1.15129
                                        (Min-Max: 100 - 150000)</option>
                                    <option data-min="100" data-max="220000" value="530" data-rate="1.29">530 -
                                        Telegram Members | Max 150K| 30 Days Non Drop 🔥 - $1.29 (Min-Max: 100 - 220000)
                                    </option>
                                    <option data-min="500" data-max="150000" value="537" data-rate="1.95">537 -
                                        Telegram 0% Drop| Members | 3Months Non Drops | FAST | Instant - $1.95 (Min-Max: 500
                                        - 150000)</option>
                                    <option data-min="100" data-max="100000" value="532" data-rate="1.29">532 -
                                        Telegram Members [100k Capacity] 30 days NonDrop - $1.29 (Min-Max: 100 - 100000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="525" data-rate="0.27">525 -
                                        Telegram Members | Max 100K - $0.27 (Min-Max: 10 - 500000)</option>
                                    <option data-min="500" data-max="200000" value="539" data-rate="2.25">539 -
                                        Telegram Members| Max 150K| 360 Day NonDrop ⭐ - $2.25 (Min-Max: 500 - 200000)
                                    </option>
                                    <option data-min="100" data-max="150000" value="529" data-rate="1.275">529 -
                                        Telegram Members |Max 80K| 30Day Non-Drop - $1.275 (Min-Max: 100 - 150000)</option>
                                    <option data-min="10" data-max="500000" value="1013" data-rate="0.435">1013 -
                                        Telegram Channel/Group Members | Low Drop | 10K/Day ⚡ | 7 Days Guaranteed ♻️ -
                                        $0.435 (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="100000" value="1014" data-rate="0.165">1014 -
                                        Telegram Members | 3 Days Refill | Max 100K | 0-15 Minutes - $0.165 (Min-Max: 10 -
                                        100000)</option>
                                    <option data-min="10" data-max="100000" value="1015" data-rate="0.693">1015 -
                                        Telegram Channel/Group Members l Low Drop | 20K/Day ⚡ | 60 Days Guaranteed ♻️ -
                                        $0.693 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="40000" value="1016" data-rate="0.72">1016 -
                                        Telegram Channel/Group Members l Non Drop 🔥 | 5K/Day | 60 Days Guaranteed ♻️ -
                                        $0.72 (Min-Max: 10 - 40000)</option>
                                    <option data-min="100" data-max="100000" value="1017" data-rate="0.79">1017 -
                                        Telegram Channel/Group Members l Non Drop | 20K/Day ⚡ | 60 Days Guaranteed ♻️ -
                                        $0.79 (Min-Max: 100 - 100000)</option>
                                    <option data-min="10" data-max="500000" value="1018" data-rate="0.27">1018 -
                                        Telegram Members | Max 10K | Instant | Refill 3 Day | 10K/Day - $0.27 (Min-Max: 10 -
                                        500000)</option>
                                    <option data-min="10" data-max="300000" value="1019" data-rate="1.518">1019 -
                                        Telegram Channel/Group Members l 0% Drop | 20K/Day | Lifetime Guaranteed ♻️ - $1.518
                                        (Min-Max: 10 - 300000)</option>
                                    <option data-min="500" data-max="100000" value="1020" data-rate="1.54">1020 -
                                        Telegram Channel/Group Members | 100K/Day | 365 Days Guaranteed ♻️ - $1.54 (Min-Max:
                                        500 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="747" data-rate="0.69">747 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 100K | Day 30K | 𝟯𝟬 𝗗𝗮𝘆𝘀
                                        𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $0.69 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1021" data-rate="0.8928">1021
                                        - Telegram Channel/Group Members l Non Drop 🔥 | 30K/Day ⚡ | Lifetime Guaranteed ♻️
                                        - $0.8928 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="749" data-rate="0.88">749 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 100K | Day 50K | 𝟵𝟬 𝗗𝗮𝘆𝘀
                                        𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $0.88 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="30000" value="744" data-rate="0.16">744 -
                                        Telegram Channel/Group Members | Real | No Refill ⚠️ | Max 10K | Day 10K 💎 - $0.16
                                        (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="100000" value="751" data-rate="1.1">751 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 100K | Day 100K | 𝟯𝟲𝟱
                                        𝗗𝗮𝘆𝘀 𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $1.1 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="30000" value="746" data-rate="0.39">746 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 30K | Day 30K | 𝟳 𝗗𝗮𝘆𝘀
                                        𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $0.39 (Min-Max: 10 - 30000)</option>
                                    <option data-min="10" data-max="100000" value="748" data-rate="0.77">748 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 100K | Day 50K | 𝟲𝟬 𝗗𝗮𝘆𝘀
                                        𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $0.77 (Min-Max: 10 - 100000)</option>
                                    <option data-min="500" data-max="10000" value="1022" data-rate="1.93">1022 -
                                        Telegram Channel/Group Members | 50K/Day | 180 Days Guaranteed ♻️ - $1.93 (Min-Max:
                                        500 - 10000)</option>
                                    <option data-min="10" data-max="100000" value="750" data-rate="0.96">750 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 100K | Day 70K | 𝟭𝟴𝟬
                                        𝗗𝗮𝘆𝘀 𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $0.96 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="30000" value="745" data-rate="0.26">745 -
                                        Telegram Real Channel/Group Members | HQ | Fast | Max 30K | Day 30K | 𝟯 𝗗𝗮𝘆𝘀
                                        𝗡𝗼𝗻 𝗗𝗿𝗼𝗽 💎 - $0.26 (Min-Max: 10 - 30000)</option>
                                    <option data-min="5" data-max="100000" value="1248" data-rate="400">1248 -
                                        Google Reviews Map | Start 0 - 24 Hour | Refill 7 Day | 5 - 20/Day - $400 (Min-Max:
                                        5 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1240" data-rate="9.36">1240 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 60 Minutes - $9.36
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1241" data-rate="14.04">1241 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 90 Minutes -
                                        $14.04 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1242" data-rate="18.72">1242 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 2 hours - $18.72
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1243" data-rate="28.08">1243 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 3 hours - $28.08
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1244" data-rate="37.44">1244 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 4 hours - $37.44
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1245" data-rate="56.16">1245 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 6 hours - $56.16
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1238" data-rate="2.34">1238 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 15 Minutes - $2.34
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1246" data-rate="112.32">1246
                                        - Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 12 hours -
                                        $112.32 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1239" data-rate="4.68">1239 -
                                        Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 30 Minutes - $4.68
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="100000" value="1247" data-rate="224.64">1247
                                        - Shopee Live Stream Views [ Max 100K ] | Only Thailand Link 🇹🇭 | 24 hours -
                                        $224.64 (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="5000" value="651" data-rate="1.625">651 -
                                        Love Việt | Tốc Độ 200 - 1K/1 Ngày | Max 5K - $1.625 (Min-Max: 10 - 5000)</option>
                                    <option data-min="500" data-max="2000" value="656" data-rate="3.2864">656 -
                                        Shopee Followers | Min 500 | Max 10K | Không Bảo Hành | Dán Full Link Shop - $3.2864
                                        (Min-Max: 500 - 2000)</option>
                                    <option data-min="500" data-max="2000" value="657" data-rate="6.032">657 -
                                        Shopee Followers | Min 500 | Max 10K | Bảo Hành 30 Ngày | Dán Full Link Shop -
                                        $6.032 (Min-Max: 500 - 2000)</option>
                                    <option data-min="10" data-max="5000" value="652" data-rate="2.65625">652 -
                                        Follow Việt | Tốc Độ 200 - 1K/1 Ngày | Max 5K - $2.65625 (Min-Max: 10 - 5000)
                                    </option>
                                    <option data-min="10" data-max="1000" value="653" data-rate="2.10936">653 -
                                        Sv3 ( Cài = Link shop ) ( Sub shoppe - Min 10/đơn - Max 5k ) ( Kbh - lên thiếu 10%
                                        &gt; 30% ) - $2.10936 (Min-Max: 10 - 1000)</option>
                                    <option data-min="50" data-max="100000" value="654" data-rate="3.04">654 -
                                        Shopee Followers | Min 500 | Instant | No refill | 2K - 5K/Day - $3.04 (Min-Max: 50
                                        - 100000)</option>
                                    <option data-min="10" data-max="1000" value="655" data-rate="1.994304">655 -
                                        Shopee Followers | Min 10 | Max 5K | Lên Thiếu 10%-30% | Không Bảo Hành | Dán Full
                                        Link Shop - $1.994304 (Min-Max: 10 - 1000)</option>
                                    <option data-min="10" data-max="100000" value="568" data-rate="36.5568">568
                                        - Shopee Live Stream Views | 240 Minutes Viewers - $36.5568 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="569" data-rate="54.8352">569
                                        - Shopee Live Stream Views | 360 Minutes Viewers - $54.8352 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="562" data-rate="2.2848">562 -
                                        Shopee Live Stream Views | 15 Minutes Viewers - $2.2848 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="570" data-rate="109.6704">570
                                        - Shopee Live Stream Views | 720 Minutes Viewers - $109.6704 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="563" data-rate="4.5696">563 -
                                        Shopee Live Stream Views | 30 Minutes Viewers - $4.5696 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="571" data-rate="219.3408">571
                                        - Shopee Live Stream Views | 1440 Minutes Viewers - $219.3408 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="564" data-rate="9.1392">564 -
                                        Shopee Live Stream Views | 60 Minutes Viewers - $9.1392 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="565" data-rate="11.88">565 -
                                        Shopee livestream Views | Max 50K | 90 Munites - $11.88 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="566" data-rate="18.2784">566
                                        - Shopee Live Stream Views | 120 Minutes Viewers - $18.2784 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="567" data-rate="23.76">567 -
                                        Shopee livestream Views | Max 50K | 180 Munites - $23.76 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="10" data-max="10000" value="712" data-rate="0.6172">712 -
                                        Threads LİKES | Instant Start | 10K/Days | 5K | - $0.6172 (Min-Max: 10 - 10000)
                                    </option>
                                    <option data-min="1" data-max="1" value="903" data-rate="1">903 - test -
                                        $1 (Min-Max: 1 - 1)</option>
                                    <option data-min="20" data-max="10000" value="1023" data-rate="1.9278">1023 -
                                        Threads Followers | Slow / Day 500 - $1.9278 (Min-Max: 20 - 10000)</option>
                                    <option data-min="10" data-max="10000" value="1024" data-rate="6.5934">1024 -
                                        Threads Followers | Slow / Day 1K - $6.5934 (Min-Max: 10 - 10000)</option>
                                    <option data-min="50" data-max="100000" value="1521" data-rate="1">1521 -
                                        Threads Like Vietnam | Instant | No refill | 1K+/Day - $1 (Min-Max: 50 - 100000)
                                    </option>
                                    <option data-min="10" data-max="1000" value="1025" data-rate="2.0196">1025 -
                                        Threads Followers | Slow / Day 500 | 30 Days Guaranteed ♻️ - $2.0196 (Min-Max: 10 -
                                        1000)</option>
                                    <option data-min="10" data-max="10000" value="1027" data-rate="0.9396">1027 -
                                        Threads Likes | Cancel Enabled | Fast / Day 2K - $0.9396 (Min-Max: 10 - 10000)
                                    </option>
                                    <option data-min="50" data-max="100000" value="1028" data-rate="5.06">1028 -
                                        Threads Likes [ Worldwide 🌍 ] | Fast / Day 10K ⚡ | 30 Days Guaranteed ♻️ - $5.06
                                        (Min-Max: 50 - 100000)</option>
                                    <option data-min="100" data-max="20000" value="717" data-rate="1.584">717 -
                                        Threads Followers - Real App Data - 20K/D - No Reffil - Less Drop - $1.584 (Min-Max:
                                        100 - 20000)</option>
                                    <option data-min="10" data-max="1000000" value="713" data-rate="0.8342">713
                                        - Threads Likes [High Quatity - 0-1H - 5K/D - No Refill] - $0.8342 (Min-Max: 10 -
                                        1000000)</option>
                                    <option data-min="100" data-max="30000" value="1026" data-rate="1.98">1026 -
                                        Threads Followers | Cancel Enabled | Fast / Day 5K ⚡ - $1.98 (Min-Max: 100 - 30000)
                                    </option>
                                    <option data-min="10" data-max="100000" value="714" data-rate="0.8342">714 -
                                        Threads LİKES | Instant Start | 200K/Days | 1M | ♻️𝗥𝗘𝗙𝗜𝗟𝗟 Button Enabled♻️ -
                                        $0.8342 (Min-Max: 10 - 100000)</option>
                                    <option data-min="100" data-max="50000" value="716" data-rate="1.6896">716 -
                                        Threads Followers [ Max 5K ] Refill: 30 Days ♻️ - $1.6896 (Min-Max: 100 - 50000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="715" data-rate="1.584">715 -
                                        Threads Followers [High Quatity - 0-1H - 5K/D - No Refill] - $1.584 (Min-Max: 100 -
                                        1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1520" data-rate="1.32">1520 -
                                        Threads Follow Vietnam | Instant | No refill | 1K+/Day - $1.32 (Min-Max: 100 -
                                        1000000)</option>
                                    <option data-min="10" data-max="500" value="1288" data-rate="11.5">1288 -
                                        WhatsApp Poll Votes [ D ] ( 12 Hour Complete ) [ Real Pakistani Accounts] - $11.5
                                        (Min-Max: 10 - 500)</option>
                                    <option data-min="10" data-max="5000" value="1296" data-rate="5.04">1296 -
                                        🇵🇰 Whatsapp - Channel Member ~ Pakistan ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="50000" value="1304" data-rate="3.168">1304 -
                                        🇹🇷 Whatsapp - Channel Member ~ Turkey ~ Max 250 ~ 100-150/ days ~ INSTANT - $3.168
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="10000" value="1289" data-rate="6.6593">1289 -
                                        🌍 Whatsapp - Channel Member ~ Global ~ Max 10k ~ 500-2k/days ~ INSTANT - $6.6593
                                        (Min-Max: 10 - 10000)</option>
                                    <option data-min="10" data-max="5000" value="1297" data-rate="5.04">1297 -
                                        🇵🇭 Whatsapp - Channel Member ~ Philippines ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="100000" value="1290" data-rate="6.4734">1290
                                        - 🇮🇳 Whatsapp - Channel Member ~ India ~ Max 5k ~ 500/days ~ INSTANT - $6.4734
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="5000" value="1298" data-rate="5.04">1298 -
                                        🇻🇳 Whatsapp - Channel Member ~ Vietnam ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="5000" value="1291" data-rate="5.04">1291 -
                                        🇦🇪 Whatsapp - Channel Member ~ Arab ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="5000" value="1299" data-rate="5.04">1299 -
                                        🇹🇭 Whatsapp - Channel Member ~ Thailand ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="5000" value="1292" data-rate="5.04">1292 -
                                        🇹🇷 Whatsapp - Channel Member ~ Turkey ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="100000" value="1300" data-rate="6.4734">1300
                                        - 🇳🇬 Whatsapp - Channel Member ~ Nigeria ~ Max 5k ~ 500/days ~ INSTANT - $6.4734
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="500" value="1285" data-rate="11.5">1285 -
                                        WhatsApp Poll Votes [ A ] ( 12 Hour Complete ) [ Real Pakistani Accounts] - $11.5
                                        (Min-Max: 10 - 500)</option>
                                    <option data-min="10" data-max="5000" value="1293" data-rate="5.04">1293 -
                                        🇺🇸 Whatsapp - Channel Member ~ USA ~ Max 5k ~ 500/days ~ INSTANT - $5.04 (Min-Max:
                                        10 - 5000)</option>
                                    <option data-min="10" data-max="10000" value="1301" data-rate="1.4308">1301 -
                                        🌍 Whatsapp - Channel Member ~ Global ~ Max 1k ~ 500-1k/days ~ INSTANT - $1.4308
                                        (Min-Max: 10 - 10000)</option>
                                    <option data-min="10" data-max="500" value="1286" data-rate="11.5">1286 -
                                        WhatsApp Poll Votes [ B ] ( 12 Hour Complete ) [ Real Pakistani Accounts] - $11.5
                                        (Min-Max: 10 - 500)</option>
                                    <option data-min="10" data-max="5000" value="1294" data-rate="5.04">1294 -
                                        🇪🇺 Whatsapp - Channel Member ~ Europe ~ Max 5k ~ 500/days ~ INSTANT - $5.04
                                        (Min-Max: 10 - 5000)</option>
                                    <option data-min="10" data-max="50000" value="1302" data-rate="3.168">1302 -
                                        🇺🇸 Whatsapp - Channel Member ~ USA ~ Max 500 ~ 200-300/days ~ INSTANT - $3.168
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="500" value="1287" data-rate="11.5">1287 -
                                        WhatsApp Poll Votes [ C ] ( 12 Hour Complete ) [ Real Pakistani Accounts] - $11.5
                                        (Min-Max: 10 - 500)</option>
                                    <option data-min="10" data-max="100000" value="1295" data-rate="6.4734">1295
                                        - 🇧🇷 Whatsapp - Channel Member ~ Brazil ~ Max 5k ~ 500/days ~ INSTANT - $6.4734
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="50000" value="1303" data-rate="3.168">1303 -
                                        🇪🇺 Whatsapp - Channel Member ~ Europe ~ Max 500 ~ 200-300/days ~ INSTANT - $3.168
                                        (Min-Max: 10 - 50000)</option>
                                    <option data-min="100" data-max="9000" value="1551" data-rate="0.094537">1551
                                        - 1 - FB - $0.094537 (Min-Max: 100 - 9000)</option>
                                    <option data-min="20" data-max="50000" value="1831" data-rate="0.0968">1831 -
                                        Facebook Post/Comment Reaction | Hidden | LIKE 👍 - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="100" data-max="8000" value="1559" data-rate="0.1875">1559 -
                                        Theo dõi Facebook Độc quyền | Tài khoản Việt Nam | Không giới hạn số lượng | Bảo
                                        hành 7 ngày | Tốc độ 10K/ngày - $0.1875 (Min-Max: 100 - 8000)</option>
                                    <option data-min="20" data-max="50000" value="1832" data-rate="0.0968">1832 -
                                        Facebook Post/Comment Reaction | Hidden | LOVE ❤️ - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="100" data-max="10000" value="1604" data-rate="0.225">1604 -
                                        fb mem - $0.225 (Min-Max: 100 - 10000)</option>
                                    <option data-min="20" data-max="50000" value="1833" data-rate="0.0968">1833 -
                                        Facebook Post/Comment Reaction | Hidden | WOW 😲 - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="100" data-max="20000" value="1629" data-rate="0.135">1629 -
                                        FB - 1 - $0.135 (Min-Max: 100 - 20000)</option>
                                    <option data-min="20" data-max="50000" value="1834" data-rate="0.0968">1834 -
                                        Facebook Post/Comment Reaction | Hidden | HAHA 😀 - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="100" data-max="50000" value="1636" data-rate="0.1509">1636 -
                                        Tăng theo dõi giá rẻ siêu nhanh có thể bị lag trang cá nhân cài thêm 15 sub via là
                                        hết bảo hành 30 ngày - $0.1509 (Min-Max: 100 - 50000)</option>
                                    <option data-min="20" data-max="50000" value="1835" data-rate="0.0968">1835 -
                                        Facebook Post/Comment Reaction | Hidden | CARE 🤗 - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="1663" data-rate="0.1628">1663
                                        - Services Only API - $0.1628 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1738" data-rate="0.0763">1738
                                        - Only API V2 - $0.0763 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="20" data-max="50000" value="1836" data-rate="0.0968">1836 -
                                        Facebook Post/Comment Reaction | Hidden | SAD 😢 - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="20" data-max="50000" value="1837" data-rate="0.0968">1837 -
                                        Facebook Post/Comment Reaction | Hidden | ANGRY 😡 - $0.0968 (Min-Max: 20 - 50000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="1750" data-rate="0.1818">1750
                                        - Facebook Follow Profile/Page Hidden Data 500K/ Day Max 2M (Own Service) - $0.1818
                                        (Min-Max: 100 - 1000000)</option>
                                    <option data-min="100" data-max="20000" value="1838" data-rate="0.1628">1838 -
                                        Facebook Followers | Hidden | Instant | 20K/Day - $0.1628 (Min-Max: 100 - 20000)
                                    </option>
                                    <option data-min="100" data-max="10000" value="1751" data-rate="0.08">1751 -
                                        Facebook - React Post [Vietnamese] Data No Drop (Own Service) - $0.08 (Min-Max: 100
                                        - 10000)</option>
                                    <option data-min="5" data-max="10000" value="1752" data-rate="0.8545">1752 -
                                        Facebook - Comments [Vietnamese] Data - $0.8545 (Min-Max: 5 - 10000)</option>
                                    <option data-min="100" data-max="10000" value="1839" data-rate="0.1479">1839 -
                                        Facebook Followers | Hidden | Instant | 10K/Day - $0.1479 (Min-Max: 100 - 10000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="1753" data-rate="0.0909">1753
                                        - Facebook Follow Profile/Page Hidden Data Max 1M/ Day - $0.0909 (Min-Max: 100 -
                                        1000000)</option>
                                    <option data-min="100" data-max="1000000" value="1754" data-rate="0.1091">1754
                                        - Facebook Share Post Hidden Data 500K/ Day Max 2M (Own Service) - $0.1091 (Min-Max:
                                        100 - 1000000)</option>
                                    <option data-min="5" data-max="100000" value="1755" data-rate="0.0909">1755
                                        - Facebook Comment Hidden Data 500K/ Day Max 2M - $0.0909 (Min-Max: 5 - 100000)
                                    </option>
                                    <option data-min="100" data-max="1000000" value="1756" data-rate="0.0273">1756
                                        - Facebook - Video/Reels Plays - $0.0273 (Min-Max: 100 - 1000000)</option>
                                    <option data-min="10" data-max="500000" value="1790" data-rate="0.0771">1790
                                        - Facebook Post Reaction Vietnam | Like 👍| Instant | 5K - 10K/Day ⚡ - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="10000" value="1757" data-rate="0.0807">1757 -
                                        Facebook Like Vietnam Name Bot (Own Service)) - $0.0807 (Min-Max: 100 - 10000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="1791" data-rate="0.0771">1791
                                        - Facebook Post Reaction Vietnam | Love❤️ | Instant | 5K - 10K/Day ⚡ - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="10" data-max="10000" value="1758" data-rate="0.08">1758 -
                                        Tăng like ngoại giá siêu rẻ tài nguyên cookie scan đa quốc gia - $0.08 (Min-Max: 10
                                        - 10000)</option>
                                    <option data-min="10" data-max="500000" value="1792" data-rate="0.0771">1792
                                        - Facebook Post Reaction Vietnam | Haha 😂 | Instant | 5K - 10K/Day ⚡ - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="50" data-max="10000" value="1759" data-rate="0.5091">1759 -
                                        Facebook reaction Vietnam Data - $0.5091 (Min-Max: 50 - 10000)</option>
                                    <option data-min="10" data-max="500000" value="1793" data-rate="0.0771">1793
                                        - Facebook Post Reaction Vietnam | Wow 😯 | Instant | 5K - 10K/Day ⚡ - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="3000" value="1760" data-rate="0.0455">1760 -
                                        Facebook Follow Profile/Page Hidden Data 500K/ Day Max 10k / Day - $0.0455 (Min-Max:
                                        100 - 3000)</option>
                                    <option data-min="10" data-max="500000" value="1794" data-rate="0.0771">1794
                                        - Facebook Post Reaction Vietnam | Sad 😢 | Instant | 5K - 10K/Day ⚡ - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="50000" value="1761" data-rate="0.2727">1761 -
                                        Facebook Member Group (Own Service) - $0.2727 (Min-Max: 100 - 50000)</option>
                                    <option data-min="10" data-max="100000" value="1795" data-rate="0.0716">1795
                                        - Facebook Post Reaction Vietnam | Angry😡 | Instant | 5K - 10K/Day ⚡ - $0.0716
                                        (Min-Max: 10 - 100000)</option>
                                    <option data-min="10" data-max="10000" value="1762" data-rate="0.1818">1762 -
                                        Facebook - 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲 𝗣𝗿𝗼𝗳𝗶𝗹𝗲/𝗣𝗮𝗴𝗲 Followers ~ 𝗚𝗹𝗼𝗯𝗮𝗹 𝗡𝗮𝗺𝗲
                                        ~ Max 1M ~ 50k/day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 - $0.1818 (Min-Max: 10 - 10000)
                                    </option>
                                    <option data-min="10" data-max="500000" value="1796" data-rate="0.0771">1796
                                        - Facebook Post Reaction Vietnam | Care😊 | Instant | 5K - 10K/Day ⚡ - $0.0771
                                        (Min-Max: 10 - 500000)</option>
                                    <option data-min="100" data-max="5000" value="1813" data-rate="0.1421">1813 -
                                        Follow FB SALE - $0.1421 (Min-Max: 100 - 5000)</option>
                                    <option data-min="100" data-max="10000" value="1814" data-rate="0.1421">1814 -
                                        FOLLOW SALE - $0.1421 (Min-Max: 100 - 10000)</option>
                                    <option data-min="10" data-max="50000" value="1815" data-rate="0.2148">1815 -
                                        Like Page FB - $0.2148 (Min-Max: 10 - 50000)</option>
                                    <option data-min="10" data-max="100000" value="1841" data-rate="0.1721">1841
                                        - Facebook Group Member | Max 100K | 5K/Day - $0.1721 (Min-Max: 10 - 100000)
                                    </option>
                                    <option data-min="100" data-max="1000000000" value="1842" data-rate="0.2443">
                                        1842 - Facebook Group Member | VN | Max 2M | 10K/Dây - $0.2443 (Min-Max: 100 -
                                        1000000000)</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-10">
                                <input type="number" class="form-control form-control-solid ipt-combo-service-quantity"
                                    placeholder="Số lượng">
                            </div>
                            <div class="col-lg-1 col-2">
                                <button type="button" class="btn btn-primary w-100"
                                    onclick="_products.on.click.comboService.add(document.querySelector('.sl-service').value.trim(), document.querySelector('.ipt-combo-service-quantity').value.trim(), document.querySelector('.sl-service').options[document.querySelector('.sl-service').selectedIndex].getAttribute('data-rate'), document.querySelector('.sl-service').options[document.querySelector('.sl-service').selectedIndex].getAttribute('data-min'), document.querySelector('.sl-service').options[document.querySelector('.sl-service').selectedIndex].getAttribute('data-max'))">+</button>
                            </div>
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped align-middle table-row-dashed gs-5 fs-6 gy-2 border table-combo-service">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <td>Service ID</td>
                                                <td>Rate</td>
                                                <td>Quantity</td>
                                                <td>Cost price</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot style="display: none;">
                                            <tr>
                                                <td class="text-center text-gray-500 fw-bold fs-7 text-uppercase"
                                                    colspan="3">Total cost price</td>
                                                <td class="fw-bolder"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5 mt-5 div-process-type div-params" style="">
                    <div class="separator div-param div-require_text mt-5 border border-dashed" style=""></div>
                    <div class="col-lg-12 div-param div-require_text" style="">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox"
                                value="require_text"
                                onchange="document.querySelector('.require-text-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Requirement</label>
                        </div>
                        <div class="row ps-lg-10 g-5 require-text-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please input your requirement">
                            </div>
                            <div class="col-lg-12">
                                <div id="div-translated-description"></div>
                                @if (!empty($languages) && $languages->count())
                                    <div id="div-add-translated-btn">
                                        <a class="btn btn-secondary btn-sm" href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown">Add translated description</a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            @foreach ($languages as $lang)
                                                <a href="javascript:;" class="dropdown-item ai-icon"
                                                    onclick="_products.on.click.addTranslatedDescription('vn')">
                                                    <span class="rounded-1 {{ $lang->flag }} fs-4"></span>
                                                    <span class="ms-2">{{ $lang->name }}</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Min/max length input (0 for nolimit)</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-require-text-min-length"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="0"
                                        inputmode="text">
                                    <span class="input-group-text bg-secondary">-</span>
                                    <input type="text" class="form-control ipt-require-text-max-length"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="0"
                                        inputmode="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-prompt mt-5 border border-dashed" style="display: none;"></div>
                    <div class="col-lg-12 div-param div-prompt" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="prompt"
                                onchange="document.querySelector('.prompt-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Prompt (AI)</label>
                        </div>
                        <div class="row ps-lg-10 g-5 prompt-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please input prompt">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Min/max length input (0 for nolimit)</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-prompt-min-length"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="0"
                                        inputmode="text">
                                    <span class="input-group-text bg-secondary">-</span>
                                    <input type="text" class="form-control ipt-prompt-max-length"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="0"
                                        inputmode="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-images mt-5 border border-dashed" style="display: none;"></div>
                    <div class="col-lg-12 div-param div-images" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="images"
                                onchange="document.querySelector('.images-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Images (AI Image/Video)</label>
                        </div>
                        <div class="row ps-lg-10 g-5 images-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please upload images">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Min/max images upload</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-images-min-upload"
                                        data-inputmask="'mask': '9', 'repeat': 1, 'greedy' : false" value="1"
                                        inputmode="text">
                                    <span class="input-group-text bg-secondary">-</span>
                                    <input type="text" class="form-control ipt-images-max-upload"
                                        data-inputmask="'mask': '9', 'repeat': 1, 'greedy' : false" value="1"
                                        inputmode="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Min/max references upload</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-references-min-upload"
                                        data-inputmask="'mask': '9', 'repeat': 1, 'greedy' : false" value="1"
                                        inputmode="text">
                                    <span class="input-group-text bg-secondary">-</span>
                                    <input type="text" class="form-control ipt-references-max-upload"
                                        data-inputmask="'mask': '9', 'repeat': 1, 'greedy' : false" value="1"
                                        inputmode="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Structure upload</label>
                                <select
                                    class="form-select form-select-solid sl-images-structure sl-references-structure select2-hidden-accessible"
                                    data-control="select2" data-hide-search="true"
                                    data-select2-id="select2-data-29-q2do" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option value="0" data-select2-id="select2-data-31-893r">Array by AI Provider
                                    </option>
                                    <option value="1">references</option>
                                    <option value="111">references (vietauto)</option>
                                    <option value="2">subjects</option>
                                    <option value="222">subjects (vietauto)</option>
                                    <option value="3">scenes</option>
                                    <option value="4">styles</option>
                                    <option value="5">faces</option>
                                    <option value="888">images (vietauto)</option>
                                    <option value="999">Default (AI Provider)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-references mt-5 border border-dashed" style="display: none;">
                    </div>
                    <div class="col-lg-12 div-param div-references" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="references"
                                onchange="document.querySelector('.references-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">References (AI
                                Image/Video)</label>
                        </div>
                        <div class="row ps-lg-10 g-5 references-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please upload references">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label">Min/max references upload</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-references-min-upload"
                                        data-inputmask="'mask': '9', 'repeat': 1, 'greedy' : false" value="1"
                                        inputmode="text">
                                    <span class="input-group-text bg-secondary">-</span>
                                    <input type="text" class="form-control ipt-references-max-upload"
                                        data-inputmask="'mask': '9', 'repeat': 1, 'greedy' : false" value="1"
                                        inputmode="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Structure upload</label>
                                <select
                                    class="form-select form-select-solid sl-references-structure select2-hidden-accessible"
                                    data-control="select2" data-hide-search="true"
                                    data-select2-id="select2-data-32-l5ez" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option value="0" data-select2-id="select2-data-34-3bi2">Array by AI Provider
                                    </option>
                                    <option value="1">references</option>
                                    <option value="111">references (vietauto)</option>
                                    <option value="2">subjects</option>
                                    <option value="222">subjects (vietauto)</option>
                                    <option value="3">scenes</option>
                                    <option value="4">styles</option>
                                    <option value="5">faces</option>
                                    <option value="888">images (vietauto)</option>
                                    <option value="999">Default (AI Provider)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-dimension mt-5 border border-dashed" style="display: none;">
                    </div>
                    <div class="col-lg-12 div-param div-dimension" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="dimension"
                                onchange="document.querySelector('.dimension-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Dimension (AI
                                Image/Video)</label>
                        </div>
                        <div class="row ps-lg-10 g-5 dimension-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please choose dimension">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Choose dimension</label><a
                                    class="text-primary text-decoration-underline fs-8 ms-2" href="javascript:;"
                                    onclick="select_all('.sl-dimension')">Select all</a>
                                <select class="form-select form-select-solid sl-dimension select2-hidden-accessible"
                                    data-control="select2" data-close-on-select="false"
                                    data-placeholder="Select dimensions" data-allow-clear="false" multiple=""
                                    data-select2-id="select2-data-35-9wit" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option value="2:3">2:3</option>
                                    <option value="3:2">3:2</option>
                                    <option value="1:1">1:1</option>
                                    <option value="16:9">16:9</option>
                                    <option value="9:16">9:16</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-style mt-5 border border-dashed" style="display: none;"></div>
                    <div class="col-lg-12 div-param div-style" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="style"
                                onchange="document.querySelector('.style-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Style (AI Image)</label>
                        </div>
                        <div class="row ps-lg-10 g-5 style-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please choose style image">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Choose style</label><a
                                    class="text-primary text-decoration-underline fs-8 ms-2" href="javascript:;"
                                    onclick="select_all('.sl-style')">Select all</a>
                                <select class="form-select form-select-solid sl-style select2-hidden-accessible"
                                    data-control="select2" data-close-on-select="false"
                                    data-placeholder="Select style image" data-allow-clear="false" multiple=""
                                    data-select2-id="select2-data-37-1ri4" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option value="2d_to_3d">2d_to_3d</option>
                                    <option value="chibi">chibi</option>
                                    <option value="anime">anime</option>
                                    <option value="comic">comic</option>
                                    <option value="cartoon">cartoon</option>
                                    <option value="restoration">restoration</option>
                                    <option value="pencil_sketch">pencil_sketch</option>
                                    <option value="pop_art">pop_art</option>
                                    <option value="line_art">line_art</option>
                                    <option value="webtoon">webtoon</option>
                                    <option value="manga">manga</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-speaker mt-5 border border-dashed" style="display: none;"></div>
                    <div class="col-lg-12 div-param div-speaker" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="speaker"
                                onchange="document.querySelector('.speaker-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Speaker</label>
                        </div>
                        <div class="row ps-lg-10 g-5 speaker-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please choose speaker">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Choose speaker</label><a
                                    class="text-primary text-decoration-underline fs-8 ms-2" href="javascript:;"
                                    onclick="select_all('.sl-speaker')">Select all</a>
                                <select class="form-select form-select-solid sl-speaker select2-hidden-accessible"
                                    data-control="select2" data-close-on-select="false"
                                    data-placeholder="Select style image" data-allow-clear="false" multiple=""
                                    data-select2-id="select2-data-39-7suv" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1"></select><span
                                    class="select2 select2-container select2-container--bootstrap5" dir="ltr"
                                    data-select2-id="select2-data-40-a9ly" style="width: 100%;"><span
                                        class="selection"><span
                                            class="select2-selection select2-selection--multiple form-select form-select-solid sl-speaker"
                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                            tabindex="-1" aria-disabled="false">
                                            <ul class="select2-selection__rendered" id="select2-shjq-container"></ul>
                                            <span class="select2-search select2-search--inline">
                                                <textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none"
                                                    spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search"
                                                    aria-describedby="select2-shjq-container" placeholder="Select style image" style="width: 100%;"></textarea>
                                            </span>
                                        </span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-speaker_profile mt-5 border border-dashed"
                        style="display: none;"></div>
                    <div class="col-lg-12 div-param div-speaker_profile" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox"
                                value="speaker_profile"
                                onchange="document.querySelector('.speaker_profile-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Speaker profile</label>
                        </div>
                        <div class="row ps-lg-10 g-5 speaker_profile-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please input speaker description">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Min/max length input</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control ipt-speaker-profile-min-length"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="0"
                                        inputmode="text">
                                    <span class="input-group-text bg-secondary">-</span>
                                    <input type="text" class="form-control ipt-speaker-profile-max-length"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="0"
                                        inputmode="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-speed mt-5 border border-dashed" style="display: none;"></div>
                    <div class="col-lg-12 div-param div-speed" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox" value="speed"
                                onchange="document.querySelector('.speed-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Speed</label>
                        </div>
                        <div class="row ps-lg-10 g-5 speed-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please choose speed">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Choose speed</label><a
                                    class="text-primary text-decoration-underline fs-8 ms-2" href="javascript:;"
                                    onclick="select_all('.sl-speed')">Select all</a>
                                <select class="form-select form-select-solid sl-speed select2-hidden-accessible"
                                    data-control="select2" data-close-on-select="false"
                                    data-placeholder="Select style image" data-allow-clear="false" multiple=""
                                    data-select2-id="select2-data-41-i03u" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option value="0.25">0.25</option>
                                    <option value="0.5">0.5</option>
                                    <option value="0.75">0.75</option>
                                    <option value="1">1</option>
                                    <option value="1.05">1.05</option>
                                    <option value="1.1">1.1</option>
                                    <option value="1.15">1.15</option>
                                    <option value="1.2">1.2</option>
                                    <option value="1.3">1.3</option>
                                    <option value="1.4">1.4</option>
                                    <option value="1.5">1.5</option>
                                    <option value="1.6">1.6</option>
                                    <option value="1.7">1.7</option>
                                    <option value="1.8">1.8</option>
                                    <option value="1.9">1.9</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator div-param div-pause_duration mt-5 border border-dashed"
                        style="display: none;"></div>
                    <div class="col-lg-12 div-param div-pause_duration" style="display: none;">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input cb-param w-25px h-25px" type="checkbox"
                                value="pause_duration"
                                onchange="document.querySelector('.pause_duration-options').style.display=this.checked ? '' : 'none'">
                            <label class="form-check-label fs-5 fw-bold" data-lang="">Pause Duration</label>
                        </div>
                        <div class="row ps-lg-10 g-5 pause_duration-options mt-2" style="display: none;">
                            <div class="col-lg-12">
                                <div class="form-check form-check-custom form-check-solid form-check-success">
                                    <input class="form-check-input cb-required w-20px h-20px" type="checkbox">
                                    <label class="form-check-label" data-lang="">Required?</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Description</label>
                                <input type="text" class="form-control form-control-solid ipt-description"
                                    placeholder="Please choose pause duration">
                            </div>
                            <div class="col-lg-12">
                                <label class="form-label" data-lang="">Choose pause duration</label><a
                                    class="text-primary text-decoration-underline fs-8 ms-2" href="javascript:;"
                                    onclick="select_all('.sl-pause_duration')">Select all</a>
                                <select class="form-select form-select-solid sl-pause_duration select2-hidden-accessible"
                                    data-control="select2" data-close-on-select="false"
                                    data-placeholder="Select style image" data-allow-clear="false" multiple=""
                                    data-select2-id="select2-data-43-5h7g" tabindex="-1" aria-hidden="true"
                                    data-kt-initialized="1">
                                    <option value="0.5">0.5</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="ipt-param-platform" value="nmh">
                    <input type="hidden" class="ipt-param-using-for-creator" value="">
                    <script>
                        // click select all to choose all
                        function select_all(element) {
                            const select = document.querySelector(element);
                            const options = select.querySelectorAll('option');
                            options.forEach(option => {
                                option.selected = true;
                            });
                            $(select).trigger('change'); // Trigger change event to update the select2
                        }
                    </script>
                </div>
            </div>
        </div>

        {{-- Card 4: Mô tả & Chính sách bảo hành --}}
        <div class="row g-5 mb-10">
            <div class="col-lg-6">
                <div class="d-flex flex-wrap flex-stack mb-3">
                    <h3 class="fw-bold my-2">Chi tiết</h3>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div id="editor-product-description" style="height:300px"></div>
                        <input type="hidden" id="product-description-content"
                            value="{{ $product->description ?? '' }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex flex-wrap flex-stack mb-3">
                    <h3 class="fw-bold my-2">Chính sách bảo hành</h3>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div id="editor-product-warranty" style="height:300px"></div>
                        <input type="hidden" id="product-warranty-content"
                            value="{{ $product->warranty_policy ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="d-flex justify-content-end gap-3 mb-10">
            <a href="/admin/products" class="btn btn-light btn-sm">Hủy</a>
            <button type="button" class="btn btn-primary btn-sm" onclick="_products.on.click.save()">
                Lưu thay đổi
            </button>
        </div>
    </div>

    <script>
        var _productId = {{ $product->id ?? 'null' }};
        var _productTranslations = @json($product->translations ?? []);
        var _productApiServiceId = '{{ $product->api_service_id ?? '' }}';

        // Init Select2
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $ === 'undefined' || typeof $.fn.select2 === 'undefined') return;

            $('.sl-product-add-type').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.sl-status').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.sl-category').select2({
                placeholder: 'Chọn danh mục',
                allowClear: true,
                width: '100%'
            });
            $('.sl-group').select2({
                placeholder: 'Không có nhóm',
                allowClear: true,
                width: '100%'
            });
            $('.sl-provider').select2({
                placeholder: 'Chọn',
                allowClear: true,
                width: '100%'
            });
            $('.sl-type').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.sl-warehouse').select2({
                minimumResultsForSearch: Infinity,
                width: '100%'
            });
            $('.sl-service').select2({
                placeholder: 'Chọn dịch vụ',
                allowClear: true,
                width: '100%'
            });

            // Gắn lại onChange cho các select sau khi select2 init
            $('.sl-product-add-type').on('change', function() {
                _products.on.change.addType(this.value);
            });
            $('.sl-provider').on('change', function() {
                _products.on.change.provider(this.value);
            });
            $('.sl-group').on('change', function() {
                document.querySelector('.div-group').style.display = this.value > 0 ? '' : 'none';
            });
            $('.sl-type').on('change', function() {
                _products.on.change.processType(this.value);
            });

            // Auto-load provider services nếu product là Api và đã có provider
            @if(($product->type ?? '') === 'Api' && ($product->api_provider_id ?? ''))
            _products.on.change.provider('{{ $product->api_provider_id }}');
            @endif

            // Format price inputs (loại bỏ trailing zeros)
            ['.ipt-cost-price', '.ipt-product-price', '.ipt-product-price-1', '.ipt-product-price-2'].forEach(
                function(cls) {
                    var el = document.querySelector(cls);
                    if (el && el.value) {
                        el.value = _products.formatPrice(el.value);
                    }
                });

            // Render translated descriptions đã có
            if (_productTranslations && typeof _productTranslations === 'object') {
                Object.keys(_productTranslations).forEach(function(lang) {
                    _products.on.click.addTranslatedDescription(lang);
                    var input = document.querySelector('#div-translated-description [data-language="' +
                        lang + '"] .ipt-service-translated-name');
                    if (input) input.value = _productTranslations[lang] || '';
                });
            }
        });

        // Init Quill editors
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Quill === 'undefined') return;

            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'align': []
                }],
                ['link'],
                [{
                    'color': []
                }, {
                    'background': []
                }],
                [{
                    'size': ['small', false, 'large', 'huge']
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }]
            ];

            function initQuill(editorId, inputId) {
                var el = document.getElementById(editorId);
                if (!el) return;
                var q = new Quill('#' + editorId, {
                    theme: 'snow',
                    modules: {
                        toolbar: toolbarOptions
                    }
                });
                var input = document.getElementById(inputId);
                if (input && input.value) {
                    try {
                        q.setContents(JSON.parse(input.value));
                    } catch (e) {
                        q.root.innerHTML = input.value;
                    }
                }
                q.on('text-change', function() {
                    if (input) input.value = JSON.stringify(q.getContents());
                });
            }

            initQuill('editor-product-description', 'product-description-content');
            initQuill('editor-product-warranty', 'product-warranty-content');
        });

        var _products = {
            formatPrice: function(val) {
                var n = parseFloat(val);
                if (isNaN(n)) return '';
                // Tối đa 4 chữ số thập phân, bỏ trailing zeros
                return parseFloat(n.toFixed(4)).toString();
            },
            slug: function(str) {
                return str.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                    .replace(/đ/g, 'd').replace(/[^a-z0-9\s-]/g, '')
                    .trim().replace(/\s+/g, '-');
            },
            on: {
                change: {
                    addType: function(val) {
                        document.querySelectorAll('.div-add-type-api').forEach(function(el) {
                            el.style.display = val === 'Api' ? '' : 'none';
                        });
                        document.querySelectorAll('.div-add-type-manual').forEach(function(el) {
                            el.style.display = val === 'Manual' ? '' : 'none';
                        });
                    },
                    provider: function(val) {
                        var sl = document.querySelector('.sl-provider-pid');
                        var divProduct = document.querySelector('.div-provider-product');
                        if (typeof $ !== 'undefined' && $(sl).data('select2')) $(sl).select2('destroy');
                        sl.innerHTML = '<option></option>';
                        if (!val) {
                            divProduct.style.display = 'none';
                            return;
                        }
                        divProduct.style.display = '';
                        fetch('/admin/api/provider/' + val + '/services', {
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            })
                            .then(function(r) {
                                return r.json();
                            })
                            .then(function(res) {
                                var services = res.data || res || [];
                                services.forEach(function(s) {
                                    var opt = document.createElement('option');
                                    opt.value = s.service || s.id;
                                    opt.textContent = '[' + (s.service || s.id) + '] ' + (s.name || '');
                                    opt.setAttribute('data-min', s.min || 0);
                                    opt.setAttribute('data-max', s.max || 0);
                                    sl.appendChild(opt);
                                });
                                // Pre-select api_service_id khi load trang update
                                if (_productApiServiceId) {
                                    sl.value = _productApiServiceId;
                                }
                                if (typeof $ !== 'undefined') {
                                    $(sl).select2({
                                        placeholder: 'Chọn sản phẩm',
                                        allowClear: true,
                                        width: '100%'
                                    });
                                    if (_productApiServiceId) {
                                        $(sl).val(_productApiServiceId).trigger('change');
                                    }
                                }
                            });
                    },
                    providerProduct: function(val) {
                        if (!val) return;
                        var opt = document.querySelector('.sl-provider-pid option[value="' + val + '"]');
                        if (!opt) return;
                        var min = opt.getAttribute('data-min');
                        var max = opt.getAttribute('data-max');
                        if (min) document.querySelector('.ipt-product-min').value = min;
                        if (max) document.querySelector('.ipt-product-max').value = max;
                    },
                    processType: function(val) {
                        var aiTypes = ['Veo3', 'NEW_VEO3', 'VEO2_QUALITY', 'VEO2_FAST', 'HAILUO_V2_768P_6S',
                            'HAILUO_V2_1080P_6S', 'HAILUO_V2_768P_10S', 'KLING_1_6_5S', 'KLING_1_6_10S',
                            'KLING_2_1_5S', 'KLING_2_1_10S', 'AI_IMAGE_DEFAULT', 'AI_VIDEO_DEFAULT',
                            'AI_VOICE_DEFAULT', 'GG_IMAGE_3_5', 'GG_IMAGE_3_1', 'HAILUO_IMAGE_01',
                            'KLING_COLORS_2_1', 'KLING_COLORS_2_0', 'KLING_COLORS_1_5', 'AI_IMAGE_OLD',
                            'AI_VIDEO_OLD', 'AI_VIDEO_VIETAUTO', 'AI_IMAGE_VIETAUTO', 'ANS'
                        ];
                        var wh = document.querySelector('.div-warehouse');
                        var svc = document.querySelector('.div-service');
                        var params = document.querySelector('.div-params');
                        if (wh) wh.style.display = val === 'Auto' ? '' : 'none';
                        if (svc) svc.style.display = val === 'Service' ? '' : 'none';
                        if (params) {
                            if (aiTypes.includes(val)) {
                                params.classList.remove('d-none');
                            } else {
                                params.classList.add('d-none');
                            }
                        }
                    },
                    syncprice: function(checked) {}
                },
                keyup: {
                    costPrice: function(val) {
                        var cost = parseFloat(val) || 0;
                        [
                            ['ipt-product-price', 'ipt-product-price-percent'],
                            ['ipt-product-price-1', 'ipt-product-price-1-percent'],
                            ['ipt-product-price-2', 'ipt-product-price-2-percent']
                        ].forEach(function(pair) {
                            var pct = parseFloat(document.querySelector('.' + pair[1]).value) || 100;
                            document.querySelector('.' + pair[0]).value = _products.formatPrice(cost * pct /
                                100);
                        });
                    },
                    pricePercent: function(field, val) {}
                },
                click: {
                    addTranslatedDescription: function(lang) {
                        var container = document.getElementById('div-translated-description');
                        if (!container) return;
                        // Không thêm trùng
                        if (container.querySelector('[data-language="' + lang + '"]')) return;
                        var langMap = {
                            'vn': {
                                flag: 'fi-vn',
                                label: 'VN'
                            }
                        };
                        var m = langMap[lang] || {
                            flag: 'fi-' + lang,
                            label: lang.toUpperCase()
                        };
                        var div = document.createElement('div');
                        div.className = 'mb-3 div-translated-' + lang;
                        div.setAttribute('data-language', lang);
                        div.innerHTML =
                            '<div class="input-group input-group-solid">' +
                            '<span class="input-group-text bg-secondary">' +
                            '<span class="rounded-1 fi ' + m.flag + ' fs-5 me-2"></span>' +
                            '<span>' + m.label + '</span>' +
                            '</span>' +
                            '<input type="text" class="form-control ipt-service-translated-name" placeholder="Nhập mô tả (' +
                            m.label + ')" value="">' +
                            '<span class="input-group-text bg-secondary text-danger pointer" onclick="this.closest(\'[data-language]\').remove()" title="Xóa">' +
                            '<i class="fas fa-times"></i>' +
                            '</span>' +
                            '</div>';
                        container.appendChild(div);
                    },
                    editSlug: function() {
                        var el = document.querySelector('.ipt-slug');
                        var icon = document.querySelector('.ipt-slug ~ span i');
                        var btn = document.querySelector('.ipt-slug ~ span');
                        if (el.disabled) {
                            el.disabled = false;
                            el.classList.add('border-primary');
                            if (icon) {
                                icon.className = 'fas fa-check text-primary';
                            }
                            if (btn) btn.title = 'Xác nhận';
                            el.focus();
                        } else {
                            el.disabled = true;
                            el.classList.remove('border-primary');
                            if (icon) {
                                icon.className = 'fas fa-pencil';
                            }
                            if (btn) btn.title = 'Chỉnh sửa slug';
                        }
                    },
                    save: function() {
                        var type = document.querySelector('.sl-product-add-type').value;
                        var payload = {
                            type: type,
                            name: document.querySelector('.ipt-name').value.trim(),
                            slug: document.querySelector('.ipt-slug').value.trim(),
                            status: document.querySelector('.sl-status').value,
                            product_category_id: document.querySelector('.sl-category').value,
                            product_group_id: document.querySelector('.sl-group').value || 0,
                            group_tag: document.querySelector('.ipt-group-tag')?.value.trim() || '',
                            thumbnail: document.querySelector('.ipt-thumbnail').value.trim(),
                            price: document.querySelector('.ipt-product-price').value,
                            price_1: document.querySelector('.ipt-product-price-1').value,
                            price_2: document.querySelector('.ipt-product-price-2').value,
                            price_percent: document.querySelector('.ipt-product-price-percent').value,
                            price_1_percent: document.querySelector('.ipt-product-price-1-percent').value,
                            price_2_percent: document.querySelector('.ipt-product-price-2-percent').value,
                            min: document.querySelector('.ipt-product-min').value,
                            max: document.querySelector('.ipt-product-max').value,
                            description: document.getElementById('product-description-content')?.value || '',
                            warranty_policy: document.getElementById('product-warranty-content')?.value || '',
                        };
                        if (type === 'Manual') {
                            payload.cost_price = document.querySelector('.ipt-cost-price').value;
                            payload.process_type = document.querySelector('.sl-type')?.value || 'Manual';
                        } else {
                            payload.api_provider_id = document.querySelector('.sl-provider').value;
                            payload.api_service_id = document.querySelector('.sl-provider-pid').value;
                            payload.sync = document.querySelector('.cb-product-sync').checked ? 1 : 0;
                        }
                        if (!payload.name) {
                            alert('Vui lòng nhập tên sản phẩm');
                            return;
                        }
                        if (!payload.product_category_id) {
                            alert('Vui lòng chọn danh mục');
                            return;
                        }

                        if (typeof showFullScreenLoader === 'function') showFullScreenLoader('', 'body');

                        fetch('/admin/products/' + _productId, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(payload)
                            })
                            .then(function(r) {
                                return r.json();
                            })
                            .then(function(res) {
                                if (res.success) {
                                    window.location.href = '/admin/products';
                                } else {
                                    if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                                    alert(res.message || 'Có lỗi xảy ra');
                                }
                            })
                            .catch(function() {
                                if (typeof hideFullScreenLoader === 'function') hideFullScreenLoader();
                                alert('Có lỗi xảy ra, vui lòng thử lại');
                            });
                    }
                }
            }
        };
    </script>
@endsection
