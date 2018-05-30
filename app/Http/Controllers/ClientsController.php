<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ServiceType;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('layouts.index',
                    [
                      'data' => Client::index(),
                      'title' => 'Clients'
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create',['title'=> 'Add New Client!']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'status'      => 'required',
            'description' => 'required',
            'phone'       => 'required',
            'contract_start_date' => 'required',
            'contract_end_date'   => 'required',
        ]);
        Client::create($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('clients.show',
                  [
                    'title' => 'Client '.$client->title,
                    'data' => $client,
                  ]
               );;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('clients.edit',
                  [
                    'title' => 'Edit Client Type',
                    'data' => Client::where('id',$id)->withServices()->first(),
                    'services' => ServiceType::all()
                  ]
               );
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

        if ($request->has('filter')) {
            $client = Client::find($id);
            if ($request->filter == 'manage') {
                $client->ServiceType()->sync($request->type_id);
            }
            return view('clients.edit',
                      [
                        'title' => 'Edit Client Type',
                        'data' => Client::where('id',$id)->withServices()->first(),
                        'services' => ServiceType::all()
                      ]
                   );
        }
        $request->validate([
            'title'       => 'sometimes|required',
            'status'      => 'sometimes|required',
            'description' => 'sometimes|required',
            'phone'       => 'sometimes|required',
            'contract_start_date' => 'sometimes|required',
            'contract_end_date'   => 'sometimes|required',
        ]);
        $client = client::find($id);
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index');
    }
}
