<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="icon" type="image/x-icon" href="{{ asset('logo.ico') }}">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135" width="100" height="100" class="svg-animations">
                    <path 
                        d="M67.5 0C30.2755 0 0 30.2755 0 67.5C0 104.724 30.2755 135 67.5 135C71.1788 135 74.7759 134.7 78.2913 134.128C101.223 130.422 120.325 115.134 129.373 94.4646C132.997 86.194 135.014 77.0786 135.014 67.5C135 30.2755 104.724 0 67.5 0ZM126.253 91.3444C126.048 91.14 125.83 90.922 125.639 90.7312L118.2 83.2918C111.619 76.7107 94.4918 74.9258 85.431 81.2207C94.1784 75.1438 101.877 71.3696 106.073 71.9282L97.3668 62.4586C94.3556 59.4474 91.3444 56.3817 88.265 53.3569C82.1881 47.389 74.3399 39.786 65.0338 41.0123C60.0469 41.8298 55.6051 44.6503 52.7301 48.8333C52.3214 49.3783 51.9398 49.9369 51.5856 50.5092L38.0011 53.2888C37.0746 53.5204 36.3388 54.2425 36.0799 55.1691C35.8211 56.0956 36.0799 57.0902 36.7612 57.7715L47.607 66.0693V66.0557C49.4873 67.5136 50.6318 68.3993 53.3705 71.0698C62.336 80.3487 59.9788 86.4392 59.9788 97.1079C60.1832 105.024 62.3496 112.763 66.2737 119.644C68.4538 123.65 71.1788 127.302 74.3535 130.545C72.0917 130.79 69.8027 130.926 67.4864 130.926C32.5373 130.912 4.08761 102.476 4.08761 67.5C4.08761 32.5237 32.5373 4.08761 67.5 4.08761C102.463 4.08761 130.912 32.5373 130.912 67.5C130.912 75.9341 129.25 83.9867 126.253 91.3444ZM68.9988 59.1068C68.9988 61.2596 67.2547 63.0036 65.1019 63.0036C62.9491 63.0036 61.2051 61.2596 61.2051 59.1068C61.2051 56.954 62.9491 55.2099 65.1019 55.2099C67.2684 55.2099 68.9988 56.954 68.9988 59.1068Z" 
                        class="fill-gray-800 dark:fill-gray-200"
                    />
                </svg>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
