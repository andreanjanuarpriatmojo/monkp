<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use App\Semester;
use App\Student;
use App\User;
use Hash;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller {

	/**
	 * The Guard implementation. See Illuminate\Auth\Guard.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->middleware('guest', ['except' => ['getLogout', 'getProfile', 'postProfile']]);
		$this->auth = $auth;
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('home');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		//eturn $request;
		//print "oke";
		$this->validate($request, [
			'username' => 'required', 'password' => 'required',
		]);

		$credentials = $request->only('username', 'password');
		if ($this->auth->attempt($credentials, false))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect()->back()
				->withInput($request->only('username'))
				->withErrors([
					'username' => 'Incorrect username and/or password.',
				]);
	}

	/**
	 * Show the user settings form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getProfile()
	{
		return view('inside.profile');
	}

	/**
	 * Handle user settings.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postProfile(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'password' => 'required|same:password_confirmation|confirmed|min:8',
		]);

		$old = $request->input('old_password');
		$new = $request->input('password');

		if (Hash::check($old, $this->auth->user()->password)) {
			if($validator->fails()) {
				return Redirect::back()->withInput()->withErrors($validator->messages());
			}
			$this->auth->user()->password = Hash::make($new);
			$this->auth->user()->save();
			return redirect('/');
		}

		return redirect()->back()->withErrors(['error' => 'Wrong password.']);
	}

	/**
	 * Show the application register form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		if (Semester::allowedToRegister()) {
			return view('register');
		}
		return redirect()->back()->withErrors(['error' => 'Tidak bisa register sekarang.']);
	}

	/**
	 * Handle a register request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		if (Semester::allowedToRegister()==1) {//buat ngecek waktu pendaftaran kp
			$validator = Validator::make($request->all(), [
                'name' => 'required',
				'nrp' => 'required|numeric|unique:users,username,students',#buat mengecek nrp tidak boleh sama di table student dan user
				'password' => 'required|same:password_confirmation|confirmed|min:8',
				'nohp'=>'required|numeric',
            ]);
			if($validator->fails()) {
				return Redirect::back()->withInput()->withErrors($validator->messages());
			}

			# make student
			$student = new Student();
			$student->nrp = $request->nrp;
			$student->name = $request->name;
			$student->save();

			# make user
			$user = new User();
			$user->username = $request->nrp;
			$user->password = bcrypt($request->password);

			# attach student to user
			$user->personable_id = $student->id;
			$user->personable_type = 'student';
			$user->nohp=$request->nohp;
			$user->save();

			$this->auth->login($user);

			return redirect($this->redirectPath());
		}
		else
		{
			return redirect()->back()->withErrors(['error' => 'Tidak bisa register sekarang.']);
		}
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();
		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
	}

}
