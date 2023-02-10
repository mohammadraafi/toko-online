<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard-settings', [
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        $user = Auth::user();

        $province = Province::all();
        $alamat = DB::table('addresses')
            ->join('cities','cities.city_id','=','addresses.city_id')
            ->join('provinces','provinces.province_id','=','cities.province_id')
            ->select('provinces.title as prov','cities.title as kota','addresses.*')
            ->where('addresses.users_id', Auth::user()->id)
            ->get();


        return view('pages.profile', [
            'user' => $user,
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

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);

        Alert::success('Berhasil', 'Data berhasil diubah');
        return redirect()->route($redirect);
    }


    public function updatePhoto(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user) {
            if (request()->hasFile('photo')) {
                $photouploaded = request()->file('photo');
                $photoname = time() . '.' . $photouploaded->getClientOriginalExtension();
                $photopath = public_path('/images/');
                $photouploaded->move($photopath, $photoname);

                $user->photo = public_path('/images/');
                $user->photo = '/images/' . $photoname;
                $user->update();
                // dd($photoname);
            }
            return redirect()->back();
        }
    }
}
