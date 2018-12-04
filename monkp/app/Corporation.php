<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporation extends Model {

	protected $hidden = ['created_at', 'updated_at'];
	protected $fillable = [
			'name',
			'address',
			'city',
			'post_code',
			'telp',
			'fax',
			'business_type',
			'description'
		];
	protected $appends = ['name_city'];

	public function getNameCityAttribute($a) {
		return $this->name . ' - ' . $this->city;
	}

	public function groups() {
		return $this->hasMany('App\Group');
	}
}
