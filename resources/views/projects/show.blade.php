<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('projects.view_project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Back Button -->
                    <div class="mb-6">
                        <a href="{{ route('projects') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            {{ __('projects.back_to_projects') }}
                        </a>
                    </div>

                    <!-- Project Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Project Name -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.name') }}</h3>
                            <p class="text-sm">{{ $project->name }}</p>
                        </div>
                        <!-- Description -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.description') }}</h3>
                            <p class="text-sm">{{ $project->description }}</p>
                        </div>
                        <!-- Stack Technologies -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.stack_technologies') }}</h3>
                            <p class="text-sm">{{ $project->stack_technologies }}</p>
                        </div>
                        <!-- Creator -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.created_by') }}</h3>
                            <p class="text-sm">{{ $project->creator->name }}</p>
                        </div>
                        <!-- Status -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.status') }}</h3>
                            <p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                    {{ $project->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </p>
                        </div>
                        <!-- Deadline -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.deadline') }}</h3>
                            <p class="text-sm">{{ $project->deadline ? $project->deadline->format('d/m/Y') : '-' }}</p>
                        </div>
                        <!-- Team Members -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.team_members') }}</h3>
                            <p class="text-sm">{{ is_array($project->team_members) ? implode(', ', $project->team_members) : $project->team_members }}</p>
                        </div>
                        <!-- Progress -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.progress') }}</h3>
                            <p class="text-sm">{{ $project->progress }}%</p>
                        </div>
                        <!-- Priority -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.priority') }}</h3>
                            <p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                    {{ strtolower($project->priority) === 'low' ? 'bg-blue-200 text-blue-800' : (strtolower($project->priority) === 'medium' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                    {{ __('general.' . strtolower($project->priority)) }}
                                </span>
                            </p>
                        </div>
                        <!-- Repository URL -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.repository_url') }}</h3>
                            <p class="text-sm">
                                <a href="{{ $project->repository_url }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ $project->repository_url }}
                                </a>
                            </p>
                        </div>
                        <!-- Documentation URL -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.documentation_url') }}</h3>
                            <p class="text-sm">
                                <a href="{{ $project->documentation_url }}" target="_blank" class="text-blue-500 hover:underline">
                                    {{ $project->documentation_url }}
                                </a>
                            </p>
                        </div>
                        <!-- Start Date -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.start_date') }}</h3>
                            <p class="text-sm">{{ $project->start_date ? $project->start_date->format('d/m/Y') : '-' }}</p>
                        </div>
                        <!-- End Date -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-md shadow-md">
                            <h3 class="text-lg font-semibold">{{ __('projects.end_date') }}</h3>
                            <p class="text-sm">{{ $project->end_date ? $project->end_date->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
