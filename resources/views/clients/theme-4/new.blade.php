@extends('clients.theme-4.layouts.app')
@section('title', 'New Order')

@section('content')
    <!--begin::Content-->
    <div class="content flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'New order'])
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post" id="kt_post">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="sl-quick-search" class="form-label" data-lang="newOrder.quick_search">Quick search service</label>
                        {{-- Placeholder hiển thị khi JS chưa load, trông giống empty select --}}
                        <div id="qs-placeholder" class="form-select form-select-solid text-muted" style="pointer-events:none;color:#b5b5c3!important">&nbsp;</div>
                        <select id="sl-quick-search" class="form-select form-select-solid" style="display:none">
                            <option value=""></option>
                            @foreach ($data['services'] as $svc)
                                <option value="{{ $svc['id'] }}" data-rate="{{ $svc['rate_formatted'] }}"
                                    data-content="<div><span class=&quot;fw-bolder me-1&quot;>{{ $svc['id'] }}</span> - {{ e($svc['name']) }} - <span class=&quot;text-primary fw-bolder ms-1&quot;>{{ e($svc['rate_formatted']) }}</span></div>">
                                    {{ $svc['id'] }} - {{ $svc['name'] }} - {{ $svc['rate_formatted'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-5">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="sl-platform" class="form-label" data-lang="newOrder.social_media">Social media</label>
                                <select id="sl-platform" class="form-select form-select-solid">
                                    <option value="-1"
                                        data-content="&lt;i class=&quot;fa-solid fa-star&quot;&gt;&lt;/i&gt; Best for you"
                                        data-lang="newOrder.best_for_you" data-fav="1"
                                        style="display:none" disabled>Best for you</option>
                                    @foreach ($data['platforms'] as $p)
                                        @if ($p->image && (str_contains($p->image, '/') || str_contains($p->image, '.')))
                                            <option value="{{ $p->id }}"
                                                data-content="&lt;img src=&quot;{{ $p->image }}&quot; class=&quot;w-15px h-15px me-1&quot; /&gt; {{ $p->name }}"
                                                data-lang="">{{ $p->name }}</option>
                                        @elseif($p->image)
                                            <option value="{{ $p->id }}"
                                                data-content="&lt;i class=&quot;{{ $p->image }}&quot;&gt;&lt;/i&gt; {{ $p->name }}"
                                                data-lang="">{{ $p->name }}</option>
                                        @else
                                            <option value="{{ $p->id }}" data-content="{{ $p->name }}"
                                                data-lang="">{{ $p->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label for="sl-category" class="form-label" data-lang="newOrder.category">Category</label>
                                <select id="sl-category" class="form-select form-select-solid">
                                    <option value="-1"
                                        data-content="&lt;i class=&quot;fa-solid fa-star&quot;&gt;&lt;/i&gt; Favorite"
                                        data-lang="newOrder.favorite" data-fav="1">Favorite</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 display-as display-as-default">
                        <label for="sl-service" class="form-label" data-lang="newOrder.service">Service</label>
                        <select id="sl-service" class="form-select form-select-solid"
                            onchange="_new.on.change.service(this.value)">
                        </select>
                    </div>
                    <div class="display-as display-as-table" style="display: none;"></div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="card div-order">
                        <div class="card-body">
                            <fieldset class="border border-2 rounded p-2 mb-5">
                                <legend class="float-none w-auto fs-7 d-flex">
                                    <div class="form-check form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="radio" value="0" name="link_input_type"
                                            onchange="_new.on.change.link_input_type(this.value)" checked="">
                                        <label class="form-check-label" data-lang="newOrder.one">One</label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" value="1" name="link_input_type"
                                            onchange="_new.on.change.link_input_type(this.value)">
                                        <label class="form-check-label" data-lang="newOrder.multi">Multi</label>
                                    </div>
                                </legend>
                                <div class="mb-0">
                                    <label class="form-label" data-lang="newOrder.link">Link</label>
                                    <div class="input-group input-group-solid">

                                        <input type="text" id="ipt-link" class="form-control form-control-solid"
                                            oninput="_new.on.input.showButton(this.value)">
                                        <button id="btn-convert" class="btn btn-icon btn-light-primary d-none"
                                            type="button" onclick="_new.on.click.convertFbId()"><i
                                                class="ki-duotone ki-arrows-loop fs-2"><span class="path1"></span><span
                                                    class="path2"></span></i></button>
                                    </div>
                                    <small class="form-text text-muted fst-italic">
                                        <p class="mb-0 link-convert-notice d-none text-info"><i
                                                class="bi bi-info-circle me-1"></i><span data-lang="newOrder.if_service_requires_id">If service
                                                requires ID, click</span> <i class="ki-solid ki-arrows-loop"></i></p>
                                    </small>
                                </div>
                                <div class="mb-0" style="display: none;">
                                    <label class="form-label" data-lang="newOrder.link_per_line">Link (1 per line)</label>
                                    <div class="position-relative">
                                        <textarea id="txa-link" class="form-control form-control-solid" rows="8"></textarea>
                                        <div class="position-absolute text-muted fs-8 link-count-overlay"
                                            style="bottom: 8px; right: 12px; pointer-events: none; background: rgba(255,255,255,0.8); padding: 2px 6px; border-radius: 4px;">
                                            0</div>
                                    </div>
                                </div>
                            </fieldset>
                            <script>
                                function updateCharCount() {
                                    document.querySelector('.link-count-overlay').textContent = document.querySelector('#txa-link').value.trim()
                                        .split('\n').filter(line => line.trim() !== '').length;
                                }
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.querySelector('#txa-link').addEventListener('input', function() {
                                        updateCharCount();
                                    });
                                    updateCharCount();
                                });
                            </script>
                            <div class="mb-3">
                                <label class="form-label" data-lang="newOrder.quantity">Quantity</label>
                                <div class="input-group input-group-solid">

                                    <input type="text" id="ipt-quantity" class="form-control"
                                        onkeyup="_new.on.keyup.calculatePrice(0)"
                                        data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" inputmode="text">
                                    <span class="input-group-text"><span class="badge badge-primary fw-bold charge">$
                                            0</span></span>
                                </div>
                                <small class="form-text text-muted fst-italic">
                                    <p class="mb-0"><span data-lang="newOrder.min">Min</span>: <span class="min">500</span> -
                                        <span data-lang="newOrder.max">Max</span>: <span class="max">1000000000</span>
                                    </p><a href="#" class="text-warning fw-bold span-quantity-discount ms-2"
                                        data-bs-toggle="modal" data-bs-target="#modal-quantity-discount"
                                        style="display: none;" data-lang="newOrder.special_discount">Special Discount</a>
                                </small>
                            </div> <!-- begin::Type -->
                            <div class="mb-3 service-type custom-comments" style="display: none;">
                                <label class="form-label" data-lang="newOrder.comments_per_line">Comments (1 per line)</label>
                                <textarea id="txa-comment" class="form-control form-control-solid" rows="8"
                                    onkeyup="_new.on.keyup.calculatePrice(1, '#txa-comment')"></textarea>

                            </div>
                            <div class="mb-3 service-type special special-1" style="display: none;">
                                <label class="form-label" data-lang="newOrder.list">List</label>
                                <input type="text" id="ipt-suggest" class="form-control form-control-solid">

                            </div>
                            <div class="mb-35 service-type special-1" style="display: none;">
                                <label class="form-label" data-lang="newOrder.keyword_list">Keyword list</label>
                                <input type="text" id="ipt-search" class="form-control form-control-solid">

                            </div>
                            <div class="mb-3 service-type mentions mentions-with-hashtags mentions-custom-list"
                                style="display: none;">
                                <label class="form-label" data-lang="newOrder.usernames_per_line">Usernames (1 per line)</label>
                                <textarea id="txa-usernames" class="form-control form-control-solid" rows="8"></textarea>

                            </div>
                            <div class="mb-3 service-type mentions-with-hashtags" style="display: none;">
                                <label class="form-label" data-lang="newOrder.hashtags_per_line">Hashtags (1 per line)</label>
                                <textarea id="txa-hashtags" class="form-control form-control-solid" rows="8"></textarea>

                            </div>
                            <div class="mb-3 service-type seo" style="display: none;">
                                <label class="form-label" data-lang="newOrder.keywords_per_line">Keywords (1 per line)</label>
                                <textarea id="txa-keywords" class="form-control form-control-solid" rows="8"></textarea>

                            </div>
                            <div class="mb-3 service-type mentions-user-followers comment-likes" style="display: none;">
                                <label class="form-label" data-lang="newOrder.username">Username</label>
                                <input type="text" id="ipt-username" class="form-control form-control-solid">

                            </div>
                            <div class="mb-3 service-type mentions-hashtag" style="display: none;">
                                <label class="form-label" data-lang="newOrder.video_description">Video description</label>
                                <input type="text" id="ipt-hashtag" class="form-control form-control-solid">

                            </div>
                            <div class="mb-3 service-type mentions-media-likers" style="display: none;">
                                <label class="form-label" data-lang="newOrder.media_url">Media URL</label>
                                <input type="text" id="ipt-media" class="form-control form-control-solid">

                            </div>
                            <div class="mb-3 service-type invites-from-groups" style="display: none;">
                                <label class="form-label" data-lang="newOrder.groups_per_line">Groups (1 per line)</label>
                                <textarea id="txa-groups" class="form-control form-control-solid" rows="8"></textarea>

                            </div> <!-- end::Type -->
                            <div class="mb-3 schedule" style="">
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="cb-schedule" class="form-check-input"
                                        onchange="document.querySelector('.schedule-time').style.display = this.checked ? '' : 'none';">
                                    <label class="form-check-label"><span class="fw-bold" data-lang="newOrder.schedule">Schedule</span>.
                                        <span data-lang="newOrder.your_timezone">Your
                                            timezone</span>: <span class="fw-bolder">+07:00</span></label>
                                </div>

                            </div>
                            <div class="mb-3 schedule-time" style="display: none;">
                                <label class="form-label" data-lang="newOrder.choose_time">Choose time</label>
                                <input type="text" id="ipt-schedule-time" class="form-control form-control-solid"
                                    readonly="">

                            </div>
                            <div class="mb-3 loop" style="">
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="cb-loop" class="form-check-input"
                                        onchange="document.querySelector('.loop-quantity').style.display = this.checked ? '' : 'none';document.querySelector('.loop-spacing').style.display = this.checked ? '' : 'none';">
                                    <label class="form-check-label"><span class="fw-bold" data-lang="newOrder.loop">Loop</span>.
                                        <span data-lang="newOrder.loop_desc">Auto
                                            Re-order when this order has been <span class="fw-bolder">COMPLETED</span>.
                                            Carefully when to use this
                                            function. Always make sure balance is enough.</span></label>
                                </div>

                            </div>
                            <div class="row g-5">
                                <div class="col-sm-6">
                                    <div class="mb-3 loop-quantity" style="display: none;">
                                        <label for="sl-loop-quantity" class="form-label" data-lang="newOrder.loop_quantity">Loop
                                            quantity</label>
                                        <select id="sl-loop-quantity" class="form-select form-select-solid">
                                            <option value="1" data-lang="">1</option>
                                            <option value="2" data-lang="">2</option>
                                            <option value="3" data-lang="">3</option>
                                            <option value="4" data-lang="">4</option>
                                            <option value="5" data-lang="">5</option>
                                        </select>

                                    </div>
                                    {{-- sl-loop-quantity và sl-loop-spacing được init trong @push('scripts') --}}
                                    <div class="mb-3 loop-spacing" style="display: none;">
                                        <label for="sl-loop-spacing" class="form-label" data-lang="newOrder.loop_spacing">Loop
                                            spacing (minutes)</label>
                                        <select id="sl-loop-spacing" class="form-select form-select-solid">
                                            <option value="0" data-lang="">0</option>
                                            <option value="1" data-lang="">1</option>
                                            <option value="2" data-lang="">2</option>
                                            <option value="3" data-lang="">3</option>
                                            <option value="4" data-lang="">4</option>
                                            <option value="5" data-lang="">5</option>
                                            <option value="6" data-lang="">6</option>
                                            <option value="7" data-lang="">7</option>
                                            <option value="8" data-lang="">8</option>
                                            <option value="9" data-lang="">9</option>
                                            <option value="10" data-lang="">10</option>
                                            <option value="11" data-lang="">11</option>
                                            <option value="12" data-lang="">12</option>
                                            <option value="13" data-lang="">13</option>
                                            <option value="14" data-lang="">14</option>
                                            <option value="15" data-lang="">15</option>
                                            <option value="16" data-lang="">16</option>
                                            <option value="17" data-lang="">17</option>
                                            <option value="18" data-lang="">18</option>
                                            <option value="19" data-lang="">19</option>
                                            <option value="20" data-lang="">20</option>
                                            <option value="21" data-lang="">21</option>
                                            <option value="22" data-lang="">22</option>
                                            <option value="23" data-lang="">23</option>
                                        </select>

                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            $('#sl-loop-spacing').select2({
                                                escapeMarkup: function(markup) {
                                                    return markup;
                                                },

                                                templateResult: function(option) {
                                                    if (!option.element) return option.text;

                                                    const style = option.element.getAttribute('style');
                                                    if (style && style.includes('display: none')) {
                                                        return null;
                                                    }

                                                    const content = option.element.getAttribute('data-content');
                                                    return content ? content : option.text;
                                                },
                                                templateSelection: function(option) {
                                                    if (!option.element) return option.text;
                                                    const content = option.element.getAttribute('data-content');
                                                    return content ? content : option.text;
                                                },
                                                width: '100%'
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            <button type="button" id="btn-order" class="btn btn-primary w-100 mt-5 text-uppercase"
                                onclick="_new.on.click.order()" data-lang="newOrder.submit">Submit order</button>
                            <div class="alert alert-order alert-normal mt-5 mb-5" style="display: none;"></div>
                            <div class="alert alert-order alert-bulk p-0 pt-5 mb-5" style="display: none;">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-7 gy-1">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-order alert-confirm bg-light-danger text-center"
                                style="display: none;">
                                <div class="mb-3">
                                    <i class="bi bi-exclamation-circle fs-3tx text-danger"></i>
                                </div>
                                <div class="text-center">
                                    <h2 class="fw-bold mb-3" data-lang="newOrder.rate_alert">Rate alert</h2>
                                    <div class="separator separator-dashed border-danger opacity-25 mb-3"></div>
                                    <div class="mb-9 text-dark" data-lang="newOrder.rate_alert_desc">Service
                                        prices have increased. Please confirm the new price before ordering</div>
                                    <div class="d-flex flex-center flex-wrap">
                                        <a href="javascript:;" class="btn btn-danger m-2" data-lang="newOrder.confirm_rate"
                                            onclick="_new.on.click.confirmRate()">Ok, I
                                            got it</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card border">
                        <div class="card-body">
                            <div class="div-choose-service text-center mb-5">
                                <p class="fs-2 fw-bolder text-primary mb-0 ls-1" id="svc-display-id">—</p>
                                <p class="fs-4 fw-semibold mb-0" id="svc-display-name">—</p>
                            </div>
                            <div id="advanced-setting" class="mt-2 mb-3" style="display: none;"></div>
                            <div class="">
                                <label class="form-label" data-lang="newOrder.average_time">Average time</label>
                                <input type="text" id="ipt-average-time" class="form-control form-control-solid"
                                    disabled="">
                                <small class="form-text text-muted fst-italic"><span data-lang="newOrder.average_time_tooltip">The average time is
                                        based on 10 latest completed orders per 1000 quantity</span></small>
                            </div>
                            <div class="border border-3 border-dashed div-description mt-3 p-5" style="">
                                <ol>
                                    <li data-list="bullet"><span class="ql-ui"
                                            contenteditable="false"></span>Recommended quantity to order is 30 50 100 200
                                        300 500 1000</li>
                                    <li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Số lượng
                                        nên đặt hàng là 30 50 100 200 300 500 1000</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal-quantity-discount" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header py-4">
                            <h4 class="modal-title" data-lang="newOrder.special_discount">Special Discount</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table align-middle table-row-dashed fs-7 gy-2">
                                <thead>
                                    <tr class="text-start text-muted bg-light fw-bold fs-7 text-uppercase gs-0">
                                        <th data-lang="newOrder.quantity">Quantity</th>
                                        <th data-lang="common.description">Discount</th>
                                        <th data-lang="newOrder.special_discount_new_rate">New rate</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var LABEL_FEATURES = {
                        "Owner": "danger",
                        "Exclusive": "danger",
                        "Provider Direct": "danger",
                        "New": "success",
                        "Best seller": "danger",
                        "Promotion": "success",
                        "Recommend": "success",
                        "Instant": "success",
                        "Super Fast": "success",
                        "Real": "success",
                        "Lifetime": "success",
                        "7 days Refill": "success",
                        "15 days Refill": "success",
                        "30 days Refill": "success",
                        "60 days Refill": "success",
                        "90 days Refill": "success",
                        "365 days Refill": "success",
                        "No refill": "success",
                        "Auto Refill": "success",
                        "No refund": "success",
                        "Refill Button": "success",
                        "Cancel Button": "success"
                    },
                    SERVICES = (function(svcs, cats) {
                        var catMap = {};
                        cats.forEach(function(c) {
                            catMap[c.id] = c;
                        });
                        return svcs.map(function(s) {
                            var cat = catMap[s.category_id] || {};
                            return {
                                id: s.id,
                                catid: s.category_id,
                                cat: cat.name || '',
                                cat_display_as: 0,
                                name: s.name,
                                image: s.image || '',
                                rate: s.rate_raw,
                                rate_formatted: s.rate_formatted,
                                min: s.min,
                                max: s.max,
                                desc: s.description || '',
                                type: s.type_service || 'Default',
                                schedule: true,
                                avg: s.average_time || '',
                                loop: true,
                                confirm: false,
                                platformid: cat.platform_id || -1,
                                summary: '{}',
                                feature: [],
                                attrs: (function(a) {
                                    if (!a) return [];
                                    if (Array.isArray(a)) return a;
                                    try { return JSON.parse(a) || []; } catch(e) { return []; }
                                })(s.attributes),
                                advanced_settings: false,
                                advanced_settings_data: {
                                    min_balance: '0',
                                    max_order: '0'
                                },
                                quantity_discount: false,
                                quantity_discount_data: []
                            };
                        });
                    })(@json($data['services']), @json($data['categories']));
            </script>
        </div>
        <!--end::Post-->
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var _hasFavs = getFavIds().length > 0;

            // Chỉ hiện option "Best for you" khi có favorites
            if (_hasFavs) {
                $('#sl-platform option[data-fav="1"]').removeAttr('disabled').show();
            }

            var s2opts = {
                escapeMarkup: function(m) {
                    return m;
                },
                minimumResultsForSearch: -1,
                templateResult: function(o) {
                    if (!o.element) return o.text;
                    // Ẩn option fav nếu không có favorites
                    if (o.element.getAttribute('data-fav') && !_hasFavs) return null;
                    var c = o.element.getAttribute('data-content');
                    return c ? c : o.text;
                },
                templateSelection: function(o) {
                    if (!o.element) return o.text;
                    var c = o.element.getAttribute('data-content');
                    return c ? c : o.text;
                },
                width: '100%'
            };

            // s2opts riêng cho sl-platform: templateSelection hardcode "Best for you"
            var s2PlatformOpts = $.extend(true, {}, s2opts, {
                templateSelection: function(o) {
                    if (String(o.id) === '-1') {
                        return $(
                            '<span><i class="fa-solid fa-star text-warning me-1"></i> Best for you</span>'
                            );
                    }
                    if (!o.element) return o.text;
                    var c = o.element.getAttribute('data-content');
                    return c ? c : o.text;
                }
            });

            var allCategories = @json($data['categories']);

            function iconHtml(img) {
                if (!img) return '';
                return (img.indexOf('/') !== -1 || img.indexOf('.') !== -1) ?
                    '<img src="' + img + '" class="w-15px h-15px me-1" />' :
                    '<i class="' + img + '"></i> ';
            }

            // ====================== INIT ALL SELECT2 ======================
            $('#sl-platform').select2(s2PlatformOpts);

            // Init quick search select2, ẩn placeholder div sau khi init xong
            $('#sl-quick-search').css('display', '').select2({
                placeholder: '{{ $langData["addfunds.please_select"] ?? "Please choose" }}',
                allowClear: false,
                width: '100%',
                minimumResultsForSearch: Infinity,
                escapeMarkup: function(m) { return m; },
                templateResult: function(o) {
                    if (!o.element) return o.text;
                    var c = o.element.getAttribute('data-content');
                    return c ? $(c) : o.text;
                },
                templateSelection: function(o) {
                    // Luôn hiển thị placeholder, không giữ option đã chọn
                    return '{{ $langData["addfunds.please_select"] ?? "Please choose" }}';
                }
            });
            $('#qs-placeholder').remove();
            // ====================== BUILD FUNCTIONS ======================
            function buildCategories(platformId) {
                var cats = (platformId == -1 || platformId === 'all') ?
                    allCategories :
                    allCategories.filter(c => parseInt(c.platform_id) === parseInt(platformId));

                var $cat = $('#sl-category');
                if ($cat.hasClass('select2-hidden-accessible')) $cat.select2('destroy');
                $cat.empty();

                // Giữ lại option "Favorite" nếu đang có favs
                var favIds = getFavIds();
                if (favIds.length) {
                    $cat.append(
                        $('<option>').val(-1).text('Favorite')
                        .attr('data-content', '<i class="fa-solid fa-star text-warning me-1"></i> Favorite')
                        .prop('disabled', true)
                    );
                }

                cats.forEach(function(c) {
                    var content = iconHtml(c.image) + c.name;
                    $cat.append($('<option>').val(c.id).text(c.name).attr('data-content', content));
                });

                $cat.select2(s2opts);
                return cats.length > 0 ? cats[0].id : null;
            }

            function buildAttributeBadges(attrs) {
                if (!attrs || !attrs.length) return '';
                return '<div class="mt-1">' + attrs.map(function(a) {
                    var color = LABEL_FEATURES[a] || 'secondary';
                    var style = color === 'danger'
                        ? 'border:1px solid #f1416c;color:#f1416c;background:transparent;'
                        : 'border:1px solid #50cd89;color:#50cd89;background:transparent;';
                    return '<span style="' + style + 'font-size:10px;padding:1px 6px;border-radius:4px;margin-right:3px;display:inline-block;">' + a + '</span>';
                }).join('') + '</div>';
            }

            function buildServices(catId) {
                var svcs = (catId !== null && catId !== undefined) ?
                    SERVICES.filter(s => parseInt(s.catid) === parseInt(catId)) :
                    [];

                var $svc = $('#sl-service');
                if ($svc.hasClass('select2-hidden-accessible')) $svc.select2('destroy');
                $svc.empty();

                svcs.forEach(function(s) {
                    var icon = iconHtml(s.image);
                    var badges = buildAttributeBadges(s.attrs);
                    var content =
                        `<div>${icon}<span class="fw-bolder me-1">${s.id}</span> - ${s.name} - <span class="text-primary fw-bolder ms-1">${s.rate_formatted}</span>${badges}</div>`;

                    $svc.append($('<option>')
                        .val(s.id)
                        .text(s.name)
                        .attr('data-rate', s.rate)
                        .attr('data-min', s.min)
                        .attr('data-max', s.max)
                        .attr('data-content', content)
                    );
                });

                $svc.select2(s2opts);

                // Log service đang hiển thị sau khi build
                var firstVal = $svc.val();
                if (firstVal) {
                    logService(firstVal);
                } else {
                    // Không có service nào — reset panel bên phải
                    document.getElementById('svc-display-id').textContent = '—';
                    document.getElementById('svc-display-name').textContent = '—';
                    document.getElementById('ipt-average-time').value = '';
                    var descEl = document.querySelector('.div-description');
                    if (descEl) descEl.style.display = 'none';
                }
            }

            function logService(serviceId) {
                var svc = SERVICES.find(function(s) {
                    return parseInt(s.id) === parseInt(serviceId);
                });
                if (!svc) return;

                // === Cập nhật UI ===
                // ID
                document.getElementById('svc-display-id').textContent = svc.id;

                // Image/icon + name
                var iconHtml = '';
                if (svc.image) {
                    iconHtml = (svc.image.indexOf('/') !== -1 || svc.image.indexOf('.') !== -1) ?
                        '<img src="' + svc.image + '" class="w-20px h-20px me-1">' :
                        '<i class="' + svc.image + ' me-1"></i>';
                }
                document.getElementById('svc-display-name').innerHTML = iconHtml + svc.name;

                // Average time
                document.getElementById('ipt-average-time').value = svc.avg || 'No data';

                // Min / Max
                var minEl = document.querySelector('.min');
                var maxEl = document.querySelector('.max');
                if (minEl) minEl.textContent = svc.min;
                if (maxEl) maxEl.textContent = svc.max;

                // Description
                var descEl = document.querySelector('.div-description');
                if (descEl) {
                    if (svc.desc) {
                        descEl.style.display = '';
                        descEl.innerHTML = svc.desc;
                    } else {
                        descEl.style.display = 'none';
                    }
                }
            }

            // ====================== QUICK SEARCH - FIXED VERSION ======================
            $('#sl-quick-search').on('change', function() {
                const selected = $(this).val();
                if (!selected) return;

                const serviceId = parseInt(Array.isArray(selected) ? selected[0] : selected);
                const service = SERVICES.find(s => parseInt(s.id) === serviceId);

                if (!service) {
                    console.warn(`Service ID ${serviceId} không tồn tại`);
                    return;
                }

                console.clear();
                console.log('%c=== QUICK SEARCH SELECTED ===', 'color:#0d6efd; font-weight:bold');
                console.log('Service ID    :', service.id);
                console.log('Name          :', service.name);
                console.log('Platform ID   :', service.platformid);
                console.log('Category ID   :', service.catid);

                // Bước 1: Set Platform trước
                const platformId = parseInt(service.platformid) || -1;
                $('#sl-platform').val(platformId).trigger('change.select2');

                // Bước 2: Build Categories theo Platform mới
                setTimeout(() => {
                    buildCategories(platformId);

                    // Bước 3: Set Category nếu có
                    const catId = parseInt(service.catid);
                    if (catId && $(`#sl-category option[value="${catId}"]`).length > 0) {
                        $('#sl-category').val(catId).trigger('change.select2');
                    }

                    // Bước 4: Build Services và set Service
                    setTimeout(() => {
                        buildServices(catId);

                        $('#sl-service').val(serviceId).trigger('change.select2');

                        // Gọi hàm chính thức của bạn
                        try {
                            _new.on.change.service(serviceId);
                        } catch (e) {
                            console.warn(' _new.on.change.service error', e);
                        }
                    }, 80);
                }, 80);
            });

            // ====================== NORMAL EVENTS ======================
            $('#sl-category').on('change', function() {
                buildServices($(this).val());
            });

            $('#sl-service').on('change', function() {
                const val = $(this).val();
                if (!val) return;
                logService(val);
                try {
                    _new.on.change.service(val);
                } catch (e) {}
            });

            // ====================== FAVORITES FROM localStorage ======================
            function getFavIds() {
                try {
                    return Object.keys(JSON.parse(localStorage.getItem('svc_favorites')) || {}).map(Number);
                } catch (e) {
                    return [];
                }
            }

            function buildFavServices() {
                var favIds = getFavIds();
                var favSvcs = SERVICES.filter(function(s) {
                    return favIds.indexOf(parseInt(s.id)) !== -1;
                });

                // Category: chỉ "Favorite"
                var $cat = $('#sl-category');
                if ($cat.hasClass('select2-hidden-accessible')) $cat.select2('destroy');
                $cat.empty().append(
                    $('<option>').val(-1).text('Favorite')
                    .attr('data-content', '<i class="fa-solid fa-star text-warning me-1"></i> Favorite')
                    .attr('data-fav', '1')
                );
                $cat.select2(s2opts);

                // Services từ favorites — thêm icon ⭐ vào đầu mỗi service
                var $svc = $('#sl-service');
                // Tạm remove onchange để tránh CDN lỗi khi trigger
                var _onchange = $svc.attr('onchange');
                $svc.removeAttr('onchange');
                if ($svc.hasClass('select2-hidden-accessible')) $svc.select2('destroy');
                $svc.empty();
                favSvcs.forEach(function(s) {
                    var badges = buildAttributeBadges(s.attrs);
                    var content = '<div><i class="fa-solid fa-star text-warning me-1"></i>' +
                        '<span class="fw-bolder me-1">' + s.id + '</span> - ' +
                        s.name + ' - <span class="text-primary fw-bolder ms-1">' + s.rate_formatted +
                        '</span>' + badges + '</div>';
                    $svc.append($('<option>').val(s.id).text(s.name)
                        .attr('data-rate', s.rate).attr('data-min', s.min)
                        .attr('data-max', s.max).attr('data-content', content));
                });
                $svc.select2(s2opts);
                if (favSvcs.length > 0) {
                    var firstId = favSvcs[0].id;
                    $svc.val(firstId).trigger('change.select2');
                    // Restore onchange rồi mới gọi CDN
                    if (_onchange) $svc.attr('onchange', _onchange);
                    logService(firstId);
                    setTimeout(function() {
                        try {
                            _new.on.change.service(firstId);
                        } catch (e) {}
                    }, 50);
                } else {
                    if (_onchange) $svc.attr('onchange', _onchange);
                }
            }
            // Bind trước để INITIAL LOAD có thể trigger
            $('#sl-platform').on('change', function() {
                var val = $(this).val();
                if (val == -1) {
                    buildFavServices();
                } else {
                    var firstCat = buildCategories(val);
                    buildServices(firstCat);
                }
            });

            // ====================== INITIAL LOAD ======================
            (function() {
                var favIds = getFavIds();

                @if (!empty($data['selectedService']))
                // Có ?service= trong URL — load đúng platform > category > service
                var _sel = @json($data['selectedService']);
                if (_sel && _sel.id) {
                    setTimeout(function() {
                        // Tìm category của service này
                        var cat = allCategories.find(function(c) { return c.id == _sel.category_id; });
                        var platformId = cat ? (cat.platform_id || -1) : -1;

                        // Set platform
                        $('#sl-platform').val(platformId).trigger('change.select2');

                        setTimeout(function() {
                            // Build categories theo platform
                            buildCategories(platformId);

                            // Set category
                            if ($('#sl-category option[value="' + _sel.category_id + '"]').length) {
                                $('#sl-category').val(_sel.category_id).trigger('change.select2');
                            }

                            setTimeout(function() {
                                // Build services theo category
                                buildServices(_sel.category_id);

                                // Set service
                                $('#sl-service').val(_sel.id).trigger('change.select2');
                                logService(_sel.id);
                                try { _new.on.change.service(_sel.id); } catch(e) {}
                            }, 80);
                        }, 80);
                    }, 100);
                    return;
                }
                @endif

                if (favIds.length) {
                    // Có favorites: đặt "Best for you" lên đầu, chọn nó
                    var $bestOpt = $('#sl-platform option[value="-1"]');
                    $('#sl-platform').prepend($bestOpt);
                    if ($('#sl-platform').hasClass('select2-hidden-accessible')) $('#sl-platform').select2('destroy');
                    $('#sl-platform').select2(s2PlatformOpts);
                    $('#sl-platform').val('-1').trigger('change.select2');
                    buildFavServices();
                } else {
                    // Không có favorites: load bình thường
                    var initialPlatform = $('#sl-platform').val() || -1;
                    var firstCat = buildCategories(initialPlatform);
                    buildServices(firstCat);
                }
            })();
        });
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window._new = {
                _pendingRate: null,

                on: {
                    input: {
                        showButton: function(val) {
                            var btn = document.getElementById('btn-convert');
                            if (btn) btn.classList.toggle('d-none', !val);
                        }
                    },
                    keyup: {
                        calculatePrice: function(type, selector) {
                            var svcId = $('#sl-service').val();
                            var svc = SERVICES.find(s => parseInt(s.id) === parseInt(svcId));
                            if (!svc) return;

                            var qty = 0;
                            if (type === 0) {
                                qty = parseInt(document.getElementById('ipt-quantity')?.value) || 0;
                            } else if (type === 1 && selector) {
                                var lines = ($(selector).val() || '').split('\n').filter(l => l.trim());
                                qty = lines.length;
                            }

                            var symbolMatch = svc.rate_formatted.match(/[^\d\s.,\-]+/);
                            var symbol = symbolMatch ? symbolMatch[0] : '$';
                            var position = svc.rate_formatted.indexOf(symbol) === 0 ? 'before' : 'after';
                            var rateNumStr = svc.rate_formatted.replace(/[^\d.]/g, '');
                            var rateNum = parseFloat(rateNumStr) || 0;
                            var decimalMatch = rateNumStr.match(/\.(\d+)$/);
                            var decimals = decimalMatch ? decimalMatch[1].length : 2;
                            var totalCharge = qty > 0 ? (qty / 1000) * rateNum : 0;
                            var formatted = totalCharge.toFixed(decimals);
                            var display = position === 'before' ? symbol + formatted : formatted + symbol;

                            document.querySelectorAll('.charge').forEach(function(el) {
                                el.textContent = display;
                            });
                        }
                    },
                    change: {
                        service: function(val) {
                            var svc = SERVICES.find(s => parseInt(s.id) === parseInt(val));
                            if (!svc) return;

                            // Update display
                            document.getElementById('svc-display-id').textContent = svc.id;
                            var icon = svc.image
                                ? ((svc.image.indexOf('/') !== -1 || svc.image.indexOf('.') !== -1)
                                    ? '<img src="' + svc.image + '" class="w-20px h-20px me-1">'
                                    : '<i class="' + svc.image + ' me-1"></i>')
                                : '';
                            document.getElementById('svc-display-name').innerHTML = icon + svc.name;
                            document.getElementById('ipt-average-time').value = svc.avg || 'No data';

                            var minEl = document.querySelector('.min');
                            var maxEl = document.querySelector('.max');
                            if (minEl) minEl.textContent = svc.min.toLocaleString();
                            if (maxEl) maxEl.textContent = svc.max.toLocaleString();

                            var descEl = document.querySelector('.div-description');
                            if (descEl) {
                                descEl.style.display = svc.desc ? '' : 'none';
                                if (svc.desc) descEl.innerHTML = svc.desc;
                            }

                            // Show/hide service type fields
                            document.querySelectorAll('.service-type').forEach(el => el.style.display = 'none');
                            var type = (svc.type || 'Default').toLowerCase().replace(/\s+/g, '-');
                            document.querySelectorAll('.service-type.' + type).forEach(el => el.style.display = '');

                            // Reset charge với đúng symbol từ rate_formatted
                            var symMatch = svc.rate_formatted.match(/[^\d\s.,\-]+/);
                            var sym = symMatch ? symMatch[0] : '$';
                            var symPos = svc.rate_formatted.indexOf(sym) === 0 ? 'before' : 'after';
                            var zeroDisplay = symPos === 'before' ? sym + '0' : '0' + sym;
                            document.querySelectorAll('.charge').forEach(function(el) {
                                el.textContent = zeroDisplay;
                            });
                        },
                        link_input_type: function(val) {
                            var one = document.querySelector('.mb-0:has(#ipt-link)');
                            var multi = document.querySelector('.mb-0:has(#txa-link)');
                            if (val === '1') {
                                if (one) one.style.display = 'none';
                                if (multi) multi.style.display = '';
                            } else {
                                if (one) one.style.display = '';
                                if (multi) multi.style.display = 'none';
                            }
                        }
                    },
                    click: {
                        convertFbId: function() {
                            var link = document.getElementById('ipt-link')?.value?.trim();
                            if (!link) return;
                            fetch('/api/convert-fb-id?url=' + encodeURIComponent(link))
                                .then(r => r.json())
                                .then(d => { if (d.id) document.getElementById('ipt-link').value = d.id; })
                                .catch(() => {});
                        },
                        confirmRate: function() {
                            if (_new._pendingRate) {
                                _new._pendingRate();
                                _new._pendingRate = null;
                            } 
                            document.querySelector('.alert-order.alert-confirm').style.display = 'none';
                        },
                        order: function() {
                            var btn = document.getElementById('btn-order');
                            var svcId = $('#sl-service').val();
                            var svc = SERVICES.find(s => parseInt(s.id) === parseInt(svcId));

                            if (!svc) {
                                _new._showAlert('normal', 'Please select a service.');
                                return;
                            }

                            // Collect form data
                            var data = {
                                _token: '{{ csrf_token() }}',
                                service: svc.id,
                            };

                            // Link (single or multi)
                            var linkType = document.querySelector('input[name="link_input_type"]:checked')?.value || '0';
                            if (linkType === '1') {
                                data.link = document.getElementById('txa-link')?.value?.trim().split('\n')[0] || '';
                            } else {
                                data.link = document.getElementById('ipt-link')?.value?.trim() || '';
                            }

                            // Quantity / Comments
                            var type = svc.type || 'Default';
                            if (type === 'Custom Comments') {
                                data.comments = document.getElementById('txa-comment')?.value || '';
                            } else if (type !== 'Package' && type !== 'Subscriptions') {
                                data.quantity = document.getElementById('ipt-quantity')?.value || '';
                            }

                            // Loop — chỉ gửi khi checkbox loop được bật và value >= 1
                            if (document.getElementById('cb-loop')?.checked) {
                                var loopQty = parseInt(document.getElementById('sl-loop-quantity')?.value) || 0;
                                var loopSpacing = parseInt(document.getElementById('sl-loop-spacing')?.value) || 0;
                                if (loopQty >= 1) data.loop_quantity = loopQty;
                                if (loopSpacing >= 1) data.loop_spacing = loopSpacing;
                            }

                            // Schedule
                            if (document.getElementById('cb-schedule')?.checked) {
                                data.schedule_time = document.getElementById('ipt-schedule-time')?.value || '';
                            }

                            btn.disabled = true;

                            fetch('{{ route("clients.orders.store") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify(data)
                            })
                            .then(r => r.json())
                            .then(function(res) {
                                var order = res.data?.order || {};

                                if (res.success) {
                                    // Check rate change
                                    if (res.data?.confirm) {
                                        _new._pendingRate = function() { _new.on.click.order(); };
                                        document.querySelector('.alert-order.alert-confirm').style.display = '';
                                        return;
                                    }

                                    var msg = 'Order successfully.'
                                        + (order.id     ? ' ID: '     + order.id     + '.' : '')
                                        + (order.charge ? ' Charge: ' + order.charge + '.' : '');
                                    _new._showAlert('normal', msg, 'success');

                                    // Reset inputs
                                    document.getElementById('ipt-link') && (document.getElementById('ipt-link').value = '');
                                    document.getElementById('ipt-quantity') && (document.getElementById('ipt-quantity').value = '');
                                    document.getElementById('txa-comment') && (document.getElementById('txa-comment').value = '');
                                    var _svc = SERVICES.find(s => parseInt(s.id) === parseInt(svc.id));
                                    var _sym = (_svc?.rate_formatted || '').match(/[^\d\s.,\-]+/);
                                    var _symStr = _sym ? _sym[0] : '$';
                                    var _symPos = (_svc?.rate_formatted || '').indexOf(_symStr) === 0 ? 'before' : 'after';
                                    var _zero = _symPos === 'before' ? _symStr + '0' : '0' + _symStr;
                                    document.querySelectorAll('.charge').forEach(function(el) { el.textContent = _zero; });
                                } else {
                                    var errMsg = res.message || 'An error occurred.';
                                    if (res.errors) {
                                        errMsg = Object.values(res.errors).flat().join('<br>');
                                    }
                                    _new._showAlert('normal', errMsg, 'danger');
                                }
                            })
                            .catch(function() {
                                _new._showAlert('normal', 'Network error. Please try again.', 'danger');
                            })
                            .finally(function() {
                                btn.disabled = false;
                            });
                        }
                    }
                },

                _showAlert: function(type, msg, variant) {
                    var el = document.querySelector('.alert-order.alert-' + type);
                    if (!el) return;
                    variant = variant || 'info';
                    el.className = 'alert alert-order alert-' + type + ' alert-' + variant + ' mt-5 mb-5';
                    el.innerHTML = msg;
                    el.style.display = '';
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    if (variant === 'success') setTimeout(() => el.style.display = 'none', 5000);
                }
            };

            // Init first service
            var initSvcId = $('#sl-service').val();
            if (initSvcId) {
                try { _new.on.change.service(initSvcId); } catch(e) {}
            }

        }); // end DOMContentLoaded
    </script>
@endpush
