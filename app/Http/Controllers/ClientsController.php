<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
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
        $clients = Client::with('companies')
                           ->paginate($this->pageCount)
                           ->onEachSide($this->pageLink);
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
            'email' => ['required','email','min:6','max:255','unique:clients'],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->messages()
            ], 422);
        }

        $client = new Client;
        $client->name = request('name');
        $client->email = request('email');
        $client->description = request('description');
        $client->save();

        $clients = Client::paginate($this->pageCount)
                         ->onEachSide($this->pageLink)
                         ->withPath('/clients');

        return response()->json([
            'message' => 'Client was created!',
            'clients' => $clients
        ],200);
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
            'email' => ['required','email','min:6','max:255','unique:clients,email,'.$id],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->messages()
            ], 422);
        }
        $client = Client::find($id);
        $client->name = request('name');
        $client->description = request('description');
        $client->email = request('email');
        $client->companies()->sync(request('value'));
        $client->save();
        return response()->json([
            'message' => 'Client was updated!',
            'client' => $client->load('companies')
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::where('id',$id)->first();
        if($client) {
            $client->companies()->detach();
            $client->delete();
        }

        return response()->json([
            'message' => 'Client was deleted!',
            'clients' => Client::paginate($this->pageCount)
                              ->onEachSide($this->pageLink)
                              ->withPath('/clients')
        ],200);
    }
}
