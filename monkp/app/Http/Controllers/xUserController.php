<?php namespace App\Http\Controllers;



use App\Lecturer;

use App\Student;

use App\User;

use Illuminate\Http\Request;



class xUserController extends Controller {



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

			->with('alert', ['alert' => 'success', 'body' => 'Berhasil membuat akun.']);

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

			->with('alert', ['alert' => 'success', 'body' => 'Berhasil membuat akun.']);

	}



	/**

	 * Reset student password, given nrp.

	 *

	 * @return Response

	 */

	public function reset_mhs(Request $request)

	{

		$this->validate($request, [

			'student.nrp' => 'numeric',

		]);

		$student = $request->get('student');

		$nrp = $student['nrp'];

		$obj_student = Student::where('nrp', $nrp)->first();

		$user = $obj_student->user;

		$user->password = bcrypt($nrp);

		$user->save();

		return redirect()->back()

			->with('alert', ['alert' => 'success', 'body' => 'Berhasil mereset password '.$nrp.'.']);

	}



		/**

	 * Reset student password, given nrp.

	 *

	 * @return Response

	 */

	public function reset_lecturer(Request $request)

	{

		$this->validate($request, [

			'lecturer.nip' => 'numeric',

		]);

		$lecturer = $request->get('lecturer');

		$nip = $lecturer['nip'];

		$obj_lecturer = Lecturer::where('nip', $nip)->first();

		$user = $obj_lecturer->user;

		$user->password = bcrypt($nip);

		$user->save();

		return redirect()->back()

			->with('alert', ['alert' => 'success', 'body' => 'Berhasil mereset password '.$nip.'.']);

	}



}

