<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello, {{ $firstName }} {{ $lastName }}!</h1>
    <form action="about" method="post">
        @csrf
        <input type="text" name="firstName" placeholder="First Name">
        <input type="text" name="lastName" placeholder="Last Name"> <br> <br>
        <select name="array" id="array">
            @foreach ($arrays as $key => $array)
                <option value="{{ $key }}">{{ $array }}</option>
            @endforeach
        </select> <br> <br>
        <input type="submit" value="send data">
    </form>
</body>
</html>