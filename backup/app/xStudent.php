<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class xStudent extends Model {

	public $timestamps = false;
	protected $morphClass = "student";

	public function user() {
		return $this->morphOne('App\User', 'personable');
	}

	public function members() {
		return $this->hasMany('App\Member');
	}

	public function groups() {
		return $this->belongsToMany('App\Group', 'members');
	}

}
