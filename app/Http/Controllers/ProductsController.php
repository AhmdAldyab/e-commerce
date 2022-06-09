<?php

namespace App\Http\Controllers;

use App\products;
use App\Sections;
use App\images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    function __construct()
    {
        
        $this->middleware('permission:المنتجات', ['only' => ['index']]);
        $this->middleware('permission:اضافة منتج', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل منتج', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف المنتج', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Sections::all();
        $products = products::all();
        $images   = images::all();
        return view('products.products', compact('products', 'sections', 'images'));
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
        $this->validate($request, [
            'product_name' => 'required',
            'price'        => 'required',
            'description'  => 'required',
            'section'      => 'required',
            'pic'          => 'required',
            'pic'          => 'mimes:pdf,jpeg,png,jpg',
        ], [
            'product_name.required' => 'يرجى ادخال اسم المنتج',
            'price.required'        => 'يرجى ادخال سعر المنتج',
            'description.required'  => 'يرجى وصف المنتج',
            'section.required'      => 'يرجى ادخال القسم',
            'pic.required'          => 'يرجى ادخال صورة المنتج',
            'pic.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);
        if ($request->section !== '0') {
            //save product
            products::create([
                'product_name' => $request->product_name,
                'price'        => $request->price,
                'description'  => $request->description,
                'section_id'   => $request->section,
                'Created'      => Auth::user()->name
            ]);
            //save image
            $product_id = products::latest()->first()->id;
            $image = $request->file('pic');
            $fill_name = $image->getClientOriginalName();
            images::create([
                'image_name'  => $fill_name,
                'product_name' => $request->product_name,
                'created_by'  => Auth::user()->name,
                'product_id'  => $product_id,
            ]);
            //move image
            $image_name = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('assets/images/' . $request->product_name), $image_name);

            session()->flash('Add');
        } else {
            session()->flash('section');
        }
        if (!empty($request->home)) {
            return redirect('/home');
        } else {
            return redirect('/products');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = products::where('id',$id)->first();
        $sections = Sections::where('id',$products->section_id)->first();
        $section_name=$sections->section_name;
        $images= images::where('product_id',$id)->first();
        $image_name=$images->image_name;
        $products_other = products::where('section_id',$sections->id)->get();
        return view('products.product-details', compact('products', 'section_name', 'image_name','products_other'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section_id = sections::where('section_name', $request->section)->first()->id;
        $id = $request->id;
        $this->validate($request, [
            'product_name' => 'required',
            'price'        => 'required',
            'description'  => 'required',
            'section'      => 'required',
            'pic'          => 'required',
            'pic'          => 'mimes:pdf,jpeg,png,jpg',
        ], [
            'product_name.required' => 'يرجى ادخال اسم المنتج',
            'price.required'        => 'يرجى ادخال سعر المنتج',
            'description.required'  => 'يرجى وصف المنتج',
            'section.required'      => 'يرجى ادخال القسم',
            'pic.required'          => 'يرجى ادخال صورة المنتج',
            'pic.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);
        if ($request->section !== '0') {
            //updata product
            $products = products::find($id);
            $products->update([
                'product_name' => $request->product_name,
                'price'        => $request->price,
                'description'  => $request->description,
                'section_id'   => $section_id,
            ]);

            if (!empty($request->pic)) {
                //delete old image
                $image = $request->file('pic');
                $image_name = $image->getClientOriginalName();
                $image_id = images::where('product_id', $id)->first();
                Storage::disk('public_uploads')->delete($request->product_name . '/' . $image_id->image_name);
                $image_id->delete();
                //save image
                $product_id = products::latest()->first()->id;
                images::create([
                    'image_name'  => $image_name,
                    'product_name' => $request->product_name,
                    'created_by'  => Auth::user()->name,
                    'product_id'  => $product_id,
                ]);
                //move image
                $request->pic->move(public_path('assets/images/' . $request->product_name), $image_name);
            }
            session()->flash('Edit');
        } else {
            session()->flash('section');
        }
        if (!empty($request->home)) {
            return redirect('/home');
        } else {
            return redirect('/products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $image = images::where('product_id', $request->id)->first();
        if (!empty($image)) {
            Storage::disk('public_uploads')->deleteDirectory($request->product_name);
            $image->delete();
        }
        products::find($request->id)->delete();
        session()->flash('delete');
        if (!empty($request->home)) {
            return redirect('/home');
        } else {
            return redirect('/products');
        }
    }
}
