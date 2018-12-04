<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	public function notifiable() {
		return $this->morphTo('notifiable');
	}

	public function getNotifiableTypeAttribute($type) {
		$type = strtolower($type);
		return 'App\\'. str_replace(' ', '', ucwords($type));
	}

}
