<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function produits(){
        return $this->hasMany(produit::class,'category_id','id');
    }
}
