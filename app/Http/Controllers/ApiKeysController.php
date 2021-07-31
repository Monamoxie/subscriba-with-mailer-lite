<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApiKeyRequest;
use App\Http\Resources\ApiKeyResource;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiKeysController extends Controller
{
    public function store(StoreApiKeyRequest $request, ApiKeyService $apiKeyService)
    {
        $response = Http::acceptJson()->withHeaders([
            'X-MailerLite-ApiKey' => $request->api_key
        ])->get('https://api.mailerlite.com/api/v2');
        $content = json_decode($response->body());
        if ($response->successful()) {
            $store = $apiKeyService->store($request->api_key); 
            if (!$store[0]) {
                return $this->errorResponse('An internal error occured. Please try again', [], 500);
            } 
            return $this->successResponse('Api key has been successfully validated and saved', new ApiKeyResource($store[1]));
        } else {
            return $this->errorResponse($content->error->message, [], 400);
        }
    }

    public function index(Request $request, ApiKeyService $apiKeyService)
    {
        $apiKey = $apiKeyService->getApiKey();
        return $this->successResponse('Api key returned successfully', 
            $apiKey !== null ? new ApiKeyResource($apiKey): '');
    }
}
