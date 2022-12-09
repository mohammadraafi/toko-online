<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Review;
use App\Models\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = Complaint::with(['user'])->orderBy('created_at', 'desc')->get();
        $satu = Complaint::where('rating', '1/5')->count();
        $dua = Complaint::where('rating', '2/5')->count();
        $tiga = Complaint::where('rating', '3/5')->count();
        $empat = Complaint::where('rating', '4/5')->count();
        $lima = Complaint::where('rating', '5/5')->count();

        return view('pages.admin.complaint.index', [
            'complaints' => $complaints,
            'satu' => $satu,
            'dua' => $dua,
            'tiga' => $tiga,
            'empat' => $empat,
            'lima' => $lima
        ]);
    }




    public function customer()
    {
        $complaints = Complaint::with(['user'])->where('id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('pages.complaint.index', [
            'complaints' => $complaints
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.complaint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $status = 'Belum direspon';

        $data = $request->all();
        $data['users_id'] = $id;
        $data['status'] = $status;

        Alert::success('Berhasil', 'Penilaian terkirim');

        Complaint::create($data);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $complaints = Complaint::with([
            'user'
        ])->findOrFail($id);

        $responsess = Responses::where('complaint_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('pages.admin.complaint.detail', [
            'pengaduans' => $complaints,
            'responsess' => $responsess,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
