<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

	protected $guarded = [];

	public function member() {
		return $this->belongsTo('App\Member');
	}

}
