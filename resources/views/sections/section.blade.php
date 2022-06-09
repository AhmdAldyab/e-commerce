@extends('layouts.master')
@section('title')
    الاقسام
@endsection
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
    <!--Internal  Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal  treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">


    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    جدول الاقسام</span>
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
                    msg: 'تمت الاضافة بنجاح',
                    type: 'success'
                })
            }
        </script>
    @endif
    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'تمت الحذف بنجاح',
                    type: 'success'
                })
            }
        </script>
    @endif
    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: 'تمت التعديل بنجاح',
                    type: 'success'
                })
            }
        </script>
    @endif

    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0"></h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    @can('اضافة قسم')
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal"
                        href="#modaldemo1">اضافة قسم</a>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">ID</th>
                                    <th class="wd-15p border-bottom-0">الاسم</th>
                                    <th class="wd-15p border-bottom-0">الملاحظات</th>
                                    <th class="wd-15p border-bottom-0">القسم الرئيسي</th>
                                    <th class="wd-15p border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0;  @endphp
                                @foreach ($sections as $section)
                                    @php
                                        $i++;
                                        $father=\App\Sections::where('id',$section->parent)->get();
                                        $son   =\App\Sections::where('parent',$section->id)->get();
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            @if ($section->parent == '0')
                                                <div class="dropdown dropleft">
                                                    <button aria-expanded="false" aria-haspopup="true"
                                                        class="btn ripple btn-outline dropdown-toggle btn-block"
                                                        style="background:#89FDFF " data-toggle="dropdown"
                                                        id="dropleftMenuButton"
                                                        type="button">{{ $section->section_name }}</button>
                                                    <div aria-labelledby="dropleftMenuButton" class="dropdown-menu tx-13">
                                                        @foreach ($son as $item)
                                                            <a class="dropdown-item" href="#">{{$item->section_name}}</a>    
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                {{ $section->section_name }}
                                            @endif
                                        </td>
                                        <td>{{ $section->description }}</td>
                                        <td>
                                            @foreach ($father as $item)
                                                {{$item->section_name}}    
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('تعديل قسم')
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" data-id="{{ $section->id }}"
                                                data-section_name="{{ $section->section_name }}"
                                                data-description="{{ $section->description }}"
                                                data-section_parent="{{ $section->parent }}" href="#exampleModal2"
                                                title="تحديث">
                                                <i class="las la-pen"></i></a>
                                            @endcan
                                            @can('حذف قسم')
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $section->id }}"
                                                data-section_name="{{ $section->section_name }}" data-toggle="modal"
                                                href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                            @endcan
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
    <!-- row closed -->
    <!-- row -->
    <div class="row">
        <div class="card">
            <div class="card-body">
                <ul id="tree3">
                    <li><a href="#">الاقسام</a>
                        <ul>
                            @foreach ($sections_main as $section)
                                <li>{{$section->section_name}}
                                    @php
                                    $son   =\App\Sections::where('parent',$section->id)->get();
                                    @endphp
                                    <ul>
                                        @foreach ($son as $section_child)
                                        <li>{{$section_child->section_name}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /col -->
        </div>
    </div>
    </div>
    <!-- Basic modal -->
    <div class="modal" id="modaldemo1">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('sections.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم</label>
                            <input type="text" class="form-control" id="section_name" name="section_name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم القسم الرئيسي</label>
                            <select name="section_parent" id="section_parent" class="form-control">
                                <option value="0" selected>-----</option>
                                @foreach ($sections_main as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">الملاحظات</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
                <div class="modal-body">

                    <form action="sections/update" method="post" autocomplete="off">
                        {{ method_field('patch') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                            <input class="form-control" name="section_name" id="section_name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">ملاحظات:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">القسم الرئيسي</label>
                            <select name="section_parent" id="section_parent" class="form-control">
                                <option value="0" selected>-----</option>
                                @foreach ($sections_main as $section)
                                    <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                @endforeach
                            </select>
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
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="sections/destroy" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="section_name" id="section_name" type="text" readonly>
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
    <!-- Internal Treeview js -->
    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>

    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var description = button.data('description')
            var parent = button.data('section_parent')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #section_name').val(section_name)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #section_parent').val(parent)
        })
    </script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #section_name').val(section_name)
        })
    </script>
@endsection
