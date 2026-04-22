    @extends('clients.theme-default.layouts.app')

    @section('title', __('newOrder.title'))

    @section('content')

        @include('clients.theme-default.components.index')

        <div id="block_39">
            <div class="block-bg"></div>
            <div class="container-fluid">
                <div class="new_order-block">
                    <div class="row">
                        <!-- Left: Form -->
                        <div class="col-lg-7 mb-4 mb-lg-0">
                            <div class="component_form_group component_card component_radio_button component_platforms">
                                <div class="card">
                                    <form action="{{ route('clients.orders.store') }}" method="post" id="order-form">
                                        @csrf

                                        <!-- Alert Messages -->
                                        <div class="alert alert-dismissible mb-3 js-order-alert alert-danger" role="alert"
                                            id="js-order-alert-error" style="display: none;">
                                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <div class="text"></div>
                                        </div>

                                        <div class="alert alert-dismissible mb-3 js-order-alert alert-success"
                                            role="alert" id="js-order-alert-success" style="display: none;">
                                            <button type="button" class="close" data-hide="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <div class="text"></div>
                                        </div>

                                        <!-- Platforms -->
                                        <div class="platforms">

                                            {{-- ALL PLATFORM --}}
                                            <div class="platforms-item platforms-item-col-5">
                                                <button type="button" class="platforms-item__with-icon active"
                                                    data-platform="all" data-platform-id="all">

                                                    <span class="platforms-item__icon platforms-item__icon-original">
                                                        <svg width="100%" height="100%" viewBox="0 0 24 24"
                                                            fill="none">
                                                            <path d="M5 7h14M5 12h14M5 17h14" stroke="currentColor"
                                                                stroke-width="2" />
                                                        </svg>
                                                    </span>

                                                    <span class="platforms-item__title">{{ __('newOrder.all') }}</span>
                                                </button>
                                            </div>

                                            {{-- PLATFORMS FROM DB --}}
                                            @foreach ($data['platforms'] as $platform)
                                                <div class="platforms-item platforms-item-col-5">
                                                    <button type="button" class="platforms-item__with-icon"
                                                        data-platform="{{ Str::slug($platform->name) }}"
                                                        data-platform-id="{{ $platform->id }}"
                                                        data-icon="{{ $platform->image }}">

                                                        <span class="platforms-item__icon platforms-item__icon-original">
                                                            @if ($platform->image && (strpos($platform->image, '.') !== false || strpos($platform->image, '/') === 0 || strpos($platform->image, 'http') === 0))
                                                                <img src="{{ $platform->image }}" alt="{{ $platform->name }}"
                                                                    style="width:20px;height:20px;object-fit:contain;">
                                                            @else
                                                                <i class="{{ $platform->image }}" style="font-size:18px;"></i>
                                                            @endif
                                                        </span>

                                                        <span class="platforms-item__title">
                                                            {{ $platform->name }}
                                                        </span>
                                                    </button>
                                                </div>
                                            @endforeach
                                            <div class="platforms-item platforms-item-col-5">
                                                <button type="button" class="platforms-item__with-icon"
                                                    data-platform="other" data-platform-id="2">
                                                    <span class="platforms-item__icon platforms-item__icon-original">
                                                        <svg width="100%" height="100%" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M13 5C13 4.44687 12.5531 4 12 4C11.4469 4 11 4.44687 11 5V11H5C4.44687 11 4 11.4469 4 12C4 12.5531 4.44687 13 5 13H11V19C11 19.5531 11.4469 20 12 20C12.5531 20 13 19.5531 13 19V13H19C19.5531 13 20 12.5531 20 12C20 11.4469 19.5531 11 19 11H13V5Z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="platforms-item__title">{{ __('newOrder.other') }}</span> </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="search-dropdown select2-container--default select2-container--below"
                                                id="search-container" style="position: relative;">
                                                <div class="input-wrapper">
                                                    <button type="button" class="input-wrapper__prepend">
                                                        <span class="fas fa-search"></span>
                                                    </button>
                                                    <input id="service-search-input" placeholder="{{ __('newOrder.search') }}"
                                                        class="select2-selection select2-selection--single form-control"
                                                        autocomplete="off">
                                                    <button type="button" class="input-wrapper__append"
                                                        id="search-clear-btn" style="display: none;">
                                                        <span class="fas fa-times"></span>
                                                    </button>
                                                </div>
                                                <!-- Search Results Dropdown -->
                                                <div id="search-results-container" style="position: relative;">
                                                    <span
                                                        class="select2-container select2-container--default select2-container--open"
                                                        id="search-dropdown-wrapper"
                                                        style="position: absolute; top: 0px; left: 0px; width: 100%; display: none; z-index: 1050;">
                                                        <span class="select2-dropdown dropdown-menu select2-dropdown--below"
                                                            style="width: 100%; position: relative;">
                                                            <span class="select2-results" style="width: 100%;">
                                                                <div
                                                                    style="max-height: 400px; overflow-y: auto; overflow-x: hidden; width: 100%; scrollbar-width: thin; scrollbar-color: #ccc #f1f1f1;">
                                                                    <ul role="group"
                                                                        class="select2-results__options dropdown-menu"
                                                                        id="search-results-list"
                                                                        style="padding: 0; margin: 0; list-style: none;">
                                                                        <!-- Search results will be populated here -->
                                                                    </ul>
                                                                </div>
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Category – Tự động thay đổi theo platform -->
                                        <div class="form-group">
                                            <label for="orderform-category" class="control-label">{{ __('newOrder.category') }}</label>
                                            <select class="form-control select2-hidden-accessible" id="orderform-category"
                                                name="category" data-select="true" data-select-search="true"
                                                data-select-search-placeholder="{{ __('newOrder.search') }}"
                                                data-select-container="#select-category-container" tabindex="-1"
                                                aria-hidden="true">
                                                @foreach ($data['categories'] as $key => $categories)
                                                    <option value="{{ $categories['id'] }}"
                                                        data-category-id="{{ $categories['id'] }}"
                                                        data-platform_id="{{ $categories['platform_id'] }}"
                                                        data-icon="<img src='{{ $categories['image'] }}'
                        class='img-responsive btn-group-vertical'>">
                                                        {{ $categories['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div id="select-category-container" class="position-relative"></div>
                                        </div>

                                        <div class="form-group">
                                            <label for="orderform-service" class="control-label">{{ __('newOrder.service') }}</label>
                                            <div class="d-flex">
                                                <div class="w-100 new_order-block__services-list">
                                                    <select class="form-control select2-hidden-accessible"
                                                        id="orderform-service" name="service" data-select="true"
                                                        data-select-search="true" data-select-search-placeholder="{{ __('newOrder.search') }}"
                                                        data-select-container="#select-service-container" tabindex="-1"
                                                        aria-hidden="true">
                                                        @foreach ($data['services'] as $service)
                                                            <option data-type="0" value="{{ $service['id'] }}"
                                                                data-template="{{ $service['id'] }} - {{ $service['name'] }} - {{ $service['rate_formatted'] }}"
                                                                data-category_id ="{{ $service['category_id'] }}"
                                                                data-id="{{ $service['id'] }}"
                                                                data-name="{{ $service['name'] }}"
                                                                data-title="{{ $service['title'] }}"
                                                                data-description="{{ $service['description'] }}"
                                                                data-position="{{ $service['position'] }}"
                                                                data-attributes="{{ $service['attributes'] }}"
                                                                data-min="{{ $service['min'] }}"
                                                                data-max="{{ $service['max'] }}"
                                                                data-type_service="{{ $service['type_service'] }}"
                                                                data-type_radio="{{ $service['type_radio'] }}"
                                                                data-refill="{{ $service['refill'] }}"
                                                                data-cancel="{{ $service['cancel'] }}"
                                                                data-dripfeed="{{ $service['dripfeed'] }}"
                                                                data-average-time="{{ $service['average_time'] }}"
                                                                data-note="{{ $service['note'] }}"
                                                                data-rate_formatted="{{ $service['rate_formatted'] }}">

                                                                {{ $service['id'] }} - {{ $service['name'] }} -
                                                                {{ $service['rate_formatted'] }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    <div id="select-service-container" class="position-relative">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Service Description -->
                                        <div class="form-group hidden fields component_service_description"
                                            id="service_description">
                                            <label for="service_description" class="control-label">{{ __('newOrder.description') }}</label>
                                            <div class="panel-description"><br>
                                            </div>
                                        </div>

                                        <!-- Fields -->
                                        <div id="fields">
                                            {{-- <div class="form-group hidden fields" id="order_user_name">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-user_name">Username</label>
                                                        <input class="form-control w-full" name="OrderForm[user_name]"
                                                            value="" type="text"
                                                            id="field-orderform-fields-user_name">
                                                    </div> --}}
                                            <div class="form-group fields" id="order_link">
                                                <label class="control-label"
                                                    for="field-orderform-fields-link">{{ __('newOrder.link') }}</label>
                                                <input class="form-control" name="link" value="" type="text"
                                                    dir="ltr" id="field-orderform-fields-link">
                                            </div>
                                            <div class="form-group fields" id="order_quantity">
                                                <label class="control-label"
                                                    for="field-orderform-fields-quantity">{{ __('newOrder.quantity') }}</label>
                                                <input class="form-control" name="quantity" value=""
                                                    type="text" id="field-orderform-fields-quantity"><small
                                                    class="help-block min-max"></small>
                                            </div>
                                            <div class="form-group hidden fields" id="order_keywords">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-keywords">Keywords (1 per line)</label>
                                                        <textarea class="form-control" name="keywords" id="field-orderform-fields-keywords" cols="30"
                                                            rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_comment">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-comments">Comments (1 per line)</label>
                                                        <textarea class="form-control" name="comments" id="field-orderform-fields-comments" cols="30"
                                                            rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_mentionUsernames">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-mentionUsernames">Usernames (1 per
                                                            line)</label>
                                                        <textarea class="form-control" name="mentionUsernames" id="field-orderform-fields-mentionUsernames"
                                                            cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_usernames">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-usernames">Usernames (1 per
                                                            line)</label>
                                                        <textarea class="form-control w-full" name="usernames" id="field-orderform-fields-usernames"
                                                            cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_usernames_custom">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-usernames_custom">Usernames (1 per
                                                            line)</label>
                                                        <textarea class="form-control" name="OrderForm[usernames_custom]" id="field-orderform-fields-usernames_custom"
                                                            cols="30" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_username">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-username">Username</label>
                                                        <input class="form-control" name="username" value=""
                                                            type="text" id="field-orderform-fields-username">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_mediaUrl">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-mediaUrl">Media URL</label>
                                                        <input class="form-control" name="mediaUrl" value=""
                                                            type="text" id="field-orderform-fields-mediaUrl">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_hashtag">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-hashtag">Hashtag</label>
                                                        <input class="form-control" name="hashtag" value=""
                                                            type="text" id="field-orderform-fields-hashtag">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_hashtags">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-hashtags">Hashtags (1 per line)</label>
                                                        <textarea class="form-control" name="hashtags" id="field-orderform-fields-hashtags" cols="30"
                                                            rows="10"></textarea>
                                                    </div>
                                                    <div id="dripfeed" class="space-y-3">
                                                        <!-- Drip-feed Toggle -->
                                                        <!-- Schedule Toggle -->
                                                        <div class="form-group">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input type="checkbox" id="is_schedule-time" name="is_schedule_time" value="1">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="is_schedule-time"
                                                                    class="form-group__label-title">
                                                                    {{ __('schedule.description') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Schedule DateTime Input -->
                                                        <div id="is-schedule-time-content" class="hidden">
                                                            <div class="form-group">
                                                                <label class="control-label" for="schedule-time">{{ __('schedule.datetime_label') }}</label>
                                                                <input type="datetime-local" id="schedule-time" name="schedule_time" class="form-control">
                                                            </div>
                                                        </div>

                                                        <!-- Loop Toggle -->
                                                        <div class="form-group">
                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input type="checkbox" id="is_loop" name="loop" value="1">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label for="is_loop"
                                                                    class="form-group__label-title">
                                                                    {{ __('loop.title') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <!-- Loop Inputs -->
                                                        <div id="loop-fields" class="hidden">
                                                            <div class="form-group">
                                                                <label class="control-label" for="loop_quantity">{{ __('loop.quantity') }}</label>
                                                                <input type="number" id="loop_quantity" name="loop_quantity" class="form-control" placeholder="1">
                                                                <small class="form-text text-muted d-block">{{ __('loop.quantity_help') }}</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label" for="loop_spacing">{{ __('loop.spacing') }}</label>
                                                                <input type="number" id="loop_spacing" name="loop_spacing" class="form-control" placeholder="30">
                                                                <small class="form-text text-muted d-block">{{ __('loop.spacing_help') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_posts">
                                                        <label class="control-label" for="field-orderform-fields-posts">New
                                                            posts</label>
                                                        <input class="form-control" name="posts" value=""
                                                            type="text" id="field-orderform-fields-posts">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_old_posts">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-old_posts">Old posts</label>
                                                        <input class="form-control" name="old_posts"
                                                            value="" type="text"
                                                            id="field-orderform-fields-old_posts">
                                                        <small class="help-block max"></small>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_min">
                                                        <label class="control-label" for="order_count">Quantity</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" id="order_count"
                                                                    name="min" value=""
                                                                    placeholder="Min"><small class="help-block min-max"></small>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" id="order_count"
                                                                    name="max" value="" placeholder="Max">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_delay">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label class="control-label"
                                                                    for="field-orderform-fields-delay">Delay (minutes)</label>
                                                                <select class="form-control" name="delay"
                                                                    id="field-orderform-fields-delay">

                                                                    <option value="0">No delay (0 min)</option>

                                                                    <option value="5">5 minutes</option>

                                                                    <option value="10">10 minutes</option>

                                                                    <option value="15">15 minutes</option>

                                                                    <option value="20">20 minutes</option>

                                                                    <option value="30">30 minutes</option>

                                                                    <option value="40">40 minutes</option>

                                                                    <option value="50">50 minutes</option>

                                                                    <option value="60">60 minutes (1 hour)</option>

                                                                    <option value="90">90 minutes (1.5 hours)</option>

                                                                    <option value="120">120 minutes (2 hours)</option>

                                                                    <option value="150">150 minutes (2.5 hours)</option>

                                                                    <option value="180">180 minutes (3 hours)</option>

                                                                    <option value="210">210 minutes (3.5 hours)</option>

                                                                    <option value="240">240 minutes (4 hours)</option>

                                                                    <option value="270">270 minutes (4.5 hours)</option>

                                                                    <option value="300">300 minutes (5 hours)</option>

                                                                    <option value="360">360 minutes (6 hours)</option>

                                                                    <option value="420">420 minutes (7 hours)</option>

                                                                    <option value="480">480 minutes (8 hours)</option>

                                                                    <option value="540">540 minutes (9 hours)</option>

                                                                    <option value="600">600 minutes (10 hours)</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="field-orderform-fields-expiry">Expiry (d/m/Y)</label>
                                                                <div class="input-group">
                                                                    <input class="form-control datetime" autocomplete="off"
                                                                        name="expiry" value="" placeholder="dd/mm/yyyy"
                                                                        type="text" id="field-orderform-fields-expiry">
                                                                    <span class="input-group-btn">
                                                                        <button
                                                                            class="btn btn-default btn-big-secondary clear-datetime"
                                                                            type="button"
                                                                            data-rel="#field-orderform-fields-expiry"><span
                                                                                class="fa far fa-trash-alt"></span></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_comment_username">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-comment_username">Username of the
                                                            comment owner</label>
                                                        <input class="form-control" name="OrderForm[comment_username]"
                                                            value="" type="text"
                                                            id="field-orderform-fields-comment_username">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_answer_number">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-answer_number">Answer number</label>
                                                        <input class="form-control" name="OrderForm[answer_number]"
                                                            value="" type="text"
                                                            id="field-orderform-fields-answer_number">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_email">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-email">Email</label>
                                                        <input class="form-control" name="OrderForm[email]" value=""
                                                            type="text" id="field-orderform-fields-email">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_groups">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-groups">Groups</label>
                                                        <textarea class="form-control" name="OrderForm[groups]" id="field-orderform-fields-groups" cols="30"
                                                            rows="10"></textarea>
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_country">
                                                        <label class="control-label" for="field-orderform-fields-country">
                                                            Country
                                                        </label>
                                                        <input class="form-control" name="country" value=""
                                                            placeholder="US" type="text"
                                                            id="field-orderform-fields-country">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_device">
                                                        <label class="control-label" for="field-orderform-fields-device">
                                                            Device
                                                        </label>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="device" id="device-1" value="1">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="device-1">Desktop</label>
                                                        </div>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="device" id="device-2" value="2">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="device-2">Mobile (Android)</label>
                                                        </div>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="device" id="device-3" value="3">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="device-3">Mobile (iOS)</label>
                                                        </div>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="device" id="device-4" value="4">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="device-4">Mixed (Mobile)</label>
                                                        </div>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="device" id="device-5" value="5">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="device-5">Mixed (Mobile &amp; Desktop)</label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group hidden fields" id="order_type_of_traffic">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-type_of_traffic">
                                                            Type of Traffic
                                                        </label>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="type_of_traffic" id="type_of_traffic-1"
                                                                    checked="" value="1">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="type_of_traffic-1">Google Keyword</label>
                                                        </div>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="type_of_traffic" id="type_of_traffic-2"
                                                                    value="2">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="type_of_traffic-2">Custom Referrer</label>
                                                        </div>

                                                        <div class="form-group__checkbox">
                                                            <label class="form-group__checkbox-label">
                                                                <input class="form-check-input" type="radio"
                                                                    name="type_of_traffic" id="type_of_traffic-3"
                                                                    value="3">
                                                                <span class="radiomark"></span>
                                                            </label>
                                                            <label class="form-check-label form-group__label-title mr-5"
                                                                for="type_of_traffic-3">Blank Referrer</label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group hidden fields" id="order_google_keyword">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-google_keyword">
                                                            Google Keyword
                                                        </label>
                                                        <input class="form-control" name="google_keyword"
                                                            value="" placeholder="Google Keyword..." type="text"
                                                            id="field-orderform-fields-google_keyword">
                                                    </div>
                                                    <div class="form-group hidden fields" id="order_referring_url">
                                                        <label class="control-label"
                                                            for="field-orderform-fields-referring_url">
                                                            Referring URL
                                                        </label>
                                                        <input class="form-control" name="referring_url"
                                                            value="" placeholder="https://instagram.com" type="text"
                                                            id="field-orderform-fields-referring_url">
                                                    </div>

                                            <div class="form-group hidden fields" id="order_average_time">
                                                <label class="control-label" for="field-orderform-fields-average_time">
                                                    {{ __('newOrder.average_time') }}
                                                    <span class="ml-1 mr-1 fa fa-exclamation-circle" data-toggle="tooltip"
                                                        data-placement="right"
                                                        title="The average completion time is calculated based on the completion times of the latest orders.">
                                                    </span>
                                                </label>
                                                <input class="form-control" readonly="" value="" type="text"
                                                    id="field-orderform-fields-average_time" disabled="">
                                            </div>
                                        </div>

                                        <!-- Schedule Time Section -->
                                        {{-- <div class="space-y-3 mb-3">
                                            <!-- Toggle Schedule -->
                                            <label for="is_schedule-time" class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 dark:border-gray-600 px-3 py-2 transition hover:border-indigo-400 dark:hover:border-indigo-500">
                                                <input type="checkbox" id="is_schedule-time" name="is_schedule_time" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Đặt lịch chạy. Múi giờ: +07:00</span>
                                            </label>

                                            <!-- DateTime Input -->
                                            <div id="is-schedule-time-content" class="hidden">
                                                <div class="position-relative">
                                                    <input type="datetime-local" id="schedule-time" name="schedule_time" class="form-control pl-5">
                                                    <!-- Calendar Icon -->
                                                    <div class="position-absolute" style="top: 50%; left: 10px; transform: translateY(-50%); pointer-events: none; color: #9ca3af;">
                                                        <svg class="h-5 w-5" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <!-- Loop Section -->
                                        {{-- <div class="space-y-3 mb-3">
                                            <!-- Toggle Loop -->
                                            <label for="is_loop" class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 dark:border-gray-600 px-3 py-2 transition hover:border-indigo-400 dark:hover:border-indigo-500">
                                                <input type="checkbox" id="is_loop" name="loop" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Đặt vòng lặp</span>
                                            </label>

                                            <!-- Loop Inputs -->
                                            <div id="loop-fields" class="row hidden">
                                                <div class="col-md-6 mb-3">
                                                    <label for="loop_quantity" class="control-label font-weight-bold">Loop quantity (số lần)</label>
                                                    <input type="number" id="loop_quantity" name="loop_quantity" class="form-control" placeholder="1">
                                                    <small class="form-text text-muted">Tổng số lần bạn muốn chạy lặp (bao gồm lần đầu)</small>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="loop_spacing" class="control-label font-weight-bold">Loop spacing (minutes)</label>
                                                    <input type="number" id="loop_spacing" name="loop_spacing" class="form-control" placeholder="30">
                                                    <small class="form-text text-muted">Khoảng cách thời gian giữa mỗi lần chạy lặp (phút)</small>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="charge" class="control-label">{{ __('newOrder.charge') }}</label>
                                                <input type="text" class="form-control" id="charge" value=""
                                                    readonly="">
                                            </div>
                                        </div>

                                        <div class="new-order-button-submit component_button_submit ">
                                            <button id="submit-btn" type="submit"
                                                class="btn btn-block btn-big-primary">{{ __('newOrder.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Policy -->
                        <div class="col-lg-5">
                            <div class="component_content_card component_content_button">
                                <div class="card">
                                    <div class="new-order__content-text">
                                        @if ($config && $config->notice_system)
                                            {!! $config->notice_system !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <style>
            /* Schedule & Loop Styles */
            .space-y-3 > * + * {
                margin-top: 0.75rem;
            }
            .flex {
                display: flex;
            }
            .items-center {
                align-items: center;
            }
            .gap-3 {
                gap: 0.75rem;
            }
            .cursor-pointer {
                cursor: pointer;
            }
            .rounded-lg {
                border-radius: 0.5rem;
            }
            .border {
                border-width: 1px;
                border-style: solid;
            }
            .border-gray-300 {
                border-color: #d1d5db;
            }
            .dark .dark\:border-gray-600 {
                border-color: #4b5563;
            }
            .px-3 {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
            .py-2 {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
            }
            .transition {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }
            label.flex:hover {
                border-color: #818cf8;
            }
            .dark label.flex:hover {
                border-color: #6366f1;
            }
            .h-4 {
                height: 1rem;
            }
            .w-4 {
                width: 1rem;
            }
            .rounded {
                border-radius: 0.25rem;
            }
            .text-indigo-600 {
                color: #4f46e5;
            }
            .focus\:ring-indigo-500:focus {
                --tw-ring-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5);
            }
            .text-sm {
                font-size: 0.875rem;
                line-height: 1.25rem;
            }
            .font-medium {
                font-weight: 500;
            }
            .text-gray-900 {
                color: #111827;
            }
            .dark .dark\:text-gray-100 {
                color: #f3f4f6;
            }
            .hidden {
                display: none;
            }
            .position-relative {
                position: relative;
            }
            .pl-5 {
                padding-left: 2.5rem !important;
            }
            .font-weight-bold {
                font-weight: 700;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const allCategories = @json($data['categories']);
                const allServices = @json($data['services']);
                const selectedService = @json($data['selectedService']);
                let currentPlatformId = 'all';
                let currentServiceRate = 0; // Lưu trữ rate hiện tại



                // Nếu có selectedService từ URL, load nó sau khi DOM sẵn sàng
                if (selectedService && selectedService.id) {

                    setTimeout(() => {
                        loadServiceFromUrl(selectedService);
                    }, 100);
                }

                // ==================== XỬ LÝ CLICK PLATFORM ====================
                document.querySelectorAll('.platforms-item button').forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        document.querySelectorAll('.platforms-item button').forEach(b => b.classList
                            .remove('active'));
                        this.classList.add('active');

                        currentPlatformId = this.getAttribute('data-platform-id');


                        loadCategoriesByPlatform(currentPlatformId);
                    });
                });

                // ==================== BẮT SỰ KIỆN CHỌN CATEGORY (CỰC KỲ QUAN TRỌNG) ====================
                const categorySelect = document.getElementById('orderform-category');

                // Cách 1: Bắt native change (khi dispatch thủ công từ platform)
                categorySelect.addEventListener('change', handleCategoryChange);

                // Cách 2: Bắt event Select2 - ĐẢM BẢO load service khi chọn từ dropdown
                $(categorySelect).on('select2:select', function(e) {

                    handleCategoryChange(e);
                });

                // Hàm xử lý chung khi category thay đổi
                function handleCategoryChange(e) {
                    const categoryId = categorySelect.value;
                    if (categoryId) {

                        loadServicesByCategory(categoryId);
                    }
                }

                // ==================== BẮT SERVICE CHANGE (tùy chọn) ====================
                const serviceSelect = document.getElementById('orderform-service');
                serviceSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    if (selectedOption) {
                        const data = {
                            id: selectedOption.getAttribute('data-id'),
                            name: selectedOption.getAttribute('data-name'),
                            rate: selectedOption.getAttribute('data-rate_formatted') || selectedOption
                                .getAttribute('data-rate-formatted'),
                            min: selectedOption.getAttribute('data-min'),
                            max: selectedOption.getAttribute('data-max'),
                            description: selectedOption.getAttribute('data-description') || '',
                            average_time: selectedOption.getAttribute('data-average-time') || '',
                            type_service: selectedOption.getAttribute('data-type_service') || selectedOption
                                .getAttribute('data-type-service') || 'Default'
                        };

                        updateServiceInfo(data);
                        resetInputFields(); // Reset input fields khi chọn service khác
                        calculateCharge(); // Tính toán charge khi chọn service
                    }
                });

                $(serviceSelect).on('select2:select', function() {
                    serviceSelect.dispatchEvent(new Event('change')); // Đảm bảo trigger native change
                });

                // ==================== BẮT QUANTITY CHANGE ====================
                const quantityInput = document.getElementById('field-orderform-fields-quantity');
                if (quantityInput) {
                    quantityInput.addEventListener('input', function() {
                        calculateCharge();
                    });

                    quantityInput.addEventListener('change', function() {
                        calculateCharge();
                    });
                }

                // ==================== BẮT COMMENT CHANGE - AUTO CALCULATE QUANTITY ====================
                const commentInput = document.getElementById('field-orderform-fields-comments');
                if (commentInput) {
                    commentInput.addEventListener('input', function() {
                        // Count non-empty lines in comment textarea
                        const comments = this.value.trim();
                        const lines = comments ? comments.split('\n').filter(line => line.trim().length > 0) : [];
                        const lineCount = lines.length;

                        // Update quantity field with line count
                        if (quantityInput) {
                            quantityInput.value = lineCount > 0 ? lineCount : '';
                            // Trigger change event to recalculate charge
                            quantityInput.dispatchEvent(new Event('change'));
                        }
                    });
                }

                // ==================== LOAD CATEGORIES THEO PLATFORM ====================
                function loadCategoriesByPlatform(platformId) {
                    const filtered = platformId === 'all' ?
                        allCategories :
                        allCategories.filter(cat => cat.platform_id == platformId);



                    updateCategorySelect(filtered);

                    // Tự động chọn category đầu tiên và trigger load service
                    if (filtered.length > 0) {
                        categorySelect.value = filtered[0].id;

                        // Trigger cả 2 event để chắc chắn
                        categorySelect.dispatchEvent(new Event('change'));
                        $(categorySelect).trigger('select2:select');
                    } else {
                        updateServiceSelect([]);
                    }
                }

                // ==================== LOAD SERVICES THEO CATEGORY ====================
                function loadServicesByCategory(categoryId) {
                    if (!categoryId) {
                        updateServiceSelect([]);
                        // Reset tất cả inputs khi không có service
                        resetInputFields();

                        const avgTimeInput = document.getElementById('field-orderform-fields-average_time');
                        const avgTimeContainer = document.getElementById('order_average_time');
                        if (avgTimeInput && avgTimeContainer) {
                            avgTimeInput.value = '';
                            avgTimeInput.placeholder = '{{ __("newOrder.select_service_to_see_average_time") }}';
                            avgTimeContainer.classList.add('hidden');
                        }

                        const descContainer = document.getElementById('service_description');
                        const desc = document.querySelector('#service_description .panel-description');
                        if (descContainer && desc) {
                            desc.innerHTML = '<br>';
                            descContainer.classList.add('hidden');
                        }

                        // Reset charge và symbol
                        const chargeInput = document.getElementById('charge');
                        if (chargeInput) chargeInput.value = '';

                        window.currentCurrencySymbol = '$';
                        window.symbolPosition = 'before';

                        currentServiceRate = 0;
                        return;
                    }

                    const filteredServices = allServices.filter(s => s.category_id == categoryId);

                    updateServiceSelect(filteredServices);

                    if (filteredServices.length > 0) {
                        const firstService = filteredServices[0];
                        updateServiceInfo({
                            id: firstService.id,
                            name: firstService.name,
                            rate: firstService.rate_formatted,
                            min: firstService.min,
                            max: firstService.max,
                            description: firstService.description || '',
                            average_time: firstService.average_time || '',
                            type_service: firstService.type_service || 'Default'
                        });

                        // Tự động chọn service đầu
                        serviceSelect.value = firstService.id;
                        resetInputFields(); // Reset inputs khi load service mới
                        serviceSelect.dispatchEvent(new Event('change'));
                        calculateCharge(); // Tính charge cho service đầu tiên
                    }
                }

                // ==================== CẬP NHẬT SELECT CATEGORY ====================
                function updateCategorySelect(categories) {
                    categorySelect.innerHTML = '';

                    categories.forEach(cat => {
                        const opt = document.createElement('option');
                        opt.value = cat.id;
                        opt.textContent = cat.name;
                        opt.setAttribute('data-platform_id', cat.platform_id);
                        
                        // Tạo HTML icon dựa trên loại dữ liệu
                        let iconHtml = '';
                        if (cat.image) {
                            // Nếu là link (chứa . hoặc /)
                            if (cat.image.includes('.') || cat.image.startsWith('/') || cat.image.match(/^https?:\/\//)) {
                                iconHtml = `<img src="${cat.image}" alt="${cat.name}" loading="lazy" class="me-2" style="width:20px;height:20px;object-fit:contain;border-radius:3px;" />`;
                            } 
                            // Nếu là class icon
                            else {
                                iconHtml = `<i class="${cat.image} me-2" style="font-size: 16px;"></i>`;
                            }
                        }
                        
                        opt.setAttribute('data-icon', iconHtml);
                        categorySelect.appendChild(opt);
                    });

                    // Refresh Select2 để hiển thị icon và options mới
                    $(categorySelect).trigger('change.select2');

                }

                // ==================== CẬP NHẬT SELECT SERVICE ====================
                function updateServiceSelect(services) {
                    serviceSelect.innerHTML = '';

                    services.forEach(service => {
                        const opt = document.createElement('option');
                        opt.value = service.id;
                        opt.textContent = `<span class="select2-selection__id select2-selection__id-4 badge badge-secondary badge-pill rounded-pill">
                ${service.id}
            </span> - ${service.name} - ${service.rate_formatted} per 1000`;

                        // Gắn data attributes
                        ['id', 'name', 'title', 'description', 'min', 'max', 'rate_formatted', 'average_time',
                            'type_service', 'refill', 'cancel', 'dripfeed'
                        ].forEach(key => {
                            if (service[key] !== undefined && service[key] !== null) {
                                opt.setAttribute('data-' + key.replace('_', '-'), service[key]);
                            }
                        });

                        serviceSelect.appendChild(opt);
                    });

                    $(serviceSelect).trigger('change.select2');

                }

                // ==================== CẬP NHẬT INFO SERVICE ====================
                function updateServiceInfo(data) {
                    const rateFormatted = data.rate || '';
                    currentServiceRate = parseFloat(rateFormatted.replace(/[^0-9.-]/g, '')) || 0;

                    // Tách symbol và vị trí
                    const symbolMatch = rateFormatted.match(/[^\d\s.-]+/);
                    window.currentCurrencySymbol = symbolMatch ? symbolMatch[0] : '$';
                    window.symbolPosition = rateFormatted.indexOf(window.currentCurrencySymbol) === 0 ? 'before' :
                        'after';

                    // Cập nhật description
                    const desc = document.querySelector('#service_description .panel-description');
                    const descContainer = document.getElementById('service_description');
                    if (desc) {
                        if (data.description) {
                            desc.innerHTML = data.description.replace(/\n/g, '<br>');
                            descContainer.classList.remove('hidden');
                        } else {
                            desc.innerHTML = '<br>';
                            descContainer.classList.add('hidden');
                        }
                    }

                    // Cập nhật min-max quantity
                    const minMax = document.querySelector('#order_quantity .min-max');
                    if (minMax && data.min && data.max) {
                        minMax.textContent = `Min: ${data.min} - Max: ${data.max}`;
                    }

                    // Cập nhật average time với format đẹp hơn
                    const avgTimeInput = document.getElementById('field-orderform-fields-average_time');
                    const avgTimeContainer = document.getElementById('order_average_time');
                    if (avgTimeInput && avgTimeContainer) {
                        let displayTime = '{{ __("newOrder.not_available") }}';

                        if (data.average_time) {
                            // Nếu average_time là số (phút hoặc giờ)
                            if (!isNaN(data.average_time)) {
                                const minutes = parseInt(data.average_time);
                                if (minutes < 60) {
                                    displayTime = `${minutes} minutes`;
                                } else if (minutes < 1440) { // < 24 hours
                                    const hours = Math.floor(minutes / 60);
                                    const remainingMinutes = minutes % 60;
                                    displayTime = remainingMinutes > 0 ?
                                        `${hours}h ${remainingMinutes}m` :
                                        `${hours} hours`;
                                } else { // >= 24 hours
                                    const days = Math.floor(minutes / 1440);
                                    const remainingHours = Math.floor((minutes % 1440) / 60);
                                    displayTime = remainingHours > 0 ?
                                        `${days}d ${remainingHours}h` :
                                        `${days} days`;
                                }
                            } else {
                                // Nếu là string, hiển thị trực tiếp
                                displayTime = data.average_time;
                            }
                            avgTimeInput.value = displayTime;
                            avgTimeInput.setAttribute('title', `Average completion time: ${displayTime}`);
                            avgTimeContainer.classList.remove('hidden');
                        } else {
                            avgTimeInput.value = '';
                            avgTimeInput.placeholder = '{{ __("newOrder.not_available") }}';
                            avgTimeContainer.classList.add('hidden');
                        }
                    }

                    // ==================== XỬ LÝ HIỂN THỊ/ẨN FIELDS THEO TYPE_SERVICE ====================
                    const typeService = data.type_service || 'Default';
                    
                    // Ẩn tất cả các fields trước
                    const allFields = [
                        'order_link', 'order_quantity', 'order_comment', 'order_username',
                        'order_min', 'order_posts', 'order_old_posts', 'order_check', 
                        'order_delay'
                    ];
                    allFields.forEach(fieldId => {
                        const field = document.getElementById(fieldId);
                        if (field) field.classList.add('hidden');
                    });

                    // Hiển thị fields dựa trên type_service
                    switch (typeService) {
                        case 'Custom Comments':
                            // Custom Comments: link, comment, quantity (readonly)
                            showField('order_link');
                            showField('order_comment');
                            showField('order_quantity');
                            // Make quantity readonly but NOT disabled for Custom Comments
                            if (quantityInput) {
                                quantityInput.disabled = false;
                                quantityInput.readOnly = true;
                                quantityInput.style.backgroundColor = '#f5f5f5';
                                quantityInput.style.cursor = 'not-allowed';
                            }
                            break;

                        case 'Package':
                            // Package: link only
                            showField('order_link');
                            // Enable quantity field for other types
                            if (quantityInput) {
                                quantityInput.disabled = false;
                                quantityInput.readOnly = false;
                                quantityInput.style.backgroundColor = '';
                                quantityInput.style.cursor = '';
                            }
                            break;

                        case 'Subscriptions':
                            // Subscriptions: username, min/max, delay, posts (optional), old_posts (optional), expiry (optional)
                            showField('order_username');
                            showField('order_min');
                            showField('order_delay'); // delay is required, expiry is inside this field
                            showField('order_posts');
                            showField('order_old_posts');
                            // Enable quantity field for other types
                            if (quantityInput) {
                                quantityInput.disabled = false;
                                quantityInput.readOnly = false;
                                quantityInput.style.backgroundColor = '';
                                quantityInput.style.cursor = '';
                            }
                            break;

                        case 'Default':
                        default:
                            // Default: link, quantity, dripfeed
                            showField('order_link');
                            showField('order_quantity');
                            showField('order_check');
                            // Enable quantity field for Default type
                            if (quantityInput) {
                                quantityInput.disabled = false;
                                quantityInput.readOnly = false;
                                quantityInput.style.backgroundColor = '';
                                quantityInput.style.cursor = '';
                            }
                            break;
                    }

                    // Helper function to show field
                    function showField(fieldId) {
                        const field = document.getElementById(fieldId);
                        if (field) field.classList.remove('hidden');
                    }

                }

                // ==================== TÍNH TOÁN CHARGE ====================
                function calculateCharge() {
                    const quantityInput = document.getElementById('field-orderform-fields-quantity');
                    const chargeInput = document.getElementById('charge');

                    if (!chargeInput) return;

                    let quantity = parseInt(quantityInput?.value) || 1;
                    const totalCharge = currentServiceRate * quantity / 1000;

                    if (currentServiceRate > 0) {
                        chargeInput.value = formatChargeWithSymbol(totalCharge);
                    } else {
                        chargeInput.value = '';
                    }
                }

                // ==================== RESET INPUT FIELDS ====================
                function resetInputFields() {
                    // Reset link input
                    const linkInput = document.getElementById('field-orderform-fields-link');
                    if (linkInput) linkInput.value = '';

                    // Reset quantity input
                    const quantityInput = document.getElementById('field-orderform-fields-quantity');
                    if (quantityInput) quantityInput.value = '';
                }

                // ==================== FORMAT CHARGE WITH SYMBOL ====================
                function formatChargeWithSymbol(amount) {
                    const symbol = window.currentCurrencySymbol || '$';
                    const position = window.symbolPosition || 'before';

                    // Format số ngắn gọn: loại bỏ số 0 thừa ở cuối
                    let formattedAmount = parseFloat(amount.toFixed(10)).toString();

                    return position === 'before' ? symbol + formattedAmount : formattedAmount + symbol;
                }

                // ==================== KHỞI TẠO ====================
                document.querySelector('.platforms-item button[data-platform-id="all"]').classList.add('active');
                loadCategoriesByPlatform('all');

                // Khởi tạo tooltips cho Bootstrap
                if (typeof $().tooltip === 'function') {
                    $('[data-toggle="tooltip"]').tooltip();
                }

                // Khởi tạo charge ban đầu
                calculateCharge();

                // ==================== XỬ LÝ SUBMIT FORM ====================
                const orderForm = document.getElementById('order-form');
                const submitBtn = document.getElementById('submit-btn');
                const alertErrorDiv = document.getElementById('js-order-alert-error');
                const alertSuccessDiv = document.getElementById('js-order-alert-success');

                if (orderForm) {
                    orderForm.addEventListener('submit', function(e) {
                        e.preventDefault();

                        // Disable submit button
                        submitBtn.disabled = true;

                        // Hide previous alerts
                        hideAllAlerts();

                        // Prepare form data
                        const formData = new FormData(orderForm);
                        
                        // Ensure quantity is included even if readonly
                        const quantityInput = document.getElementById('field-orderform-fields-quantity');
                        if (quantityInput && quantityInput.value) {
                            formData.set('quantity', quantityInput.value);
                        }
                        
                        // Ensure comments are included for Custom Comments
                        const commentsInput = document.getElementById('field-orderform-fields-comments');
                        if (commentsInput && commentsInput.value) {
                            formData.set('comments', commentsInput.value);
                        }
                        
                        // Debug log
                        console.log('Form Data:', {
                            service: formData.get('service'),
                            link: formData.get('link'),
                            quantity: formData.get('quantity'),
                            comments: formData.get('comments')
                        });
 
                        // Send AJAX request
                        fetch(orderForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        ?.getAttribute('content') ||
                                        document.querySelector('input[name="_token"]')?.value
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                const orderData = data.data || {};
                                const order = orderData.order || {};
                                const errorMessage = orderData.error_message || null;
                                const hasApiError = orderData.has_api_error || false;

                                // If API returned an error, show error message
                                if (hasApiError && errorMessage) {
                                    showAlert('error', errorMessage);
                                } else if (data.success) {
                                    // Success - show success message with order details
                                    let successMessage = `<h4>{{ __("newOrder.order_received") }}</h4>`;
                                    if (order.id) successMessage += `ID: ${order.id}<br>`;
                                    if (order.service) successMessage += `Service: ${order.service}<br>`;
                                    if (order.link) successMessage += `Link: ${order.link}<br>`;
                                    if (order.quantity) successMessage += `Quantity: ${order.quantity}<br>`;
                                    if (order.comments) {
                                        const commentLines = order.comments.split('\n').length;
                                        successMessage += `Comments: ${commentLines} lines<br>`;
                                    }
                                    if (order.charge) successMessage += `Charge: ${order.charge}<br>`;
                                    if (order.balance) successMessage += `Balance: ${order.balance}<br>`;

                                    showAlert('success', successMessage);

                                    // Reset form inputs
                                    const linkInput = document.getElementById(
                                    'field-orderform-fields-link');
                                    const quantityInput = document.getElementById(
                                        'field-orderform-fields-quantity');
                                    const commentsInput = document.getElementById(
                                        'field-orderform-fields-comments');
                                    const chargeInput = document.getElementById('charge');

                                    if (linkInput) linkInput.value = '';
                                    if (quantityInput) quantityInput.value = '';
                                    if (commentsInput) commentsInput.value = '';
                                    if (chargeInput) chargeInput.value = '';
                                } else {
                                    // Validation error
                                    let errorMessage = '';

                                    if (data.errors) {
                                        let errorMessages = [];
                                        Object.values(data.errors).forEach(errorArray => {
                                            if (Array.isArray(errorArray)) {
                                                errorMessages = errorMessages.concat(errorArray);
                                            } else {
                                                errorMessages.push(errorArray);
                                            }
                                        });
                                        errorMessage = errorMessages.join('<br>');
                                    } else {
                                        errorMessage = data.message ||
                                            'An error occurred while creating the order.';
                                    }

                                    showAlert('error', errorMessage);
                                }
                            })
                            .catch(error => {
                                console.error('Order submission error:', error);
                                showAlert('error', 'Network error. Please try again.');
                            })
                            .finally(() => {
                                // Re-enable submit button
                                submitBtn.disabled = false;
                                submitBtn.textContent = 'Submit';
                            });
                    });
                }

                function hideAllAlerts() {
                    if (alertErrorDiv) alertErrorDiv.style.display = 'none';
                    if (alertSuccessDiv) alertSuccessDiv.style.display = 'none';
                }

                function showAlert(type, message) {
                    hideAllAlerts();

                    const alertDiv = type === 'success' ? alertSuccessDiv : alertErrorDiv;

                    if (alertDiv) {
                        const textDiv = alertDiv.querySelector('.text');
                        if (textDiv) {
                            textDiv.innerHTML = message;
                        }

                        alertDiv.style.display = 'block';

                        // Scroll to alert
                        alertDiv.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        // Auto hide success alerts after 5 seconds
                        if (type === 'success') {
                            setTimeout(() => {
                                alertDiv.style.display = 'none';
                            }, 5000);
                        }
                    }
                }

                // Handle close button clicks
                document.addEventListener('click', function(e) {
                    if (e.target.matches('.close[data-hide="alert"]') || e.target.closest(
                            '.close[data-hide="alert"]')) {
                        const alertDiv = e.target.closest('.alert');
                        if (alertDiv) {
                            alertDiv.style.display = 'none';
                        }
                    }
                });



                // ==================== SEARCH FUNCTIONALITY ====================
                const searchInput = document.getElementById('service-search-input');
                const searchContainer = document.getElementById('search-container');
                const searchDropdownWrapper = document.getElementById('search-dropdown-wrapper');
                const searchResultsList = document.getElementById('search-results-list');
                const searchClearBtn = document.getElementById('search-clear-btn');
                let searchTimeout;
                let isSearchActive = false;

                if (searchInput) {
                    // Handle search input
                    searchInput.addEventListener('input', function() {
                        const query = this.value.trim();

                        // Show/hide clear button
                        if (query.length > 0) {
                            searchClearBtn.style.display = 'block';
                        } else {
                            searchClearBtn.style.display = 'none';
                        }

                        // Clear previous timeout
                        clearTimeout(searchTimeout);

                        if (query.length === 0) {
                            hideSearchResults();
                            return;
                        }

                        if (query.length >= 1) {
                            // Show search results immediately for single character
                            searchTimeout = setTimeout(() => {
                                performSearch(query);
                            }, 200);
                        }
                    });

                    // Handle focus - show dropdown if there's text
                    searchInput.addEventListener('focus', function() {
                        const query = this.value.trim();
                        if (query.length >= 1) {
                            performSearch(query);
                        }
                    });

                    // Handle blur (hide results after a delay)
                    searchInput.addEventListener('blur', function() {
                        setTimeout(() => {
                            if (!isSearchActive) {
                                hideSearchResults();
                            }
                        }, 200);
                    });

                    // Handle Enter key
                    searchInput.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            const firstResult = searchResultsList.querySelector(
                                '.select2-results__option[data-service-id]');
                            if (firstResult) {
                                selectSearchResult(firstResult);
                            }
                        }

                        // Handle arrow keys for navigation
                        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                            e.preventDefault();
                            navigateResults(e.key === 'ArrowDown' ? 'down' : 'up');
                        }
                    });

                    // Handle clear button
                    searchClearBtn.addEventListener('click', function() {
                        searchInput.value = '';
                        searchClearBtn.style.display = 'none';
                        hideSearchResults();
                        searchInput.focus();
                    });

                    // Prevent dropdown from closing when clicking inside
                    searchDropdownWrapper.addEventListener('mousedown', function() {
                        isSearchActive = true;
                    });

                    searchDropdownWrapper.addEventListener('mouseup', function() {
                        setTimeout(() => {
                            isSearchActive = false;
                        }, 100);
                    });
                }

                function performSearch(query) {
                    if (!query) {
                        hideSearchResults();
                        return;
                    }

                    // Show loading
                    showSearchLoading();

                    // Get all services for search
                    let servicesToSearch = allServices;

                    // Search in service ID, name, and rate (LIKE search)
                    const searchResults = servicesToSearch.filter(service => {
                        const searchText = query.toLowerCase();
                        const serviceId = service.id.toString().toLowerCase();
                        const serviceName = service.name.toLowerCase();
                        const serviceRate = service.rate_formatted.toLowerCase();

                        return (
                            serviceId.includes(searchText) ||
                            serviceName.includes(searchText) ||
                            serviceRate.includes(searchText) ||
                            (service.description && service.description.toLowerCase().includes(searchText))
                        );
                    }).slice(0, 20); // Show more results (20)

                    displaySearchResults(searchResults, query);
                }

                function showSearchLoading() {
                    searchResultsList.innerHTML = `
                        <li class="select2-results__option" style="padding: 16px; text-align: center; color: #666;">
                            <i class="fas fa-spinner fa-spin"></i> Searching...
                        </li>
                    `;
                    showSearchDropdown();
                }

                function displaySearchResults(results, query) {
                    // if (results.length === 0) {
                    //     searchResultsList.innerHTML = `
            //         <li class="select2-results__option" style="padding: 16px; text-align: center; color: #666; font-style: italic;">
            //             No services found for "${query}"
            //         </li>
            //     `;
                    //     showSearchDropdown();
                    //     return;
                    // }

                    const resultsHtml = results.map((service, index) => {
                        return `
                            <li role="listitem" class="select2-results__option" 
                                data-service-id="${service.id}"
                                data-category-id="${service.category_id}"
                                style="cursor: pointer;">
                                <a href="#">
                                    <span class="select2-selection__id badge badge-secondary badge-pill rounded-pill">
                                        <span>${service.id}</span>
                                    </span> 
                                    <span class="select2-selection__text">
                                        <span class="service-name">${service.name}</span> 
                                        <span class="service-rate">- ${service.rate_formatted} per 1000</span>
                                    </span> 
                                    <!---->
                                </a>
                            </li>
                        `;
                    }).join('');

                    searchResultsList.innerHTML = resultsHtml;
                    showSearchDropdown();

                    // Add click handlers to results
                    searchResultsList.querySelectorAll('.select2-results__option[data-service-id]').forEach(item => {
                        item.addEventListener('click', function(e) {
                            e.preventDefault();
                            selectSearchResult(this);
                        });

                        // Add hover effects
                        item.addEventListener('mouseenter', function() {
                            // Remove highlight from all items
                            searchResultsList.querySelectorAll('.select2-results__option').forEach(
                                el => {
                                    el.classList.remove('select2-results__option--highlighted');
                                });
                            // Add highlight to current item
                            this.classList.add('select2-results__option--highlighted');
                        });
                    });
                }

                function getBadgeColor(serviceId) {
                    // Generate colors similar to the image
                    const colors = [
                        '#6c9bd1', // Light blue
                        '#7c8db5', // Blue-gray  
                        '#8fa4d3', // Light purple-blue
                        '#5a9fd4', // Medium blue
                        '#4a90e2', // Bright blue
                        '#6fa8dc', // Sky blue
                    ];

                    return colors[serviceId % colors.length];
                }

                // ==================== LOAD SERVICE FROM URL ====================
                function loadServiceFromUrl(service) {

                    // Find the category for this service
                    const category = allCategories.find(c => c.id == service.category_id);
                    if (!category) {
                        console.error(`❌ Category not found for service: ${service.id}`);
                        return;
                    }

                    // Find the platform for this category
                    const platformId = category.platform_id;

                    // Update platform if needed
                    const targetPlatformButton = document.querySelector(`[data-platform-id="${platformId}"]`);
                    if (!targetPlatformButton) {
                        console.error(`❌ Platform button not found for platform ID: ${platformId}`);
                        return;
                    }

                    // Switch platform if needed
                    if (!targetPlatformButton.classList.contains('active')) {

                        document.querySelectorAll('.platforms-item button').forEach(btn => {
                            btn.classList.remove('active');
                        });
                        targetPlatformButton.classList.add('active');
                        loadCategoriesByPlatform(platformId);

                        // Wait for platform change, then select category and service
                        setTimeout(() => {
                            selectCategoryAndService(service.category_id, service.id, service);
                        }, 300);
                    } else {
                        // Platform is already correct, just select category and service
                        selectCategoryAndService(service.category_id, service.id, service);
                    }
                }

                function selectSearchResult(resultItem) {
                    const serviceId = resultItem.getAttribute('data-service-id');
                    const categoryId = resultItem.getAttribute('data-category-id');


                    // Find the service
                    const service = allServices.find(s => s.id == serviceId);
                    if (!service) {
                        console.error(`❌ Service not found: ${serviceId}`);
                        return;
                    }

                    // Find the category
                    const category = allCategories.find(c => c.id == categoryId);
                    if (!category) {
                        console.error(`❌ Category not found: ${categoryId}`);
                        return;
                    }



                    // Update platform if needed
                    const currentActivePlatform = document.querySelector('.platforms-item button.active');
                    const targetPlatformButton = document.querySelector(`[data-platform-id="${category.platform_id}"]`);

                    if (!targetPlatformButton) {
                        console.error(`❌ Platform button not found for platform ID: ${category.platform_id}`);
                        return;
                    }

                    // Always update platform to ensure consistency
                    if (!targetPlatformButton.classList.contains('active')) {

                        // Remove active from all platforms
                        document.querySelectorAll('.platforms-item button').forEach(btn => {
                            btn.classList.remove('active');
                        });

                        // Add active to selected platform
                        targetPlatformButton.classList.add('active');

                        // Load categories for this platform
                        loadCategoriesByPlatform(category.platform_id);

                        // Wait longer for platform change
                        setTimeout(() => {
                            selectCategoryAndService(categoryId, serviceId, service);
                        }, 300);
                    } else {
                        // Platform is already correct, just select category and service
                        selectCategoryAndService(categoryId, serviceId, service);
                    }

                    // Clear search immediately
                    searchInput.value = '';
                    searchClearBtn.style.display = 'none';
                    hideSearchResults();
                }

                function selectCategoryAndService(categoryId, serviceId, service) {

                    // Select category
                    if (categorySelect.value !== categoryId) {
                        categorySelect.value = categoryId;
                        categorySelect.dispatchEvent(new Event('change'));
                        $(categorySelect).trigger('select2:select');

                        // Wait for category change to load services
                        setTimeout(() => {
                            selectServiceById(serviceId, service);
                        }, 200);
                    } else {
                        // Category is already selected, just select service
                        selectServiceById(serviceId, service);
                    }
                }

                function selectServiceById(serviceId, service) {

                    // Make sure the service exists in the dropdown
                    const serviceOption = serviceSelect.querySelector(`option[value="${serviceId}"]`);
                    if (!serviceOption) {
                        console.error(`❌ Service option not found in dropdown: ${serviceId}`);
                        // Force update the service select with current category services
                        const currentCategoryId = categorySelect.value;
                        const categoryServices = allServices.filter(s => s.category_id == currentCategoryId);
                        updateServiceSelect(categoryServices);

                        // Try again after update
                        setTimeout(() => {
                            const updatedServiceOption = serviceSelect.querySelector(
                                `option[value="${serviceId}"]`);
                            if (updatedServiceOption) {
                                selectServiceFinal(serviceId, service);
                            } else {
                                console.error(`❌ Service still not found after update: ${serviceId}`);
                            }
                        }, 100);
                    } else {
                        selectServiceFinal(serviceId, service);
                    }
                }

                function selectServiceFinal(serviceId, service) {
                    // Select the service
                    serviceSelect.value = serviceId;
                    serviceSelect.dispatchEvent(new Event('change'));
                    $(serviceSelect).trigger('select2:select');

                    // Update service info and calculate charge
                    updateServiceInfo({
                        id: service.id,
                        name: service.name,
                        rate: service.rate_formatted,
                        min: service.min,
                        max: service.max,
                        description: service.description || '',
                        average_time: service.average_time || '',
                        type_service: service.type_service || 'Default'
                    });

                    calculateCharge();


                }


                function showSearchDropdown() {
                    searchContainer.classList.add('select2-container--open');
                    searchDropdownWrapper.style.display = 'block';

                    // Calculate and adjust dropdown height based on content
                    const resultsDiv = searchDropdownWrapper.querySelector('.select2-results > div');
                    const resultsList = searchResultsList;

                    if (resultsDiv && resultsList) {
                        // Get the number of items
                        const itemCount = resultsList.querySelectorAll('li').length;

                        // Calculate height: ~40px per item, max 300px
                        const itemHeight = 40;
                        const calculatedHeight = Math.min(itemCount * itemHeight, 300);

                        // Set the max-height dynamically
                        resultsDiv.style.maxHeight = calculatedHeight + 'px';
                        resultsDiv.style.overflowY = calculatedHeight >= 300 ? 'auto' : 'visible';
                    }
                }

                function hideSearchResults() {
                    searchContainer.classList.remove('select2-container--open');
                    searchDropdownWrapper.style.display = 'none';
                }

                function navigateResults(direction) {
                    const results = searchResultsList.querySelectorAll('.select2-results__option[data-service-id]');
                    const highlighted = searchResultsList.querySelector('.select2-results__option--highlighted');

                    if (results.length === 0) return;

                    let newIndex = 0;
                    if (highlighted) {
                        const currentIndex = Array.from(results).indexOf(highlighted);
                        if (direction === 'down') {
                            newIndex = (currentIndex + 1) % results.length;
                        } else {
                            newIndex = currentIndex === 0 ? results.length - 1 : currentIndex - 1;
                        }
                    }

                    // Remove highlight from all
                    results.forEach(el => el.classList.remove('select2-results__option--highlighted'));

                    // Add highlight to new item
                    results[newIndex].classList.add('select2-results__option--highlighted');

                    // Scroll into view
                    results[newIndex].scrollIntoView({
                        block: 'nearest'
                    });
                }

                // ==================== SCHEDULE & LOOP TOGGLE ====================
                const scheduleCheckbox = document.getElementById('is_schedule-time');
                const scheduleContent = document.getElementById('is-schedule-time-content');
                const loopCheckbox = document.getElementById('is_loop');
                const loopFields = document.getElementById('loop-fields');
                const dripfeedCheckbox = document.getElementById('field-orderform-fields-check');
                const dripfeedOptions = document.getElementById('dripfeed-options');

                // Toggle Schedule Time
                if (scheduleCheckbox && scheduleContent) {
                    scheduleCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            scheduleContent.classList.remove('hidden');
                        } else {
                            scheduleContent.classList.add('hidden');
                            document.getElementById('schedule-time').value = '';
                        }
                    });
                }

                // Toggle Loop Fields
                if (loopCheckbox && loopFields) {
                    loopCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            loopFields.classList.remove('hidden');
                        } else {
                            loopFields.classList.add('hidden');
                            document.getElementById('loop_quantity').value = '';
                            document.getElementById('loop_spacing').value = '';
                        }
                    });
                }

                // Toggle Drip-feed Options
                if (dripfeedCheckbox && dripfeedOptions) {
                    dripfeedCheckbox.addEventListener('change', function() {
                        if (this.checked) {
                            dripfeedOptions.classList.remove('hidden');
                        } else {
                            dripfeedOptions.classList.add('hidden');
                            // Clear drip-feed fields
                            const runsInput = document.getElementById('field-orderform-fields-runs');
                            const intervalInput = document.getElementById('field-orderform-fields-interval');
                            if (runsInput) runsInput.value = '';
                            if (intervalInput) intervalInput.value = '';
                        }
                    });
                }

                // ==================== KHỞI TẠO SELECT2 VỚI FORMATTER ====================
                // Formatter function cho category select
                function formatCategoryOption(item) {
                    if (!item.id) return item.text;
                    
                    const iconHtml = jQuery(item.element).data('icon') || '';
                    
                    if (iconHtml) {
                        return jQuery(`<span class="d-flex align-items-center">${iconHtml}${item.text}</span>`);
                    }
                    
                    return item.text;
                }

                // Khởi tạo Select2 cho category
                $(categorySelect).select2({
                    templateResult: formatCategoryOption,
                    templateSelection: formatCategoryOption,
                    allowClear: false,
                    width: '100%'
                });

                // Khởi tạo Select2 cho service
                $(serviceSelect).select2({
                    allowClear: false,
                    width: '100%'
                });

            });
        </script>
    @endpush
