<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Throwable;

class DriverController extends Controller
{
    use ApiResponser;
    private $serviceAPi;

    public function __construct(ServicesApi $serviceAPi)
    {
        $this->serviceAPi = $serviceAPi;
    }
    function index()
    {
        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->getListDriver())
                ->original, true);

            return dd($response);


            return view('layouts.driver', ["title" => "Driver", "data" => $response["data"]]);
        } catch (Throwable $exception) {
        }
    }
}
