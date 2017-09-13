<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Company;

class CompaniesController extends Controller
{
    public function index()
    {
    	try {
    		$fieldsToShow = ["id", "name", "path", "tagline", "address", "last_updated"];
    	    $companies = Company::select($fieldsToShow)
    	    	->paginate(5);

    	    return view('companies.companies', compact('companies'));
    	} catch (\Exception $e) {
    	    abort(500);
    	}
    }

    public function show($id)
    {
    	try {
    		$company = Company::findOrFail($id);

    		return view('companies.company', compact('company'));
    	} catch (\Exception $e) {
    	    if ($e instanceOf ModelNotFoundException) {
    	        abort(404);
    	    }
    	    abort(500);
    	}
    }
}
