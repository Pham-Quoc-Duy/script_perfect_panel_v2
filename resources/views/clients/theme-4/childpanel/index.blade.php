@extends('clients.theme-4.layouts.app')
@section('title', 'Child Panel')

@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Child Panel'])
        <div class="post" id="kt_post">
            <div class="alert alert-primary">
                <p class="m-0" data-lang="childPanel.dns_notice">If you have a domain, change the nameservers and point it to:</p>
                <p class="m-0 fw-bolder">{{ $config->namesv1 ?? '' }}</p>
                <p class="m-0 fw-bolder">{{ $config->namesv2 ?? '' }}</p>
            </div>
            <div class="alert alert-danger" data-lang="childPanel.login_notice">Use your current account on this website to log in to your panel admin.</div>

            <div class="card mb-5">
                <div class="card-body">
                    <label class="form-label" data-lang="childPanel.domain">Domain</label>
                    <div class="input-group input-group-solid">
                        <span class="input-group-text fw-bold">{{ $costFormatted }}</span>
                        <input type="text" id="ipt-domain" class="form-control" placeholder="example.com">
                        <button type="button" id="btn-create" class="btn btn-primary" data-lang="childPanel.create_btn"
                            onclick="_childpanel.on.click.create()">Create child panel</button>
                    </div>
                </div>
            </div>

            {{-- Feature cards --}}
            <div class="row g-5">
                @foreach ([
                    ['icon'=>'la-shopping-cart', 'title'=>'childPanel.unlimited_orders',   'desc'=>'childPanel.unlimited_orders_desc'],
                    ['icon'=>'la-universal-access','title'=>'childPanel.white_label',       'desc'=>'childPanel.white_label_desc'],
                    ['icon'=>'la-credit-card',    'title'=>'childPanel.unlimited_payments', 'desc'=>'childPanel.unlimited_payments_desc'],
                    ['icon'=>'la-rocket',         'title'=>'childPanel.auto_processing',    'desc'=>'childPanel.auto_processing_desc'],
                ] as $f)
                <div class="col-sm-6 col-xl-3 mb-xl-10">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-center flex-column p-5">
                            <div class="m-0 text-center"><i class="las {{ $f['icon'] }} fs-3hx text-gray-600"></i></div>
                            <div class="d-flex flex-column my-5 text-center">
                                <span class="fw-semibold fs-2 text-gray-800 ls-1" data-lang="{{ $f['title'] }}"></span>
                                <span class="fw-semibold fs-7 text-gray-500" data-lang="{{ $f['desc'] }}"></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Steps --}}
            <div class="row g-5">
                @foreach ([
                    [1, 'childPanel.step_buy_domain',  'childPanel.step_buy_domain_desc'],
                    [2, 'childPanel.step_nameservers', 'childPanel.step_nameservers_desc'],
                    [3, 'childPanel.step_order',       'childPanel.step_order_desc'],
                    [4, 'childPanel.step_import',      'childPanel.step_import_desc'],
                    [5, 'childPanel.step_payments',    'childPanel.step_payments_desc'],
                    [6, 'childPanel.step_money',       'childPanel.step_money_desc'],
                ] as [$n, $title, $desc])
                <div class="col-sm-6 col-xl-2 mb-xl-10">
                    <div class="card border border-primary h-lg-100">
                        <div class="card-body d-flex justify-content-between align-items-start flex-column py-1">
                            <div class="d-flex flex-column my-7">
                                <span class="fw-semibold fs-3x text-primary lh-1 ls-n2">{{ $n }}{{ $n < 6 ? ' →' : '' }}</span>
                                <span class="fw-semibold fs-6 text-gray-600" data-lang="{{ $title }}"></span>
                                <span class="fw-semibold fs-7 text-gray-500" data-lang="{{ $desc }}"></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- FAQ --}}
            <div class="row g-5">
                @php
                $faqs = [
                    ['childPanel.faq_smm',       'childPanel.faq_smm_ans',       'kt_acc_1'],
                    ['childPanel.faq_child',      'childPanel.faq_child_ans',     'kt_acc_2'],
                    ['childPanel.faq_providers',  'childPanel.faq_providers_ans', 'kt_acc_3'],
                    ['childPanel.faq_services',   'childPanel.faq_services_ans',  'kt_acc_4'],
                    ['childPanel.faq_manage',     'childPanel.faq_manage_ans',    'kt_acc_5'],
                    ['childPanel.faq_customers',  'childPanel.faq_customers_ans', 'kt_acc_6'],
                ];
                @endphp
                <div class="col-lg-6">
                    <div class="accordion">
                        @foreach (array_slice($faqs, 0, 3) as [$q, $a, $id])
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#{{ $id }}"
                                    data-lang="{{ $q }}"></button>
                            </h2>
                            <div id="{{ $id }}" class="accordion-collapse collapse">
                                <div class="accordion-body" data-lang="{{ $a }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="accordion">
                        @foreach (array_slice($faqs, 3) as [$q, $a, $id])
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#{{ $id }}"
                                    data-lang="{{ $q }}"></button>
                            </h2>
                            <div id="{{ $id }}" class="accordion-collapse collapse">
                                <div class="accordion-body" data-lang="{{ $a }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
