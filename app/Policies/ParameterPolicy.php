<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Parameter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParameterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user, Parameter $parameter, Company $company) {
        return $user->id === $parameter->user_id && $user->id === $company->user_id;
    }

    public function delete(User $user, Parameter $parameter, Company $company) {
        return $user->id === $parameter->user_id && $user->id === $company->user_id;
    }
}
