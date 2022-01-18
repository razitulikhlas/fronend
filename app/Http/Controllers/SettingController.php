<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Throwable;

class SettingController extends Controller
{
    use ApiResponser;
    private $serviceAPi;

    private $dataManagement;

    public function __construct(ServicesApi $serviceAPi)
    {
        $this->serviceAPi = $serviceAPi;
    }
    public function index()
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getManagementSystem())
                ->original, true);
            $data = $response["data"];
            // return dd($data);
            // return $this->dataManagement;
            $distance =  explode(",", $data["distance"]);
            $totalOrder =  explode(",", $data["total_order"]);
            $rating =  explode(",", $data["rating"]);
            $level =  explode(",", $data["level_pelanggan"]);
            $jumlah_transaksi =  explode(",", $data["jumlah_transaksi"]);
            $total_transaksi =  explode(",", $data["total_transaksi"]);
            return view('layouts.settings.index', [
                "title" => "Setting",
                "distance" => $distance,
                "total_order" => $totalOrder,
                "rating" =>$rating,
                "jumlah_transaksi" => $jumlah_transaksi,
                "level" => $level,
                "total_transaksi" => $total_transaksi,
                "fullData"=>$data
            ]);
        } catch (Throwable $exception) {
        }
    }

    public function getListProductStore($id)
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getListProductStore($id))
                ->original, true);
            // return dd($response);
            if ($response['success']) {
                return view('layouts.store.detail', [
                    "title" => $response["data"]["store_name"],
                    "product" => $response["product"],
                    "id_store" => $id
                ]);
            }
        } catch (Throwable $exception) {
        }
    }

    public function changePassword(Request $request){
        // return "hello";
        $oldPassword=$request->input("oldPassword");
        $newPassword=$request->input("newPassword");
        $confirmPassword=$request->input("confirmPassword");

        if($newPassword != $confirmPassword){
            return back()->with('loginError', "tolong masukan new password dan confirm password yang sama");
        }

        try {
            $data = [
                "oldPassword"=>$oldPassword,
                "newPassword"=>$confirmPassword,
            ];

            // return dd($data);


            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->changePasswordAdmin($data))
                ->original, true);

                if ($response["success"]) {
                    return redirect('setting');
                }else{
                    return back()->with('loginError', "password lama yang anda masukan salah");
                }
        } catch (Throwable $exception) {
            if ($exception instanceof ClientException) {
                $message = $exception->getResponse()->getBody();
                $code = $exception->getCode();
                $erorResponse = json_decode($this->errorMessage($message, $code)->original, true);
                // return var_dump($erorResponse);
                return back()->with('loginError', $erorResponse["message"]);
            } else {
                return back()->with('loginError', "Check your connection");
            }
        }


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response =  json_decode($this->successResponse($this
        ->serviceAPi
        ->getManagementSystem())
        ->original, true);
        $data = $response["data"];

        if($request->input("type") == "sawdriver"){
            $distance1=$request->input("distance1");
            $distance2=$request->input("distance2");
            $distance3=$request->input("distance3");
            $distance4=$request->input("distance4");

            $total_order1=$request->input("total_order1");
            $total_order2=$request->input("total_order2");
            $total_order3=$request->input("total_order3");
            $total_order4=$request->input("total_order4");

            $rating1=$request->input("rating1");
            $rating2=$request->input("rating2");
            $rating3=$request->input("rating3");
            $rating4=$request->input("rating4");

            $rating = $rating1.",".$rating2.",".$rating3.",".$rating4;
            $distance = $distance1.",".$distance2.",".$distance3.",".$distance4;
            $total_order = $total_order1.",".$total_order2.",".$total_order3.",".$total_order4;
            $data["rating"] = $rating;
            $data["distance"] = $distance;
            $data["total_order"] = $total_order;
        }else{
            $level1=$request->input("level1");
            $level2=$request->input("level2");
            $level3=$request->input("level3");

            $jumlahTransaksi1=$request->input("jumlahTransaksi1");
            $jumlahTransaksi2=$request->input("jumlahTransaksi2");
            $jumlahTransaksi3=$request->input("jumlahTransaksi3");
            $jumlahTransaksi4=$request->input("jumlahTransaksi4");

            $totalTransaksi1=$request->input("totalTransaksi1");
            $totalTransaksi2=$request->input("totalTransaksi2");
            $totalTransaksi3=$request->input("totalTransaksi3");
            $totalTransaksi4=$request->input("totalTransaksi4");

            $level = $level1.",".$level2.",".$level3;
            $jumlah_transaksi= $jumlahTransaksi1.",".$jumlahTransaksi2.",".$jumlahTransaksi3.",".$jumlahTransaksi4;
            $total_transaksi= $totalTransaksi1.",".$totalTransaksi2.",".$totalTransaksi3.",".$totalTransaksi4;

            $data["level_pelanggan"] = $level;
            $data["jumlah_transaksi"] = $jumlah_transaksi;
            $data["total_transaksi"] = $total_transaksi;

        }

        $responseUpdate =  json_decode($this->successResponse($this
        ->serviceAPi
        ->updateManagementSystem($data))
        ->original, true);


        if($responseUpdate["success"]){
            return redirect('setting');
        }

    }


}
