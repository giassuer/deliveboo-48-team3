@extends('layouts.dashboard');

@section('content')
    <div class="create_restaurant">
        <form action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            {{-- insert name --}}
            <div class="mb-3">
              <label for="restaurant_name" class="form-label">Nome ristorante</label>
              <input type="text" class="form-control" id="restaurant_name" name="restaurant_name"  value="{{ old('restaurant_name') }}">
            </div>
            @error('restaurant_name')
                <div class="alert alert-danger">Campo obbligatorio</div>
            @enderror

            {{-- insert categories --}}
            <div class="mb-3">
                <h6>Categorie</h6>
                @foreach ($categories as $category)
                    <div class="form-check">
                        <input {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }} class="form-check-input" name="categories[]" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}">
                        <label class="form-check-label" for="category-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
                
            </div>

            @error('categories')
                <div class="alert alert-danger">Seleziona almeno una categoria</div>
            @enderror

            {{-- insert address --}}
            <div class="mb-3">
                <label for="address" class="form-label">indirizzo</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            </div>
            @error('address')
                <div class="alert alert-danger">Campo obbligatorio</div>
            @enderror

            {{-- insert vat --}}
            <div class="mb-3">
                <label for="vat" class="form-label">P.Iva</label>
                <input type="number" class="form-control" id="vat" name="vat" value="{{ old('vat') }}">
            </div>
            @error('vat')
                <div class="alert alert-danger">Campo obbligatorio</div>
            @enderror

            {{-- insert phone --}}
            <div class="mb-3">
                <label for="phone" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            </div>
            @error('phone')
                <div class="alert alert-danger">Campo obbligatorio</div>
            @enderror

            {{-- insert img --}}
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <div>
                    <input type="file" id="image" name="image">
                </div>
            </div>
            @error('image')
                <div class="alert alert-danger">Campo obbligatorio. Il file non può superare 512kb</div>
            @enderror

            <button type="submit" class="btn btn-primary">Crea ristorante</button>
          </form>
    </div>
@endsection