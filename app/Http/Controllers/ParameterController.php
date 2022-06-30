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
        $request->validate([
            'name' => ['required', 'string'],
            'coefficient' => ['required', 'numeric', 'between:0,1'],
        ]);

        $parameter = new Parameter();

        $parameter->fill($request->all());
        $parameter->user_id = Auth::id();

        $parameter->save();

        return response()->json(['id' => $parameter->id], 201);
    }

    public function storeCompanyRelation(Parameter $parameter, Company $company)
    {
        $this->authorize('create', [$parameter, $company]);

        $parameter->companies()->attach($company->id);
    }

    public function deleteCompanyRelation(Parameter $parameter, Company $company)
    {
        $this->authorize('delete', [$parameter, $company]);

        $parameter->companies()->detach($company->id);
    }
}
