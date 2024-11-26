<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.name') }} <span class="text-red-500">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.description') }}</label>
        <textarea name="description" id="description" rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">{{ old('description', $project->description) }}</textarea>
        @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="stack_technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.stack_technologies') }}</label>
        <input type="text" name="stack_technologies" id="stack_technologies" value="{{ old('stack_technologies', $project->stack_technologies) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
        @error('stack_technologies')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>


    <div class="mb-4">
        <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.deadline') }}</label>
        <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $project->deadline ? $project->deadline->format('Y-m-d') : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
        @error('deadline')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.priority') }}</label>
        <select name="priority" id="priority"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
            <option value="low" {{ old('priority', $project->priority) === 'low' ? 'selected' : '' }}>{{ __('projects.low') }}</option>
            <option value="medium" {{ old('priority', $project->priority) === 'medium' ? 'selected' : '' }}>{{ __('projects.medium') }}</option>
            <option value="high" {{ old('priority', $project->priority) === 'high' ? 'selected' : '' }}>{{ __('projects.high') }}</option>
        </select>
        @error('priority')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="repository_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.repository_url') }}</label>
        <input type="url" name="repository_url" id="repository_url" value="{{ old('repository_url', $project->repository_url) }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
        @error('repository_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.start_date') }}</label>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
        @error('start_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.end_date') }}</label>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
        @error('end_date')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('projects.status') }}</label>
        <select name="status" id="status"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-100">
            <option value="active" {{ old('status', $project->status) === 'active' ? 'selected' : '' }}>{{ __('projects.active') }}</option>
            <option value="inactive" {{ old('status', $project->status) === 'inactive' ? 'selected' : '' }}>{{ __('projects.inactive') }}</option>
        </select>
        @error('status')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex justify-end">
        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            {{ __('projects.update_project') }}
        </button>
    </div>
</form>