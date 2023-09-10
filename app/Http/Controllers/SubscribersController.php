<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Labs\StringManipulator;
use App\Services\ApiKeyService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\Unit\Auth\DeleteSubscriberTest;
use Yajra\DataTables\Facades\DataTables;

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
        ])->post(config('app.mailer_lite_base_Url') . '/subscribers', [
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
    }

    public function index(Request $request, StringManipulator $stringManipulator)
    {
        $response = Http::acceptJson()->withHeaders([
            'X-MailerLite-ApiKey' => $this->apiKey
        ])->get(config('app.mailer_lite_base_Url') . '/subscribers');
        $content = json_decode($response->body());
        if ($response->successful()) {
            $data = [];
            $data = array_map(function ($i) use ($data, $stringManipulator) {
                
                $elmento = [];
                $elmento['email'] = $i->email;
                $elmento['name'] = $i->name;
                $elmento['country'] = $stringManipulator->extractCountryValueFromFields($i->fields);
                $elmento['date_subscribe'] = Carbon::parse($i->date_created)->format('d/m/Y');
                $elmento['time_subscribe'] = Carbon::parse($i->date_created)->format('H:i');
                return $elmento;
            }, $content);
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($data) {
                        $btn = ' <span data-tag="'.$data['email'].'" data-c="'.$data['country'].'" data-n="'.$data['name'].'">Edit</span> ';
                        $btn .= '<span data-tag="'.$data['email'].'">Delete</span>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        } else {
            return $this->errorResponse('An error occured. Please try again', [], 400);
        } 
    }

    public function update(UpdateSubscriberRequest $request)
    { 
        $response = Http::acceptJson()->withHeaders([
            'Host' => 'api.mailerlite.com',
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $this->apiKey
        ])->put(config('app.mailer_lite_base_Url') . '/subscribers/' . $request->email, [
            'name' => $request->name,
            'fields'=> [ "country" => $request->country ]
        ]);
        $content = json_decode($response->body());
        if ($response->successful()) {
            return $this->successResponse('Subscriber details have been successfully updated', $content);
        } else {
            return $this->errorResponse('An error occured. Please try again', [], 400);
        }
    }

    public function delete(Request $request) 
    { 
        $response = Http::acceptJson()->withHeaders([
            'Host' => 'api.mailerlite.com',
            'Content-Type' => 'application/json',
            'X-MailerLite-ApiKey' => $this->apiKey
        ])->delete(config('app.mailer_lite_base_Url') . '/subscribers/' . $request->email);
        $content = json_decode($response->body());
        if ($response->successful()) {
            return $this->successResponse('Subscriber details have been successfully deleted', $content);
        } else {
            return $this->errorResponse('An error occured. Please try again', [], 400);
        }
    }
}
