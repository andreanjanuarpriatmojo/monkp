<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use File as FileFacade;

class File extends Model {

	public $timestamps = false;
	protected $guarded = [];
	protected $appends = ['path'];
	protected $download_path = 'storage/upload/';

	public function getPathAttribute() {
		return $this->download_path . $this->saved_name;
	}

	public function delete()
	{
		if (is_null($this->primaryKey)) {
			throw new Exception("No primary key defined on model.");
		}

		if ($this->exists) {
			FileFacade::delete($this->path);
			$this->performDeleteOnModel();
			return true;
		}
	}

}
