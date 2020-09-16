<?php

namespace App\Http\Controllers;

use App\Livre;
use App\APIError;
use Illuminate\Http\Request;

class LivreController extends Controller
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
    public function create()
    {
        $data = $req->all();
        $data = $req->validate([
            'nomLivre' =>  'required',
            'nomAuteur' => 'required',
            'maisonEdition' => 'required',
            'dateParution' => 'required',
            'idEtagere' => 'required',
        ]);

        $path1 = " ";
        //upload image
        if(isset($request->photo)){
            $photo = $request->file('photo'); 
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                $relativeDestination = "uploads/Livre";
                $destinationPath = public_path($relativeDestination);
                $safeName = "Livre".time().'.'.$extension;
                $photo->move($destinationPath, $safeName);
                $path1 = "$relativeDestination/$safeName";
            }
        }
        $data['photo'] = $path1;

        $livre = new Livre();
        $livre ->nomLivre = $data['nomLivre'];
        $livre ->nomAuteur = $data['nomAuteur'];
        $livre ->maisonEdition = $data['maisonEdition'];
        $livre ->dateParution = $data['dateParution'];
        $livre ->idEtagere = $data['idEtagere'];
        $livre ->photo = $data['photo'];
        $livre ->save();
        return response()->json($livre);  
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
     * @param  \App\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function show(Livre $livre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function edit(Livre $livre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livre $livre)
    {
        $livre = Livre::find($id);
        if($livre == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("LIVRE_NOT_FOUND");
            $notfound->setMessage("livre id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = [];
        $data = array_merge($data, $request->only([
            'nomLivre', 
            'nomAuteur', 
            'maisonEdition',
            'dateParution',
            'photo',
            'idEtagere',
            ]));

            $path1 = " ";
            //upload image
            if(isset($request->photo)){
                $photo = $request->file('photo'); 
                if($photo != null){
                    $extension = $photo->getClientOriginalExtension();
                    $relativeDestination = "uploads/Livre";
                    $destinationPath = public_path($relativeDestination);
                    $safeName = "Livre".time().'.'.$extension;
                    $photo->move($destinationPath, $safeName);
                    $path1 = "$relativeDestination/$safeName";
                }
            }
            $data['photo'] = $path1;  

            $livre = new Livre();
        $livre ->nomLivre = $data['nomLivre'];
        $livre ->nomAuteur = $data['nomAuteur'];
        $livre ->maisonEdition = $data['maisonEdition'];
        $livre ->dateParution = $data['dateParution'];
        $livre ->idEtagere = $data['idEtagere'];
        $livre ->photo = $data['photo'];
        $livre ->save();
        return response()->json($livre);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livre $livre)
    {
        $livre = Livre::find($id);
        if($etagere == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("LIVRE_NOT_FOUND");
            $notfound->setMessage("livre id not found in database.");
            return response()->json($notfound, 404);
        }
 
        $categorie->delete();
         return response()->json(200);
    }
}
