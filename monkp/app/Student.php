<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

	protected $table = 'students';
    protected $primaryKey = 'id';

	public $timestamps = false;
	protected $morphClass = "student";

	public function user() {
		//return $this->morphOne('App\User', 'personable');
		return $this->hasOne('App\User','username','nrp');
	}

	public function members() {
		return $this->hasMany('App\Member', 'id');
	}

	public function groups() {
		return $this->belongsToMany('App\Group', 'members');
	}
	public function logs() {
		return $this->belongsToMany('App\logs', 'member_id');
	}

}
