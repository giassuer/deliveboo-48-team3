@extends('layouts.dashboard')

@section('content')
<section>
    <div class="container">
        <h1>Benvenuto {{ $user->name  }} {{ $user->lastname  }}</h1>
    </div>
</section>
@endsection