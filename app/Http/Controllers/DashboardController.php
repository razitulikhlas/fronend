<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ApiResponser;
    private $serviceAPi;

    public function __construct(ServicesApi $serviceAPi)
    {
        $this->serviceAPi = $serviceAPi;
    }
    function index()
    {
        $response =  json_decode($this->successResponse($this
            ->serviceAPi
            ->dashboard())
            ->original, true);

        $response["data"]["benefit"] = $this->rupiah($response["data"]["benefit"]);
        return view('layouts.dashboard', [
            "title" => "Dashboard",
            "data" => $response["data"]
        ]);
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;

    }

    function login(Request $request)
    {

        $username = $request->input("username");
        $password = $request->input("password");

        $body = [
            "username" => $username,
            "password" => $password
        ];

        $response =  json_decode($this->successResponse($this
            ->serviceAPi
            ->login($body))
            ->original, true);

        if ($response["success"]) {
            $request->session()->flash('success', 'Login Success');
            return redirect('/dashboard');
        } else {
            $request->session()->flash('failed', 'Login failed');
        }

        return view('login', ["title" => "Login"]);

        // return dd($response);
    }
}
