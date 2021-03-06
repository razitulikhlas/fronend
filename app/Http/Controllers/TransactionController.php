<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Throwable;

class TransactionController extends Controller
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
                ->getListTransactionFromAdmin())
                ->original, true);
            $data = [];
            if(isset($response["data"])){
                $data = array_reverse($response["data"]);
            }
            // return dd($response);
            return view('layouts.transactions.index', ["title" => "Transaksi", "data" => $data]);
        } catch (Throwable $exception) {
            // return $exception;
            return view('layouts.transactions.index', ["title" => "Transaksi", "data" => []]);
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
                ->getDetailTransaction($id))
                ->original, true);

                // return dd($response);

            $totalTransaction = 0;

            $totalTransaction= array_reduce($response["detail_transaksi"], function($totalTransaction, $item)
            {
                    return $item["count"] * $item["price_product"] + $totalTransaction;
            });
            $discount = null;
            if($response["promo"] != null){
                $discount = $response["promo"]["promoPrice"];
            }
            if ($response['success']) {
                return view('layouts.transactions.detailTransaction', [
                    "title" => "Detail Transaction",
                    "store" => $response["store"],
                    "driver" => $response["driver"],
                    "transaction" => $response["transaction"],
                    "detailTransaction" => $response["detail_transaksi"],
                    "totalTransaction" => $totalTransaction,
                    "promo"=>$discount
                ]);
            }
        } catch (Throwable $exception) {
            // return $exception;
            return view('layouts.error.index',["title" => ""]);
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
                    // return var_dump($erorResponse);
                    return back()->with('loginError', $erorResponse["message"]);
                } else {
                    return back()->with('loginError', "Check your connection");
                }
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



    public function generatePdf($id){
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getDetailTransaction($id))
                ->original, true);

             //  return dd($response);

            $totalTransaction = 0;

            $totalTransaction= array_reduce($response["detail_transaksi"], function($totalTransaction, $item)
            {
                    return $item["count"] * $item["price_product"] + $totalTransaction;
            });
            $discount = null;
            if($response["promo"] != null){
                $discount = $response["promo"]["promoPrice"];
            }

            $fileName = "transanction.pdf";
            $mpdf = new Mpdf([
                'margin_left'=>10,
                'margin_right'=>10,
                'margin_top'=>15,
                'margin_bottom'=>10,
                'margin_header'=>10,
                'margin_footer'=>10,
                'mode' => 'utf-8',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]);
            $html = view('layouts.transactions.pdf', [
                    "store" => $response["store"],
                    "driver" => $response["driver"],
                    "transactionsa" => $response["transaction"],
                    "detailTransaction" => $response["detail_transaksi"],
                    "totalTransaction" => $totalTransaction,
                    "promo"=>$discount
            ]);
            $html = $html->render();

            $mpdf->WriteHTML($html);
            $mpdf->Output($fileName,"I");

        } catch (Throwable $exception) {
            return view('layouts.transactions.detailTransaction', [
                "title" => "Customer"
            ]);
        }

    }
}
