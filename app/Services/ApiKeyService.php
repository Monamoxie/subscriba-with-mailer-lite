<?php

namespace App\Services;

use App\Models\ApiKey;
use Facade\FlareClient\Api;
use Illuminate\Support\Facades\DB;

class ApiKeyService
{
    public function store(string $key): array
    {
        DB::beginTransaction();
        $apiKey = new ApiKey;
        $apiKey->api_key = $key;
        if ($apiKey->save()) {
            DB::commit();
            return [true, $apiKey];
        }   
        DB::rollBack();
        return [false];
    }

    public function getApiKey()
    {
        return ApiKey::first();
    }
}