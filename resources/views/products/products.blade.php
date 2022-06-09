@extends('layouts.master')
@section('title')
    قائمة المنتجات
@endsection
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />

    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة
                    المنتجات</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
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
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"></h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                        @can('اضافة منتج')
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">اضافة منتج</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">ID</th>
                                    <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                    <th class="wd-20p border-bottom-0">الوصف</th>
                                    <th class="wd-15p border-bottom-0">المستخدم</th>
                                    <th class="wd-10p border-bottom-0">القسم</th>
                                    <th class="wd-25p border-bottom-0">السعر</th>
                                    <th class="wd-25p border-bottom-0">صورة المنتج</th>
                                    <th class="wd-25p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=0 @endphp
                                @foreach ($products as $product)
                                    @php $i++  @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>{{ $product->Created }}</td>
                                        <td>
                                            {{ $product->section->section_name }}
                                        </td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            @foreach ($images as $image)
                                                @if ($product->id == $image->product_id)
                                                    @php
                                                        $product_name = $image->product_name;
                                                        $file_name = $image->image_name;
                                                    @endphp
                                                    @can('عرض الصورة')
                                                    <a class="btn btn-outline-success btn-block btn-sm"
                                                        href="{{ url('view_image') }}/{{ $product->product_name }}/{{ $file_name }}"
                                                        role="button">عرض الصورة
                                                    </a>
                                                    @endcan
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>
                                            <div class="dropdown dropleft">
                                                <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-success dropdown-toggle btn-block"
                                                    data-toggle="dropdown" id="dropleftMenuButton" type="button">&nbsp;
                                                    العمليات</button>
                                                <div aria-labelledby="dropleftMenuButton" class="dropdown-menu tx-13">
                                                    @can('تعديل منتج')
                                                    <a class="dropdown-item modal-effect" data-effect="effect-scale"
                                                        data-id="{{ $product->id }}"
                                                        data-name="{{ $product->product_name }}"
                                                        data-price="{{ $product->price }}"
                                                        data-description="{{ $product->description }}"
                                                        data-section="{{ $product->section->section_name }}"
                                                        data-toggle="modal" href="#exampleModal2">تعديل المنتج</a>
                                                    @endcan
                                                    @can('حذف المنتج')
                                                    <a class="dropdown-item modal-effect" data-effect="effect-scale"
                                                        data-id="{{ $product->id }}"
                                                        data-name="{{ $product->product_name }}" data-toggle="modal"
                                                        href="#modaldemo9">حذف المنتج</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                data-height="70" required/>
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
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>

    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

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
        $('#modaldemo9').on('show.bs.modal',function(event){
            var button = $(event.relatedTarget)
            var id =button.data('id')
            var name=button.data('name')
            var modal=$(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #product_name').val(name)
        })
    </script>
@endsection
