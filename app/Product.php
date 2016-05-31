<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'products';
    protected $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description','created_at','cate_id'];
//    public $timestamps = false;

    public function cate(){
        return $this->belongsTo('App\Cate');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function images (){
        return $this->hasMany('App\Image');
    }

}
