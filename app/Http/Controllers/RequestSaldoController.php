<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Throwable;

class RequestSaldoController extends Controller
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
            ->requestSaldo())
            ->original, true);
            // return dd($response);
            return view('layouts.requestsaldo.index', [
                "title"=>"Request Saldo",
                "store" => $response["data"]["store"],
                "driver" => $response["data"]["driver"],
            ]);
        } catch (\Throwable $th) {
            // return dd($response);
            return view('layouts.requestsaldo.index', [
                "title"=>"Request Saldo",
                "data" => []
            ]);
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
        $data = $request->only([
            'idCustomer', 'promoName','promoDescription','promoPrice','date','expired'
        ]);

        $response =  json_decode($this->successResponse($this
        ->serviceAPi
        ->giftPromoCustomer($data))
        ->original, true);

        if ($response['success']) {
            return redirect('promo');
        }
        // return dd($data);
    }

    public function listPromo()
    {
        echo "hello";
        // return "Hello"
        // return view('layouts.promocustomer.listPromo', [
        //     // "title"=>"Promo customer"
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$type,$category)
    {
        // $category = $request->input('category');
        try{
            if($category == 'store'){
                $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->updateRequestSaldoStore($id,$type))
                ->original, true);
                if ($response["success"]) {
                    return redirect('request');
                }
            }else{
                $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->updateRequestSaldoDriver($id,$type))
                ->original, true);
                if ($response["success"]) {
                    return redirect('request');
                }
            }

        }catch(\Throwable $th){
            return $th;
        }

    }

    public function getStore($id)
    {

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

    }
}
