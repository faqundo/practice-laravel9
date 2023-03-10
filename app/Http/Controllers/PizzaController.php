<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::query();

        #filters

       return response()->json($pizzas->get());
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
        $validator = Validator::make(
            [
                'image'      => $request->image,
                'extension' => strtolower($request->image->getClientOriginalExtension()),
            ],
            [
                'image'          => 'sometimes|nullable',
                'extension'      => 'required|in:jpg,png',
            ]
          );

        $pizza = new Pizza($request->all());

        if($request->has('image')){
            $path = date('Y') . '/' . date('m') . '/' . date('d');
            $pizza->image = Storage::putFile($path, $request->image);
        }

        $pizza->save();
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
        try {
            $pizza = Pizza::find($id);
            $pizza->fill($request->all());
            $pizza->save();

            return response()->json(['message' => 'Pizza update successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $region = Pizza::find($id);
            $region->delete();

            return response()->json(['message' => 'Pizza removed successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
