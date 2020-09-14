<?php

namespace App\Http\Controllers;

use App\Produit;
use App\APIError;
use Illuminate\Http\Request;

class Produit1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Categorie::simplePaginate($req->has('limit') ? $req->limit : 15);
        //ceci te sera util pour ajouter l'url du serveur a tes images lorsque tu les retournes.
         foreach ($data as $not) {
            $not->image = url($not->image);
        } 
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $this->validate($req->all(), [
            'nom_produit' => 'required',
            'id_categorie' => 'required',
            'prix' => 'required',
            'quantite' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);
        $data = [];
        $data = array_merge($data, $request->only([
            'nom_produit', 
            'id_categorie',
            'prix',
            'quantite', 
            'description', 
            'photo',
            
        ]));
        $path1 = " ";
        //upload image
        if(isset($req->photo)){
            $photo = $req->file('photo'); 
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                $relativeDestination = "uploads/PRODUITS";
                $destinationPath = public_path($relativeDestination);
                $safeName = "produit".time().'.'.$extension;
                $photo->move($destinationPath, $safeName);
                $path1 = "$relativeDestination/$safeName";
            }
        }
        $data['photo'] = $path1;
        $produit = new Produit();
        $produit ->nom_produit = $data['nom_produit'];
        $produit ->description = $data['description'];
        $produit ->photo = $data['photo'];
        $produit ->prix = $data['prix'];
        $produit ->quantite = $data['quantite'];
        $produit ->id_categorie = $data['id_categorie'];
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
        $produit = Produit::find($id);
        if($produit == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("CATEGORY_NOT_FOUND");
            $notfound->setMessage("Category id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = [];
        $data = array_merge($data, $req->only([
            'nom_produit', 
            'prix', 
            'quantite',
            'id_categorie',
            'photo',
            'description',
        ]));
        $path1 = "";
        //upload image
        if(isset($req->photo)){
            $photo = $req->file('photo'); 
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                $relativeDestination = "uploads/PRODUIT";
                $destinationPath = public_path($relativeDestination);
                $safeName = "produit".time().'.'.$extension;
                $photo->move($destinationPath, $safeName);
                $path1 = "$relativeDestination/$safeName";
            }
        }
        $data['photo'] = $path1;
        
         $produit ->nom_produit = $data['nom_produit'];
         $produit ->prix = $data['prix'];
         $produit ->quantite = $data['quantite'];
         $produit ->id_categorie = $data['id_categorie'];
         $produit ->photo = $data['photo'];
         $produit ->description = $data['description'];
        $produit->update();
        return response()->json($produit);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $produit = Produit::find($id);
       if($produit == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("CATEGORY_NOT_FOUND");
           $notfound->setMessage("Category id not found in database.");
           return response()->json($notfound, 404);
       }

       $produit->delete();
        return response()->json(200);
    }

     // methode pour rechercher une categorie en base de donnee
     public function find($id){
       
       $produit = Produit::find($id);
       if($produit == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("CATEGORY_NOT_FOUND");
           $notfound->setMessage("Category id not found in database.");
           return response()->json($notfound, 404);
       }
       return response()->json($produit);
     }
}
