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
            return view('layouts.requestsaldo.index', [
                "title"=>"Request Saldo",
                "store" => $response["data"]["store"],
                "driver" => $response["data"]["driver"],
            ]);
        } catch (\Throwable $th) {
            return view('layouts.requestsaldo.index', [
                "title"=>"Request Saldo",
                "store" => [],
                "driver" => [],
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
                    return back()->with('success', 'data berhasil di update');
                }
            }
        }catch(\Throwable $exception){
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

}
