<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<body>
<div class="card m-4">
<div class="card-header">Prime Numbers</div>
<div class="card-body">
@foreach (range(1, 100) as $i)
@if(isPrime($i))
<span class="badge bg-primary">{{$i}}</span>
@else
<span class="badge bg-secondary">{{$i}}</span>
@endif
@endforeach
</div>
</div>
</body>
</html>