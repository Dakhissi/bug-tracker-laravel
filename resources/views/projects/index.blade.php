<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('projects.manage_projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create projects')
                        <div class="mb-4">
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                + {{ __('projects.create_new_project') }}
                            </a>
                        </div> 
                    @endcan

                    <div class="mb-4 flex justify-between items-center">
                        <!-- Search Form -->
                        <form action="{{ route('projects') }}" method="GET" class="flex items-center w-full space-x-2">
                            <!-- Search Input -->
                            <input type="text" name="query" placeholder="{{ __('general.search_name_description') }}"
                                   value="{{ request('query') }}"
                                   class="flex-grow rounded-l-md border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   aria-label="{{ __('general.search_name_description') }}">
                            <!-- Filter Dropdown -->
                            <select name="filter" class="border-l border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">{{ __('general.all_statuses') }}</option>
                                <option value="active" {{ request('filter') === 'active' ? 'selected' : '' }}>
                                    {{ __('general.active') }}
                                </option>
                                <option value="inactive" {{ request('filter') === 'inactive' ? 'selected' : '' }}>
                                    {{ __('general.inactive') }}
                                </option>
                            </select>
                            <!-- Submit Button -->
                            <button type="submit"
                                    class="rounded-r-md bg-gray-500 text-white px-4 py-2 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                {{ __('general.search') }}
                            </button>
                        </form>
                    </div>

                    <table class="table-auto w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2  text-center">{{ __('projects.name') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('projects.description') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('projects.priority') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('projects.deadline') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('projects.status') }}</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 text-center">{{ $project->name }}</td>
                                    <td class="px-4 py-2 text-center">{{ $project->description ?? '-' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            {{ strtolower($project->priority) === 'low' ? 'bg-blue-200 text-blue-800' : (strtolower($project->priority) === 'medium' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                            {{ __('general.' . strtolower($project->priority)) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center">{{ $project->deadline ? $project->deadline->format('d/m/Y') : '-' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            {{ $project->status === 'active' ? 'bg-green-200 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="relative w-10">
                                        <button 
                                            id="dropdownMenuIconButton{{ $project->id }}"
                                            data-dropdown-toggle="dropdownDots{{ $project->id }}" 
                                            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                            </svg>
                                        </button>
                                        <div 
                                            id="dropdownDots{{ $project->id }}"
                                            class="absolute right-0 z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                <!-- View -->
                                            @can('view projects')
                                            <li class="flex items-center ps-2 rounded" >
                                                
                                                    <x-heroicon-o-eye class="w-5 h-5" />
                                                    <a href="{{ route('projects.show', $project) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('general.view') }}</a>
                                            </li>
                                            @endcan
                                            <!-- Edit -->
                                            @can('edit projects')
                                            <li class="flex items-center ps-2 rounded" >
                                                <x-heroicon-o-pencil class="w-5 h-5" />
                                                <a href="{{ route('projects.edit', $project) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                    {{ __('general.edit') }}
                                                </a>
                                            </li>
                                            @endcan
                                            @can('edit projects')
                                            <li class="flex items-center ps-2 rounded" >
                                                <x-heroicon-o-users class="w-5 h-5" />
                                                <button 
                                                    data-modal-target="manageTeamMembersModal{{ $project->id }}" 
                                                    data-modal-toggle="manageTeamMembersModal{{ $project->id }}"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ __('general.team_members') }}
                                                </button>
                                            </li>
                                            @endcan
                                            
                                            <!-- Delete -->
                                            @can('delete projects')
                                            <li >
                                                <form action="{{ route('projects.destroy', $project) }}" class="flex items-center ps-2 rounded" method="POST" class="block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-heroicon-o-trash class="w-5 h-5" />
                                                    <button type="submit" class="w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ __('general.delete') }}
                                                    </button>
                                                </form>
                                            </li>
                                            @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                        {{ __('projects.no_projects_found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $projects->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @forelse ($projects as $project)
    <!-- Manage Team Members Modal -->
    <div id="manageTeamMembersModal{{ $project->id }}" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden overflow-y-auto" data-modal>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('general.manage_team_members') }}
                    </h3>
                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="manageTeamMembersModal{{ $project->id }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                <form action="{{ route('projects.addTeam', $project) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="add_team_members" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('general.add_team_members') }}
                        </label>
                        <select id="add_team_members" name="team_members[]" multiple class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            @foreach($users as $user)
                            <!-- remove already users in team members -->
                            @if(is_array($project->team_members) && in_array($user->id, $project->team_members))
                                @continue
                            <option value="{{ $user->id }}" class="flex items-center" >
                                        <img 
                                        src="{{ $user->profile_photo_url ?: asset('default-avatar.jpg') }}" 
                                        onerror="this.src='{{ asset('default-avatar.jpg') }}'" 
                                        alt="{{ $user->name }}" 
                                        class="w-6 h-6 rounded-full">
                                            {{ $user->name }}
                                        </option>
                            @endif
                            @endforeach

                        </select>
                    </div>
                    <button type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        {{ __('general.save') }}
                    </button>
                </form>

                <!-- Remove Team Members Form -->
                <form action="{{ route('projects.removeTeam', $project) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="remove_team_members" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            {{ __('general.delete_team_members') }}
                        </label>
                        <select id="remove_team_members" name="team_members[]" multiple class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            @if(is_array($project->team_members))
                                @foreach($project->team_members as $memberId)
                                    @php $member = $users->find($memberId); @endphp
                                    @if($member)
                                        <option value="{{ $member->id }}" class="flex items-center" >
                                        <img 
                                        src="{{ $member->profile_photo_url ?: asset('default-avatar.jpg') }}" 
                                        onerror="this.src='{{ asset('default-avatar.jpg') }}'" 
                                        alt="{{ $member->name }}" 
                                        class="w-6 h-6 rounded-full">
                                            {{ $member->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        {{ __('general.save') }}
                    </button>
                </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    //end loop
    @endforelse
    
</x-app-layout>
