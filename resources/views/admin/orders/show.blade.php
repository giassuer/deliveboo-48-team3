@extends('layouts.dashboard')

@section('content')
    

@if(!$restaurant)
  @include('includes.alert_restaurant')
@else  
<div class="container box">
  <div class="container d-flex justify-content-center align-items-center">
    <div class="card my-5 py-3 font-size-2" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Ordine n° {{ $order->id }}</h5>
          <p class="card-text"><strong>Nome Cliente: </strong>{{ $order->name }}</p>
          <p class="card-text"><strong>Cognome Cliente: </strong>{{ $order->lastname }}</p>
          <p class="card-text"><strong>Indirizzo Cliente: </strong>{{ $order->address }}</p>
          <p class="card-text"><strong>Email Cliente: </strong>{{ $order->email }}</p>
          <p class="card-text"><strong>Prezzo: </strong> € {{ $order->amount }}</p>
          <p class="card-text"><strong>Pagato: </strong>  
            @if($order->status)
            <span class="badge badge-pill badge-success">Pagato</span>
            @else
            <span class="badge badge-pill badge-danger">Da pagare</span>
            @endif
          </p>
          <ul>
            <h6><strong>Piatti nell'ordine:</strong> </h6>
            @foreach ($order->dishes as $dish)
            
           
            <li>{{$dish->pivot->quantity}} - {{ $dish->name }}  </li>
            
            @endforeach
          </ul>
          
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <a class="btn btn-primary" href="{{ route('admin.orders.index') }}">Torna agli ordini</a>
    </div>
  </div>
@endif

@endsection