<x-error-layout>
    <x-slot name="title">
        {{ __('Not Found') }}
    </x-slot>

    <div class="min-h-screen flex items-center justify-center bg-transparent">
        <div class="text-center">
        <svg fill="#000000" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" class="w-60 h-60 mx-auto" aria-hidden="true">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>bird-mask</title> <path d="M14.763 15.451c0.161 0.831 0.103 5.21 0.103 5.21s-1.632-3.753-1.793-4.583 0.087-1.644 0.554-1.817c0.467-0.173 0.975 0.36 1.136 1.19l-0 0zM17.015 15.537c-0.161 0.831-0.103 5.21-0.103 5.21s1.632-3.753 1.793-4.583-0.087-1.644-0.554-1.817c-0.467-0.173-0.975 0.36-1.136 1.19l0 0zM16.871 11.82c-0.307-0.078-0.627-0.12-0.957-0.12-0.402-0-0.789 0.062-1.157 0.176-0.531 1.158-1.493 2.078-2.681 2.554-0.214 0.54-0.332 1.134-0.332 1.758 0 2.48 4.171 14.615 4.171 14.615s4.171-12.136 4.17-14.615h0c0-0.595-0.109-1.162-0.304-1.682-1.301-0.456-2.355-1.436-2.91-2.687zM15.779 1.439c-6.19 0-11.209 3.679-11.209 8.217s5.018 8.217 11.209 8.217 11.209-3.679 11.209-8.217c-0-4.538-5.018-8.217-11.209-8.217zM10.223 14.786c-2.754 0-4.987-2.233-4.987-4.987s2.233-4.987 4.987-4.987 4.987 2.233 4.987 4.987c-0 2.754-2.233 4.987-4.987 4.987zM21.431 14.786c-2.754 0-4.987-2.233-4.987-4.987s2.233-4.987 4.987-4.987 4.987 2.233 4.987 4.987c-0 2.754-2.233 4.987-4.987 4.987zM10.47 6.132c-1.963 0-3.554 1.591-3.554 3.554s1.591 3.554 3.554 3.554c1.963 0 3.554-1.591 3.554-3.554s-1.591-3.554-3.554-3.554zM11.031 10.416c-0.648 0-1.174-0.525-1.174-1.174s0.525-1.174 1.174-1.174 1.174 0.525 1.174 1.174c0 0.648-0.525 1.174-1.174 1.174zM21.702 6.132c-1.963 0-3.554 1.591-3.554 3.554s1.591 3.554 3.554 3.554c1.963 0 3.554-1.591 3.554-3.554s-1.591-3.554-3.554-3.554zM22.197 10.416c-0.648 0-1.174-0.525-1.174-1.174s0.525-1.174 1.174-1.174 1.174 0.525 1.174 1.174c0 0.648-0.525 1.174-1.174 1.174z"></path> </g>
        </svg>
            <h1 class="text-5xl font-bold">{{ __('404 - Well, This is Awkward!') }}</h1>
            <p class="text-xl text-left mt-4">{{ __('It seems you ve wandered off the map. The page you re looking for doesn t exist, but don t worry the crow is on the case! (Though it might just be staring at you, wondering what you re doing here.)') }}</p>
            <ul
                class="list-disc text-left mt-4"
            >
                <li>{{ __('If you typed in the URL, check your spelling. It could be a typo.') }}</li>
                <li>{{ __('If you clicked on a link, it may be out of date.') }}</li>
                <li>{{ __('Or just enjoy the crow s confused expression. 🐦') }}</li>
            </ul>
            <a href="{{ url('/') }}" class="mt-6 inline-block bg-gray-500 text-white px-4 py-2 rounded">
                {{ __('Go Home') }}
            </a>
        </div>
    </div>
</x-error-layout>