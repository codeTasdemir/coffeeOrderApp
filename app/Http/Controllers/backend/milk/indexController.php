<?php

namespace App\Http\Controllers\backend\milk;

use App\Http\Controllers\Controller;
use App\Models\Milk;
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
        $milks = Milk::all();
        return view('backend.milk.index',compact('milks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.milk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $milk = new Milk();
        $milk->name = $request->name;
        $milk->slug = Str::slug($request->name);
        $milk->desc = $request->desc;
        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/milks'),$imageName);
            $milk->image = $imageName;
        }
        $milk->save();
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $milk = Milk::find($id);
        return view('backend.milk.edit',compact('milk'));
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
        $milk = Milk::find($id);
        $milk->name = $request->name;
        $milk->slug = Str::slug($request->name);
        $milk->desc = $request->desc;
        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/milks'),$imageName);
            $milk->image = $imageName;
        }
        $milk->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $milk = Milk::find($id);
        $milk->delete();
    }
}
