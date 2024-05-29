<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produit extends Model
{
public function category(){
    return $this->belongsTo(Category::class,'category_id','id');
}
/**
 * Get all of the comments for the produit
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function reviews()
{
    return $this->hasMany(Review::class, 'produit_id', 'id');
}
public function lignecommande(){
    return $this->hasMany(lignecommande::class,'produit_id','id');
}
}
