<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


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

</body>
</html>
