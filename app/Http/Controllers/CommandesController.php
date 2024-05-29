<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\commandes;
use App\lignecommande;
use Illuminate\Support\Facades\Auth;
class CommandesController extends Controller
{
    public function store(Request $request){
        //verifier si une commande est en cours pour ce client
        $existe=false;
        $commande=commandes::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        if($commande){ //commande en cours existe
            //check if product existe
          foreach($commande->lignecommandes as $lignelc) {

            if ($lignelc->produit_id==$request->idproduit) {
                $existe=true;
                $lignelc->qte+=$request->qte;
                $lignelc->update();
            }

          }

          if (!$existe) {//existe false
          $lc=new lignecommande();
            $lc->qte=$request->qte;
            $lc->produit_id=$request->idproduit;
            $lc->commande_id=$commande->id;
            $lc->save();
          }
          return redirect('/client/cart')->with('success','produit commander avec success');
            }else{//commande en cours n'existe pas
            //creation de commande
        $commande=new commandes();
        $commande->client_id=Auth::user()->id;
        if ($commande->save()) {
             //creation de ligne de commande
        $lc=new lignecommande();
        $lc->qte=$request->qte;
        $lc->produit_id=$request->idproduit;
        $lc->commande_id=$commande->id;
        $lc->save();
        return redirect('/client/cart')->with('success','produit commander avec success');
//redirection panier
        }else {
            return redirect()->back()->with('error','impossible de commander votre produit');
        }
        }
    }
    public function lignecommandedestroy($idlc){
        $lc=lignecommande::find($idlc);
        $lc->delete();
        return redirect()->back()->with('success','ligne de commande supprimer');

    }
}
