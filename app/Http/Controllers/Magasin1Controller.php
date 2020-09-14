<?php

namespace App\Http\Controllers;

use App\Magasin;
use App\APIError;
use Illuminate\Http\Request;

class Magasin1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Magasin::simplePaginate($req->has('limit') ? $req->limit : 15);
        //ceci te sera util pour ajouter l'url du serveur a tes images lorsque tu les retournes.
        /* foreach ($data as $not) {
            $not->image = url($not->image);
        } */
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
            'nom_magasin' => 'required', 
            'description' => 'required',
        ]);
        $magasin = new Magasin();
        $magasin ->nom_magasin = $data['nom_magasin'];
        $magasin ->description = $data['description'];
        $magasin ->save();
        return response()->json($magasin);
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
        $magasin = Magasin::find($id);
        if($magasin == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("CATEGORY_NOT_FOUND");
            $notfound->setMessage("Category id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = $req->all();
        $data = $req->validate([
            'nom_magasin' => 'required', 
            'description' => 'required',
        ]);
        
         $magasin ->nom_magasin = $data['nom_magasin'];
       
         $magasin ->description = $data['description'];
        $magasin->update();
        return response()->json($magasin);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $magasin = Magasin::find($id);
       if($magasin == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("CATEGORY_NOT_FOUND");
           $notfound->setMessage("Category id not found in database.");
           return response()->json($notfound, 404);
       }

       $magasin->delete();
        return response()->json(200);
    }

     // methode pour rechercher une categorie en base de donnee
     public function find($id){
       
       $magasin = Magasin::find($id);
       if($magasin == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("CATEGORY_NOT_FOUND");
           $notfound->setMessage("Category id not found in database.");
           return response()->json($notfound, 404);
       }
       return response()->json($magasin);
     }
}
