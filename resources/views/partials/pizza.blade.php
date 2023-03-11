@extends('layouts.app')

@section('content')
    <div class="container bg-gray-100 dark:bg-gray-900">
        <form method="POST" enctype="multipart/form-data" action="{{ route('pizzas.update', $pizza) }}">
            @method('PUT')
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{isset($pizza->name) ? $pizza->name:''}}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control file" id="image" name="image">
            </div>

            <div class="mb-3">
                <ul class="list-group">
                    @foreach ($pizza->ingredients as $ingredient)
                        <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="1" id="firstCheckbox">
                        <label class="form-check-label" for="firstCheckbox">{{isset($ingredient->name) ? $ingredient->name:''}}</label>
                        </li>
                    @endforeach
                  </ul>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

