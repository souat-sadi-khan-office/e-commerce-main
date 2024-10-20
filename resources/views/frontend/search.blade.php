@extends('frontend.layouts.app', ['title' => 'Search - '. get_settings('system_name') ])

@push('page_meta_information')

    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:site_name" content="{{ get_settings('system_name') }}">
    
    <meta name="title" content="{{ $search . ' '. get_settings('sysem_name') }}">
@endpush

@push('breadcrumb')
    <div class="breadcrumb_section page-title-mini">
        <div class="custom-container">
            <div class="row align-items-center">
                <div class="col-md-12 mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <i class="linearicons-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ $search }}
                        </li>
                    </ol>
                </div>

               <div class="row">
                <div class="brands col-md-6">

                    @if (isset($brands))
                    <h6>Related Brands:</h6>
                        @foreach ($brands as $brand)
                            <a class="btn btn-sm btn-fill-out rounded" href="{{ route('slug.handle',$brand->slug) }}">
                                {{ $brand->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
                <div class="categories col-md-6">

                    @if (isset($brands))
                    <h6>Related categories:</h6>
                        @foreach ($categories as $categories)
                            <a class="btn btn-sm btn-fill-out rounded" href="{{ route('slug.handle',$categories->slug) }}">
                                {{ $categories->name }}
                            </a>
                        @endforeach
                    @endif
                </div>
               </div>
            </div>
        </div>
    </div>
@endpush
@push('styles')
    
@endpush
@section('content')
    <div class="section bg_gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row align-items-center mb-4 pb-1">
                        <div class="col-12">
                            <div class="product_header bg_white">
                                <div class="product_header_left">
                                    <h4><b>{{ $search }} </b></h4>

                                    <button class="tool-btn btn btn-line-fill btn-sm" id="lc-toggle">
                                        <i class="fas fa-filter"></i>
                                        Filter
                                    </button>
                                </div>
                                <div class="product_header_right">
                                    <div class="products_view">
                                        <a href="javascript:;" class="shorting_icon grid active">
                                            <i class="fas fa-th-large"></i>
                                        </a>
                                        <a href="javascript:;" class="shorting_icon list">
                                            <i class="fas fa-list"></i>
                                        </a>
                                    </div>
                                    <div class="custom_select">
                                        <select id="sort-by" class="form-control form-control-sm">
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="shop_container grid" id="product-area">
                        <div class="row">
                            @include('frontend.components.product_list',compact('products'))
                        </div>
                    </div>
                    
                   @include('frontend.components.paginate',compact('products'))
                    
                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="search_text" value="{{ $search }}">
@endsection

@push('scripts')
    <script>
        $(document).on('change', '#sort-by', function() {
            let value = $(this).val();
            let search = $('#search_text').val();
            let url = '/search?search='+search+'&sort='+value;
            window.location.href=url;
        })
    </script>
@endpush