@extends('clients.theme-default.layouts.app')

@section('title', __('services.title'))

@section('content')

    <style>
        .services-filter__active-category {
            font-weight: 500;
        }

        [data-favorite-service-id] {
            cursor: pointer;
            transition: color 0.2s ease;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }

        [data-favorite-service-id]:hover {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
        }

        [data-favorite-service-id].favorite-active {
            color: #ffc107;
        }

        .services-list__description .btn-actions {
            padding: 0.375rem 0.75rem;
            transition: all 0.2s ease;
        }

        .services-list__description .btn-actions:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .service-description-content {
            max-height: 400px;
            overflow-y: auto;
            padding: 1rem 0;
        }

        .service-description-content h5 {
            color: #333;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .service-description-content p {
            margin-bottom: 0.75rem;
            line-height: 1.6;
        }

        .services-list-category-title h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .services-table-empty {
            text-align: center;
            padding: 2rem;
            color: #999;
        }

        .services-table-empty i {
            font-size: 2rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .services-list__description .btn-actions {
                width: 100%;
            }
        }
    </style>

    <!-- Main variables *content* -->
    <div id="block_37">
        <div class="block-bg"></div>
        <div class="container-fluid">
            <div class="services-list ">
                <div class="row">
                    <div class="col ">
                        <div
                            class="services-filters component_filter_form_group component_filter_card component_platforms mb-3">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-auto mb-3 mb-md-0">
                                        <div class="component_filter_button">
                                            <div class="dropdown">
                                                <a class="btn btn-big-primary w-sm-auto w-100 dropdown-toggle"
                                                    href="#" role="button" id="dropdown-category-filter-37"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="fal fa-filter"></span>
                                                    <span class="services-filter__active-category"
                                                        data-filter-active-category="true">{{ __('services.all_categories') }}</span>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#"
                                                        data-filter-category-id="All">{{ __('services.all') }}</a>
                                                    <a class="dropdown-item d-flex align-items-center text-decoration-none"
                                                        href="#" data-filter-category-id="favorites"
                                                        data-filter-category-name="{{ __('services.favorite_services') }}">
                                                        <span class="fas fa-star align-middle mr-1"
                                                            style="min-width: 18px"></span>
                                                        <div>{{ __('services.favorite_services') }}</div>
                                                    </a>
                                                    @foreach ($categories as $category)
                                                        <a class="dropdown-item d-flex align-items-center text-decoration-none"
                                                            href="#" data-filter-category-id="{{ $category['id'] }}"
                                                            data-filter-category-name="{{ $category['name'] }}">
                                                            <span class="d-flex align-middle mr-1" style="min-width: 18px">
                                                                @if ($category['image'])
                                                                    @if (strpos($category['image'], '.') !== false || strpos($category['image'], '/') === 0 || strpos($category['image'], 'http') === 0)
                                                                        <img src="{{ $category['image'] }}"
                                                                            alt="{{ $category['name'] }}" class="img-fluid"
                                                                            style="max-width: calc(1em + 6px); max-height: calc(1em + 6px);">
                                                                    @else
                                                                        <i class="{{ $category['image'] }}" style="font-size: 16px;"></i>
                                                                    @endif
                                                                @else
                                                                    <span class="fas fa-folder"></span>
                                                                @endif
                                                            </span>
                                                            <div>{{ $category['name'] }}</div>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="{{ __('services.search') }}"
                                                data-search-service="#service-table-37">
                                            <span class="input-group-append component_button_search">
                                                <button class="btn btn-big-secondary" type="button"
                                                    data-filter-serch-btn="true">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="services-list__table">
                            <div class="table-bg component_table ">
                                <div class="table-wr table-responsive editor__component-wrapper">
                                    <table class="table" id="service-table-37">
                                        <thead>
                                            <tr>
                                                <th style="width: 42px"></th>
                                                <th>{{ __('services.id') }}</th>
                                                <th class="nowrap">{{ __('services.service') }}</th>
                                                <th class="nowrap">{{ __('services.rate_per_1000') }}</th>
                                                <th class="nowrap">{{ __('services.min_order') }}</th>
                                                <th class="nowrap">{{ __('services.max_order') }}</th>
                                                <th class="nowrap" nowrap="">
                                                    <div class="d-flex align-items-center">
                                                        <span>{{ __('services.average_time') }}</span>
                                                        <span class="ml-1 mr-1 fa fa-exclamation-circle"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="{{ __('services.average_time_tooltip') }}"></span>
                                                    </div>
                                                </th>
                                                <th class="hidden-xs hidden-sm service-description__th">{{ __('services.description') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="service-tbody">
                                            @foreach ($categories as $category)
                                                @if (isset($groupedServices[$category['id']]) && $groupedServices[$category['id']]->count() > 0)
                                                    <tr class="services-list-category-title"
                                                        data-filter-table-category-id="{{ $category['id'] }}">
                                                        <td colspan="100%"
                                                            class="style-bg-primary-alpha-20 style-text-primary services-category editor__component-wrapper">
                                                            <div class="w-100 ">
                                                                <h4>
                                                                    @if ($category['image'])
                                                                        @if (strpos($category['image'], '.') !== false || strpos($category['image'], '/') === 0 || strpos($category['image'], 'http') === 0)
                                                                            <img src="{{ $category['image'] }}"
                                                                                alt="{{ $category['name'] }}"
                                                                                class="img-fluid align-middle mr-1"
                                                                                style="max-width: calc(1em + 6px); max-height: calc(1em + 6px);">
                                                                        @else
                                                                            <i class="{{ $category['image'] }} align-middle mr-1" style="font-size: 18px;"></i>
                                                                        @endif
                                                                    @endif
                                                                    <span
                                                                        class="align-middle">{{ $category['name'] }}</span>
                                                                </h4>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    @foreach ($groupedServices[$category['id']] as $service)
                                                        <tr data-filter-table-category-id="{{ $category['id'] }}" class="service-row">
                                                            <td data-label="{{ __('services.service') }}">
                                                                <a href="#"
                                                                    data-favorite-service-id="{{ $service['id'] }}"
                                                                    class="favorite-btn"
                                                                    title="{{ __('services.add_to_favorites') }}">
                                                                    <span data-favorite-icon="" class="far fa-star"></span>
                                                                </a>
                                                            </td>
                                                            <td data-label="{{ __('services.id') }}"
                                                                data-filter-table-service-id="{{ $service['id'] }}">
                                                                {{ $service['id'] }}</td>
                                                            <td data-label="{{ __('services.service') }}"
                                                                data-filter-table-service-name="true">
                                                                {{ $service['name'] }}
                                                            </td>
                                                            <td data-label="{{ __('services.rate_per_1000') }}">
                                                                {{ $service['rate_formatted'] }}
                                                            </td>
                                                            <td data-label="{{ __('services.min_order') }}">
                                                                {{ number_format($service['min']) }}</td>
                                                            <td data-label="{{ __('services.max_order') }}">
                                                                {{ number_format($service['max']) }}</td>
                                                            <td data-label="{{ __('services.avg_time') }}" class="nowrap">
                                                                {{ $service['average_time'] ?? '-' }}
                                                            </td>
                                                            <td data-label="{{ __('services.description') }}" class="services-list__description">
                                                                <div class="component_button_view">
                                                                    <button
                                                                        class="btn btn-actions btn-view-service-description"
                                                                        data-toggle="modal"
                                                                        data-content-id="#service-description-id-{{ $service['id'] }}"
                                                                        data-service-id="{{ $service['id'] }}"
                                                                        data-service-name="{{ $service['name'] }}"
                                                                        data-min="{{ $service['min'] }}"
                                                                        data-max="{{ $service['max'] }}"
                                                                        data-target="#service-description-37">
                                                                        {{ __('services.view') }}
                                                                    </button>
                                                                </div>
                                                                <div class="d-none"
                                                                    id="service-description-id-{{ $service['id'] }}">
                                                                    {{ $service['description'] ?? __('services.no_description') }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            @if (empty($groupedServices) || collect($groupedServices)->sum(fn($s) => $s->count()) === 0)
                                                <tr>
                                                    <td colspan="100%" class="services-table-empty">
                                                        <div>
                                                            <i class="fas fa-inbox"></i>
                                                            <p>{{ __('common.info') ?? 'No services available' }}</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade " tabindex="-1" role="dialog" id="service-description-37">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                            <div class="service-description-content"></div>
                            <button class="btn btn-block btn-big-primary" id="createQuickOrder"
                                style="margin-top: 24px;">
                                {{ __('services.create_order') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // LocalStorage helper functions for favorites
            function getFavorites() {
                const favorites = localStorage.getItem('favorite_services');
                return favorites ? JSON.parse(favorites) : [];
            }

            function saveFavorites(favorites) {
                localStorage.setItem('favorite_services', JSON.stringify(favorites));
            }

            function isFavorite(serviceId) {
                const favorites = getFavorites();
                return favorites.includes(parseInt(serviceId));
            }

            function toggleFavorite(serviceId) {
                let favorites = getFavorites();
                const id = parseInt(serviceId);

                if (favorites.includes(id)) {
                    favorites = favorites.filter(fav => fav !== id);
                } else {
                    favorites.push(id);
                }

                saveFavorites(favorites);
                return favorites.includes(id);
            }

            // Initialize favorite icons on page load
            function initializeFavorites() {
                $('[data-favorite-service-id]').each(function() {
                    const serviceId = $(this).data('favorite-service-id');
                    const $link = $(this);
                    const $icon = $(this).find('[data-favorite-icon]');

                    if (isFavorite(serviceId)) {
                        $icon.removeClass('far').addClass('fas');
                        $link.addClass('favorite-active');
                    } else {
                        $icon.removeClass('fas').addClass('far');
                        $link.removeClass('favorite-active');
                    }
                });
            }

            // Initialize favorites on page load
            initializeFavorites();

            // Category filter functionality
            $('[data-filter-category-id]').on('click', function(e) {
                e.preventDefault();

                const categoryId = $(this).data('filter-category-id');
                const categoryName = $(this).data('filter-category-name') || $(this).text().trim();

                // Update active category display
                $('.services-filter__active-category').text(categoryName);

                // Show/hide services based on category
                if (categoryId === 'All') {
                    $('[data-filter-table-category-id]').show();
                } else if (categoryId === 'favorites') {
                    // Show only favorited services
                    $('[data-filter-table-category-id]').hide();

                    let hasVisibleFavorites = false;

                    $('[data-filter-table-category-id]').each(function() {
                        const $row = $(this);
                        if (!$row.hasClass('services-list-category-title')) {
                            const $favoriteLink = $row.find('[data-favorite-service-id]');
                            if ($favoriteLink.hasClass('favorite-active')) {
                                $row.show();
                                hasVisibleFavorites = true;
                                // Also show the category header
                                const categoryId = $row.data('filter-table-category-id');
                                $('[data-filter-table-category-id="' + categoryId +
                                    '"].services-list-category-title').show();
                            }
                        }
                    });

                    // Show message if no favorites
                    if (!hasVisibleFavorites) {
                        const noFavoritesMsg = '{{ __('notifications.no_notifications') }}';
                        console.log(noFavoritesMsg);
                    }
                } else {
                    $('[data-filter-table-category-id]').hide();
                    $('[data-filter-table-category-id="' + categoryId + '"]').show();
                }
            });

            // Search functionality
            $('[data-search-service]').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                const tableSelector = $(this).data('search-service');

                if (searchTerm === '') {
                    $(tableSelector + ' tbody tr').show();
                } else {
                    $(tableSelector + ' tbody tr').each(function() {
                        const $row = $(this);
                        const serviceName = $row.find('[data-filter-table-service-name]').text()
                            .toLowerCase();
                        const serviceId = $row.find('[data-filter-table-service-id]').text()
                            .toLowerCase();

                        if (serviceName.includes(searchTerm) || serviceId.includes(searchTerm)) {
                            $row.show();
                        } else if (!$row.hasClass('services-list-category-title')) {
                            $row.hide();
                        }
                    });
                }
            });

            // Service description modal functionality
            $('.btn-view-service-description').on('click', function() {
                const contentId = $(this).data('content-id');
                const serviceName = $(this).data('service-name');
                const serviceId = $(this).data('service-id');
                const minOrder = $(this).data('min');
                const maxOrder = $(this).data('max');

                // Get description content
                const description = $(contentId).html() || '{{ __('services.no_desc') }}';

                // Update modal content
                const modal = $($(this).data('target'));
                const serviceIdLabel = '{{ __('services.service_id') }}';
                const minOrderLabel = '{{ __('services.min_order') }}';
                const maxOrderLabel = '{{ __('services.max_order') }}';
                const descriptionLabel = '{{ __('services.description') }}';
                
                modal.find('.service-description-content').html(`
            <h5>${serviceName}</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>${serviceIdLabel}:</strong> <span class="badge badge-primary">${serviceId}</span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>${minOrderLabel}:</strong> <span class="badge badge-info">${minOrder}</span></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>${maxOrderLabel}:</strong> <span class="badge badge-warning">${maxOrder}</span></p>
                </div>
            </div>
            <div class="mt-3">
                <strong>${descriptionLabel}:</strong>
                <div class="mt-2 p-2 bg-light rounded">${description || '<em>No description available</em>'}</div>
            </div>
        `);

                // Update create order button
                modal.find('#createQuickOrder').data('service-id', serviceId);
            });

            // Create quick order functionality
            $('#createQuickOrder').on('click', function() {
                const serviceId = $(this).data('service-id');
                if (serviceId) {
                    // Redirect to order creation page with service parameter
                    window.location.href = `/new?service=${serviceId}`;
                }
            });

            // Favorite service functionality with localStorage
            $('[data-favorite-service-id]').on('click', function(e) {
                e.preventDefault();

                const serviceId = $(this).data('favorite-service-id');
                const $link = $(this);
                const $icon = $(this).find('[data-favorite-icon]');

                // Toggle favorite status
                const isFav = toggleFavorite(serviceId);

                // Update icon and class
                if (isFav) {
                    $icon.removeClass('far').addClass('fas');
                    $link.addClass('favorite-active');
                    const removeLabel = '{{ __('services.favorite_services') }}';
                    $link.attr('title', removeLabel);
                } else {
                    $icon.removeClass('fas').addClass('far');
                    $link.removeClass('favorite-active');
                    const addLabel = '{{ __('services.favorite_services') }}';
                    $link.attr('title', addLabel);
                }
            });

            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush
