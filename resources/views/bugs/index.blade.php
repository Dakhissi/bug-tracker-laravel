<x-app-layout>
    <x-slot name="header">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('bugs.manage_bugs') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('create bugs')
                        <div class="mb-4">
                            <a href="{{ route('bugs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                + {{ __('bugs.create_new_bug') }}
                            </a>
                        </div> 
                    @endcan

                    <div class="mb-4 flex justify-between items-center">
                        <!-- Search Form -->
                        <form action="{{ route('bugs') }}" method="GET" class="flex items-center w-full space-x-2">
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
                                <th class="px-4 py-2"></th>
                                <th class="px-4 py-2  text-center">{{ __('bugs.title') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('bugs.description') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('bugs.project') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('bugs.reporter') }}</th>
                                <th class="px-4 py-2  text-center">{{ __('bugs.assigned') }}</th>
                                <th class="px-4 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bugs as $bug)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-2 text-center">
                                        @php
                                            // Map priority to colors with a diverse, accessible palette
                                            $priorityColors = [
                                                'P1' => 'bg-red-600 text-white',     // Urgent (Red)
                                                'P2' => 'bg-orange-500 text-white',  // High (Orange)
                                                'P3' => 'bg-yellow-400 text-black',  // Medium (Yellow)
                                                'P4' => 'bg-green-500 text-white',   // Low (Green)
                                                'P5' => 'bg-blue-500 text-white',    // Minimal (Blue)
                                            ];
                                        @endphp
                                        <span 
                                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $priorityColors[$bug->priority] ?? 'bg-gray-200 text-gray-800' }}">
                                            {{ $bug->priority }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $bug->status === 'open' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ __($bug->status) }}
                                        </span>
                                    </td>
                                    
                                        
                                    <td class="px-4 py-2 text-center">{{ $bug->title }}</td>
                                    <td class="px-4 py-2 text-center">{{ $bug->description }}</td>
                                    <td class="px-4 py-2 text-center">{{ $bug->project->name }}</td>
                                    <td class="px-4 py-2 text-center">{{ $bug->reporter->name }}</td>
                                    <td class="px-4 py-2 text-center">{{ $bug->assignee ? $bug->assignee->name : __('bugs.not_assigned') }}</td>
                                    <td class="w-10">
                                        <button id="dropdownMenuIconButton{{ $bug->id }}" 
                                        data-dropdown-toggle="dropdownDots{{ $bug->id }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                            </svg>
                                        </button>
                                        <div id="dropdownDots{{ $bug->id }}"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                <!-- View -->
                                                @can('view bugs')
                                                <li class="flex items-center ps-2 rounded" > 
                                                        <x-heroicon-o-eye class="w-5 h-5" />
                                                        <a href="{{ route('bugs.show', $bug) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            {{ __('general.view') }}</a>
                                                </li>
                                                @endcan
                                                <!-- Assigne Team member -->
                                                @can('edit bugs')
                                                <li class="flex items-center ps-2 rounded" > 
                                                    <x-heroicon-o-user class="w-5 h-5" />
                                                    <button 
                                                        data-modal-toggle="assigneModal{{ $bug->id }}" 
                                                        data-modal-target="assigneModal{{ $bug->id }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ __('bugs.assigne') }}</button>

                                                </li>
                                                @endcan
                                                <!-- Solve -->
                                                @can('edit bugs')
                                                <li class="flex items-center ps-2 rounded" > 
                                                    <x-heroicon-c-check class="w-5 h-5" />
                                                    <button 
                                                        data-modal-toggle="solveModal{{ $bug->id }}" 
                                                        data-modal-target="solveModal{{ $bug->id }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ __('bugs.solve') }}</button>

                                                </li>
                                                @endcan
                                                <!-- Edit -->
                                                @can('edit bugs')
                                                <li class="flex items-center ps-2 rounded" >
                                                    <x-heroicon-o-pencil class="w-5 h-5" />
                                                    <a href="{{ route('bugs.edit', $bug) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ __('general.edit') }}</a>
                                                </li>
                                                @endcan
                                                <!-- Close -->
                                                @can('close bugs')
                                                <li class="flex items-center ps-2 rounded">
                                                    <x-heroicon-o-x-circle class="w-5 h-5" />
                                                    <button 
                                                    data-modal-toggle="{{ $bug->status === 'closed' ? 'reopenModal'.$bug->id : 'closeModal'.$bug->id }}"  
                                                    data-modal-target="{{ $bug->status === 'closed' ? 'reopenModal'.$bug->id : 'closeModal'.$bug->id }}"
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                        {{ $bug->status === 'closed' ? __('bugs.reopen') : __('bugs.close') }}
                                                    </button>
                                                </li>
                                                @endcan
                                                <!-- Delete -->
                                                @can('delete bugs')
                                                <li>
                                                <li class="flex items-center ps-2 rounded">
                                                    <x-heroicon-o-trash class="w-5 h-5" />
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('general.delete') }}</a>
                                                </li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                        {{ __('bugs.no_bugs_found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $bugs->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($bugs as $bug)
        <!-- Solve Modal -->
        <div id="solveModal{{ $bug->id }}" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden overflow-y-auto" data-modal="solveModal{{ $bug->id }}">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="relative w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600  ps-2 rounded ">
                        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            {{ __('bugs.solve_bug') }}
                        </h2>
                        <button data-modal-close="solveModal{{ $bug->id }}" class="modal-close">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                <div class="p-6 space-y-6">
                     <!-- AI Diagnostic Tool -->
                        <div class="ai-diagnostic-tool">
                            <div id="chatWindow{{ $bug->id }}" class="chat-window bg-gray-100 dark:bg-gray-800 p-4 rounded h-64 overflow-y-auto">
                                <!-- Chat messages will be appended here -->
                            </div>
                            <div class="mt-4 flex">
                                <input type="text" id="userMessage{{ $bug->id }}" class="flex-grow rounded-l-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 px-4 py-2 focus:outline-none" placeholder="{{ __('Type your message...') }}">
                                <button type="button" onclick="sendMessage({{ $bug->id }})" class="rounded-r-md bg-gray-500 text-white px-4 py-2 hover:bg-gray-600 focus:outline-none">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    <form action="{{ route('bugs.solve', $bug) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mt-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="solution">
                                {{ __('bugs.solution') }}
                            </label>
                            <textarea name="solution" id="solution" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required></textarea>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <x-heroicon-o-check class="w-5 h-5 mr-2" />
                                {{ __('general.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>


        <!-- Assignee Modal -->
        <div id="assigneModal{{ $bug->id }}" ctabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden w-full overflow-y-auto" data-modal="assigneModal{{ $bug->id }}">
            <div class="flex items-center justify-center min-h-screen px-4">
                <div class="relative  w-full max-w-2xl max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600  ps-2 rounded ">
                        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                            {{ __('bugs.assigne_bug') }}
                        </h2>
                        <button data-modal-close="assigneModal{{ $bug->id }}" class="modal-close">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                </div>
                <div class="p-6 space-y-6">
                    <form action="{{ route('bugs.assign', $bug) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="assigned_to">
                                {{ __('bugs.assigne') }}
                            </label>
                            <select name="assigned_to" id="assigned_id" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <x-heroicon-o-check class="w-5 h-5 mr-2" />
                                {{ __('general.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <!-- Close Modal -->
        <div id="{{ $bug->status === 'closed' ? 'reopenModal'.$bug->id : 'closeModal'.$bug->id }}" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden overflow-y-auto" data-modal="{{ $bug->status === 'closed' ? 'reopenModal'.$bug->id : 'closeModal'.$bug->id }}">
        <div class="flex items-center justify-center min-h-screen px-4">
        <div class="relative w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600  ps-2 rounded ">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        {{ $bug->status === 'closed' ? __('bugs.reopen_bug') : __('bugs.close_bug') }}
                    </h2>
                    <button data-modal-close="{{ $bug->status === 'closed' ? 'reopenModal'.$bug->id : 'closeModal'.$bug->id }}" class="modal-close">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <form action="{{ $bug->status === 'closed' ? route('bugs.reopen', $bug) : route('bugs.close', $bug) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mt-2">
                            <!-- Message based on status -->
                            <p class="text-sm text-gray-700 dark:text-gray-200">
                                {{ $bug->status === 'closed' ? __('bugs.reopen_message') : __('bugs.close_message') }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <x-heroicon-o-check class="w-5 h-5 mr-2" />
                                {{ __('general.save') }}
                            </button>
                        </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach

    <script>
    function sendMessage(bugId) {
        const messageInput = document.getElementById(`userMessage${bugId}`);
        const chatWindow = document.getElementById(`chatWindow${bugId}`);
        const message = messageInput.value.trim();

        if (message === '') return;

        // Display user's message
        const userMessageDiv = document.createElement('div');
        userMessageDiv.classList.add('user-message', 'mb-2', 'text-right');
        userMessageDiv.innerHTML = `<span class="bg-blue-500 text-white px-3 py-1 rounded-lg inline-block">${message}</span>`;
        chatWindow.appendChild(userMessageDiv);
        chatWindow.scrollTop = chatWindow.scrollHeight;

        // Clear input
        messageInput.value = '';

        // Send message to the server via AJAX
        fetch(`{{ url('/ai-diagnostic') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                message: message,
                bug_id: bugId
            })
        })
        .then(response => response.json())
        .then(data => {
            // Display AI's response
            const aiMessageDiv = document.createElement('div');
            aiMessageDiv.classList.add('ai-message', 'mb-2', 'text-left');
            aiMessageDiv.innerHTML = `<span class="bg-gray-300 text-gray-900 px-3 py-1 rounded-lg inline-block">${data.reply}</span>`;
            chatWindow.appendChild(aiMessageDiv);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors appropriately
        });
    }
</script>

</x-app-layout>
