<?php

namespace App\Http\Controllers;

use App\Http\Resources\Pizza as ResourcesPizza;
use App\Models\Ingredient;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = Pizza::query()->get();
        /* dd(ResourcesPizza::collection($pizzas)->toArray(request())); */
        return view('partials.pizzas', ['pizzas' =>  ResourcesPizza::collection($pizzas)->toArray(request())]);
       /* return response()->json($pizzas->get()); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('partials.pizza', ['ingredients' => $ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
          /*  $validator = Validator::make(
            [
                'image'      => $request->image,
                'extension' => strtolower($request->image->getClientOriginalExtension()),
            ],
            [
                'image'          => 'sometimes|nullable',
                'extension'      => 'required|in:jpg,png',
            ]
          ); */

        $pizza = new Pizza($request->all());
        $ids = array_values($request->ingredients);



        /* if($request->has('image')){
            $path = date('Y') . '/' . date('m') . '/' . date('d');
            $pizza->image = Storage::putFile($path, $request->image);
        } */

        $pizza->save();

        $pizza->ingredients()->sync($ids ,$pizza->id);
        return redirect()->route('pizzas.index');
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['message' => $e]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        return view('partials.pizza',['pizza' => $pizza, 'ingredients' => $ingredients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {

        try {
            /* $pizza = Pizza::find($id); */
            $pizza->fill($request->all());
            $pizza->ingredients()->sync($request->ingredients ,$pizza->id);
            $pizza->save();

            return redirect()->route('pizzas.index');

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
            $pizza = Pizza::findOrFail($id);
            $pizza->ingredients()->detach();
            $pizza->delete();

            return redirect()->route('pizzas.index');
        } catch (\Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
