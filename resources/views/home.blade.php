@extends('layouts.master')
@section('title')
    الصفحة الرئيسية
@endsection
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!-- Internal Nice-select css  -->
    <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    



    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <div class="card">
                    <div class="card-body p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ...">
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="button">Search</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-dashboard-header-right">
            <div>
                @can('اضافة منتج')
                <a class="modal-effect btn btn-sm" style="background-color: rgb(160, 193, 241)" data-effect="effect-scale" data-toggle="modal"
                    href="#modaldemo8">اضافة منتج
                </a>
                @endcan
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        <strong>{{ $error }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('Add'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'تمت اضافة المنتج',
                    type: 'success'
                })
            }
        </script>
    @endif
    @if (session()->has('Edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'تمت تعديل المنتج',
                    type: 'success'
                })
            }
        </script>
    @endif
    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'تمت حذف المنتج',
                    type: 'error'
                })
            }
        </script>
    @endif

    @if (session()->has('section'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'يرجى اضافة قسم',
                    type: 'warning'
                })
            }
        </script>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-9 col-lg-9 col-md-12">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3 col-lg-3 col-xl-3  col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                @php
                                    $user = Auth::user()->name ?? '';
                                @endphp
                                @if ($user == $product->Created)
                                    <div class="EditDelete">
                                        <a class="btn btn-info btn-sm modal-effect" data-effect="effect-scale"
                                            data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                            data-price="{{ $product->price }}"
                                            data-description="{{ $product->description }}"
                                            data-section="{{ $product->section->section_name }}" data-toggle="modal"
                                            href="#exampleModal2"><i class="las la-pen"></i></a>
                                        <a class="modal-effect btn btn-danger btn-sm" data-effect="effect-scale"
                                            data-id="{{ $product->id }}" data-name="{{ $product->product_name }}"
                                            data-toggle="modal" href="#modaldemo9"><i class="las la-trash"></i></a>
                                    </div>
                                @endif
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
    <!-- Basic modal -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="home" value="home">
                        <div class="form-group">
                            <input placeholder="يرجى ادخال اسم المنتج" type="text" class="form-control" id="product_name"
                                name="product_name" required>
                        </div>
                        <div class="form-group">
                            <input placeholder="يرجى ادخال سعر المنتج" type="number" class="form-control" id="price"
                                name="price"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="صف المنتج بما يناسبه" class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم</label>
                            <select name="section" id="section" class="form-control" required>
                                <option value="0" selected>-----</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                            <h5 class="card-title">يرجى ادخال صورة المنتج</h5>
                            <input type="file" name="pic" class="dropify" accept=".jpg, .png, image/jpeg, image/png"
                                data-height="70" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">اضافة</button>
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->
    <!-- edit -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="products/update" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="home" value="home">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="form-group">
                            <input type="text" class="form-control" id="product_name" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="price" name="price"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم</label>
                            <select name="section" id="section" class="form-control" required>
                                @foreach ($sections as $section)
                                    <option>{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                            <h5 class="card-title">يرجى ادخال صورة المنتج</h5>
                            <input type="file" name="pic" class="dropify" accept=".jpg, .png, image/jpeg, image/png"
                                data-height="70" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete -->
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="products/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="home" value="home">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="product_name" id="product_name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- row closed -->

    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!-- Internal Nice-select js-->
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>


    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var price = button.data('price')
            var description = button.data('description')
            var section = button.data('section')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #product_name').val(name)
            modal.find('.modal-body #price').val(price)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #section').val(section)
        })
    </script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #product_name').val(name)
        })
    </script>
@endsection
