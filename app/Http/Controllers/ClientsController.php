<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(20);
        return view('clients',compact('clients'));
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
        $client = new Client;
        $client->name = request('name');
        $client->description = request('description');
        $client->save();
        $clients = Client::paginate($this->pageCount);
        return [
            'message' => 'Client was created!',
            'clients' => $clients
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

        $client = Client::find($id);
        $client->name = request('name');
        $client->description = request('description');
        $client->save();
        return [
            'message' => 'Client was updated!',
            'client' => $client
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
        Client::findOrFail($id)->delete();

        return [
            'message' => 'Client was deleted!',
            'client' => Client::paginate($this->pageCount)->withPath('/client')
        ];
    }
}
