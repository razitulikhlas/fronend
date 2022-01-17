<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Throwable;

class CustomerController extends Controller
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
                ->getListCustomer())
                ->original, true);
            // return dd($response);
            // $response["data"]
            return view('layouts.customer.index', ["title" => "Customer", "data" => $response["data"]]);
        } catch (Throwable $exception) {
            return view('layouts.customer.index', ["title" => "Customer", "data" => []]);
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
                ->getTransactionCustomer($id))
                ->original, true);

                return view('layouts.customer.detail', [
                    "title" => "Detail Customer",
                    "transaction" => $response["data"],
                    "customer" => $response["customer"]
                ]);
        } catch (Throwable $exception) {
            return view('layouts.error.index',["title" => "Customer"]);
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


        $data = $request->only([
            'name', 'phone', 'email', 'address', 'level'
        ]);

        // return dd($data);

            try {
                $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->updateCustomer($data,$id))
                ->original, true);

                if ($response["success"]) {
                    return back()->with('success','success update data' );
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

}
