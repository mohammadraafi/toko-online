<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Province;
use App\Models\StoreAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AlamatTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $province = Province::all();
        $alamat =  DB::table('store_addresses')
                    ->join('cities','cities.city_id','=','store_addresses.city_id')
                    ->join('provinces','provinces.province_id','=','cities.province_id')
                    ->select('store_addresses.*','cities.title as kota','provinces.title as prov')->first();

        return view('pages.admin.alamat.index', [
                'alamat' => $alamat,
                'province' => $province
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getCity($id)
    {
        //mengambil data kota/kab
        $city = City::where('province_id',$id)->get();
        return response()->json($city); 
    }
    
    public function create()
    {   

        return view('pages.admin.alamat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        StoreAddress::create([
            'city_id' => $request->city_id,
            'detail'    => $request->detail,
        ]);
        
        return redirect()->back();
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
         return view('pages.admin.alamat.edit',$data); 
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
        $alamat = StoreAddress::findOrFail($id);
        $alamat->city_id = $request->city_id;
        $alamat->detail = $request->detail;
        $alamat->save();
        return redirect()->route('alamat-toko.index');
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
