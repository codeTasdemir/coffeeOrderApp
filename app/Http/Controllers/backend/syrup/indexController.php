<?php

namespace App\Http\Controllers\backend\syrup;

use App\Http\Controllers\Controller;
use App\Models\Syrup;
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
        $syrups = Syrup::all();
        return view('backend.syrup.index',compact('syrups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.syrup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $syrup = new Syrup();
        $syrup->name = $request->name;
        $syrup->slug = Str::slug($request->name);
        $syrup->desc = $request->desc;
        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/syrups'),$imageName);
            $syrup->image = $imageName;
        }
        $syrup->save();
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $syrup = Syrup::find($id);
        return view('backend.syrup.edit',compact('syrup'));
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
        $syrup = Syrup::find($id);
        $syrup->name = $request->name;
        $syrup->slug = Str::slug($request->name);
        $syrup->desc = $request->desc;
        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/syrups'),$imageName);
            $syrup->image = $imageName;
        }
        $syrup->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syrup = Syrup::find($id);
        $syrup->delete();
    }
}
