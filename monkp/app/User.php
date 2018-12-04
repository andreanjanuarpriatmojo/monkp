<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	protected $hidden = ['password'];
	protected $appends = ['role'];
	
	public function getRoleAttribute() {
		if ($this->personable_type == 'App\Student') {
			return 'STUDENT';
		} else if ($this->personable_type == 'App\Lecturer') {
			if ($this->personable->nip == '0') {
				return 'ADMIN';
			} else if ($this->personable->nip == '1') {
				return 'TU';
			} else {
				return 'LECTURER';
			}
		} else {
			return 'UNKNOWN';
		}
	}

	public function personable() {
		return $this->morphTo('personable');
	}

	public function notif() {
		return $this->hasMany('App\Notification');
	}

	public function getPersonableTypeAttribute($type) {
		$type = strtolower($type);
		return 'App\\'. str_replace(' ', '', ucwords($type));
	}

}
