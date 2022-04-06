@extends('layouts.dashboard')

@section('content')
    <div class="detail text-center my-2">
        <div class="img_detail" style="width:70%;margin:auto;">
            @if (str_contains($restaurant->path_img,'http'))
                <img src="{{$restaurant->path_img}}" class="card-img-top" alt="{{$restaurant->restaurant_name}}" style="border-radius:20px;overflow:hidden;">
            @else
                <img src="{{asset('storage/' . $restaurant->path_img)}}" class="card-img-top" alt="{{$restaurant->restaurant_name}}" style="border-radius:20px;overflow:hidden;">
            @endif
        </div>
        <div class="description my-3">
            <h2><span class="text-danger">Nome:</span> {{$restaurant->restaurant_name}}</h2>
            <h5>{{$restaurant->slug}}</h5>
            <div>
                <h3 class="d-inline"><span class="text-danger">Categorie:</span></h3>
                @forelse ($restaurant->category as $category)
                    {{ $category->name }}{{ $loop->last ? '' : ', ' }}
                @empty
                    nessuno
                @endforelse

            </div>
            <h3><span class="text-danger">Indirizzo:</span> {{$restaurant->address}}</h3>
            <h3><span class="text-danger">Telefono:</span> {{$restaurant->phone}}</h3>
            <h4><span class="text-danger">P.Iva:</span> {{$restaurant->vat}}</h4>
        </div>
        <div class="btn btn-light border-dark mb-3">
            <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}">Modifica ristorante</a>
        </div>

        <div>
            <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}" method="post">
                @csrf
                @method('DELETE')

                <button onclick="return confirm('sei sicuro di voler cancellare?')" class="btn btn-danger">Cancella</button>
            </form>
        </div>
    </div>
    {{-- DISHES --}}
    <div class="dishes_cards border border-dark rounded rounded-3 mt-5">
        <div class="container">
            <h2 class="text-center my-3">Aggiungi piatti</h2>
            <div class="text-center">
                <a href="{{ route('admin.dishes.create') }}" class="btn btn-primary">Aggiungi</a>
            </div>
            <div class="row">
                @foreach ($dishes as $dish)
            <div class="col">
                               {{-- single dish --}}
                    <div class="card mx-3 my-5" style="width: 18rem;">
                        @if (str_contains($dish->path_img,'http'))
                        
                            <img src="{{$dish->path_img}}" class="card-img-top" alt="{{$dish->name}}" style="max-height: 180px;">
                        @else
                            <img src="{{asset('storage/' . $dish->path_img)}}" class="card-img-top" alt="{{$dish->name}}" style="max-height: 180px">
                        @endif
                        
                        <div class="card-body">
                          <h5 class="card-title">Nome: {{$dish->name}}</h5>
                          <p class="card-text">{{$dish->slug}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">Descrizione: {{$dish->description}}</li>
                          <li class="list-group-item">Prezzo €{{$dish->price}}</li>
                        </ul>
                        <div class="card-body d-inline text-center">
                          <a href="{{ route('admin.dishes.edit', ['dish' => $dish->id]) }}" class="card-link mx-2 btn btn-primary">Modifica</a>
                          
                        
                            <form class="d-inline" action="{{ route('admin.dishes.destroy', ['dish' => $dish->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                
                                <button onclick="return confirm('sei sicuro di voler cancellare?')" class="btn btn-danger">Cancella</button>
                            </form>
                        </div>
                      
                    </div>
                </div>

                @endforeach

                    {{-- end single dish --}}  
            </div>
        </div>
    </div>
@endsection