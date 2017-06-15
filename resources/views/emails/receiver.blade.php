<html>
<head>
    <title>Mtracker Transaction</title>
</head>
<body>
<h3>Hello, {{$receiver->full_name}}!</h3>

<p>
    You are to retrieve some goods sent by <span style="font-weight: bold;">{{$sender->full_name}}</span> at
    <span style="font-weight: bold">{{$depo}}</span>
    <br>
    Transaction Token: {{$token}}


<hr>
<p>Created on {{\Carbon\Carbon::parse($timestamp)->toFormattedDateString()}}</p>

</p>
</body>
</html>