<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        $province = Province::all();
        $alamat = DB::table('addresses')
            ->join('cities','cities.city_id','=','addresses.city_id')
            ->join('provinces','provinces.province_id','=','cities.province_id')
            ->select('provinces.title as prov','cities.title as kota','addresses.*')
            ->where('addresses.users_id', Auth::user()->id)
            ->get();

            return view('pages.profile', [ 
                'alamat' => $alamat,
                'province' => $province
            ]);
    }

    public function getCity($id)
    {
        //mengambil data kota/kab
        $city = City::where('province_id',$id)->get();
        return response()->json($city); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $province = Province::all();

        return view('pages.add-address', [
            'province' => $province
        ]);


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Address::create([
            'city_id' => $request->city_id,
            'detail'    => $request->detail,
            'users_id'   => Auth::user()->id
        ]);
        
        return redirect()->route('dashboard-settings-account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         //menampilkan form edit alamat
         $data['id'] = $id;
         $data['province'] = Province::all();
         return view('pages.edit-address',$data); 
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
         //mengupdate alamat
         $alamat = Address::findOrFail($id);
         $alamat->city_id = $request->city_id;
         $alamat->detail = $request->detail;
         $alamat->save();
         return redirect()->route('alamat-customer.index');
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
