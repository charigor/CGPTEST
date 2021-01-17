<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Debugbar;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    public $pageCount = 20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $companies = Company::paginate($this->pageCount);
        return view('companies',compact('companies'));
    }
    public function show() {

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
        $company->save();
        $companies = Company::paginate($this->pageCount);
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
            'company' => $company
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
        Company::findOrFail($id)->delete();

        return [
            'message' => 'Company was deleted!',
            'companies' => Company::paginate($this->pageCount)->withPath('/companies')
        ];
    }
}
