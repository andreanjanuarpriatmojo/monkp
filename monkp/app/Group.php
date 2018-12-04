<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	protected $fillable = ['status', 'start_date', 'end_date', 'semester_id'];
	protected static $StatusCollection = [
		['status' =>  0, 'name' => 'created', 'desc' => 'Pengajuan kelompok KP baru saja dibuat', 'changeto' => [1, -1]],
		['status' => -1, 'name' => 'denied', 'desc' => 'Pengajuan kelompok KP ditolak oleh Koor KP', 'changeto' => []],
		['status' =>  1, 'name' => 'confirmed', 'desc' => 'Pengajuan kelompok KP telah dikonfirmasi', 'changeto' => [2, -2]],
		['status' => -2, 'name' => 'rejected', 'desc' => 'Pengajuan kelompok KP ditolak perusahaan', 'changeto' => []],
		['status' =>  2, 'name' => 'progress', 'desc' => 'Pengajuan kelompok KP diterima perusahaan', 'changeto' => [3,-2]],
		['status' =>  3, 'name' => 'finished', 'desc' => 'Proses KP telah selesai', 'changeto' => [2]],
	];

	public static function statusAll() {
		return collect(static::$StatusCollection);
	}

	public function getStatusAttribute($status) {
		return collect(static::$StatusCollection)
				->where('status', (int)$status)
				->first();
	}

	public function students() {
		return $this->belongsToMany('App\Student', 'members');
	}

	public function members() {
		return $this->hasMany('App\Member');
	}

	public function corporation() {
		return $this->belongsTo('App\Corporation');
	}

	public function mentor() {
		return $this->hasOne('App\Mentor');
	}

	public function lecturer() {
		return $this->belongsTo('App\Lecturer');
	}

	public function semester() {
		return $this->belongsTo('App\Semester')->select('id');
	}

	public function requests() {
		return $this->hasMany('App\GroupRequest');
	}

}
