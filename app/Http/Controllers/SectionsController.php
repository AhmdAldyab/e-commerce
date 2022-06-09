<?php

namespace App\Http\Controllers;

use App\images;
use App\products;
use App\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:الاقسام', ['only' => ['index']]);
        $this->middleware('permission:اضافة قسم', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل قسم', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف قسم', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections_main=Sections::where('parent', '=','0')->get();
        $sections=Sections::all();
        return view('sections.section',compact('sections','sections_main'));
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
        $this->validate($request,[
            'section_name' =>'required|max:255|unique:Sections,section_name',
            'section_parent' =>'required',
        ],[
            'section_name.required' =>'يرجى ادخال القسم',
            'section_name.unique'   =>'الاسم مسجل مسبقا',
            'section_parent.required' =>'يرجى ادخال القسم الرئيسي',
        ]);
        Sections::create([
            'section_name'  =>$request->section_name,
            'description'   =>$request->description,
            'parent'        =>$request->section_parent,
        ]);
        session()->flash('Add');
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $sections=Sections::where('parent','0')->get();
        return view('sections.SectionFront',compact('sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
            'section_parent' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'section_parent.required' =>'يرجي ادخال القسم الرئيسي',

        ]);

        $sections = sections::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description'  => $request->description,
            'parent'       =>$request->section_parent,
        ]);

        session()->flash('edit');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        session()->flash('delete');
        return redirect('/sections');
    }
    public function show_section($id)
    {
        $section_name=Sections::where('id',$id)->first()->section_name;
        $images=images::all();
        $products=products::where('section_id',$id)->get();
        return view('sections.show_section',compact('section_name','images','products'));
    }
}
