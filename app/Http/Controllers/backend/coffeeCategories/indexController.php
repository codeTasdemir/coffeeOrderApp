<?php

namespace App\Http\Controllers\backend\coffeeCategories;

use App\Http\Controllers\Controller;
use App\Models\CoffeeCategory;
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
        $coffeeCategories = CoffeeCategory::all();
        return  view('backend.coffeeCategories.index',compact('coffeeCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return  view('backend.coffeeCategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
            $coffeeCategories = new CoffeeCategory();
            $coffeeCategories->name = $request->name;
            $coffeeCategories->slug = Str::slug($request->name);
            $coffeeCategories->desc = $request->desc;

            if ($request->hasFile('image')){
                $imageName  = rand(0,10000).".".$request->image->getClientOriginalExtension();
                $upload = $request->image->move(public_path('images/coffeeCategories'),$imageName);
                $coffeeCategories->image = $imageName;
            }
            $coffeeCategories->save();
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
        $category = CoffeeCategory::find($id);
        return view('backend.coffeeCategories.edit',compact('category'));
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
        $categories = CoffeeCategory::find($id);
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name);
        $categories->desc = $request->desc;

        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->image->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/coffeeCategories'),$imageName);
            $categories->image = $imageName;
        }
        $categories->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CoffeeCategory::find($id);
        $category->delete();
    }
}
