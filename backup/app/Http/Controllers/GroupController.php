<?php namespace App\Http\Controllers;

use App\Grade;
use App\Group;
use App\Lecturer;
use App\Mentor;
use App\Member;
use App\Semester;
use App\Student;
use App\User;
use App\logs; //log
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Pagination;
use App\Notification as Notif;
class GroupController extends Controller {

 /**
  * Display groups listing.
  *
  * @return Response
  */
 public function index(Request $request)
 {
  switch (Auth::user()->role) {
   case 'LECTURER':
   case 'STUDENT':
    $groups = Auth::user()->personable->groups;
    break;
   case 'ADMIN':
   case 'TU':
    $groups = Group::where('status','>=','-2');
    break;
   default:
    return view('home');
    break;
  }
  $stat = $request->input('status');
  $search = $request->input('search');
  if(Auth::user()->role=='LECTURER')
  {
   $idlct=Lecturer::where('nip',Auth::user()->username)->first();
   if ($search != null && $search != '' && $stat != null && $stat != 'null') {
    $groups=Group::where('lecturer_id',$idlct->id)->where('status',$stat)->where(function($q)use($search){
      $q->whereHas('students',function($q)use($search){
       $q->where('name','like','%'.$search.'%');
      })->orwhereHas('corporation',function($q)use($search){
       $q->where('name','like','%'.$search.'%');
      })->orwhereHas('students',function($q)use($search){
       $q->where('nrp','like','%'.$search.'%');
      });
     });
    $groups=$groups->get();
   }
   elseif($search != null && $search != '')
   {
    $groups=Group::where('lecturer_id',$idlct->id)->where(function($q)use($search){
      $q->whereHas('students',function($q)use($search){
       $q->where('name','like','%'.$search.'%');
      })->orwhereHas('corporation',function($q)use($search){
       $q->where('name','like','%'.$search.'%');
      })->orwhereHas('students',function($q)use($search){
       $q->where('nrp','like','%'.$search.'%');
      });
     });
    $groups=$groups->get();
   }
   elseif ($stat != null && $stat != 'null') {
    $groups = Group::where('lecturer_id',$idlct->id)->where('status',$stat)->get();
   }
  }
  elseif(Auth::user()->role=='ADMIN'||Auth::user()->role=='TU')
  {
   if ($search != null && $search != '' && $stat != null && $stat != 'null') {
    $groups =$groups=Group::where('status',$stat)
      ->where(function($q)use($search){
       $q->whereHas('students',function($q)use($search){
        $q->where('name','like','%'.$search.'%');
       })->orwhereHas('corporation',function($q)use($search){
        $q->where('name','like','%'.$search.'%');
       })->orwhereHas('students',function($q)use($search){
        $q->where('nrp','like','%'.$search.'%');
       });
      });
   }
   else if($search != null && $search != '')
   {
    $groups =
     Group::whereHas('corporation', function($q) use ($search) {
      $q->where('name', 'like', '%'.$search.'%');
     })->orWhereHas('students', function($q) use ($search) {
      $q->where('name', 'like', '%'.$search.'%');
     })->orWhereHas('students', function($q) use ($search) {
      $q->where('nrp', 'like', '%'.$search.'%');
     });
   }
   else if ($stat != null && $stat != 'null') {
    $groups = $groups->where('status', $stat);
   }
   $groups=$groups->get();
  }

  $semester_id = $request->input('semester');
  if ($semester_id != null && $semester_id != 'null') {
   if (Semester::find($semester_id) != null) {
    $groups = $groups->where('semester_id', intval($semester_id));
   } 
   return $semester_id = null;
  }
  $lecturers = Lecturer::dosen()->get()->sortBy('initial');

  $total = $groups->count();
  $perPage = 10;
  $page = $request->input('page');
  $page == null ? 1 : $page;
  $option = ['path' => url('home')];

  if($groups->count()!=0)
  {
   $groups = new Pagination($groups, $total, $perPage, $page, $option);
   $error="ada ".$total." kelompok ditemukan";  
   $data = compact('groups', 'lecturers', 'stat', 'search', 'semester_id','error');
   //return $groups;
   return view('inside.kelompok', $data);  
  }
  $error="tidak ada kelompok ditemukan";
  //$groups = new Pagination($groups, $total, $perPage, $page, $option);
  $data = compact('groups', 'lecturers', 'stat', 'search', 'semester_id');
  //return Auth::user()->notif;
  return view('inside.kelompok', $data);
 }

 /**
  * Get group by given group_id with grade.
  *
  * @param  int  $id
  * @return string
  */
 public function getGroupWithGrade($id) {
  $with = ['members.grade', 'members.student'];
  return Group::with($with)->find($id)->toJson();
 }
 public function getGroupWithlog($id) { //log masih error
  return DB::table('logs')
            ->join('members', 'logs.member_id', '=', 'members.id')
            ->join('students', 'student_id', '=', 'students.id')
            ->join('lecturers', 'editor_id', '=', 'nip')
            ->select('logs.id', 'nrp', 'students.name as student_name', 'lecturer_grade', 'mentor_grade', 'discipline_grade','report_status', 'lecturers.name', 'logs.updated_at')
      ->where('members.group_id', '=', $id) ->orderBy('logs.updated_at', 'desc')->get();

 }
 
