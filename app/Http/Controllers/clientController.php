<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Review;
use App\commandes;
class clientController extends Controller
{
    //fonction qui permet d'afficher le dhasboard client
    public function dashboard(){
        return view('client.dashboard');
    }
    public function profile(){
        return view('client.profile');
    }

    public function updateprofile(Request $request){
        Auth::user()->name=$request->name;
        Auth::user()->email=$request->email;
        if($request->password){// if mot de passe contient valeur
            Auth::user()->password= Hash::make($request->password);
        }
        Auth::user()->update();
        return redirect('/client/profile')->with('success','Client modifier  effectuée avec success ..!');
        }

        public function addreview(Request $request){
          $review=new Review();
          $review->rate=$request->rate;
          $review->produit_id=$request->produit_id;
          $review->content=$request->content;
          $review->user_id=Auth::user()->id;
          $review->save();
          return redirect()->back();
        }
        public function cart(){
            $categories=Category::all();
            $commande=commandes::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
            return view('guest.cart')->with('categories',$categories)->with('commande',$commande);
        }
        public function checkout(Request $request){
            $commande=commandes::find($request->commande);
            $commande->etat="payee";
            //dd($commande->gettotal());
            $commande->update();
            return redirect('/client/dashboard')->with('success','commande payee avec success');
        }
        public function mescommandes(){
          return view('client.commande');
        }
}
