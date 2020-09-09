<?php

namespace App\Http\Controllers;

use App\Produit;
use App\APIError;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Produit::simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($data);
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
            'nom_produit' => 'required', 
            'description' => 'required',
            'quantite' => 'required',
            'prix' => 'required',
            'id_categorie' => 'required',
            'photo' => 'required',
        ]);
        $produit = new Produit();
        $produit ->nom_produit = $data['nom_produit'];
        $produit ->description = $data['description'];
        $produit ->quantite = $data['quantite'];
        $produit ->prix = $data['prix'];
        $produit ->id_categorie = $data['id_categorie'];
        $produit ->photo = $data['photo'];
        $produit ->save();
        return response()->json($produit);  
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
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $produit = Produit::find($id);
        if(!$produit){
            abort(404,"CATEGORIE NOT FOUND WITH ID $id");
        }

        $data = $req->all();
        $data = $req->validate([
            'nom_produit' => 'required', 
            'description' => 'required',
            'quantite' => 'required',
            'prix' => 'required',
            'id_categorie' => 'required',
            'photo' => 'required',
        ]);
        
        if($data['nom_produit']) $produit ->nom_produit = $data['nom_produit'];
       
       if($data['description']) $produit ->description = $data['description'];

       if($data['quantite']) $produit ->quantite = $data['quantite'];
       if($data['prix']) $produit ->prix = $data['prix'];
       if($data['id_categorie']) $produit ->$id_categorie = $data['id_categorie'];
       if($data['photo']) $produit ->$photo = $data['photo'];
        $produit->update();
        return response()->json($produit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Produit::where('id', $id)->delete();
        return response()->json(200);
    }

    //recherche d'un element a partir de son id
    public function find($id){
       
        $produit = Produit::find($id);
        if($produit == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("SERVICE_NOT_FOUND");
            $notfound->setMessage("Service id not found in database.");
 
            return response()->json($notFound, 404);
        }
        return response()->json($produit);
      }
}
