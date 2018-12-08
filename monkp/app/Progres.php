<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Progres extends Model {

	protected $table = 'progres';
    protected $primaryKey = 'id';

	public function file_progres() {
		return $this->hasMany('App\FileProgres', 'id');
	}

	public function group() {
		return $this->belongsTo('App\Group');
	}

}
