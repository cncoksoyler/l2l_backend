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
        

        $response = Http::post('https://autoliv-eu2.leading2lean.com/api/1.0/users/clock_out/TPC8200/?auth=majIaaaj7gzZQVB5aFfTOUFGLn2OCk4e&site=20&linecode=Ni-Cr Plating', [
            'auth' =>  config('services.l2l.apiKey'),
            'site' => config('services.l2l.site'),
            'linecode' => 'Ni-Cr Plating',
        ]);
       dd($response);
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
        $url = config('services.l2l.url');
        //dd($url);
        
        $code  = Http::get($url . 'lines', [
            'auth' => config('services.l2l.apiKey'),
            'site' => config('services.l2l.site'),
            'code' => $id,
        ]);
       
        $code = json_decode($code)->data[0]->defaultmachine;
        // dd($code);
        $response = Http::get($url . '/machines/get_open_dispatches/' . $code, [
            'auth' => config('services.l2l.apiKey'),
            'site' => config('services.l2l.site'),
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
    public function edit($id)
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
