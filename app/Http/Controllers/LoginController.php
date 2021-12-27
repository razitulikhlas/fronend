<?php

namespace App\Http\Controllers;

use App\Services\ServicesApi;
use App\Traits\ApiResponser;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class LoginController extends Controller
{
    use ApiResponser;
    private $serviceAPi;

    public function __construct(ServicesApi $serviceAPi)
    {
        $this->serviceAPi = $serviceAPi;
    }
    function index()
    {
        return view('login', ["title" => "Login"]);
    }

    function login(Request $request)
    {

        $username = $request->input("username");
        $password = $request->input("password");

        $body = [
            "username" => $username,
            "password" => $password
        ];

        // return dd($body);


        try {
            $response =  json_decode($this->successResponse($this
                ->serviceAPi
                ->login($body))
                ->original, true);

            // return dd($response);
            if ($response["success"]) {
                session([
                    "login"=>true,
                    "name"=>$response["data"]["name"],
                    "avatar"=>$response["data"]["avatar"],
                    "role"=>$response["data"]["role"],
                    "jwt"=>$response["data"]["jwt"],
                ]);
                return redirect()->intended('/dashboard');
            }
        } catch (Exception $exception) {
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

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }
}
