<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>


    <title>Document</title>
</head>
<body>

@if (session('success'))
    <div id="flash-message" class="flash success">
        <span>{{ session('success') }}</span>
        <button class="close-btn" onclick="document.getElementById('flash-message').remove()">X</button>
    </div>

    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }
        }, 4000);
    </script>
@endif

</body>
</html>
