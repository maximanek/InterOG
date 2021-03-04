<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ApiController extends Controller
{
    private $credential_token;
    private $code_token;

    function __construct()
    {
        $login = Config::get('myapi.login');
        $password = Config::get('myapi.password');
        $response = Http::withBasicAuth($login,$password)
            ->get('https://allegro.pl.allegrosandbox.pl/auth/oauth/token?grant_type=client_credentials' )
            ->json('access_token');
        $this->credential_token = $response;

        return $response;
    }

    function getCodeToken(Request $request)
    {
        $login = Config::get('myapi.login');
        $password = Config::get('myapi.password');
        $client = new Client(['base_uri' => 'https://allegro.pl.allegrosandbox.pl',]);

        $response = $client->request('POST', '/auth/oauth/token', [
            'auth' => [$login, $password],
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $request->code,
                'redirect_uri' => 'http://localhost:8000/api/orders/']
        ])->getBody()->getContents();
        $response = json_decode($response);
        dd($response->access_token);
        $this->code_token = $response;
        return view('api.allegroapi', ['response' => $response]);
    }

    function getOrders()
    {
        $login = Config::get('myapi.login');
        $password = Config::get('myapi.password');
        $token = $this->code_token->access_token;
        $request = Http::withToken($token)
            ->post('https://api.allegro.pl.allegrosandbox.pl/order/events');
        dd($request);
        return view('api.allegroapi', ['response' => $response]);
    }


}
