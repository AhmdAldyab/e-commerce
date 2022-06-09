@extends('layouts.master')
@section('title')
    تفاصيل المنتجات
@endsection
@section('css')
    <!--Internal  Nice-select css  -->
    <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <!-- Internal Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"></h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
            </div>
            <div class="mb-3 mb-xl-0">
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body h-100">
                    <div class="row row-sm ">
                        <div class=" col-xl-5 col-lg-12 col-md-12">
                            <div class="preview-pic tab-content">
                                <div class="tab-pane active" id="pic-1"><img
                                        src="{{ URL::asset('assets/images/' . $products->product_name . '/' . $image_name) }}"
                                        alt="image" /></div>
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                <li class="active"><a data-target="#pic-1" data-toggle="tab"></a>
                                </li>
                                <li><a data-target="#pic-2" data-toggle="tab"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="details col-xl-7 col-lg-12 col-md-12 mt-4 mt-xl-0">
                            <h4 class="product-title mb-1">{{ $products->product_name }}</h4>
                            <p class="text-muted tx-13 mb-1">{{ $section_name }}</p>
                            <div class="rating mb-1">
                                <div class="stars">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star text-muted"></span>
                                    <span class="fa fa-star text-muted"></span>
                                </div>
                            </div>
                            <h6 class="price"> السعر الحالي : &nbsp; <span
                                    class="h3 ml-2">{{ $products->price }}&nbsp;$</span></h6>
                            <p class="product-description">{{ $products->description }}</p>
                            <h5 class="product-description"> تم االاضافة بواسطة : {{ $products->Created }}</h5>
                            <div class="d-flex  mt-2">
                                <div class="mt-2 product-title">Quantity:</div>
                                <div class="d-flex ml-2">
                                    <ul class=" mb-0 qunatity-list">
                                        <li>
                                            <div class="form-group">
                                                <select name="quantity" id="select-countries17"
                                                    class="form-control nice-select wd-100">
                                                    <option value="1" selected="">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="action">
                                <button class="add-to-cart btn btn-success" type="button">اضافة الى المفضلة</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row">
        @foreach ($products_other as $product)
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('details_product') }}/{{ $product->id }}">
                            <div class="pro-img-box">
                                <div class="d-flex product-sale">
                                    <div class="badge bg-pink">New</div>
                                </div>
                                <img class="w-100"
                                    src="{{ URL::asset('assets/images/' . \App\images::where('product_id', $product->id)->first()->product_name . '/' . \App\images::where('product_id', $product->id)->first()->image_name) }}"
                                    alt="product-image">
                            </div>
                            <div class="text-center pt-3">
                                <h3 class="h6 mb-2 mt-4 font-weight-bold text-uppercase">
                                    {{ $product->product_name }}
                                </h3>
                                <h4 class="h5 mb-0 mt-2 text-center font-weight-bold text-danger">
                                    ${{ $product->price }}
                                    <span class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$59</span>
                                </h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /row -->

    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="feature2">
                        <i class="mdi mdi-airplane-takeoff bg-purple ht-50 wd-50 text-center brround text-white"></i>
                    </div>
                    <h5 class="mb-2 tx-16">Free Shipping</h5>
                    <span class="fs-14 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua domenus orioneu.</span>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="feature2">
                        <i class="mdi mdi-headset bg-pink  ht-50 wd-50 text-center brround text-white"></i>
                    </div>
                    <h5 class="mb-2 tx-16">Customer Support</h5>
                    <span class="fs-14 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua domenus orioneu.</span>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-4 col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="feature2">
                        <i class="mdi mdi-refresh bg-teal ht-50 wd-50 text-center brround text-white"></i>
                    </div>
                    <div class="icon-return"></div>
                    <h5 class="mb-2  tx-16">30 days money back</h5>
                    <span class="fs-14 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua domenus orioneu.</span>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2.min js -->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!-- Internal Nice-select js-->
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>
@endsection
