<?php namespace App\Http\Controllers;

use App\Lecturer;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class xxUserController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('inside.user');
	}

	/**
	 * Store a student in storage.
	 *
	 * @return Response
	 */
	public function student(Request $request)
	{
		$this->validate($request, [
			'student.name' => 'required',
			'student.nrp' => 'required|numeric|unique:users,username',
			'student.password' => 'required',
		]);
		$req = $request->input('student');

		$student = new Student;
		$student->name = $req['name'];
		$student->nrp = $req['nrp'];
		$student->save();

		$user = new User;
		$user->username = $req['nrp'];
		$user->password = bcrypt($req['password']);
		$user->personable_id = $student->id;
		$user->personable_type = 'student';
		$user->save();
		return redirect()->back()
			->with('alert', ['alert' => 'warning', 'body' => 'Berhasil membuat akun.']);
	}

	/**
	 * Store a lecturer in storage.
	 *
	 * @return Response
	 */
	public function lecturer(Request $request)
	{
		$this->validate($request, [
			'lecturer.name' => 'required',
			'lecturer.full_name' => 'required',
			'lecturer.initial' => 'required|alpha|between:2,3',
			'lecturer.nip' => 'required|numeric|unique:users,username',
			'lecturer.password' => 'required',
		]);
		$req = $request->input('lecturer');

		$lecturer = new Lecturer;
		$lecturer->name = $req['name'];
		$lecturer->full_name = $req['full_name'];
		$lecturer->initial = strtoupper($req['initial']);
		$lecturer->nip = $req['nip'];
		$lecturer->save();

		$user = new User;
		$user->username = $req['nip'];
		$user->password = bcrypt($req['password']);
		$user->personable_id = $lecturer->id;
		$user->personable_type = 'lecturer';
		$user->save();
		return redirect()->back()
			->with('alert', ['alert' => 'warning', 'body' => 'Berhasil membuat akun.']);
	}

}
