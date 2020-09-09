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
    public function index(Request $req)
    {
        $data = Magasin::simplePaginate($req->has('limit') ? $req->limit:15);
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
            'nomMagasin' =>  'required',
            'capacite' => 'required',
            'description' => 'required',
        ]);
        $CategorieUpdate = new Magasin();
        $CategorieUpdate->nomMagasin = $data['nomMagasin'];
        $CategorieUpdate->description = $data['description'];
        $CategorieUpdate->capacite = $data['capacite'];
        $CategorieUpdate->save();
        return response()->json( $CategorieUpdate);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Magasin::where('id', $id)->destroy();
        return response()->json(200);
    }
}
