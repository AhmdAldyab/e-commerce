<?php

namespace App\Http\Controllers;

use App\images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $this->middleware('permission:عرض الصورة',['only'=>['show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function show($product_name,$file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($product_name.'/'.$file_name);
        return response()->file($files);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function edit(images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, images $images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\images  $images
     * @return \Illuminate\Http\Response
     */
    public function destroy(images $images)
    {
        //
    }
}
