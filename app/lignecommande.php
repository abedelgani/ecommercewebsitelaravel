<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lignecommande extends Model
{
public function commande(){
    return $this->belongsTo(commande::class,'commande_id','id');
}
public function produit(){
    return $this->belongsTo(produit::class,'produit_id','id');
}

}
