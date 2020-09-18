<?php

namespace App\Http\Controllers;

use App\Produit_magasin;
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
        $produit_magasin = new Produit_magasin();
        $produit_magasin ->id_produit = $data['id_produit'];
        $produit_magasin ->id_magasin = $data['id_magasin'];
        $produit_magasin ->save();
        return response()->json($produit_magasin);
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
     * @param  \App\produit_magasin  $produit_magasin
     * @return \Illuminate\Http\Response
     */
    public function show(produit_magasin $produit_magasin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\produit_magasin  $produit_magasin
     * @return \Illuminate\Http\Response
     */
    public function edit(produit_magasin $produit_magasin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produit_magasin  $produit_magasin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produit_magasin $produit_magasin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\produit_magasin  $produit_magasin
     * @return \Illuminate\Http\Response
     */
    public function destroy(produit_magasin $produit_magasin)
    {
        //
    }
     // retourne tous les produits et leurs categories pour un magasin
    public function findProduitMagasin(Request $req, $id)
    {
        $produitmagasin = Produit_magasin::select('produits.*','produit_magasins.*','magasins.*')
        ->join('produits', 'produit_magasins.id_produit', '=', 'produits.id' )
        ->join('magasins', 'produit_magasins.id_magasin', '=', 'magasins.id' )
        ->where(['produit_magasins.id_produit' => $id])
        ->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($produitmagasin);
    }
    //retourne tous les produits pour le magasin d'id $id
    public function findProduitMagasin1(Request $req, $id)
    {
        $produitmagasin = Produit_magasin::select('magasins.*','produit_magasins.*','produits.*')
        ->join('magasins', 'produit_magasins.id_magasin', '=', 'magasins.id' )
        ->join('produits', 'produit_magasins.id_produit', '=', 'produits.id' )
        ->where(['produit_magasins.id_magasin' => $id])
        ->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($produitmagasin); 
    }

    public function findProduitMagasin2(Request $req, $id)
    {
        $produitmagasin = Produit_magasin::select('magasins.id as id_magasin','magasins.nom_magasin','magasins.description as description_magasin','produit_magasins.id_produit','produit_magasins.id_magasin','produits.id as id_produit','produits.nom_produit','produits.quantite','produits.prix','produits.created_at as produit_created_at','produits.description as description_produit')
        ->join('magasins', 'produit_magasins.id_magasin', '=', 'magasins.id' )
        ->join('produits', 'produit_magasins.id_produit', '=', 'produits.id' )
        ->where(['produit_magasins.id_magasin' => $id])
        ->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($produitmagasin); 
    }

    public function findProduitMagasin3(Request $req, $id)
    {
        $produitmagasin = Produit_magasin::select('magasins.id as id_magasin','magasins.nom_magasin','magasins.description as description_magasin','produit_magasins.id_produit','produit_magasins.id_magasin','produits.id as id_produit','produits.nom_produit','produits.quantite','produits.prix','produits.created_at as produit_created_at','produits.description as description_produit','categories.id as id_categorie','categories.nom_categorie','categories.description as description_categorie')
        
        ->join('magasins', 'produit_magasins.id_magasin', '=', 'magasins.id' )
        ->join('produits', 'produit_magasins.id_produit', '=', 'produits.id' )
        ->join('categories', 'produits.id_categorie', '=', 'categories.id' )
        ->where(['produit_magasins.id_magasin' => $id])
        ->simplePaginate($req->has('limit') ? $req->limit : 15);
        return response()->json($produitmagasin); 
    }
}
