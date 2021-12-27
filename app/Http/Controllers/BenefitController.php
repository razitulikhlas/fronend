<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Throwable;

class BenefitController extends Controller
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
            ->listBenefit())
            ->original, true);

        foreach ($response["data"] as $key => $value) {
            $response["data"][$key]["totalBenefit"] = $this->rupiah($value["totalBenefit"]);
        }

        // return dd($response);
        return view('layouts.benefits.index', [
            "title" => "Benefit",
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

    public function show($id)
    {

        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getStore($id))
                ->original, true);
            // return dd($response);
            if ($response['success']) {
                return view('layouts.store.detail', [
                    "title" => $response["data"]["store_name"],
                    "product" => $response["product"],
                    "id_store" => $response["data"]["id_store"]
                ]);
            }
        } catch (Throwable $exception) {
        }
    }
}
