<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $company = new Company();

        $company->fill($request->all());
        $company->user_id = Auth::id();

        $company->save();

        return response()->json(['id' => $company->id], 201);
    }
}
