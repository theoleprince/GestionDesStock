<?php

namespace App\Http\Controllers;

use App\ProduitMagasin;
use Illuminate\Http\Request;

class ProduitMagasinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $data = $req->all();
        $data = $req->validate([
            'id_produit' => 'required', 
            'id_magasin' => 'required',
            
        ]);

        $produitMagasin = new ProduitMagasin();
        $produitMagasin ->id_produit = $data['id_produit'];
        $produitMagasin ->id_magasin = $data['id_magasin'];
        $produitMagasin->save();
        return response()->json( $produitMagasin);
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
     * @param  \App\produitMagasin  $produitMagasin
     * @return \Illuminate\Http\Response
     */
    public function show(produitMagasin $produitMagasin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\produitMagasin  $produitMagasin
     * @return \Illuminate\Http\Response
     */
    public function edit(produitMagasin $produitMagasin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produitMagasin  $produitMagasin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produitMagasin $produitMagasin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\produitMagasin  $produitMagasin
     * @return \Illuminate\Http\Response
     */
    public function destroy(produitMagasin $produitMagasin)
    {
        //
    }
    
}
