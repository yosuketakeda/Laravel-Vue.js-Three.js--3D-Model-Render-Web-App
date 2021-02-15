<!DOCTYPE html>
<html>
<head>
<title>Title of the document</title>
<style>
p{
    font-size: 18px;
    margin: 8px 0;
}
</style>
</head>

<body>
<p>Name : {{$name}}</p>
<p>Company : {{$company}}</p>
<p>phone : {{$phone}}</p>
<p>email : {{$from_email}}</p>
<p>Order Number : {{$orderNumber}}</p>
<br>
<p>Message : </p>
<p>{{$note}}</p>
</body>

</html>