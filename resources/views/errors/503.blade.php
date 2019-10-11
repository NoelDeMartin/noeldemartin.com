<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noel De Martin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@1.1.2/dist/tailwind.min.css">
</head>
<body class="w-screen h-screen flex flex-col bg-gray-300 justify-center items-center p-8">
    <h1 class="text-center text-2xl font-bold mb-4">Site under maintenance, I'll be right back!</h1>
    <h2 class="text-center text-sm mb-2">In the meanwhile, you can find me here:</h2>

    <ul class="flex flex-wrap justify-center">
        @foreach (content_socials() as $social)
            @if (isset($social->hide_in_maintenance))
                @continue
            @endif

            <li class="flex">
                <a
                    href="{{ $social->url }}"
                    title="{{ $social->name }}"
                    class="text-sm underline mx-2 text-blue-600 hover:text-blue-800"
                    @attrs($social->extras)
                >
                    {{ $social->short_name }}
                </a>
                @if (!$loop->last)
                    |
                @endif
            </li>
        @endforeach
    </ul>

</body>
</html>
