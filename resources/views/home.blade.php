<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    <form action="/fbreview/reviews" mehtod="get">
        <input name="url" type="text" />
        <button>Get review</button>
        {{ $reviwes }}
    </form>
</body>
</html>