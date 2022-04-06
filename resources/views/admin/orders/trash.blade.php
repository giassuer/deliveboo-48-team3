@extends('layouts.dashboard')

@section('content')
    <section id="orders" class="container">

      <h1 class="text-success mb-4 text-center">Ordini Eliminati</h1>
    
        <a class="btn btn-outline-secondary my-3" href="{{ route('admin.orders.index') }}">Indietro</a>
  
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Amount</th>
                <th scope="col">Paid</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)  
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>€ {{ $order->amount }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                      <form method="POST" action="{{ route('admin.orders.restore', $order->id) }}">
                          @csrf
                          @method('PATCH')
                          <button class="btn btn-success" type="submit">Ripristina</button>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>

    </section>
@endsection