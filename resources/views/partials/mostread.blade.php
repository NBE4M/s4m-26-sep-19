<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Most Read Story</h2>

<table>
  <tr>
  <th>URL</th>
  <th>TITLE</th>
  <th>VIEWCOUNT</th>
  </tr>
  @foreach($analytics as $key)

  <tr>
    <td><a href="{{url('/')}}{{$key['url']}}">{{url('/')}}{{$key['url']}}</a></td>
    <td>{{$key['pageTitle']}}</td>
    <td>{{$key['pageViews']}}</td>
  </tr>
  @endforeach
</table>

</body>
</html>
