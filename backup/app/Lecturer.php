<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model {

	public $timestamps = false;
	protected $morphClass = "lecturer";

	public function getNameAttribute($name) {
		return ucwords(strtolower($name));
	}

	public function scopeDosen($q) {
		return $q->whereNotIn('nip', ['0', '1']);
	}

	public function user() {
		return $this->morphOne('App\User', 'personable');
	}

	public function groups() {
		return $this->hasMany('App\Group');
	}

	public function groups_by_period($period){
//		return $this->hasMany('App\Group')->where("semester_id",$period)->where("status");
		return $this->hasMany('App\Group')->where("semester_id",$period);
	}
}
