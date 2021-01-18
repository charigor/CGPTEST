<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Company;
use App\Models\Client;
use Debugbar;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public $pageCount = 20;
    public $pageLink = 2;

    public function getAllCompanies()
    {
        $companies = Company::paginate($this->pageCount)
                            ->onEachSide($this->pageLink);
        if (!$companies) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($companies, 200);
    }

    public function getClients($id)
    {
        $company = Company::with('clients')
                          ->where('id', $id)
                          ->first();

        if (is_null($company->clients)) {
            return response()->json([
                'message' => 'Not Found'
            ], 404);
        }
        return response()->json(
            $company->clients()
                    ->paginate($this->pageCount)
                    ->onEachSide($this->pageLink),
            200);
    }

    public function getClientCompanies($id)
    {
        $client = Client::with('companies')
            ->where('id', $id)
            ->first();
        return response()->json(
            $client->companies()
                   ->paginate($this->pageCount)
                   ->onEachSide($this->pageLink),
            200);
    }

    public function getAllClients()
    {
        $clients = Client::paginate($this->pageCount)
                         ->onEachSide($this->pageLink);
        if (!$clients) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json($clients, 200);

    }
}
