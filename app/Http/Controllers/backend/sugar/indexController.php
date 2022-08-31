<?php

namespace App\Http\Controllers\backend\sugar;

use App\Http\Controllers\Controller;
use App\Models\Sugar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $sugars = Sugar::all();
        return view('backend.sugar.index',compact('sugars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.sugar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sugar = new Sugar();
        $sugar->name = $request->name;
        $sugar->slug = Str::slug($request->name);
        $sugar->desc = $request->desc;
        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/sugars'),$imageName);
            $sugar->image = $imageName;
        }
        $sugar->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sugar = Sugar::find($id);
        return view('backend.sugar.edit',compact('sugar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sugar = Sugar::find($id);
        $sugar->name = $request->name;
        $sugar->slug = Str::slug($request->name);
        $sugar->desc = $request->desc;
        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/sugars'),$imageName);
            $sugar->image = $imageName;
        }
        $sugar->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sugar = Sugar::find($id);
        $sugar->delete();
    }
}
