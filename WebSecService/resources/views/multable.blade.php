@extends('layouts.master')

@section('title', "Multiplication Table of $j")

@section('content')
<div class="container">
    <h2>Multiplication Table of {{ $j }}</h2>
    <table class="table table-bordered">
        @for ($i = 1; $i <= 10; $i++)
            <tr>
                <td>{{ $j }} × {{ $i }} = {{ $j * $i }}</td>
            </tr>
        @endfor
    </table>
</div>
@endsection
