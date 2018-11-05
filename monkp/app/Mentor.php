<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model {

	public $timestamps = false;

	public function group() {
		return $this->belongsTo('App\Group');
	}

}
