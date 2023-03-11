@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-row-reverse">
        <div class="p-2">
           <a href="{{ route('pizzas.create')}}"><button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Nuevo</button></a>
        </div>
      </div>

</div>
<div class="container bg-gray-100 dark:bg-gray-900">
    <div class="row">
        @foreach ($pizzas as $pizza)
            {{-- {{dd(Storage::disk('local')->url($pizza['image']))}} --}}
            <div class="card col" style="width: 15rem;">
                <p>{{ asset('../storage/app/public/'.$pizza['image']) }}</p>
                <img
                @if (isset($pizza['image']))
                    src={{ asset('../storage/app/public/'.$pizza['image']) }}
                @else
                    src={{ asset('img/default.jpeg')}}
                @endif
                class="card-img-top" alt="pizza">
                <div class="card-body">
                <h5 class="card-title"><b> {{isset($pizza['name']) ? $pizza['name'] : null}}</b></h5>
                <h6 class="card-title "><b> Ingredientes</b></h6>
                @foreach ($pizza['ingredients'] as $ingredient)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{isset($ingredient['name']) ? $ingredient['name'] : '-'}}</li>
                    </ul>
                @endforeach
                <p class="card-text text_aligne-left">Precio: ${{ isset($pizza['price']) ? $pizza['price'] : '-' }}</p>

                <div class="d-grid gap-2 d-md-block">


                    <form method="POST" action="{{ route('pizzas.destroy', $pizza['id']) }}">
                        @csrf
                        @method("DELETE")
                        <a href="{{ url('/app/pizzas/'.$pizza['id'].'/edit')}}" class="btn btn-primary">Editar</a>
                        <button type="submit" class="btn btn-warning">Delete</button>
                    </form>
                </div>

                </div>
            </div>
            @endforeach
    </div>

</div>


@endsection
