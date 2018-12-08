<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FileProgres extends Model {

	protected $table = 'file_progres';
    protected $primaryKey = 'id';

	public function progres() {
		return $this->belongsTo('App\Progres', 'progres_id');
	}

}
