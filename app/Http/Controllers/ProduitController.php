<?php

namespace App\Http\Controllers;

use App\Category;
use App\produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProduitController extends Controller
{
    public function index(){
        $produits=produit::all();
        $categories=Category::all();
        return view('admin.produits.index')->with('produits',$produits)->with('categories',$categories);
    }

    public function store(Request $request){
        $produits=new produit();
        $produits->name=$request->name;
        $produits->category_id=$request->categorie;
        $produits->description=$request->description;
        $produits->price=$request->price;
        $produits->qte=$request->qte;

        $newname=uniqid();
        $image=$request->file('photo');
        $newname.=".". $image->getClientOriginalExtension();
        $destinationpath='uploads';
        $image->move($destinationpath,$newname);
        $produits->photo=$newname;
        if($produits->save()){
            return redirect()->back();
        }else{
            echo"error";
        }
    }
    public function destroy($id){
        $produits=produit::find($id);
        $file_path=public_path().'/uploads/'.$produits->photo;
        unlink($file_path);
        if($produits->delete()){
            return redirect()->back();
        }else{
            return "error";
        }
    }
    public function update(Request $request){
        $produits= produit::find($request->idproduit);

        $produits->name=$request->name;
        $produits->category_id=$request->categorie;
        $produits->description=$request->description;
        $produits->price=$request->price;
        $produits->qte=$request->qte;
        if($request->file('photo')){
            //supprimer ancienne photo
            $file_path=public_path().'/uploads/'.$produits->photo;
            unlink($file_path);
            $newname=uniqid();
            $image=$request->file('photo');
            $newname.=".". $image->getClientOriginalExtension();
            $destinationpath='uploads';
            $image->move($destinationpath,$newname);
            $produits->photo = $newname;

        }
        if($produits->update()){
            return redirect()->back();
        }else{
            echo"error";
        }
    }
}
