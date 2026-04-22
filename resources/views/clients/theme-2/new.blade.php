@extends('clients.theme-2.layouts.app')

@section('content')
    <div class="content_area">
        <div class="top_header">
            <div class="top_head_wrap">
                <div class="item">
                    <button class="sidebar_menu_icon" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="logo_off_nav">
                        <a href="/">
                            <img src="#" class="img-fluid"
                                alt="">
                        </a>
                    </div>
                </div>
                <div class="item">

                </div>
                <div class="item user_settings">


                    <a href="javascript:void(0)" class="day_night_btn" onclick="toggleThemeMode()">
                        <span class="active_circle"></span>
                        <span class="night_mode"> <i class="fas fa-moon"></i> </span>
                        <span class="day_mode"><i class="fas fa-sun"></i></span>
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-secondarybtn_profiles" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <span class="user_top_avatar">
                                <img src="https://storage.perfectcdn.com/hmz1fi/xnihm05yyakf6ouk.png" width="40px"
                                    class="img-fluid" alt="" id="profile2">
                            </span>
                        </button>

                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                            aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                                    <a href="/">
                                        <img src="https://storage.perfectcdn.com/hmz1fi/hjzk7i0ydcb6cf5i.png"
                                            class="img-fluid offcanvas_site_logo" alt="">
                                    </a>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div>
                                    <div class="user_data mb-3">
                                        <div class="user_badges" data-bs-toggle="modal" data-bs-target="#GGstaticBackdrop">
                                            <h4>
                                                FREQUENT
                                            </h4>
                                        </div>
                                        <div class="total_data">
                                            <div class="user_wrap">
                                                <div class="v2_avatar">
                                                    <img src="https://storage.perfectcdn.com/hmz1fi/xnihm05yyakf6ouk.png"
                                                        class="img-fluid" alt="Tech SMM Avatar" id="profile1">
                                                </div>
                                                <div class="v2_user_info">
                                                    <h5>smmkay</h5>
                                                </div>
                                            </div>
                                            <div class="user_balance">
                                                <span class="balance">$0.000</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user_menu_wraper">
                                        <div class="user__menu">
                                            <a class="user_menu__item" href="/account">
                                                <span class="user_menu_icon"><i class="fas fa-cog"></i></span>
                                                <span class="user_menu_text">Settings</span>
                                            </a>

                                            <a class="user_menu__item" href="/terms">
                                                <span class="user_menu_icon"><i class="fas fa-list"></i></span>
                                                <span class="user_menu_text">Terms</span>
                                            </a>
                                            <a class="user_menu__item" href="/faq">
                                                <span class="user_menu_icon"><i class="fas fa-question-circle"></i></span>
                                                <span class="user_menu_text">Faq</span>
                                            </a>
                                            <a class="user_menu__item" href="/logout">
                                                <span class="user_menu_icon"> <i class="fas fa-sign-out"></i></span>
                                                <span class="user_menu_text">Logout</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <!-- page and other top info -->
            <div id="page_info">

            </div>
            <!-- // page and other top info -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user_statistic_wraper">
                            <div class="statistic__item">
                                <div class="statistic_inner">
                                    <div class="icon">
                                        <img src="https://storage.perfectcdn.com/hmz1fi/bcpg233dh40fsdoc.png"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="user__data">
                                        <span>Username</span>
                                        <h4>smmkay</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="statistic__item">
                                <div class="statistic_inner">
                                    <div class="icon">
                                        <img src="https://storage.perfectcdn.com/hmz1fi/raj356puppqixik9.png"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="user__data">
                                        <span>Balance</span>
                                        <h4 class="d-flex gap-2 align-items-center has_currency">
                                            $0.000
                                            <div class="dropdown">
                                                <a class="btn btn-sm fw-bold currency_change_btn" href="#"
                                                    role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    (USD $)
                                                    <i class="fas fa-sort-down"></i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                                    id="currencies-list">
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="AED" data-rate-symbol="د.إ">AED
                                                            د.إ</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="BRL" data-rate-symbol="R$">BRL
                                                            R$</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="CNY" data-rate-symbol="¥">CNY
                                                            ¥</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="EGP" data-rate-symbol="£">EGP
                                                            £</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="EUR" data-rate-symbol="€">EUR
                                                            €</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="INR" data-rate-symbol="₹">INR
                                                            ₹</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="KRW" data-rate-symbol="₩">KRW
                                                            ₩</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="KWD" data-rate-symbol="KD">KWD
                                                            KD</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="NGN" data-rate-symbol="₦">NGN
                                                            ₦</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="PHP" data-rate-symbol="₱">PHP
                                                            ₱</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="PKR" data-rate-symbol="Rs">PKR
                                                            Rs</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="RUB" data-rate-symbol="₽">RUB
                                                            ₽</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="SAR" data-rate-symbol="ر.س">SAR
                                                            ر.س</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="THB" data-rate-symbol="฿">THB
                                                            ฿</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="TRY" data-rate-symbol="₺">TRY
                                                            ₺</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" id="currencies-item"
                                                            data-rate-key="VND" data-rate-symbol="₫">VND
                                                            ₫</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </h4>

                                    </div>
                                </div>
                            </div>

                            <div class="statistic__item">
                                <div class="statistic_inner">
                                    <div class="icon">
                                        <img src="https://storage.perfectcdn.com/hmz1fi/mp50mc1fhx7sm8o1.png"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="user__data">
                                        <span>Total Orders</span>
                                        <h4>23103371</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="statistic__item">
                                <div class="statistic_inner">
                                    <div class="icon">
                                        <img src="https://storage.perfectcdn.com/hmz1fi/aw21tyz9g0kxlk1u.png"
                                            class="img-fluid" alt="">
                                    </div>
                                    <div class="user__data">
                                        <span>Announcement</span>
                                        <h4>
                                            <a href="https://chat.whatsapp.com/F3gmlyQ6C9O2YEIsmOvsks"
                                                class="btn btn-sm btn-primary join_now_btn" target="_blank">Join Now
                                                ➜</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- category Filters -->
            <div id="category_filter" class="mb-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="category_filter_wrap">
                                <div class="card card_v2">
                                    <div class="card-body">
                                        <div class="filter_btn_wrap" id="categoryFIlterWraper">

                                            <button class="btn_filter" onclick="filterStarted('instagram')">
                                                <i class="fab fa-instagram"></i>
                                                <span class="filter_txt">
                                                    Instagram
                                                </span>
                                            </button>
                                            <button class="btn_filter" onclick="filterStarted('Facebook')">
                                                <i class="fab fa-facebook"></i>
                                                <span class="filter_txt">
                                                    Facebook
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('youtube')">
                                                <i class="fab fa-youtube"></i>
                                                <span class="filter_txt">
                                                    Youtube
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Twitter')">
                                                <i class="fab fa-twitter"></i>
                                                <span class="filter_txt">
                                                    Twitter
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Spotify')">
                                                <i class="fab fa-spotify"></i>
                                                <span class="filter_txt">
                                                    Spotify
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Tiktok')">
                                                <i class="fab fa-tiktok"></i>
                                                <span class="filter_txt">
                                                    Tiktok
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Telegram')">
                                                <i class="fab fa-telegram"></i>
                                                <span class="filter_txt">
                                                    Telegram
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Linkedin')">
                                                <i class="fab fa-linkedin"></i>
                                                <span class="filter_txt">
                                                    Linkedin
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Discord')">
                                                <i class="fab fa-discord"></i>
                                                <span class="filter_txt">
                                                    Discord
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterStarted('Traffic')">
                                                <i class="fas fa-globe"></i>
                                                <span class="filter_txt">
                                                    Website Traffic
                                                </span>
                                            </button>

                                            <button class="  btn_filter" onclick="filterOthers()">
                                                <i class="fas fa-star-christmas"></i>
                                                <span class="filter_txt">
                                                    Others
                                                </span>
                                            </button>
                                            <button class="  btn_filter" onclick="filterStarted('everything')">
                                                <i class="far fa-ball-pile"></i>
                                                <span class="filter_txt">
                                                    Everythings
                                                </span>
                                            </button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //category Filters -->

            <!-- New Orders Part -->
            <div class="def_wraper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card_v2">
                                <div class="card-body" id="newOrderTabsWrap">
                                    <ul class="nav nav-pills tab_btn_wrap mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-order-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-order" type="button" role="tab"
                                                aria-controls="pills-order" aria-selected="true"> <i
                                                    class="fas fa-shopping-cart"></i> New Order</button>
                                        </li>
                                        <li class="nav-item" role="presentation" id="pills-addfunds"
                                            data-bs-toggle="pill" data-bs-target="#pills-addfunds" type="button"
                                            aria-controls="pills-addfunds" aria-selected="true">
                                            <button class="nav-link" onclick="window.location.href = '/addfunds'">
                                                <i class="fas fa-credit-card"></i> Add Funds</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab_wrap" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-order" role="tabpanel"
                                            aria-labelledby="pills-order-tab">
                                            <div class="newordersr">
                                                <form action="/" method="post" id="order-form">

                                                    <div class="form-group">
                                                        <div class="search-dropdown select2-container--default select2-container--below"
                                                            style="position: relative;">
                                                            <div class="input-wrapper"><button type="button"
                                                                    class="input-wrapper__prepend"><span
                                                                        class="fas fa-search"></span></button>
                                                                <input placeholder="Search"
                                                                    class="select2-selection select2-selection--single form-control">
                                                                <!---->
                                                            </div> <!---->
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="orderform-category"
                                                            class="control-label">Category</label>
                                                        <select class="form-control select2-hidden-accessible"
                                                            id="orderform-category" name="OrderForm[category]"
                                                            data-select="true" data-select-search="true"
                                                            data-select-search-placeholder="Search" tabindex="-1"
                                                            aria-hidden="true">

                                                        </select><span
                                                            class="select2 select2-container select2-container--default"
                                                            dir="undefined" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single form-control"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-orderform-category-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-orderform-category-container"
                                                                        title="
                      Facebook - Followers | Page data ᴺᴱᵂ
                  "><span><span
                                                                                class="btn-group-vertical align-middle select2-selection__icon">
                                                                                <span
                                                                                    class="fab fa-facebook-square"></span>
                                                                            </span><span
                                                                                class="select2-selection__text">Facebook
                                                                                - Followers | Page data ᴺᴱᵂ
                                                                            </span></span></span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="service" class="control-label">Service</label>
                                                        <select class="form-control select2-hidden-accessible"
                                                            id="orderform-service" name="OrderForm[service]"
                                                            data-select="true" data-select-search="true"
                                                            data-select-search-placeholder="Search" tabindex="-1"
                                                            aria-hidden="true">
                                                            <option data-type="0" value="6954" data-template=""
                                                                data-id="6954"data-name="Facebook - Followers | Max 100k | 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲 𝗣𝗿𝗼𝗳𝗶𝗹𝗲/𝗣𝗮𝗴𝗲 | Bot Data | 5k/day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟"
                                                                data-rate_formatted="$0.0922 per 1000">6954 - Facebook -
                                                                Followers | Max 100k | 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲
                                                                𝗣𝗿𝗼𝗳𝗶𝗹𝗲/𝗣𝗮𝗴𝗲 | Bot Data | 5k/day ~Instant ~ 𝐍𝐎
                                                                𝗥𝗘𝗙𝗜𝗟𝗟 - $0.0922 per 1000 </option>
                                                        </select><span
                                                            class="select2 select2-container select2-container--default"
                                                            dir="undefined" style="width: 100%;"><span
                                                                class="selection"><span
                                                                    class="select2-selection select2-selection--single form-control"
                                                                    role="combobox" aria-haspopup="true"
                                                                    aria-expanded="false" tabindex="0"
                                                                    aria-labelledby="select2-orderform-service-container"><span
                                                                        class="select2-selection__rendered"
                                                                        id="select2-orderform-service-container"
                                                                        title="6954 - Facebook - Followers | Max 100k | 𝗔𝗹𝗹 𝗧𝘆𝗽𝗲 𝗣𝗿𝗼𝗳𝗶𝗹𝗲/𝗣𝗮𝗴𝗲 | Bot Data | 5k/day ~ Instant ~ 𝐍𝐎 𝗥𝗘𝗙𝗜𝗟𝗟 - $0.0922 per 1000"><span><span
                                                                                class="select2-selection__id select2-selection__id-4 badge badge-secondary badge-pill rounded-pill">6954</span>
                                                                            - <span
                                                                                class="select2-selection__text">Facebook
                                                                                - Followers | Max 100k | 𝗔𝗹𝗹
                                                                                𝗧𝘆𝗽𝗲 𝗣𝗿𝗼𝗳𝗶𝗹𝗲/𝗣𝗮𝗴𝗲 |
                                                                                Bot Data | 5k/day ~ Instant ~ 𝐍𝐎
                                                                                𝗥𝗘𝗙𝗜𝗟𝗟</span> - $0.0922 per
                                                                            1000</span></span><span
                                                                        class="select2-selection__arrow"
                                                                        role="presentation"><b
                                                                            role="presentation"></b></span></span></span><span
                                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    </div>

                                                    <div class="mb-3 fields" id="service_description">
                                                        <label for="service_description"
                                                            class="control-label">Description</label>
                                                        <div class="panel-body border-solid border-rounded">Link:
                                                            Facebook profile/page link<br>
                                                            Start: 0-5 Minute<br>
                                                            Speed: 5k per Days<br>
                                                            Refill: No Refill<br>
                                                            <br>
                                                            Quality: Bot Account show on your follower list<br>
                                                            <br>
                                                            Important Notes:<br>
                                                            <br>
                                                            • When the service is experiencing high demand, the
                                                            starting speed may vary.<br>
                                                            • Please avoid placing a second order on the same link
                                                            until the current order is fully completed in the
                                                            system.<br>
                                                            • If you encounter any issues with the service, kindly
                                                            reach out to our support team for assistance.
                                                        </div>
                                                    </div>
                                                    <div id="fields">
                                                        <div class="form-group hidden fields" id="order_user_name">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-user_name">Username</label>
                                                            <input class="form-control w-full" name="OrderForm[user_name]"
                                                                value="" type="text"
                                                                id="field-orderform-fields-user_name">
                                                        </div>

                                                        <div id="dripfeed">
                                                            <div class="form-group fields hidden" id="order_check">
                                                                <div class="form-group__checkbox">
                                                                    <label class="form-group__checkbox-label">
                                                                        <input name="OrderForm[check]" value="1"
                                                                            type="checkbox"
                                                                            id="field-orderform-fields-check">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                    <label for="field-orderform-fields-check"
                                                                        class="form-group__label-title">
                                                                        Drip-feed
                                                                    </label>
                                                                </div>
                                                                <div class="hidden depend-fields" id="dripfeed-options"
                                                                    data-depend="field-orderform-fields-check">
                                                                    <div class="form-group">
                                                                        <label class="control-label"
                                                                            for="field-orderform-fields-runs">Runs</label>
                                                                        <input class="form-control" name="OrderForm[runs]"
                                                                            value="" type="text"
                                                                            id="field-orderform-fields-runs">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label"
                                                                            for="field-orderform-fields-interval">Interval
                                                                            (minutes)</label>
                                                                        <input class="form-control"
                                                                            name="OrderForm[interval]" value=""
                                                                            type="text"
                                                                            id="field-orderform-fields-interval">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label"
                                                                            for="field-orderform-fields-total-quantity">Total
                                                                            quantity</label>
                                                                        <input class="form-control"
                                                                            name="OrderForm[total_quantity]"
                                                                            value="" type="text"
                                                                            id="field-orderform-fields-total-quantity"
                                                                            readonly="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_posts">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-posts">New posts</label>
                                                            <input class="form-control" name="OrderForm[posts]"
                                                                value="" type="text"
                                                                id="field-orderform-fields-posts">
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_old_posts">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-old_posts">Old
                                                                posts</label>
                                                            <input class="form-control" name="OrderForm[old_posts]"
                                                                value="" type="text"
                                                                id="field-orderform-fields-old_posts">
                                                            <small class="help-block max"></small>
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_min">
                                                            <label class="control-label"
                                                                for="order_count">Quantity</label>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        id="order_count" name="OrderForm[min]"
                                                                        value="" placeholder="Min"><small
                                                                        class="help-block min-max">Min: 100 - Max:
                                                                        100&nbsp;000</small>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <input type="text" class="form-control"
                                                                        id="order_count" name="OrderForm[max]"
                                                                        value="" placeholder="Max">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_delay">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label"
                                                                        for="field-orderform-fields-delay">Delay</label>
                                                                    <select class="form-control" name="OrderForm[delay]"
                                                                        id="field-orderform-fields-delay">

                                                                        <option value="0">No delay</option>

                                                                        <option value="300">5 minutes</option>



                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="field-orderform-fields-expiry">Expiry</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control datetime"
                                                                            autocomplete="off" name="OrderForm[expiry]"
                                                                            value="" type="text"
                                                                            id="field-orderform-fields-expiry">
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
                                                                for="field-orderform-fields-comment_username">Username
                                                                of the comment owner</label>
                                                            <input class="form-control" name="OrderForm[comment_username]"
                                                                value="" type="text"
                                                                id="field-orderform-fields-comment_username">
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_answer_number">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-answer_number">Answer
                                                                number</label>
                                                            <input class="form-control" name="OrderForm[answer_number]"
                                                                value="" type="text"
                                                                id="field-orderform-fields-answer_number">
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_email">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-email">Email</label>
                                                            <input class="form-control" name="OrderForm[email]"
                                                                value="" type="text"
                                                                id="field-orderform-fields-email">
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_groups">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-groups">Groups</label>
                                                            <textarea class="form-control" name="OrderForm[groups]" id="field-orderform-fields-groups" cols="30"
                                                                rows="10"></textarea>
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_country">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-country">
                                                                Country
                                                            </label>
                                                            <input class="form-control" name="OrderForm[country]"
                                                                value="" placeholder="US" type="text"
                                                                id="field-orderform-fields-country">
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_device">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-device">
                                                                Device
                                                            </label>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[device]" id="device-1"
                                                                        value="1">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="device-1">Desktop</label>
                                                            </div>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[device]" id="device-2"
                                                                        value="2">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="device-2">Mobile (Android)</label>
                                                            </div>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[device]" id="device-3"
                                                                        value="3">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="device-3">Mobile (iOS)</label>
                                                            </div>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[device]" id="device-4"
                                                                        value="4">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="device-4">Mixed (Mobile)</label>
                                                            </div>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[device]" id="device-5"
                                                                        value="5">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="device-5">Mixed (Mobile &amp;
                                                                    Desktop)</label>
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
                                                                        name="OrderForm[type_of_traffic]"
                                                                        id="type_of_traffic-1" checked=""
                                                                        value="1">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="type_of_traffic-1">Google Keyword</label>
                                                            </div>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[type_of_traffic]"
                                                                        id="type_of_traffic-2" value="2">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="type_of_traffic-2">Custom Referrer</label>
                                                            </div>

                                                            <div class="form-group__checkbox">
                                                                <label class="form-group__checkbox-label">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="OrderForm[type_of_traffic]"
                                                                        id="type_of_traffic-3" value="3">
                                                                    <span class="radiomark"></span>
                                                                </label>
                                                                <label
                                                                    class="form-check-label form-group__label-title mr-5"
                                                                    for="type_of_traffic-3">Blank Referrer</label>
                                                            </div>

                                                        </div>
                                                        <div class="form-group hidden fields" id="order_google_keyword">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-google_keyword">
                                                                Google Keyword
                                                            </label>
                                                            <input class="form-control" name="OrderForm[google_keyword]"
                                                                value="" placeholder="Google Keyword..."
                                                                type="text" id="field-orderform-fields-google_keyword">
                                                        </div>
                                                        <div class="form-group hidden fields" id="order_referring_url">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-referring_url">
                                                                Referring URL
                                                            </label>
                                                            <input class="form-control" name="OrderForm[referring_url]"
                                                                value="" placeholder="https://instagram.com"
                                                                type="text" id="field-orderform-fields-referring_url">
                                                        </div>
                                                        <div class="form-group fields" id="order_average_time"
                                                            style="display: block;">
                                                            <label class="control-label"
                                                                for="field-orderform-fields-average_time">Average
                                                                time
                                                                <span class="ml-1 mr-1 fa fa-exclamation-circle"
                                                                    data-toggle="tooltip" data-placement="right"
                                                                    title=""
                                                                    data-original-title="The average completion time is calculated based on the completion times of the latest orders.">
                                                                </span>
                                                            </label>
                                                            <input class="form-control" readonly="" value=""
                                                                type="text" id="field-orderform-fields-average_time"
                                                                disabled="">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="charge" class="control-label">Charge</label>
                                                        <input type="text" class="form-control" id="charge"
                                                            value="" readonly="">
                                                    </div>
                                                    <input type="hidden" name="_csrf"
                                                        value="HVdnQ75ETLhQi3EUxMl7U0y2mmiIP6RBUpJHXNNUbDZRZFZz5jUK3QO8NkebpyMgO8HjJeFG4TIh_yEUsgMOBQ==">
                                                    <button type="submit"
                                                        class="btn btn-primary d-block w-100">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card_v2">
                                <div class="card-body">
                                    <div id="def_side_title">
                                        <div class="icon">
                                            <i class="fas fa-server"></i>
                                        </div>
                                        <div class="name">
                                            Services Details
                                        </div>
                                    </div>
                                    <div class="tab-content tab_wrap" id="pills-tabContent">
                                        <!-- Details Start -->
                                        <div class="tab-pane fade show active" id="pills-details" role="tabpanel"
                                            aria-labelledby="pills-details-tab">
                                            <div class="details_data">
                                                <div class="item">
                                                    <div class="item_left">
                                                        <div class="icon">
                                                            <i class="fas fa-link"></i>
                                                        </div>
                                                        <h3>Example Link</h3>
                                                    </div>
                                                    <div class="item_content">
                                                        <span data-id="serviceLink" class="serviceLink"> Facebook
                                                            profile/page link<br>
                                                            Start</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details_data">
                                                <div class="item">
                                                    <div class="item_left">
                                                        <div class="icon">
                                                            <i class="fas fa-tachometer-alt-fast"></i>
                                                        </div>
                                                        <h3>Start Time</h3>
                                                    </div>
                                                    <div class="item_content">
                                                        <p><small data-id="serviceStart">-</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details_data">
                                                <div class="item">
                                                    <div class="item_left">
                                                        <div class="icon">
                                                            <i class="fas fa-shipping-fast"></i>
                                                        </div>
                                                        <h3>Speed</h3>
                                                    </div>
                                                    <div class="item_content">
                                                        <p><small data-id="serviceSpeed">-</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details_data">
                                                <div class="item">
                                                    <div class="item_left">
                                                        <div class="icon">
                                                            <i class="fas fa-recycle"></i>
                                                        </div>
                                                        <h3>Guarantee</h3>
                                                    </div>
                                                    <div class="item_content">
                                                        <p><small data-id="serviceRefill"><span
                                                                    class="fas fa-times text-danger"></span></small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details_data">
                                                <div class="item">
                                                    <div class="item_left">
                                                        <div class="icon">
                                                            <i class="fas fa-alarm-clock"></i>
                                                        </div>
                                                        <h3>Avarage Time</h3>
                                                    </div>
                                                    <div class="item_content">
                                                        <p><small id="average_time">15 minutes</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="descriptions_box">
                                                <div data-id="serviceDesc"></div>
                                            </div>
                                        </div>
                                        <!-- //Details Start -->


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // New Orders Part -->



            <script>
                function filterNow(name) {
                    let result = [];
                    let resultHtml = '';
                    let necesItem = name.toLowerCase();

                    for (const item of allCurrentCat) {
                        const itemName = item.name.toLowerCase();
                        const itemIsTrue = itemName.includes(necesItem);
                        if (itemIsTrue == true) {
                            result.push(item);
                        }
                    }
                    if (result.length == 0) {
                        for (const item of allCurrentCat) {
                            resultHtml = resultHtml + `<option value="${item.id}" data-icon="${item.icon}">${item.name}</option>`;
                        }
                    } else {
                        for (const item of result) {
                            resultHtml = resultHtml + `<option value="${item.id}" data-icon="${item.icon}">${item.name}</option>`;
                        }
                    }
                    return resultHtml;
                }

                function filterEverything() {
                    let resultHtml;
                    let result = [];
                    for (const item of allCurrentCat) {
                        result.push(item);
                    }

                    for (const item of result) {
                        resultHtml = resultHtml + `<option value="${item.id}" data-icon="${item.icon}">${item.name}</option>`;
                    }

                    const getCatSelect = document.getElementById('orderform-category');
                    getCatSelect.innerHTML = resultHtml;
                    $('#orderform-category').trigger('change');
                }

                // other filter 
                function filterOthers() {
                    let resultHtml;
                    let result = [];

                    for (const item of allCurrentCat) {
                        const itemName = item.name.toLowerCase();
                        if (!itemName.includes('facebook') && !itemName.includes('instagram') && !itemName.includes('youtube') && !
                            itemName.includes('twitter') && !itemName.includes('spotify') && !itemName.includes('tiktok') && !
                            itemName.includes('linkedin') && !itemName.includes('discord') && !itemName.includes('telegram') && !
                            itemName.includes('traffic')) {
                            result.push(item);
                        }
                    }

                    for (const item of result) {
                        resultHtml = resultHtml + `<option value="${item.id}">${item.name}</option>`;
                    }

                    const getCatSelect = document.getElementById('orderform-category');
                    getCatSelect.innerHTML = resultHtml;
                    $('#orderform-category').trigger('change');
                }

                function filterStarted(targetName) {
                    const getResults = filterNow(targetName);
                    const getCatSelect = document.getElementById('orderform-category');
                    getCatSelect.innerHTML = getResults;
                    $('#orderform-category').trigger('change');
                }


                var getFilterWrap = document.getElementById('categoryFIlterWraper');

                getFilterWrap.addEventListener('click', function(e) {
                    var getallActive = document.getElementsByClassName('activeItem');
                    if (getallActive.length > 0) {
                        for (item of getallActive) {
                            item.classList.remove('activeItem');
                        }
                    }
                    e.target.classList.add('activeItem');
                });
            </script>

        </div>
    </div>
@endsection
