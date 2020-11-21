<?php

namespace App\Http\Controllers;

use App\Dish;
use Illuminate\Http\Request;
use DB;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = DB::table('dishes')
        ->Join('categories', 'dishes.category_id', '=', 'categories.id')
        // ->LeftJoin('dish_restaurant','dishes.category_id', '=', 'dish_restaurant.dish_id')
        ->select('dishes.*','categories.category_name')
        ->get();
        //dd($dishes);
        $restaurants = DB::table('dish_restaurant')
            ->Join('restaurants', 'dish_restaurant.restaurant_id','=', 'restaurants.id')
            ->select('dish_restaurant.dish_id','restaurants.restaurant_name') 
            ->get();

         // dd(($restaurants)->first());
         //dd(($restaurants));
        return view('dishes.index',compact('dishes','restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dishes = DB::table('dishes')
            ->Join('categories', 'dishes.category_id', '=', 'categories.id')
            ->select('dishes.*','categories.category_name')
            ->get();
        $restaurants = DB::table('restaurants')
            ->get(); 
            //dd($dishes);
        $categories = DB::table('categories')
        ->get();

        return view('dishes.create', compact('dishes','restaurants','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());

        DB::table('dishes')->insert([
            ['name'=>$request->name,
            'price' => $request->geographic_coordinate,
            'category_id'=> $request->rw ]
        ]);
        DB::table('dish_restaurant')->insert([
            ['dish_id'=>$request->name,
            'restaurant_id' => $request->geographic_coordinate,]
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
