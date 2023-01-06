<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('created_at', 'desc')->get();
        $belumDiproses = Pengaduan::where('status', 'Belum diproses')->count();
        $sedangDiproses = Tanggapan::where('status_pengaduan', 'Sedang diproses')->count();
        $selesai = Tanggapan::where('status_pengaduan', 'Selesai')->count();
        return view('pages.admin.pengaduan.index', [
            'pengaduans' => $pengaduans,
            'belumDiproses' => $belumDiproses,
            'sedangDiproses' => $sedangDiproses,
            'selesai' => $selesai
        ]);
    }

    public function pelanggan()
    {
        $pengaduans = Pengaduan::with(['tanggapan', 'user'])->where('users_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();

        return view('pages.pengaduan.index', [
            'pengaduans' => $pengaduans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'foto' => 'required'
        ]);

        $id = Auth::user()->id;

        $data = $request->all();
        $data['users_id'] = $id;
        $data['status'] = 'Belum diproses';
        $data['foto'] =  $request->file('foto')->store('assets/product', 'public');

        Pengaduan::create($data);

        Alert::success('Berhasil', 'Pengaduan terkirim');

        return redirect()->route('pengaduan.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengaduans = Pengaduan::with([
            'details', 'user',
        ])->findOrFail($id);

        $tanggapans = Tanggapan::where('pengaduans_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('pages.admin.pengaduan.detail', [
            'pengaduans' => $pengaduans,
            'tanggapans' => $tanggapans,
        ]);
    }

    public function detail_pengaduan($id)
    {
        $pengaduans = Pengaduan::with([
            'details', 'user',
        ])->findOrFail($id);

        $tanggapans = Tanggapan::where('pengaduans_id', $id)->orderBy('created_at', 'DESC')->get();

        return view('pages.pengaduan.detail', [
            'pengaduans' => $pengaduans,
            'tanggapans' => $tanggapans,
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
