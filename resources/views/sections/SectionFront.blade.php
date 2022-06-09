@extends('layouts.master')
@section('title')
    عرض الاقسام
@endsection
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاقسام</h4>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="row">
                @foreach ($sections as $section)
                    <div class="col-lg-6 col-md-4">
                        <div class="card mg-b-20" id="list">
                            <div class="card-body">
                                <div class="text-wrap">
                                    <div class="example">
                                        <div class="listgroup-example ">
                                            <ul class="list-group">
                                                <li>
                                                    <div>
                                                        <a class="btn ripple"
                                                            href="{{url('show_section')}}/{{$section->id}}" role="button">{{ $section->section_name }}</a>
                                                    </div>
                                                    <ul class="list-style-disc">
                                                        @php
                                                            $section_child = \App\Sections::where('parent', $section->id)->get();
                                                        @endphp
                                                        @foreach ($section_child as $item)
                                                            <li>
                                                                <a class="btn ripple"
                                                                    href="{{url('show_section')}}/{{$item->id}}" role="button">{{ $item->section_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

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
@endsection
