<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('projects.manage_projects') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
    <div class="container mx-auto px-4 py-8 mt-8">
        <div class="flex flex-col">
            <div >
                <ul class="flex border-b" id="tabs">
                    <li class="-mb-px mr-1"> 
                        <a class="bg-white dark:bg-gray-800 border-l border-t border-r rounded-t py-2 px-4 text-gray-700 dark:text-gray-300 font-semibold flex items-center" href="#auth-users-tab"><x-heroicon-o-user-group class="w-5 h-5 mr-2" />{{ __('settings.auth_tab') }}</a>
                    </li>

                </ul>
            </div>
            <div id="tab-contents">
                <div id="auth-users-tab" class="p-4 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
                    <!-- Content for Auth & Users Management in settings._auth.blade.php -->
                     @include('settings._auth')
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('#tabs a');
            const tabContents = document.querySelectorAll('#tab-contents > div');

            tabs.forEach(tab => {
                tab.addEventListener('click', function (event) {
                    event.preventDefault();

                    tabs.forEach(t => t.classList.remove('border-l', 'border-t', 'border-r', 'rounded-t', 'text-gray-700', 'dark:text-gray-300'));
                    tabContents.forEach(tc => tc.classList.add('hidden'));

                    tab.classList.add('border-l', 'border-t', 'border-r', 'rounded-t', 'text-gray-700', 'dark:text-gray-300');
                    document.querySelector(tab.getAttribute('href')).classList.remove('hidden');
                });
            });
        });
    </script>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>