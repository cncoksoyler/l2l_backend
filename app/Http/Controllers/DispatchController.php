<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Http\Requests\StoreDispatchRequest;
use App\Http\Requests\UpdateDispatchRequest;
use Illuminate\Support\Facades\Http;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("index");
        $response = Http::get('https://autoliv-eu2.leading2lean.com/api/1.0/machines/get_open_dispatches', [
            'auth' => env('APIKEY'),
            'site' => 20,
            'limit' => 100,
            'OPEN' => 'T',
            'dispatchtype_ids' => '622,623,837,618,1123,001'

        ]);
        return json_decode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDispatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDispatchRequest $request)
    {
        //
        dd("store");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd("show");
        $code  = Http::get('https://autoliv-eu2.leading2lean.com/api/1.0/lines', [
            'auth' => env('APIKEY'),
            'site' => 20,
            'code' => $id,
        ]);
       
        $code = json_decode($code)->data[0]->defaultmachine;
        // dd($code);
        $response = Http::get('https://autoliv-eu2.leading2lean.com/api/1.0/machines/get_open_dispatches/' . $code, [
            'auth' => env('APIKEY'),
            'site' => 20,
            'limit' => 100,
            'OPEN' => 'T',
            'dispatchtype_ids' => '622,623,837,618,1123,001'

        ]);
        // dd($response, $dispatch);
        return json_decode($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispatch $dispatch)
    {
        dd("edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDispatchRequest  $request
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDispatchRequest $request, Dispatch $dispatch)
    {
        dd("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dispatch $dispatch)
    {
        dd("destroy");
    }
}
