<?php namespace App\Http\Controllers;

use App\Corporation;
use App\Grade;
use App\Group;
use App\Lecturer;
use App\Member;
use App\Semester;
use DB;
use Excel;
use Illuminate\Http\Request;
use Response;
use Illuminate\Pagination\LengthAwarePaginator as Pagination;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getPeriode()
	{
		return view('inside.periode');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postPeriode(Request $request)
	{
		$request = $request->only(['year', 'odd', 'start_date', 'end_date', 'user_due_date']);
		if ($request['year'] < 2000
				|| $request['end_date'] == '' 
				|| $request['user_due_date'] == ''
				|| $request['start_date'] == '' 
		) {
			return redirect()->back()->withInputs($request)
				->with('alert', ['alert' => 'warning', 'body' => 'Lengkapi. Yang benar.']);
		}
		$semester = Semester::firstOrNew(array_only($request, ['year', 'odd']));
		$baru = false;
		if ($semester->id == null) {
			$baru = true;
		}
		$semester->fill($request);
		$semester->save();
		if (!$baru) {
			return redirect()->back()
				->with('alert', ['alert' => 'success', 'body' => 'Berhasil memperbarui semester.']);
		}
		return redirect()->back()
			->with('alert', ['alert' => 'success', 'body' => 'Berhasil membuat semester baru.']);
	}

	/**
	 * Display statistics.
	 *
	 * @return Response
	 */
	public function stats(Request $request, $semester_id = null) {
		$all = true;
		$semester_id = $request->input('semester');
		$tab = $request->input('tab');
		$groups;
		$gr;
		$lects;
		$x;
		if(Semester::find($semester_id) != null) {
			$all = false;
			$groups = Group::where('semester_id',$semester_id)->with('members')->get();
			$lects=Lecturer::where('nip','!=',0)->where('nip','!=',1)->orderBy('initial')->get();
			$corps=Corporation::whereHas('groups',function($q)use($semester_id){
				$q->where('semester_id', $semester_id);
			})->get();
			$gr = Group::where('lecturer_id','!=',0)->where('semester_id',$semester_id)->orderBy('lecturer_id')->get();
		}
		else if(Semester::find($semester_id) == null){
			$all = true;
			$groups = Group::with('members')->get();
			$corps=Corporation::get();
			$lects=Lecturer::where('nip','!=',0)->where('nip','!=',1)->orderBy('initial')->get();
			$gr = Group::where('lecturer_id','!=',0)->orderBy('lecturer_id')->get();
		}

		$jmlpeserta=array();
		foreach ($lects as $x) {
			$jmlpeserta[$x->id]=0;
		}
		foreach ($gr as $x) {
			foreach ($x->students as $member) {
				$jmlpeserta[$x->lecturer_id]=$jmlpeserta[$x->lecturer_id]+1;
			}
		}
		arsort($jmlpeserta);
		$sort=array_keys($jmlpeserta);

		if (isset($_GET['tab']))
			$aktif_tab = $_GET['tab'];

		$aktif_tab=$tab;

		$data = compact('all','semester_id','groups','corps','aktif_tab','jmlpeserta','sort');
		return view('inside.statistic',$data);

		$lects = Corporation::hydrateRaw(
				"SELECT * FROM (
					SELECT lecturers.*, COUNT(groups.id) AS lect_count
					FROM lecturers 
					LEFT JOIN (
						SELECT groups.*
						FROM groups, members
						WHERE groups.id = members.group_id
						$where
						GROUP BY groups.id
					) AS groups ON groups.lecturer_id = lecturers.id
					WHERE nip != 0
					GROUP BY 1) as lecturers
				ORDER BY lect_count DESC, initial");
	}

	public function stats2(Request $request, $semester_id = null) {
		$all = false;
		if (($req = $request->input('semester')) != null) {
			return redirect('stats/' . $req);
		} else if ($semester_id == null || Semester::find($semester_id) == null) {
			$all = true;
		}
		$all = false;

		$where = $all ? '' : "AND groups.semester_id = $semester_id";

		$groups = Group::with('members');
		$groups = $all ? $groups->get() : $groups->where('semester_id', $semester_id)->get();
		$lects = Corporation::hydrateRaw(
				"SELECT * FROM (
					SELECT lecturers.*, COUNT(groups.id) AS lect_count
					FROM lecturers 
					LEFT JOIN (
						SELECT groups.*
						FROM groups, members
						WHERE groups.id = members.group_id
						$where
						GROUP BY groups.id						
					) AS groups ON groups.lecturer_id = lecturers.id
					WHERE nip != 0
					GROUP BY 1) as lecturers
				ORDER BY lect_count DESC, initial");
		$corps = Corporation::hydrateRaw(
				"SELECT * FROM (
					SELECT corporations.*, COUNT(groups.id) AS corp_count
					FROM corporations 
					RIGHT JOIN (
						SELECT groups.*
						FROM groups, members
						WHERE groups.id = members.group_id
						$where
						GROUP BY groups.id						
					) AS groups ON groups.corporation_id = corporations.id
					GROUP BY 1) as corporations
				ORDER BY corp_count DESC");

		$aktif_tab = $_GET['tab'];

		$data = compact('groups', 'corps', 'lects', 'all', 'semester_id','aktif_tab');
		return Response::json($data);
	}

	/**
	 * Display groups listing in table.
	 *
	 * @return Response
	 */
	public function table(Request $request, $semester_id = null) {
		$all = false;

		if (($req = $request->input('semester')) != null) {
			$semester_id=$request->input('semester');
			$all = false;
		} else if ($semester_id == null || Semester::find($semester_id) == null) {
			$all = true;
		}
		$all = false;

		$members = $all ? Member::get() : Member::whereHas('group',
			function ($q) use($semester_id) {
				$q->where('semester_id', $semester_id);
			}
		)->get();

		$total = $members->count();
		$perPage = 15;
		$page = $request->input('page');
		$page == null ? 1 : $page;
		$option = ['path' => url('table')];

		$members = new Pagination($members, $total, $perPage, $page, $option);

		$data = compact('members', 'semester_id', 'all');
		return view('inside.table', $data);
	}

	/**
	 * Display corporation details from modal.
	 *
	 * @param $id corporation_id
	 * @return Response modal view
	 */
	public function showCorporation($id) {
		$corp = Corporation::with('groups.students')->find($id);
		return view('modal.corporation', compact('corp'));
	}

	public function showCorporation2($id,$smt) {
		$corp = Corporation::with('groups.students')->find($id);
		$group=Group::where('semester_id',$smt)->where('corporation_id',$id)->get();
		return view('modal.corporation2', compact('corp','group'));
	}
	/**
	 * Export group and corporation to excel.
	 *
	 * @return File .xls
	 */
	public function export($semester_id = null) {

		$all = false;
		$dt= date("d-M-Y H:i:s", strtotime('+5 hours'));
		if ($semester_id == null) {
			$dt=$dt." ALL Periode";
			$all = true;
		} else if (Semester::find($semester_id) != null) {
			$dt=$dt." Periode ".Semester::find($semester_id)->toString();
			$all = false;
		}
		$membera = $all ? Member::get() : Member::whereHas('group',
			function ($q) use($semester_id) {
				$q->where('semester_id', $semester_id);
			}
		)->get();

		$excel = Excel::create($dt);
		$excel->setTitle('Export List Kelompok KP')
			  ->setCreator('Teknik Informatika')
			  ->setCompany('Teknik Informatika');

		$members = [];
		foreach ($membera as $member) {
			$q['Nama'] = $member->student->name;
			$q['NRP'] = $member->student->nrp;
			$q['Kelompok (Status)'] = $member->group->id . ' (' . $member->group->status['name'] . ')';
			//echo $q['NRP']."<br>";
			$idx=$member->group->semester;
            $ids=$idx['id'];
			$q['Semester'] = Semester::find($ids)->toString();
			$q['Mulai'] = $member->group->start_date;
			$q['Selesai'] = $member->group->end_date;
			$q['Dosen Pembimbing'] = $member->group->lecturer == null ? '-' : $member->group->lecturer->name;
			$q['Perusahaan'] = $member->group->corporation->name_city;
			$q['Pembimbing Lapangan'] = $member->group->mentor == null ? '-' : $member->group->mentor->name;
			$q['NI'] = $member->grade == null ? '-' : $member->grade->lecturer_grade;
			$q['NE'] = $member->grade == null ? '-' : $member->grade->mentor_grade;
			$q['ND'] = $member->grade == null ? '-' : $member->grade->discipline_grade;
			$q['NB'] = $member->grade == null ? '-' : $member->grade->report_status;
			array_push($members, $q);
		}
		$excel->sheet('Kelompok', function($sheet) use($members) {
			$sheet->fromArray($members, null, 'A1', true);
			$sheet->setBorder('A1:L' . (count($members) + 1), 'thin');
		});
		return $excel->download('xls');
	}

}
