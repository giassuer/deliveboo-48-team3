@extends('layouts.dashboard')

@section('content')
    <section id="orders" class="container">
        <h1 class="text-success mt-3 font-weight-bold text-center mb-2">I Tuoi Ordini</h1>

      <div class="box mt-5">

        @if(session('alert-msg'))

        <div class="alert alert-{{session('alert-type')}}" role="alert">
            {{ session('alert-msg') }}
          </div>

        @endif


        @if(!$restaurant)
        @include('includes.alert_restaurant')
        @else  


        <table class="table">
            <thead>
              <tr class="bg-secondary text-white">
                <th scope="col">#</th>
                <th scope="col">Data Ordine</th>
                <th scope="col">Prezzo Totale</th>
                <th scope="col">Status</th>
                <th scope="col">Indirizzo</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)  
                <tr class="font-weight-bold bg-white">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td> € {{ $order->amount }}</td>
                    <td>
                        @if($order->status)
                        <span class="badge badge-pill badge-success">Pagato</span>
                        @else
                        <span class="badge badge-pill badge-danger">Da pagare</span>
                        @endif
                    </td>
                    <td>{{ $order->address }}</td>

                    <td><a class="btn btn-primary" href="{{ route('admin.orders.show', $order->id) }}">Vedi</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <tfoot>
            
          </tfoot>
      </div>
      {{-- <div class="mt-5  text-center">
              <a href="{{ route('admin.orders.statistics.index') }}" class="btn btn-success">Statistiche</a>           
            </div> --}}
    </section>
    @endif
@endsection