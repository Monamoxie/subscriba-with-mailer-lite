<?php

namespace Tests;

use App\Labs\StringManipulator;
use App\Models\ApiKey;
use App\Models\BackOfficeUser;
use App\Models\BackOfficeUserRole;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\CompanyUserRole;
use App\Models\LocalGovernment;
use App\Models\User;
use App\Models\Wallet;
use App\Services\CompanyService;
use App\Services\RoleService;
use Database\Seeders\AuthoritySeeder;
use Database\Seeders\BusinessTypeSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StateSeeder;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Hash;

trait AssignAuthData
{
     
    
    public function loadUp()
    {
        return $this->storeApiKeyForRetrieval();
    }
   

    private function storeApiKeyForRetrieval()
    {
        ApiKey::factory()->create([
            'api_key' => env('API_KEY')
        ]);

        return $this;
    }

    
}
