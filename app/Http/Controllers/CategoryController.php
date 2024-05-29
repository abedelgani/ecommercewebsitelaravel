<?php

namespace App\Http\Controllers;

use App\Category;
use Error;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //fonction qui permet d'afficher la liste des categories
    public function index(){
        $categories=Category::all();
        return view('admin.categories.index')->with('categories',$categories);
    }
    //fonction qui permet d'ajouter une categorie
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
        $category=new Category();
        $category->name=$request->name;
        $category->description=$request->description;
        if($category->save()){
        return redirect()->back();
        }

    }
    public function destroy($id){
        $categorie=Category::find($id);
        if($categorie->delete()){
            return redirect()->back();
        }else{
            return "error";
        }
    }
    //pour faire mise a jour de categorie
    public function update(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);
        $id=$request->id_category;
        $categorie=Category::find($id);
        $categorie->name=$request->name;
        $categorie->description=$request->description;
        if($categorie->save()){
            return redirect()->back();
        }else{
            return "error";
        }
    }
}
