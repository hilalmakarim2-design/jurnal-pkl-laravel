<?php

namespace App\Policies;

use App\Models\Jurnal;
use App\Models\User;

class JurnalPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Jurnal $jurnal): bool
    {
        return $user->isPembimbing() || $user->id === $jurnal->user_id;
    }

    public function create(User $user): bool
    {
        return $user->isPeserta();
    }

    public function update(User $user, Jurnal $jurnal): bool
    {
        return $user->id === $jurnal->user_id;
    }

    public function delete(User $user, Jurnal $jurnal): bool
    {
        return $user->id === $jurnal->user_id;
    }
}
