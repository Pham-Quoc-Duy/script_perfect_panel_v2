@extends('clients.theme-4.layouts.app')
@section('title', 'Products')

@section('content')
    <div class="content flex-column-fluid" id="kt_content">
        @include('clients.theme-4.layouts.toolbar', ['toolbarTitle' => 'Products'])
        <div class="post" id="kt_post">

            <div class="card mb-10">
                <div class="card-body">
                    <div class="row g-5">
                        <div class="col-md-4 col-12">
                            <select id="sl-category" class="form-select form-select-solid"
                                onchange="_products.on.change.category(this.value)">
                                <option value="0" data-lang="products.all_category">All category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="input-group input-group-solid">
                                <input type="text" id="ipt-keyword" class="form-control" placeholder="Keyword"
                                    data-lang="products.keyword">
                                <button type="button" id="btn-search" class="btn btn-primary"
                                    onclick="_products.on.click.search()" data-lang="products.search">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="div-products">
                @forelse ($products as $groupId => $groupProducts)
                    @php $group = $groups[$groupId] ?? null; @endphp
                    <div class="row g-5 mb-5">
                        @if ($group)
                            <h4 class="ls-1">{{ $group->name }}</h4>
                            <div class="separator border-3 border-secondary my-2"></div>
                        @endif
                        @foreach ($groupProducts as $product)
                            <div class="col-xxl-2 col-lg-3 col-md-6">
                                <div class="card">
                                    @if ($product->thumbnail)
                                        <a href="/products/{{ $product->slug }}">
                                            <img src="{{ $product->thumbnail }}" class="card-img-top"
                                                style="height:160px;object-fit:cover" alt="{{ $product->name }}">
                                        </a>
                                    @endif
                                    <div class="card-body px-3 py-4">
                                        <p class="mb-1">{{ $product->name }}</p>
                                        <p class="m-0 fw-bolder">
                                            @php
                                                $price = (float) $product->price * ($exRate ?? 1);
                                                $priceStr = rtrim(rtrim(number_format($price, 6, '.', ''), '0'), '.');
                                            @endphp
                                            {{ $sym ?? '$' }}{{ $priceStr }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="text-center text-muted py-10">
                        <i class="bi bi-inbox fs-2x d-block mb-2"></i>
                        <span data-lang="products.no_products">No products found</span>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.jQuery?.fn?.select2) {
                $('#sl-category').select2({
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
                });
            }
        });
    </script>
@endpush
