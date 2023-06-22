<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
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
    $val_data = $request->validate([
        "name" => 'required|unique:categories|max:50'
    ]);

    $val_data['slug'] = Str::slug($val_data['name']);

    $new_category = new Category();
    $new_category->fill($val_data);
    $new_category->save();

    return redirect()->back()->with('message', "Categoria {$new_category->name} creata correttamente");
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $val_data = $request->validate(
            [ "name" => 'required|unique:categories|max:50']);

        $val_data['slug'] = Str::slug($val_data['name']);
        $category->update($val_data);
        return redirect()->back()->with('message', "Categoria $category->name aggiornata correttamente ");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)

    {
        $category->delete();
        return back()->with('message', "Categoria {$category->name} eliminata correttamente");


    }
}