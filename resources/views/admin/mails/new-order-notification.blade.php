<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img{
            width: 70px;
            margin-right: 10px;
        }
        .green{
            color: green;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; box-sizing: border-box; background-color: #f3ba32;">
    
    <!-- Logo -->
    <div style="background-color: #E25822; text-align: center; padding: 20px 0; color:#f3ba32; display: flex;
    justify-content: center;
    align-items: center;">
        <img style="" src="https://i.ibb.co/Fwnrf57/fast-food.png" alt="">
        <h2 >DELIVEBOO</h2>
    </div>
    
    <div class="card" style="text-align: center;">
        <div class="card-text">
            <h4  style="margin: 0; padding: 0; margin: 30px 0 10px 0;">Ordine avvenuto con successo: </h4>
            <div>
                <ul>
                    <li style="list-style-type: none">
                        il numero ordine: {{ $order->id}}
                    </li>
                    <li style="list-style-type: none">
                        Cliente:   {{$order->name}}  {{$order->lastname}}
                    </li>
                    <li style="list-style-type: none">
                        email:  {{$order->email}}
                    </li>
                </ul>
            </div>
            
            <h5 style="margin: 0; padding: 0; margin-bottom: 10px;">Riepilogo piatti:</h5>
            <div style="text-align: center; display:inline-block;">
                <ul style="text-align: left;">
                    @foreach ($order->dishes as $dish)
                    <li style="list-style-type: none">
                        {{$dish->pivot->quantity}} - {{$dish->name}} {{$dish->price}}€
                    </li>
                    @endforeach
                </ul>
            </div>
            <h3> Totale ordine : <span class="green">{{$order->amount}} €</span></h3>
        </div>
    </div>

    
</body>
</html>