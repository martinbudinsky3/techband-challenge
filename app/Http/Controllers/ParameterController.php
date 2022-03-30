<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParameterController extends Controller
{
    public function store(Request $request)
    {
        $parameter = new Parameter();

        $parameter->fill($request->all());
        $parameter->user_id = Auth::id();

        $parameter->save();

        return response()->json(['id' => $parameter->id], 201);
    }

    public function updateChecked(Parameter $parameter, Company $company)
    {

    }
}
