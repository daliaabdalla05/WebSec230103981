<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<title>Multiplication Table of 5</title>
    </head>
    <body>
    @foreach (range(1, 10) as $j)
<div class="card m-4 col-sm-5">
<div class="card-header">{{$j}} Multiplication Table</div>
<div class="card-body">
<table>
@foreach (range(1, 10) as $i)
<tr><td>{{$i}} * {{$j}}</td><td> = {{ $i * $j }}</td></li>
@endforeach
</table>
</div>
</div>    
@endforeach
</body> 