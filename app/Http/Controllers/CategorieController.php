<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\APIError;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Categorie::latest()->simplePaginate($req->has('limit') ? $req->limit : 15);
        //ceci te sera util pour ajouter l'url du serveur a tes images lorsque tu les retournes.
        /* foreach ($data as $not) {
            $not->image = url($not->image);
        } */
        /* 
        fdfgfdf
        */
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
            'nom_categorie' => 'required', 
            'description' => 'required',
        ]);
        $categorie = new Categorie();
        $categorie ->nom_categorie = $data['nom_categorie'];
        $categorie ->description = $data['description'];
        $categorie ->save();
        return response()->json($categorie);
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
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,  $id)
    {
        $categorie = Categorie::find($id);
        if($categorie == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("CATEGORY_NOT_FOUND");
            $notfound->setMessage("Category id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = $req->all();
        $data = $req->validate([
            'nom_categorie' => 'required', 
            'description' => 'required',
        ]);
        
        if($data['nom_categorie']) $categorie ->nom_categorie = $data['nom_categorie'];
       
       if($data['description']) $categorie ->description = $data['description'];
        $categorie->update();
        return response()->json($categorie);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $categorie = Categorie::find($id);
       if($categorie == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("CATEGORY_NOT_FOUND");
           $notfound->setMessage("Category id not found in database.");
           return response()->json($notfound, 404);
       }

       $categorie->delete();
        return response()->json(200);
    }

     // methode pour rechercher une categorie en base de donnee
     public function find($id){
       
       $categorie = Categorie::find($id);
       if($categorie == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("CATEGORY_NOT_FOUND");
           $notfound->setMessage("Category id not found in database.");
           return response()->json($notfound, 404);
       }
       return response()->json($categorie);
     }

     public function findProduitCategorie(Request $req, $id)
     {
         $produitmagasin = Categorie::select('categories.nom_categorie','categories.description as description_categorie','categories.id','produits.id as id_produit','produits.nom_produit','produits.prix','produits.photo')
         ->join('produits', 'produits.id_categorie', '=', 'categories.id' )        
         ->where(['categories.id' => $id])
         ->simplePaginate($req->has('limit') ? $req->limit : 15);
         foreach ($produitmagasin as $not) {
            $not->photo = url($not->photo);
        }
         return response()->json($produitmagasin); 
     }
}
