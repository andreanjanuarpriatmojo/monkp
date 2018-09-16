<?php namespace App\Http\Controllers;

use App\Lecturer;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

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
			'student.nrp' => 'required|numeric|unique:users,username,students',
			'student.password' => 'required|min:8',
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
			'lecturer.nip' => 'required|numeric|unique:users,username,lecturers',
			'lecturer.password' => 'required|min:8',
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

	public function reset(Request $request)
	{
		if(!is_null($request->input('student')))
		{
			$this->validate($request, [
				'student.password' => 'required|min:8',
			]);
			$req = $request->input('student');
			$user= User::where('username',$req['nrp']);
			$user->update(['password'=>bcrypt($req['password'])]);
			return redirect()->back()->with('alert', ['alert' => 'warning', 'body' => 'Berhasil reset password akun.']);
		}
		else
		if(!is_null($request->input('lecturer')))
		{
			$this->validate($request, [
				'lecturer.password' => 'required|min:8',
			]);
			$req = $request->input('lecturer');
			$user= User::where('username',$req['nip']);
			$user->update(['password'=>bcrypt($req['password'])]);
			return redirect()->back()->with('alert', ['alert' => 'warning', 'body' => 'Berhasil reset password akun.']);
		}
		return redirect()->back()->with('alert', ['alert' => 'warning', 'body' => 'Gagal reset password akun.']);
	}
}
