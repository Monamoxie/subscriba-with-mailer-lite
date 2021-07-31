<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriberRequest;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SubscribersController extends Controller
{
    protected $apiKey;

    public function __construct(ApiKeyService $apiKeyService)
    {
        $apiKeyInst = $apiKeyService->getApiKey();
        if ($apiKeyInst === null) {
            return $this->errorResponse('Request terminated. No API Key found', [], 400);
        }
        $this->apiKey = $apiKeyInst->api_key;
    }

    public function store(CreateSubscriberRequest $request)
    {
        $response = Http::acceptJson()->withHeaders([
            'Host' => 'api.mailerlite.com',
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $this->apiKey
        ])->post('https://api.mailerlite.com/api/v2/subscribers', [
            'email' => $request->email, 
            'name' => $request->name,
            'fields'=> [ "country" => $request->country ]
        ]);
        $content = json_decode($response->body());
        if ($response->successful()) {
            return $this->successResponse('Welcome on board '.$request->name .'. You have been successfully subscribed', $content);
        } else {
            return $this->errorResponse('An error occured. Please try again', [], 400);
        } 
        
        // {"message":"Welcome on board User4. You have been successfully subscribed","data":{"id":1081341027807241880,"name":"User4","email":"user4@gmail.com","sent":0,"opened":0,"opened_rate":0,"clicked":0,"clicked_rate":0,"type":"active","country_id":null,"signup_ip":"","signup_timestamp":"","confirmation_ip":"","confirmation_timestamp":"","fields":[{"key":"email","value":"user4@gmail.com","type":"TEXT"},{"key":"name","value":"User4","type":"TEXT"},{"key":"last_name","value":"","type":"TEXT"},{"key":"company","value":"","type":"TEXT"},{"key":"country","value":"United States","type":"TEXT"},{"key":"city","value":"","type":"TEXT"},{"key":"phone","value":"","type":"TEXT"},{"key":"state","value":"","type":"TEXT"},{"key":"zip","value":"","type":"TEXT"}],"date_subscribe":null,"date_unsubscribe":null,"date_created":"2021-07-31 20:11:35","date_updated":"2021-07-31 20:15:43"},"errors":[],"code":200}
        // {"message":"Welcome on board User6. You have been successfully subscribed","data":{"id":1081343676015289457,"name":"User6","email":"user6@gmail.com","sent":0,"opened":0,"opened_rate":0,"clicked":0,"clicked_rate":0,"type":"active","country_id":null,"signup_ip":"","signup_timestamp":"","confirmation_ip":"","confirmation_timestamp":"","fields":[{"key":"email","value":"user6@gmail.com","type":"TEXT"},{"key":"name","value":"User6","type":"TEXT"},{"key":"last_name","value":"","type":"TEXT"},{"key":"company","value":"","type":"TEXT"},{"key":"country","value":"United States","type":"TEXT"},{"key":"city","value":"","type":"TEXT"},{"key":"phone","value":"","type":"TEXT"},{"key":"state","value":"","type":"TEXT"},{"key":"zip","value":"","type":"TEXT"}],"date_subscribe":null,"date_unsubscribe":null,"date_created":"2021-07-31 20:16:51","date_updated":"2021-07-31 20:16:51"},"errors":[],"code":200}
    }

    public function index()
    {
        $response = Http::acceptJson()->withHeaders([
            'X-MailerLite-ApiKey' => $this->apiKey
        ])->get('https://api.mailerlite.com/api/v2/subscribers');
        $content = json_decode($response->body());
        if ($response->successful()) {
            
            \Datatables::of($content)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
       
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } else {
            return $this->errorResponse('An error occured. Please try again', [], 400);
        } 
    }
}
