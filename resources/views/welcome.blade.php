
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        {{-- @if(isset($url)) --}}
            <img src="{{ asset('http://127.0.0.1:8000/storage/images/sKWpWggNZyOT8Y7FjpMSJRI2JEchnQObiE9IQ91d.jpg') }}" alt="Uploaded Image" style="width: 300px">
        {{-- @endif --}}
</div>
    </div>
    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Add CSRF token for Laravel forms -->
        <input type="file" name="image">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
