<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>Orders of Table {{$orders->orders_table}}</title>
</head>
<body>
Order id : {{$orders->id}} <br>
This is orders of table {{$orders->orders_table}} <br>
<table border=0>
<tr></tr><th>Menu</th><th>Price</th><th>Quantity</th><th>Net Price</th></tr>
@foreach ($orders_detail as $row)
<tr><td>{{$row->menu_name}}</td><td>{{$row->menu_price}}</td><td>{{$row->qty}}</td><td>{{$row->net}}</td></tr>
@endforeach
</table> <br>
The total price is {{$orders->orders_total}}
</body>
</html>