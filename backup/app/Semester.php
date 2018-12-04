<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model {

	protected $table = 'semesters';
	public $timestamps = false;
	protected $guarded = [];

	public function groups() {
		return $this->HasMany('App\Group');
	}

	public static function current() {
		$now = date('Y-m-d');
		
		$semester = static::where('start_date', '<=', $now)
				->where('end_date', '>=', $now)
				->orderBy('start_date')
				->get();
		return $semester->first();
	}

	public static function allowedToRegister() {
		$current = static::current();
		if ($current == null) {
			return false;
		}

		$start = strtotime($current->start_date);
		$end = strtotime($current->user_due_date);
		$now = time();
		return ($now >= $start) && ($now <= $end);
	}

	// public static function now() {
	// 	$year = date('Y');
	// 	$month = date('m');
	// 	$odd = 1;
	// 	if ($month < 8 && $month > 1) {
	// 		$year--;
	// 		$odd--;
	// 	}
	// 	return static::firstOrCreate(compact('year', 'odd'));
	// }

	public function toString() {
		return $this->year . '/'
			. ($this->year + 1) . ' '
			. ($this->odd == 1 ? 'Gasal' : 'Genap');
	}

}
