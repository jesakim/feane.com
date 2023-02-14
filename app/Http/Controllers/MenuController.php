<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.menu',['menu'=> Menu::all(),'loggedUser'=>session('loggedUser')]);

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
        // dd($request->image->extension());
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'image'=>'mimes:png,jpg,jpeg',
            'category'=>'required|in:Fries,Pasta,Pizza,Burger',
        ]);

        // return $request->input();
        $menu = new Menu();

        if($request->hasFile('image')){
            $menu->image = $request->category.'_'.uniqid().'.'.$request->image->extension();
            $request->image->storeAs('public/images',$menu->image);

        }else{
            $menu->image = 'Default.png';

        }
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->category = $request->category;
        $menu->price = $request->price;

        $save=$menu->save();
        if($save){
            return back()->with('success','Product Added Successfully');

        }else{
            return back()->with('fail','Something Wont Wrong');

        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menu $menu)
    {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'category'=>'required|in:Fries,Pasta,Pizza,Burger',
        ]);

        if($request->hasFile('image')){
            $menu->image = $request->category.'_'.uniqid().'.'.$request->image->extension();
            $request->image->storeAs('public/images',$menu->image);

        }
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->category = $request->category;
        $menu->price = $request->price;

        $save=$menu->save();
        if($save){
            return back()->with('success','Product Updated Successfully');

        }else{
            return back()->with('fail','Something Wont Wrong');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index');
    }
}
