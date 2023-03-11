@extends('layouts.app')

@section('content')

<div class="container bg-gray-100 dark:bg-gray-900">
    @foreach ($pizzas as $pizza)
    <div class="card " style="width: 18rem;">
        <img
        @if (isset($pizza['image']))
            src={{$pizza['image']}}
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
          <a href="{{ url('/app/pizzas/'.$pizza['id'].'/edit')}}" class="btn btn-primary">Editar</a>
        </div>
      </div>
    @endforeach
</div>


@endsection
