<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

	public function student() {
		return $this->belongsTo('App\Student');
	}

	public function group() {
		return $this->belongsTo('App\Group');
	}

	public function grade() {
		return $this->hasOne('App\Grade');
	}

}
