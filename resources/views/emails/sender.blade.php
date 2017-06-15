<html>
<head>
    <title>Mtracker Transaction</title>
</head>
<body>
<h3>Hello, {{$sender->full_name}}!</h3>

<p>
    You bid to transports goods to one <span style="font-weight: bold">{{$receiver->full_name}}</span>
    has been successful!.<br>
    Transaction Token: {{$token}}

<hr>
<p>Created on {{\Carbon\Carbon::parse($timestamp)->toFormattedDateString()}}</p>

</p>
</body>
</html>