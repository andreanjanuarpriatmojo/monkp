<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Progres;
use App\FileProgres;
use Auth;
use Redirect;
use Response;

class ProgresController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $progres = Progres::where('group_id', $id)->first();
        // dd($progres->id);
        $file_progres = FileProgres::where('progres_id', $progres->id)->get();
        // dd($file_progres);
        $data = compact('progres', 'id', 'file_progres');

        return view('inside.progres', $data);
    }

    public function update(Request $request, $id){
        // dd($request);
        $role = Auth::user()->role;
        if ($role == 'STUDENT') {
            $foto = "";
            $file_p = new FileProgres;
            // dd($request->hasFile('file_progres'));
            if($request->hasFile('file_progres'))
            {
                $destinationPath = "file_progres";
                $file = $request->file_progres;
                $extension = $file->getClientOriginalExtension();
                $fileName = time().".".$extension;
                $file->move($destinationPath, $fileName);
                $foto = $fileName;
                $file_p->nama_file = $foto;
            }
            $file_p->progres_id = $id;
            $file_p->save();
        }
        elseif($role == 'LECTURER'){
            $progres = Progres::where('group_id', $id)->first();
            // dd($progres);
            $progres->jumlah_progres = $request->jumlah_progres;
            $progres->save();
        }
        
        return Redirect::back();
    }

    public function download($id){
        $file_progres = FileProgres::where('id', $id)->first();
        $filepath = public_path('file_progres/').$file_progres->nama_file;

        return Response::download($filepath);
    }
}
 