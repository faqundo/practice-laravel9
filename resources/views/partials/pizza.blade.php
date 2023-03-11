@extends('layouts.app')

@section('content')

    <div class="container bg-gray-100 dark:bg-gray-900">
        <div class="container">
            <div class="position-relative">
                <div class="position-absolute top-0 end-0 ">
                        <a class="btn btn-secondary justify-content-end mb-5" href="{{ route('pizzas.index') }}" style="text-decoration:none;color: white;">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>

                </div>
            </div>
        </div>
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight"></div>
          </div>
        <form method="POST" enctype="multipart/form-data" action="{{ isset($pizza)? route('pizzas.update', $pizza) : route('pizzas.store') }}">
            @if (isset($pizza))
                @method('PUT')
            @endif
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
                    @foreach ($ingredients as $ingredient)
                        <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="{{isset($ingredient->id) ? $ingredient->id:''}}" id="firstCheckbox" name="ingredients[]">
                        <label class="form-check-label" for="firstCheckbox">{{isset($ingredient->name) ? $ingredient->name:''}}</label>
                        </li>
                    @endforeach
                  </ul>
            </div>
            <button type="submit" class="btn btn-primary" >
                {{isset($pizza) ? 'Submit' : 'Create'}}
            </button>
            {{-- @if (isset($pizza))
                <form action="{{  route('pizzas.destroy', $pizza)}}">
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" onclick="add(2)">Delete</button>

                </form>
            @endif --}}

        </form>
    </div>

@endsection

@push('bottom')
 <script>
     $(function(){
        alert('hola')
     })
 </script>
