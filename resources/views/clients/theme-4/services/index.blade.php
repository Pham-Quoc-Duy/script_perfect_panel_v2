@extends('clients.theme-4.layouts.app')
@section('title', 'Services')

@push('styles')
    <style>
        .wrap {
            word-break: break-all;
            overflow-wrap: anywhere;
        }

        #table-service thead th {
            white-space: nowrap;
            padding: 10px 8px;
            font-size: 11px;
        }

        #table-service td {
            line-height: 1.5;
        }
    </style>
@endpush

@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Services'])

        <div class="post" id="kt_post">
            {{-- Filter --}}
            <div class="card mb-4">
                <div class="card-body py-3 px-4">
                    @php
                        $catIdsWithServices = $groupedServices->keys()->map(fn($k) => (string) $k)->toArray();
                        $platformIdsWithServices = collect($categories)
                            ->filter(fn($c) => in_array((string) $c['id'], $catIdsWithServices))
                            ->pluck('platform_id')
                            ->unique()
                            ->toArray();
                    @endphp
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-md-3">
                            <input type="text" id="ipt-keyword" class="form-control form-control-sm form-control-solid"
                                placeholder="Keyword" data-lang="services.search" oninput="_services.on.input.keyword()">
                        </div>
                        <div class="col-12 col-md-3">
                            <select id="sl-platform" class="form-select form-select-sm form-select-solid"
                                onchange="_services.on.change.platform(this.value)">
                                <option value="-100" data-lang="services.all_social_media">All social media</option>
                                @foreach ($platforms as $p)
                                    @if (in_array($p->id, $platformIdsWithServices))
                                        @php
                                            $pIcon = '';
                                            if ($p->image) {
                                                $pIcon =
                                                    str_contains($p->image, '/') || str_contains($p->image, '.')
                                                        ? '<img src="' .
                                                            e($p->image) .
                                                            '" class="w-15px h-15px me-1" />'
                                                        : '<i class="' . e($p->image) . '"></i> ';
                                            }
                                        @endphp
                                        <option value="{{ $p->id }}" data-content="{{ $pIcon . e($p->name) }}"
                                            data-lang="">{{ $p->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select id="sl-category" class="form-select form-select-sm form-select-solid"
                                onchange="_services.on.change.category(this.value)">
                                <option value="-100" data-platform="-100" data-lang="services.all_categories">All category</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-12">
                            <button type="button" id="btn-filter" class="btn btn-sm btn-primary"
                                onclick="_services.on.click.filter()" data-lang="button::Filter">Filter</button>
                            <button type="button" id="btn-toggle-rate" class="btn btn-warning btn-sm ms-2"
                                onclick="_services.on.click.toggleRate()" data-lang="button::Rate Filter">Rate
                                Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-sm btn-secondary"
                                onclick="_services.on.click.reset()" data-lang="button::Reset">Reset</button>
                        </div>
                    </div>

                    <div id="rate-filter-wrap" class="mt-3 mb-1 d-none" data-rate-min="0.0003" data-rate-max="9999">
                        <div id="kt_slider_rate_range" class="ms-6 me-10 noUi-sm"></div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="card card-services mb-5">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-row-dashed table-row-gray-300 gs-3 gy-2 gx-2 mb-0"
                            id="table-service">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th width="1"></th>
                                    <th width="1"></th>
                                    <th data-lang="services.service" width="40%">Service</th>
                                    <th class="text-end">
                                        <span data-lang="services.rate">Rate</span>
                                        <span class="ms-1 fa-regular fa-circle-question" data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="Rate on 1000 units"
                                            data-bs-original-title="Rate on 1000 units"></span>
                                    </th>
                                    <th class="text-end col-min" width="1">Min</th>
                                    <th class="text-end col-max" width="1">Max</th>
                                    <th class="text-end col-avg" width="1">
                                        <span data-lang="services.average_time">Average time</span>
                                        <span class="ms-1 fa-regular fa-circle-question" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            aria-label="The average time is based on 10 latest completed orders per 1000 quantity"
                                            data-bs-original-title="The average time is based on 10 latest completed orders per 1000 quantity"></span>
                                    </th>
                                    <th class="text-center" width="1" data-lang="services.description">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $labelColors = [
                                        'Owner' => 'danger',
                                        'Exclusive' => 'danger',
                                        'Provider Direct' => 'danger',
                                        'Best seller' => 'danger',
                                        'No refund' => 'danger',
                                        'New' => 'success',
                                        'Promotion' => 'success',
                                        'Recommend' => 'success',
                                        'Instant' => 'success',
                                        'Super Fast' => 'success',
                                        'Real' => 'success',
                                        'Lifetime' => 'success',
                                        'Auto Refill' => 'success',
                                        'Refill Button' => 'success',
                                        'Cancel Button' => 'success',
                                        'No refill' => 'success',
                                        '7 days Refill' => 'success',
                                        '15 days Refill' => 'success',
                                        '30 days Refill' => 'success',
                                        '60 days Refill' => 'success',
                                        '90 days Refill' => 'success',
                                        '365 days Refill' => 'success',
                                    ];
                                @endphp

                                @foreach ($categories as $cat)
                                    @php $catSvcs = $groupedServices->get($cat['id'], collect()); @endphp
                                    @if ($catSvcs->isNotEmpty())
                                        {{-- Category header row --}}
                                        <tr class="svc-cat-row bg-white border-top border-2"
                                            data-platform="{{ $cat['platform_id'] ?? -1 }}"
                                            data-category="{{ $cat['id'] }}">
                                            @php
                                                $platform = collect($platforms)->firstWhere(
                                                    'id',
                                                    $cat['platform_id'] ?? null,
                                                );
                                                $platformName = $platform['name'] ?? ($platform->name ?? null);
                                                $platformImage = $platform['image'] ?? ($platform->image ?? null);
                                            @endphp
                                            <td colspan="8" class="fs-5 fw-bolder">
                                                <div class="d-flex align-items-center">
                                                    @if (!empty($platformImage))
                                                        @if (str_contains($platformImage, '/') || str_contains($platformImage, '.'))
                                                            <img src="{{ $platformImage }}" class="w-15px h-15px me-1">
                                                        @else
                                                            <i class="{{ $platformImage }} fs-5 me-1"></i>
                                                        @endif
                                                    @endif
                                                    <div class="d-flex flex-column ls-1">
                                                        {{ $platformName ? $platformName . ' | ' . $cat['name'] : $cat['name'] }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Service rows --}}
                                        @foreach ($catSvcs as $svc)
                                            <tr class="svc-row" data-platform="{{ $cat['platform_id'] ?? -1 }}"
                                                data-category="{{ $svc['category_id'] }}"
                                                data-name="{{ strtolower($svc['name']) }} {{ $svc['id'] }}"
                                                data-rate="{{ preg_replace('/[^0-9.]/', '', $svc['rate_formatted']) }}">
                                                <td class="ps-3">
                                                    <a href="javascript:;" class="svc-fav-btn"
                                                        data-id="{{ $svc['id'] }}"
                                                        data-cat="{{ $svc['category_id'] }}"
                                                        data-pid="{{ $cat['platform_id'] ?? -1 }}"
                                                        onclick="toggleFavorite({{ $svc['id'] }}, {{ $svc['category_id'] }}, {{ $cat['platform_id'] ?? -1 }})">
                                                        <i class="fa-regular fa-star text-muted fs-7"></i>
                                                    </a>
                                                </td>
                                                <td class="fw-bold text-gray-600 fs-8 col-id">{{ $svc['id'] }}</td>
                                                <td class="py-2 col-name">
                                                    <div class="d-flex flex-column">
                                                        <span
                                                            class="fw-semibold text-gray-800 fs-7">{{ $svc['name'] }}</span>
                                                        @if (!empty($svc['attributes']) && is_array($svc['attributes']))
                                                            <div class="mt-1 d-flex flex-wrap gap-1">
                                                                @foreach ($svc['attributes'] as $attr)
                                                                    @php $color = $labelColors[$attr] ?? 'primary'; @endphp
                                                                    <span
                                                                        class="badge badge-outline badge-{{ $color }} fw-light fs-9 py-1 px-1">{{ $attr }}</span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="text-end col-rate">
                                                    <span
                                                        class="fw-bold text-primary fs-7">{{ $svc['rate_formatted'] }}</span>
                                                </td>
                                                <td class="text-end text-gray-700 fs-7 col-min">
                                                    {{ number_format($svc['min']) }}</td>
                                                <td class="text-end text-gray-700 fs-7 col-max">
                                                    {{ number_format($svc['max']) }}</td>
                                                <td class="text-nowrap text-end text-gray-600 fs-7 col-avg">
                                                    {{ $svc['average_time'] ?: '—' }}</td>
                                                <td class="text-center pe-3 col-desc">
                                                    <button type="button"
                                                        class="btn btn-secondary btn-sm px-4 py-1"
                                                        onclick="_services.on.click.viewDescription({{ $svc['id'] }})"
                                                        data-lang="services.view">View</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- No results row --}}
            <div id="svc-no-result" class="text-center text-muted py-5 d-none">
                <i class="fa-regular fa-face-sad-tear fs-2 mb-2"></i>
                <div data-lang="services.no_services_found">No services found.</div>
            </div>
        </div>
    </div>

    {{-- Description modal --}}
    <div class="modal fade" id="modal-description" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-start p-5">
                    <div id="service-name"></div>
                    <div class="separator separator-dashed my-5"></div>
                    <div id="service-description"></div>
                    <a id="modal-desc-buy" href="#" target="_blank"
                        class="btn btn-primary w-100 mt-5 text-uppercase">Buy now</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            // ── Favorites ──────────────────────────────────────────────────────────
            var FAV_KEY = 'svc_favorites';

            function getFavs() {
                try {
                    return JSON.parse(localStorage.getItem(FAV_KEY)) || {};
                } catch (e) {
                    return {};
                }
            }

            function saveFavs(f) {
                localStorage.setItem(FAV_KEY, JSON.stringify(f));
            }

            function applyFavIcons() {
                var favs = getFavs();
                document.querySelectorAll('.svc-fav-btn').forEach(function(el) {
                    var icon = el.querySelector('i');
                    if (favs[el.dataset.id]) {
                        icon.classList.replace('fa-regular', 'fa-solid');
                        icon.classList.replace('text-muted', 'text-warning');
                    } else {
                        icon.classList.replace('fa-solid', 'fa-regular');
                        icon.classList.replace('text-warning', 'text-muted');
                    }
                });
            }
            window.toggleFavorite = function(id, categoryId, platformId) {
                var key = String(id),
                    favs = getFavs();
                if (favs[key]) {
                    delete favs[key];
                } else {
                    favs[key] = {
                        id,
                        category_id: categoryId,
                        platform_id: platformId
                    };
                }
                saveFavs(favs);
                applyFavIcons();
            };

            // ── Service descriptions map ────────────────────────────────────────────
            var _descMap = {
                @foreach ($services as $svc)
                    {{ $svc['id'] }}: {
                        desc: {!! json_encode($svc['description'] ?? '') !!},
                        name: {!! json_encode($svc['name']) !!},
                        image: {!! json_encode($svc['image'] ?? '') !!}
                    },
                @endforeach
            };

            // ── Category data map (grouped by platform_id) ──────────────────────────
            var _catsByPlatform = {!! json_encode(
                collect($categories)->filter(fn($c) => in_array((string) $c['id'], $catIdsWithServices))->groupBy(fn($c) => (string) ($c['platform_id'] ?? -1))->map(
                        fn($cats) => $cats->map(
                                fn($c) => [
                                    'id' => $c['id'],
                                    'name' => $c['name'],
                                    'image' => $c['image'] ?? null,
                                    'platform_id' => $c['platform_id'] ?? -1,
                                    'platform_name' =>
                                        collect($platforms)->firstWhere('id', $c['platform_id'] ?? null)?->name ?? null,
                                ],
                            )->values(),
                    ),
            ) !!};

            function iconHtml(img, cls) {
                if (!img) return '';
                cls = cls || 'w-15px h-15px';
                return (img.indexOf('/') !== -1 || img.indexOf('.') !== -1) ?
                    '<img src="' + img + '" class="' + cls + ' me-1" />' :
                    '<i class="' + img + '"></i> ';
            }

            // ── Filter state ────────────────────────────────────────────────────────
            var _state = {
                keyword: '',
                platform: '-100',
                category: '-100',
                rateMin: null,
                rateMax: null
            };
            var _rateSlider = null;

            function applyFilter() {
                var kw = _state.keyword.toLowerCase().trim();
                var platform = String(_state.platform);
                var category = String(_state.category);
                var rMin = _state.rateMin;
                var rMax = _state.rateMax;

                var visibleCats = {};

                // Filter service rows
                document.querySelectorAll('#table-service tbody tr.svc-row').forEach(function(row) {
                    var rowPlatform = String(row.dataset.platform);
                    var rowCategory = String(row.dataset.category);
                    var rowName = (row.dataset.name || '').toLowerCase();
                    var rowRate = parseFloat(row.dataset.rate) || 0;

                    var matchPlatform = platform === '-100' || rowPlatform === platform;
                    var matchCategory = category === '-100' || rowCategory === category;
                    var matchKeyword = !kw || rowName.indexOf(kw) !== -1;
                    var matchRate = (rMin === null || rowRate >= rMin) && (rMax === null || rowRate <= rMax);

                    var visible = matchPlatform && matchCategory && matchKeyword && matchRate;
                    row.style.display = visible ? '' : 'none';
                    if (visible) visibleCats[rowCategory] = true;
                });

                // Show/hide category header rows based on whether they have visible children
                document.querySelectorAll('#table-service tbody tr.svc-cat-row').forEach(function(row) {
                    var catId = String(row.dataset.category);
                    row.style.display = visibleCats[catId] ? '' : 'none';
                });

                // Show "no result" message
                var hasAny = Object.keys(visibleCats).length > 0;
                var noResult = document.getElementById('svc-no-result');
                if (noResult) noResult.classList.toggle('d-none', hasAny);
            }

            // ── _services public API ────────────────────────────────────────────────
            window._services = {
                on: {
                    input: {
                        keyword: function() {
                            _state.keyword = document.getElementById('ipt-keyword').value;
                        }
                    },
                    change: {
                        platform: function(val) {
                            _state.platform = String(val);
                            _state.category = '-100';
                            buildCategorySelect(val);
                        },
                        category: function(val) {
                            _state.category = String(val);
                        }
                    },
                    click: {
                        filter: function() {
                            applyFilter();
                        },
                        toggleRate: function() {
                            var wrap = document.getElementById('rate-filter-wrap');
                            var isHidden = wrap.classList.toggle('d-none');
                            if (!isHidden && !_rateSlider) {
                                var rMin = parseFloat(wrap.dataset.rateMin) || 0;
                                var rMax = parseFloat(wrap.dataset.rateMax) || 9999;
                                _rateSlider = noUiSlider.create(
                                    document.getElementById('kt_slider_rate_range'), {
                                        start: [rMin, rMax],
                                        connect: true,
                                        range: {
                                            min: rMin,
                                            max: rMax
                                        },
                                        tooltips: [true, true],
                                        format: {
                                            to: v => parseFloat(v).toFixed(4),
                                            from: v => parseFloat(v)
                                        }
                                    }
                                );
                                _rateSlider.on('update', function(values) {
                                    _state.rateMin = parseFloat(values[0]);
                                    _state.rateMax = parseFloat(values[1]);
                                    applyFilter();
                                });
                            }
                            if (isHidden) {
                                _state.rateMin = null;
                                _state.rateMax = null;
                                applyFilter();
                            }
                        },
                        reset: function() {
                            _state = {
                                keyword: '',
                                platform: '-100',
                                category: '-100',
                                rateMin: null,
                                rateMax: null
                            };
                            document.getElementById('ipt-keyword').value = '';
                            $('#sl-platform').val('-100').trigger('change.select2');
                            buildCategorySelect('-100');

                            var wrap = document.getElementById('rate-filter-wrap');
                            wrap.classList.add('d-none');
                            if (_rateSlider) {
                                _rateSlider.destroy();
                                _rateSlider = null;
                            }

                            applyFilter();
                        },
                        viewDescription: function(id) {
                            var entry = _descMap[id] || {};
                            var icon = iconHtml(entry.image || '', 'w-20px h-20px');
                            document.getElementById('service-name').innerHTML =
                                icon +
                                '<span class="fw-bolder fs-4 ls-1">' + id + '</span>' +
                                ' - <span class="fs-5">' + (entry.name || '') + '</span>';
                            document.getElementById('service-description').innerHTML = entry.desc || '';
                            document.getElementById('modal-desc-buy').href = '/new?service=' + id;
                            new bootstrap.Modal(document.getElementById('modal-description')).show();
                        }
                    }
                }
            };

            // ── Select2 options ─────────────────────────────────────────────────────
            var s2opts = {
                escapeMarkup: function(m) {
                    return m;
                },
                minimumResultsForSearch: -1,
                templateResult: function(o) {
                    if (!o.element) return o.text;
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

            function buildCategorySelect(platformId) {
                var $cat = $('#sl-category');
                if ($cat.hasClass('select2-hidden-accessible')) $cat.select2('destroy');
                $cat.empty().append($('<option>').val('-100').text(
                    (LANGUAGE?._flat?.['services.all_categories']) || 'All category'
                ).attr('data-platform', '-100'));

                if (String(platformId) !== '-100') {
                    var cats = _catsByPlatform[String(platformId)] || [];
                    cats.forEach(function(c) {
                        var label = c.platform_name ? c.platform_name + ' | ' + c.name : c.name;
                        $cat.append($('<option>').val(c.id).text(label)
                            .attr('data-platform', c.platform_id)
                            .attr('data-content', iconHtml(c.image) + label));
                    });
                }

                $cat.val('-100').select2(s2opts);
            }

            // ── Init select2 ────────────────────────────────────────────────────────
            document.addEventListener('DOMContentLoaded', function() {
                applyFavIcons();

                $('#sl-platform').select2(s2opts).on('change', function() {
                    _services.on.change.platform($(this).val());
                });

                buildCategorySelect('-100');

                $(document).on('change', '#sl-category', function() {
                    _services.on.change.category($(this).val());
                });
            });
        })();
    </script>
@endpush
