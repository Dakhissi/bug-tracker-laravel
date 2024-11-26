<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('bugs.title') }}: {{ $bug->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Bug Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.title') }}</h3>
                            <p class="text-sm">{{ $bug->title }}</p>
                        </div>
                        <!-- Description -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.description') }}</h3>
                            <p class="text-sm">{{ $bug->description }}</p>
                        </div>
                        <!-- Priority -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.priority') }}</h3>
                            @php
                                $priorityColors = [
                                    'P1' => 'bg-red-600 text-white',     // Most Urgent
                                    'P2' => 'bg-orange-500 text-white',  // High Priority
                                    'P3' => 'bg-yellow-400 text-black',  // Medium Priority
                                    'P4' => 'bg-green-500 text-white',   // Low Priority
                                    'P5' => 'bg-blue-500 text-white',    // Least Urgent
                                ];
                            @endphp
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $priorityColors[$bug->priority] ?? 'bg-gray-200 text-gray-800' }}">
                                {{ $bug->priority }}
                            </span>
                        </div>
                        <!-- Status -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.status') }}</h3>
                            <p class="text-sm">{{ $bug->status }}</p>
                        </div>
                        <!-- Branch -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.branch') }}</h3>
                            <p class="text-sm">{{ $bug->branch }}</p>
                        </div>
                        <!-- Project -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.project') }}</h3>
                            <p class="text-sm">{{ $bug->project->name }}</p>
                        </div>
                        <!-- Reporter -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.reporter') }}</h3>
                            <p class="text-sm">{{ $bug->reporter->name }}</p>
                        </div>
                        <!-- Assigned -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.assigned') }}</h3>
                            <p class="text-sm">
                                {{ $bug->assignee ? $bug->assignee->name : __('bugs.not_assigned') }}
                            </p>
                        </div>
                        <!-- Created At -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.created_at') }}</h3>
                            <p class="text-sm">{{ $bug->created_at }}</p>
                        </div>
                        <!-- Updated At -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('bugs.updated_at') }}</h3>
                            <p class="text-sm">{{ $bug->updated_at }}</p>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="my-8 border-gray-300 dark:border-gray-600">

                    <!-- Steps to Reproduce -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                        <h3 class="text-lg font-semibold">{{ __('bugs.steps_to_reproduce') }}</h3>
                        <p class="text-sm">{{ $bug->steps_to_reproduce }}</p>
                    </div>
                    <!-- Context -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md mt-4">
                        <h3 class="text-lg font-semibold">{{ __('bugs.context') }}</h3>
                        <p class="text-sm">{{ $bug->context }}</p>
                    </div>
                    <!-- Attachments -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md mt-4">
                        <h3 class="text-lg font-semibold">{{ __('bugs.attachments') }}</h3>
                        @if ($bug->attachments)
                            @foreach ($bug->attachments as $attachment)
                                <a href="{{ $attachment->url }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ $attachment->name }}
                                </a><br>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('bugs.no_attachments') }}</p>
                        @endif
                    </div>

                    <!-- Divider -->
                    <hr class="my-8 border-gray-300 dark:border-gray-600">

                    <!-- Solution -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                        <h3 class="text-lg font-semibold">{{ __('bugs.solution') }}</h3>
                        <p class="text-sm">{{ $bug->solution }}</p>
                    </div>
                    <!-- Resolved At -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md mt-4">
                        <h3 class="text-lg font-semibold">{{ __('bugs.resolved_at') }}</h3>
                        <p class="text-sm">{{ $bug->resolved_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
