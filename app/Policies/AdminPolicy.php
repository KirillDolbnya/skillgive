<?php

namespace App\Policies;

use App\Enums\AdminRole;
use App\Models\Admin;

class AdminPolicy
{
    public function create(Admin $admin): bool
    {
        return $admin->role === AdminRole::SuperAdmin;
    }

    public function update(Admin $admin): bool
    {
        return $admin->role === AdminRole::SuperAdmin;
    }

    public function delete(Admin $currentAdmin, Admin $targetAdmin): bool
    {
        return $currentAdmin->role === AdminRole::SuperAdmin && $currentAdmin->isNot($targetAdmin);
    }

    public function deleteAny(Admin $admin): bool
    {
        return $admin->role === AdminRole::SuperAdmin;
    }
}
