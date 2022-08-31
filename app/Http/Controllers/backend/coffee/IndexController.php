<?php

namespace App\Http\Controllers\backend\coffee;

use App\Http\Controllers\Controller;
use App\Models\Coffee;
use App\Models\CoffeeCategory;
use App\Models\Milk;
use App\Models\Size;
use App\Models\Sugar;
use App\Models\Syrup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function Psy\bin;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $coffees = Coffee::with('category')->get();
        return view('backend.coffee.index',compact('coffees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $coffeeCategories = CoffeeCategory::all();
        $milks = Milk::all();
        $sugars = Sugar::all();
        $syrups = Syrup::all();
        $sizes = Size::all();
        return view('backend.coffee.create',compact('coffeeCategories','milks','syrups','sugars','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
            $coffee = new Coffee();
            $coffee->name = $request->name;
            $coffee->slug = Str::slug($request->name);
            $coffee->desc = $request->desc;
            $coffee->catId = $request->catId;
            $coffee->sugars = $request->input('syrups');
            $coffee->milks = $request->input('milks');
            $coffee->syrups = $request->input('sugars');
            $coffee->sizes = $request->input('sizes');

            if ($request->hasFile('image')){
                $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
                $upload = $request->image->move(public_path('images/coffees'),$imageName);
                $coffee->image = $imageName;
            }
            $coffee->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $coffee = Coffee::with('category')->find($id);

        $selected_sugars = collect($coffee->sugars);
        $selected_syrups = collect($coffee->syrups);
        $selected_milks = collect($coffee->milks);
        $selected_sizes = collect($coffee->sizes);

        $milks = Milk::whereIn('id',$selected_milks)->get();
        $syrups = Syrup::whereIn('id',$selected_syrups)->get();
        $sugars = Sugar::whereIn('id',$selected_sugars)->get();
        $sizes = Size::whereIn('id',$selected_sizes)->get();

        return view('backend.coffee.show',compact('coffee','milks','syrups','sugars','sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $coffee = Coffee::find($id);
        $milks = Milk::all();
        $sugars = Sugar::all();
        $syrups = Syrup::all();
        $sizes = Size::all();
        $coffeeCategories = CoffeeCategory::all();
        return view('backend.coffee.edit',compact('coffee','coffeeCategories','milks','syrups','sugars','sizes'));
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
        $coffee = Coffee::find($id);
        $coffee->name = $request->name;
        $coffee->slug = Str::slug($request->name);
        $coffee->desc = $request->desc;
        $coffee->catId = $request->catId;
        $coffee->sugars = $request->input('sugars');
        $coffee->milks = $request->input('milks');
        $coffee->syrups = $request->input('syrups');
        $coffee->sizes = $request->input('sizes');

        if ($request->hasFile('image')){
            $imageName  = rand(0,10000).".".$request->file('image')->getClientOriginalExtension();
            $upload = $request->image->move(public_path('images/coffees'),$imageName);
            $coffee->image = $imageName;
        }
        $coffee->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coffee = Coffee::find($id);
        $coffee->delete();
    }
}
