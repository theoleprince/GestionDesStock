<?php

namespace App\Http\Controllers;

use App\Magasin;
use App\APIError;
use Illuminate\Http\Request;

class MagasinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Magasin::simplePaginate($req->has('limit') ? $req->limit : 15);
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
    public function update(Request $req, $id)
    {
        $magasin = Magasin::find($id);
        if(!$magasin){
            abort(404,"CATEGORIE NOT FOUND WITH ID $id");
        }

        $data = $req->all();
        $data = $req->validate([
            'nom_magasin' => 'required', 
            'description' => 'required',
        ]);
        
        if($data['nom_magasin']) $magasin ->nom_magasin = $data['nom_magasin'];
       
       if($data['description']) $magasin ->description = $data['description'];
        $magasin->update();
        return response()->json($magasin);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Magasin  $magasin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Magasin::where('id', $id)->delete();
        return response()->json(200);
    }
    //recherche d'element a partir de son id 

    public function find($id){
       
        $magasin = Magasin::find($id);
        if($magasin == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("SERVICE_NOT_FOUND");
            $notfound->setMessage("Service id not found in database.");
 
            return response()->json($notFound, 404);
        }
        return response()->json($magasin);
      }
}
