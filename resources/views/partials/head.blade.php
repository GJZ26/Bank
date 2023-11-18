<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title : 'Clienthub' }}</title>

    <link rel="stylesheet" href="{{ asset('css/ad.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/record.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usermanage.css') }}">
    <script src="https://kit.fontawesome.com/34117c443d.js" crossorigin="anonymous"></script>

    <script>
        function toggleInputPass(e) {
            document.getElementsByName('password')[0].type = e.target.checked ? 'text' : 'password'
        }
    </script>
</head>
