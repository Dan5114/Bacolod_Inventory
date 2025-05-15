<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WarehouseItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class WarehouseItemPolicy
{
    use HandlesAuthorization;

    public function manage(User $u): bool
    {
        return $u->role === 'admin';
    }

    public function checkout(User $u, WarehouseItem $i): bool
    {
        return $u->role === 'user';
    }
}
