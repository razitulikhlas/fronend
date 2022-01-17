<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Throwable;

class DashboardDriverController extends Controller
{

    use ApiResponser;
    private $serviceAPi;

    public function __construct(ServicesApi $serviceAPi)
    {
        $this->serviceAPi = $serviceAPi;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getListDriver())
                ->original, true);
            // return dd($response);
            return view('layouts.driver.index', ["title" => "Driver", "data" => $response["data"]]);
        } catch (Throwable $exception) {
            // return $exception;

            return view('layouts.driver.index', ["title" => "Driver", "data" => []]);
        }
    }

    public function aktivationDriver($id, $status)
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->changeStatusAktif($id, $status))
                ->original, true);
            if ($response['success']) {
                return redirect('drivers')->with(['success' => 'data berhasil di update']);
            }
        } catch (Throwable $exception) {
            if ($exception instanceof ClientException) {
                $message = $exception->getResponse()->getBody();
                $code = $exception->getCode();
                $erorResponse = json_decode($this->errorMessage($message, $code)->original, true);
                return var_dump($erorResponse);
                // return back()->with('loginError', $erorResponse["message"]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getDriver($id))
                ->original, true);

                // return dd($response);
            if ($response['success']) {
                return view('layouts.driver.detail', [
                    "title" => "Detail Driver",
                     "driver" => $response["driver"],
                     "transaction" => $response["transaction"],
                ]);
            }
        } catch (Throwable $exception) {
            return view('layouts.error.index',["title" => "Customer"]);
            // return $exception;
        }
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

        $driver = $this->getDriver($id);
        // return dd($driver);
        if ($driver) {
            $driver["name_driver"] = $request->nameDriver;
            $driver["email"] = $request->email;
            $driver["nomor_stnk"] = $request->nomorstnk;
            $driver["nik"] = $request->nik;
            $driver["plat_kendaraan"] = $request->platkendaraan;
            $driver["phone"] = $request->nohp;

            try {
                $response =  json_decode($this->successResponse($this
                    ->serviceAPi
                    ->updatedDriver($driver, $id))
                    ->original, true);

                if ($response["success"]) {
                    return redirect('drivers');
                }
            } catch (Throwable $exception) {
                if ($exception instanceof ClientException) {
                    $message = $exception->getResponse()->getBody();
                    $code = $exception->getCode();
                    $erorResponse = json_decode($this->errorMessage($message, $code)->original, true);
                    return var_dump($erorResponse);
                    // return back()->with('loginError', $erorResponse["message"]);
                } else {
                    // return back()->with('loginError', "Check your connection");
                }
            }
        }
    }

    public function getDriver($id)
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getDriver($id))
                ->original, true);
            return $response["driver"];
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
