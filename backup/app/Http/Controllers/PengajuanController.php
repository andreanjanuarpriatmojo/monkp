<?php 
namespace App\Http\Controllers;

use App\Corporation;
use App\Group;
use App\Student;
use App\Semester;
use App\GroupRequest as Friend;
use App\Notification as Notif;
use Auth;
use Input;
use App\User;
use Response;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class PengajuanController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$corps = Corporation::orderBy('name', 'desc')->get()->toJson();
		$students = Student::where('id', '!=', Auth::user()->personable_id)->orderBy('name', 'asc')->get();
		$data = compact('students', 'corps');
		return view('inside.pengajuan', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if (Semester::current() == null) {
			return redirect()->back();
		}
		$validator = Validator::make($request->all(), [
			'corporation.name' => 'required',
			'corporation.city' => 'required',
			'corporation.address' => 'required',
			'corporation.business_type' => 'required',
			'corporation.description' => 'required',
			'group.end_date' => 'required|date',
			'group.start_date' => 'required|date|before:'. $request['group']['end_date'],
		]);
		if($validator->fails())
		{

			return Redirect::back()->withInput()->withErrors($validator->messages());
		}
		
		$request = $request->all();
		$creq = $request['corporation'];
		$greq = $request['group'];
		# check if student 1 has created group in the same semester
		$now = Semester::current();
		$student = Auth::user()->personable;
		$student_groups = $student->groups->where('semester_id', $now->id);
		foreach ($student_groups as $group) {
			if ($group->status['status'] >= 0 && $group->status['status'] < 3) {
				return redirect()->back()->with('you', true);
			}
		}

		# check if student 2 has created group in the same semester
		$friend_id = $request['friend'];
		$student2 = Student::find($friend_id);
		if ($student2 != null) {
			$groups = $student2->groups->where('semester_id', $now->id);
			foreach ($groups as $group) {
			if ($group->status['status'] >= 0 && $group->status['status'] < 3) {
					return redirect()->back()->with('you', true);
				}
			}
		}
		###fax diganti boleh kosong
		# fill corporation
		$corp = Corporation::firstOrNew(array_only($creq, ['name', 'city']));
		$corp->fill($creq);
		$corp->save();

		# make group
		$group = new Group($greq);
		$group->corporation()->associate($corp);
		$group->status=0;
		$group->comment='';
		$group->lecturer_id=0;
		$group->semester()->associate(Semester::current());
		$group->save();

		# connect group to student
		Auth::user()->personable->groups()->save($group);

		if ($student2 != null) {
			# ngajak orang buat jadi temen kelompok
			$friend = new Friend;
			$friend->group_id = $group->id;
			$friend->status = 0;
			$friend->save();

			# bikin notifnya
			$notif = new Notif;
			$notif->user_id = $student2->user->id;
			//return ;
			$notif->notifiable_id = $friend->id;
			$notif->notifiable_type = 'group request';
			$notif->is_read = false;
			$notif->save();
		}

		return redirect('home');
	}

	public function accept($id)
	{
		$groupreq = Friend::find($id);
		if ($groupreq != null) {
			$student = Auth::user()->personable;
			$groupreq->status = 1;
			$groupreq->notif->is_read = true;
			$groupreq->notif->save();
			$groupreq->save();

			# check if alredy join group
			$now = Semester::current();
			$student_groups = $student->groups->where('semester_id', $now->id);
			foreach ($student_groups as $group) {
				if ($group->status['status'] >= 0) {
					$groupreq->status = 2;
					$groupreq->save();
					return redirect()->back();
				}
			}

			$student->groups()->attach($groupreq->group_id);
		}
		return redirect()->back();
	}

	public function comnt($id)
	{
		$ntf=Notif::find($id);
		if($ntf!=null)
		{
			$ntf->is_read=1;
			$ntf->save();
		}
		return redirect()->back();
	}

	public function reject($id)
	{
		$groupreq = Friend::find($id);
		if ($groupreq != null) {
			$groupreq->status = 2;
			$groupreq->notif->is_read = true;
			$groupreq->notif->save();
			$groupreq->save();
		}
		return redirect()->back();
	}

	public function upload(Request $request)
	{
		//$file= Input::file('image');
		//return $request;
		$validator = Validator::make($request->all(), [
    		'image' => 'required|max:500',
		]);
		$ext=$request->image->getClientOriginalExtension();
		//return $ext;
		if($validator->fails())
		{
			$error="File size more than 500KB";

		}
		else
		if(($ext!="jpg")&&($ext!="jpeg")&&($ext!="pdf")&&($ext!="JPG")&&($ext!="JPEG")&&($ext!="PDF"))
		{
			$error="File is not an jpg/jpeg/pdf your file extension is ".$ext;
		}	
		else
		{
			$input = $request->image;
			//$new_photo_name = $request->image->getClientOriginalExtension();
			$extension = $input->getClientOriginalExtension();
			$new_photo_name = $input->getClientOriginalName();
			$id=$request->id;
			$new_photo_name = $id;
		
			if (file_exists(public_path('surat_keterangan/'.$new_photo_name)))
			{
				$error="File Exist";
			// get current time and append the upload file extension to it,
			// then put that name to $photoName variable
	        }
	        
			$photoName = $new_photo_name.'.'.$ext;
			//$photoName = $new_photo_name;
			
			//talk the select file and move it public directory and make avatars
			//folder if doesn't exsit then give it that unique name.
			
			$input->move(public_path('surat_keterangan'), $photoName);
			if (file_exists(public_path('surat_keterangan/'.$photoName)))
			{
				$group=Group::find($id);
				$group->status="1";
				$group->nama_file=$photoName;
				$group->save();
				$error="File Upload Sukses";
				return Response::json(['success' => true,'error'=> $error]); 
			}
	        else
	        {
	        	$group=Group::find($id);
				$group->status="0";
				$group->save();
	        	$error="File Upload Gagal";
	        }
		}
		return Response::json(['success' => true,'error'=> $error]); 
    }
    public function nohp(Request $r)
    {
    	$usr=User::find(Auth::user()->id);
    	$usr->nohp=$r->nohp;
    	$usr->save();
    	return redirect('/');
    }
}
