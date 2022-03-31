<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Parameter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        $users = User::has('parameters')->has('companies')->get();
        return response()->json(['users' => $users]);
    }

    public function show(User $user)
    {
        $parameters = Parameter::with('companies')
            ->select(['id', 'name', 'coefficient'])
            ->where('user_id', $user->id)->get();

        $parametersToReturn = collect();
        foreach ($parameters as $parameter)
        {
            $parameterToReturn = new Parameter();
            $parameterToReturn->id = $parameter->id;
            $parameterToReturn->name = $parameter->name;
            $parameterToReturn->coefficient = $parameter->coefficient;
            $parameterToReturn->companies = $parameter->companies->pluck('id');
            $parametersToReturn->push($parameterToReturn);
        }

        Log::debug($parametersToReturn);

        $companies = Company::where('user_id', $user->id)->get();

        return response()->json(['parameters' => $parametersToReturn, 'companies' => $companies]);
    }

    public function destroyTable()
    {
        //
    }
}
