@extends('layouts.master')
@section('title')
    {{ $section_name }}
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ $section_name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if (!empty($products))
        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-9 col-lg-9 col-md-12">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3 col-lg-3 col-xl-3  col-sm-3">
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
                                                <span
                                                    class="text-secondary font-weight-normal tx-13 ml-1 prev-price">$59</span>
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <ul class="pagination product-pagination mr-auto float-left">
                    <li class="page-item page-prev disabled">
                        <a class="page-link" href="#" tabindex="-1">Prev</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item page-next">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- row closed -->
    @else
        <div class="alert alert-danger">لا يوجد اي منتجات لعرضها</div>
    @endif
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
