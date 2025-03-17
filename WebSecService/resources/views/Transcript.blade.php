@extends('layouts.master')
@section('title', 'Transcript')
@section('content')

<div class="container mt-3">
  <h2>Transcript</h2>            
  <table class="table">
    <thead>
      <tr>
        <th>Subject</th>
        <th>Grade</th>
        <th>Max Grade</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($grade->grades as $grade)
<tr>
    <td>{{$grade->subject}}</td>
    <td>{{$grade->grade}}</td>
    <td>{{$grade->maxGrade}}</td>
    
</tr>
@endforeach


    </tbody>
  </table>
</div>
@endsection
