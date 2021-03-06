<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Throwable;

class TestingController extends Controller
{
    use ApiResponser;
    private $serviceAPi;

    public function __construct(ServicesApi $serviceAPi)
    {
        $this->serviceAPi = $serviceAPi;
    }
    public function index()
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getListStore())
                ->original, true);
            // return dd($response);
            return view('layouts.testing.index', [
                "title" => "Store", 

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

    public function activationProduct($id, $status, $idStore)
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->changeStatusDeleteProduct($id, $status))
                ->original, true);
            if ($response['success']) {
                return redirect('store/' . $idStore);
            }
        } catch (Throwable $exception) {
            return dd($exception);
        }
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

        $store = $this->getStore($id);

        if ($store) {
            $store["owner_name"] = $request->ownerName;
            $store["store_name"] = $request->storeName;
            $store["phone"] = $request->nohp;
            $store["address"] = $request->address;
            $store["latitude"] = $request->latitude;
            $store["longititude"] = $request->longititude;

            try {
                $response =  json_decode($this->successResponse($this
                    ->serviceAPi
                    ->updatedStore($store, $id))
                    ->original, true);

                if ($response["success"]) {
                    return redirect('store');
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

    public function getStore($id)
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getStore($id))
                ->original, true);
            return $response["data"];
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

    public function aktivationStore($id, $status)
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->changeStatusAktifStore($id, $status))
                ->original, true);
            if ($response['success']) {
                return redirect('store');
            }

            return dd($response);
        } catch (Throwable $exception) {
            return dd($exception);
        }
    }
}
