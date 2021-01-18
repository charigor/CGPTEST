<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Debugbar;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class CompaniesController extends Controller
{
    public $pageCount = 20;
    public $pageLink = 2;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $companies = Company::with('clients')
                            ->paginate($this->pageCount)
                            ->onEachSide($this->pageLink);
        return view('companies',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->messages()
            ], 422);
        }

        $company = new Company;
        $company->name = request('name');
        $company->description = request('description');
        $company->clients()->sync(request('value'));
        $company->save();

        $companies = Company::paginate($this->pageCount)
                            ->onEachSide($this->pageLink)
                            ->withPath('/companies');
        return [
            'message' => 'Company was created!',
            'companies' => $companies
        ];
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->messages()
            ], 422);
        }

        $company = Company::find($id);
        $company->name = request('name');
        $company->description = request('description');
        $company->save();
        return [
            'message' => 'Company was updated!',
            'company' => $company->load('clients')
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::where('id',$id)->first();
        if($company) {
            $company->clients()->detach();
            $company->delete();
        }

        return [
            'message' => 'Company was deleted!',
            'companies' => Company::paginate($this->pageCount)
                                  ->onEachSide($this->pageLink)
                                  ->withPath('/companies')
        ];
    }
}