 /**
  * Update the status and lecturer via json.
  *
  * @param  int  $id
  * @return string
  */
 public function cobaa()
 {
  $id=394;
  $group=Group::find($id);
  $rstat=2;
  $rlect=52;
  $dosen=Lecturer::find($rlect);
  foreach($group->members as $member) {
    //echo $member;

    //$member->grade()->save(new Grade);
  }

  //return $dosen;
 }
 public function update(Request $request, $id)
 {
  
  $group = Group::find($id);
  if ($group == null) {
   return $this->alert('danger', 'ID kelompok tidak terdaftar.');
  }
  $rstat = $request->input('status');
  $rlect = $request->input('dosen');
  $group->start_date = $request->input('start_date');
  $group->end_date = $request->input('end_date');
  if($request->input('comment')==null)
  {
   $group->comment='';
  }
  return $group->comment=$request->input('comment');
  
  //return $this->alert('danger', $rlect);
  if ($rstat == 2) {
   if ($rlect == '-') {
    return $this->alert('warning', 'Silahkan pilih dosen pembimbing.');
   }
   $dosen = Lecturer::find($rlect);
   if ($dosen == null || $dosen->nip == '0') {
    return $this->alert('danger', 'Dosen tidak ada dalam database.');
   }
   $group->status = $rstat;
   $group->lecturer_id = $rlect;
   foreach($group->members as $member) {
    $ceknilai=Grade::where('member_id',$member->id)->count();
    if($ceknilai==0)#Tidak berulang-ulang
    {
     $grd=new Grade;
     $grd->member_id=$member->id;
     $grd->lecturer_grade=$grd->mentor_grade=$grd->discipline_grade=$grd->report_status=0;
     $grd->save();
    }
   }
   $group->save();
  } 
  else if ($rstat==-2){
   $group->lecturer_id = 0;
   $group->status = $rstat;   
   $group->save();
  } 
  $group->status = $rstat;
  $group->save();
  
  return $this->alert('info', 'Kelompok berhasil diperbarui. Silahkan refresh halaman.');
 }

 /**
  * Update the grade via json.
  *
  * @return string
  */
 public function updateGrade(Request $request) {

  foreach ($request->input('input') as $input) {
   $memberId = $input['id'];
   $lecturerGrade = (int)$input['lecturer_grade'];
   $lecturerGrade = $lecturerGrade < 0 ? 0 : (
    $lecturerGrade > 100 ? 100 : $lecturerGrade
   );

   $mentorGrade = (int)$input['mentor_grade'];
   $mentorGrade = $mentorGrade < 0 ? 0 : (
    $mentorGrade > 100 ? 100 : $mentorGrade
   );

   $disciplineGrade = (int)$input['discipline_grade'];
   $disciplineGrade = $disciplineGrade < 0 ? 0 : (
    $disciplineGrade > 100 ? 100 : $disciplineGrade
   );

   $reportStatus = (int)$input['report_status'];
   $reportStatus = $reportStatus < 0 ? 0 : (
    $reportStatus > 100 ? 100 : $reportStatus
   );

   $fill = compact('member_id','lecturer_grade', 'mentor_grade', 'discipline_grade', 'report_status');

   $member = Member::find($input['id']);
   if ($member->grade == null) {
    //$member->grade()->save(new Grade);
    $grade=Grade::create($fill);
   }
   else if ($member->grade != null)
   {
    $grade = $member->grade;
    $grade->fill($fill);
    $grade->save();
   }
   //Create new LOG
   /*$logs= new logs;
   $logs->member_id = $input['id'];
   $logs->lecturer_grade= $lecturer_grade;
   $logs->mentor_grade=$mentor_grade;
   $logs->discipline_grade=$discipline_grade;
   $logs->report_status=$report_status;
   $id_dosen = Auth::user()->personable->nip;
   $logs->editor_id=$id_dosen;
   $logs->save();*/
  }
  return $this->alert('info', 'Nilai berhasil diperbarui.');
 }

 /**
  * Update the mentor via json.
  *
  * @param  int  $id
  * @return string
  */
 public function updateMentor(Request $request, $id) {
  $group = Group::find($id);
  if ($group == null) {
   return $this->alert('danger', 'ID kelompok tidak terdaftar.');
  }
  if ($group->mentor == null) {
   $mentor = new Mentor;
   $mentor->group_id = $id;
   $mentor->name = $request->input('mentor');
   $mentor->save();
  } else if ($group->mentor != null){
   $group->mentor->name = $request->input('mentor');
   $group->mentor->save();
  }
  return $this->alert('info', 'Mentor berhasil diperbarui.');
 }

 /**
  * Remove the group and related resource.
  *
  * @param  int  $id of Group
  * @return Response
  */
 public function destroy($id)
 {
  $cek=0;
  $group = Group::find($id);
  if(Auth::user()->role=='ADMIN'||Auth::user()->personable->nip=='198407082010122004')
  {
   $cek=1;
  }
  else
  {
   foreach($group->members as $x)
   {
    if(Auth::user()->personable_id==$x->student_id)
    {
     $cek=1;
    }
   }
  }
  if($cek==1)
  {
   //return $group;
   foreach ($group->requests as $request) {
    Notif::where('notifiable_id',$request->id)->delete();
    $request->delete();
   }
   foreach ($group->members as $member) {
    $member->delete();
   }
   $group->delete();
  }
  
  return redirect('/home');
 }

 public function comment(Request $request,$id)
 {
  $group = Group::find($id);
  if ($group == null) {
   return $this->alert('danger', 'ID kelompok tidak terdaftar.');
  }
 }
}