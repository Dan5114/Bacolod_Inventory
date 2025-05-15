<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\WarehouseItem;
use App\Policies\WarehouseItemPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
    \App\Models\WarehouseItem::class => \App\Policies\WarehouseItemPolicy::class,
];


    public function boot(): void
    {
        $this->registerPolicies();
    }
}
