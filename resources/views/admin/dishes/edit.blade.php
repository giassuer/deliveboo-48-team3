@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="border border-dark p-5 rounded rounded-5">
            <h1 class="text-center">Modifica il tuo piatto</h1>
            {{-- FORM CREATE DISH --}}
            <form action="{{route('admin.dishes.update', ['dish' =>$dish->id])}}" method="post" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                {{-- NOME --}}
                <div class="mb-3">
                  <label for="name" class="form-label">Nome:</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{old('name', $dish->name) }}">
                </div>
                {{-- NOME --}}
                {{-- error --}}
                @error('name')
                    <div class="alert alert-danger">Campo obbligatorio</div>
                @enderror
                {{-- end error --}}
                {{-- PREZZO --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo:</label>
                    <input type="number" step="0.01" class="form-control" name="price" id="price" value="{{old('price', $dish->price)}}">
                </div>
                {{-- PREZZO --}}
                {{-- error --}}
                @error('price')
                    <div class="alert alert-danger">Campo obbligatorio</div>
                @enderror
                {{-- end error --}}
                {{-- DESCRIZIONE --}}
                <div>Descrizione:
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{old('description', $dish->description)}}</textarea>
                </div>
                {{-- DESCRIZIONE --}}
                {{-- error --}}
                @error('description')
                    <div class="alert alert-danger">Campo obbligatorio</div>
                @enderror
                {{-- end error --}}

                {{-- IMMAGINE --}}
                <div class="mb-3 my-4">
                    <label for="image" class="form-label">Immagine:</label>
                    <input type="file" name="image" id="image" value="{{old('image')}}" >
                </div>
                  {{-- IMMAGINE --}}
                  {{-- error --}}
                @error('image')
                    <div class="alert alert-danger">Campo obbligatorio. Il file non può superare 512kb</div>
                @enderror
                {{-- error --}}
                @if ($dish->path_img)
                    <div class="current-image">Immagine attuale:
                        @if (str_contains($dish->path_img,'http'))
                            <img src="{{$dish->path_img}}" class="card-img-top" alt="{{$dish->name}}">
                        @else
                            <img src="{{asset('storage/' . $dish->path_img)}}" class="card-img-top" alt="{{$dish->name}}">
                        @endif
                    </div>
                @endif
                {{-- VISIBLE --}}
                <div class="form-group">
                    <label for="visible">Visibile:</label>
                        <select class="form-control" name="visible" id="visible">
                            <option value=1>Si</option>
                            <option value=0>No</option>
                        </select>
                    </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary">MODIFCA</button>
                </div>
              </form>
            {{-- END FORM CREATE DISH --}}
        </div>
    </div>
@endsection