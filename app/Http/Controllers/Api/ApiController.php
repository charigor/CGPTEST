<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Client;
use Debugbar;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $pageCount = 20;
    public function Companies() {
        $companies = Company::paginate($this->pageCount);
        if(!$companies){
            return response()->json(['message' => 'Not Found'],404);
        }
        return response()->json($companies,200);
    }
    public function Clients($id) {
        $company = Company::find($id);
        if(is_null($company->clients)){
            return response()->json(['message' => 'Not Found'],404);
        }
        return response()->json($company->clients()->paginate($this->pageCount),200);
    }
    public function ClientCompanies($id) {
        $client = Client::find($id);
        if($client || is_null($client->companies)){
            return response()->json(['message' => 'Not Found'],404);
        }
        return response()->json($client->companies,200);
    }
}
