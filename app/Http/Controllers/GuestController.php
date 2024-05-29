<?php

namespace App\Http\Controllers;

use App\Category;
use App\produit;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home(){
        $categories=Category::all();  //recupper tout les categories de la base de données
        $produits=produit::all();    //recupper tout les produits de la base de données
        return view('guest.home')->with('produits',$produits)->with('categories',$categories);
    }

    public function productdetails($id){
        $produit=produit::find($id);
        $produits=produit::where('id','!=',$id)->get();
        $categories=Category::all();
        return view('guest.product-details')->with('categories',$categories)->with('produit',$produit)->with('produits',$produits);
    }
    public function shop($idcategory){
        $category=Category::find($idcategory);
        //premiere methode
       // $produits=produit::where('category_id',$idcategory)->get();
       //2eme methode avec le modelrelationship relation one to many
       $produits=$category->produits;
        $categories=Category::all();
        return view('guest.shop')->with('categories',$categories)->with('produits',$produits);
    }
    public function search(Request $request){
        $categories=Category::all();
        $produits=produit::where('name','LIKE','%'.$request->keywords .'%')->get();
        return view('guest.shop')->with('categories',$categories)->with('produits',$produits);

    }
}
