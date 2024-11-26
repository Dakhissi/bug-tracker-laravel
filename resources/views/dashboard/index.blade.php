<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- APPS Summary -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="flex w-full">
                    <!-- TOTAL Projects -->
                    <div class="flex-1 p-6 rounded-lg shadow-sm bg-gray-600 text-white hover:bg-gray-700 transition-colors dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" style="margin: 0 0.5rem;">
                        <h3 class="text-lg font-semibold text-center">{{ __('general.all_projects') }}</h3>
                        <span class="text-2xl font-bold text-center block">{{ $totalProjects }}</span>
                    </div>

                    <!-- TOTAL Bugs -->
                    <div class="flex-1 p-6 rounded-lg shadow-sm bg-gray-600 text-white hover:bg-gray-700 transition-colors dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" style="margin: 0 0.5rem;">
                        <h3 class="text-lg font-semibold text-center">{{ __('general.all_bugs') }}</h3>
                        <span class="text-2xl font-bold text-center block">{{ $totalBugs }}</span>
                    </div>

                    <!-- My Bugs -->
                    <div class="flex-1 p-6 rounded-lg shadow-sm bg-gray-600 text-white hover:bg-gray-700 transition-colors dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" style="margin: 0 0.5rem;">
                        <h3 class="text-lg font-semibold text-center">{{ __('general.my_bugs') }}</h3>
                        <span class="text-2xl font-bold text-center block">{{ $totalUserBugs }}</span>
                    </div>

                    <!-- My Projects -->
                    <div class="flex-1 p-6 rounded-lg shadow-sm bg-gray-600 text-white hover:bg-gray-700 transition-colors dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600" style="margin: 0 0.5rem;">
                        <h3 class="text-lg font-semibold text-center">{{ __('general.my_projects') }}</h3>
                        <span class="text-2xl font-bold text-center block">{{ $totalUserProjects }}</span>
                    </div>
                </div>
            </div>
            
            <!-- App Charts -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div style="display: flex; justify-content: space-between;">
                    <!-- Project Status Chart -->
                    <div style="width: 48%;">
                        
                        {!! $projectStatusChart->container() !!}
                    </div>

                    <!-- Bug Status Chart -->
                    <div style="width: 48%;">
                        
                        {!! $bugStatusChart->container() !!}
                    </div>
                </div>

                <!-- Render Chart Scripts -->
                {!! $projectStatusChart->script() !!}
                {!! $bugStatusChart->script() !!}
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
