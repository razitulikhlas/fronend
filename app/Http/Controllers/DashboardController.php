<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

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
        try{
            $response =  json_decode($this->successResponse($this
            ->serviceAPi
            ->dashboard())
            ->original, true);

        // return dd($response);
        $month = [];
        $price = [];
        $totalTransaction = [];
        if($response["data"]["chart"] != null){
            $month = array_column($response["data"]["chart"], 'bulan');
            $price = array_column($response["data"]["chart"], 'price');
            $totalTransaction = array_column($response["data"]["chart"], 'total');
        }
        $monthBenefit = [];
        $priceBenefit = [];
        if($response["data"]["charBenefit"] != null){
            $monthBenefit = array_column($response["data"]["charBenefit"], 'bulan');
            $priceBenefit = array_column($response["data"]["charBenefit"], 'price');
        }

        // return dd($totalTransaction);

        $response["data"]["benefit"] = $this->rupiah($response["data"]["benefit"]);
        return view('layouts.dashboard', [
            "title" => "Dashboard",
            "data" => $response["data"],
            "month"=>$month,
            "price"=>$price,
            "monthBenefit"=>$monthBenefit,
            "priceBenefit"=>$priceBenefit,
            "totalTransaction"=>$totalTransaction
        ]);
        }catch(Exception $exception){
            if ($exception instanceof ClientException) {
                $message = $exception->getResponse()->getBody();
                $code = $exception->getCode();
                $erorResponse = json_decode($this->errorMessage($message, $code)->original, true);
                return view('layouts.dashboard', [
                    "title" => "Dashboard",
                    "data" => [],
                    "month"=>[],
                    "price"=>[],
                    "monthBenefit"=>[],
                    "priceBenefit"=>[],
                    "totalTransaction"=>[]
                ]);
                return back()->with('loginError', $erorResponse["message"]);
            } else {
                return back()->with('loginError', "Check your connection");
            }
        }

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
