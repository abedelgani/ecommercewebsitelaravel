<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commandes extends Model
{
    public function lignecommandes(){
        return $this->hasMany(lignecommande::class,'commande_id','id');
    }
    public function client(){
        return $this->belongsTo(User::class,'client_id','id');
    }
//total
    public function gettotal(){
        $total =0;
        foreach($this->lignecommandes as $lc){

           $total+= $lc->produit->price*$lc->qte ;
        }
        return $total ;
    }
}
