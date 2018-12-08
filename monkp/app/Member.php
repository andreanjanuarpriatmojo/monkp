<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {

	protected $table = 'members';
    protected $primaryKey = 'id';

	public function student() {
		return $this->belongsTo('App\Student', 'student_id');
	}

	public function group() {
		return $this->belongsTo('App\Group');
	}

	public function grade() {
		return $this->hasOne('App\Grade');
	}

}
