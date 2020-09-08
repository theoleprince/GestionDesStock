<?php

namespace App\Http\Controllers;

use App\Magasin;
use Illuminate\Http\Request;

class MagasinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Magasin::simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function show(Magasin $magasin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function edit(Magasin $magasin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magasin $magasin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magasin $magasin)
    {
        //
    }
}
