<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Throwable;

class ListPromoController extends Controller
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
        ->getListPromoCustomer())
        ->original, true);

        $data = [];
        if(isset($response["data"])){
            $data = array_reverse($response["data"]);
        }

        return view('layouts.promocustomer.listPromo', [
            "title"=>"Promo customer",
            "data" => $data
        ]);
        } catch (Exception $exception) {
            return view('layouts.promocustomer.listPromo', [
                "title"=>"Promo customer",
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
    public function update(Request $request, $id)
    {


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
