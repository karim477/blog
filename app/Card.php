<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    //
    protected $table = 'cards';

    public $primaryKey = 'id';

    public $timestamps = true;


	public function post(){

		return $this->belongsTo('App\Post');

	}
}
