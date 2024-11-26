<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($method)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Project -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="project_id">
                {{ __('bugs.project') }} <span class="text-red-500">*</span>
            </label>
            <select name="project_id" id="project_id" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ $bug->project_id == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Title -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="title">
                {{ __('bugs.title') }} <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" id="title" value="{{ old('title', $bug->title) }}" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
        </div>

        <!-- Description -->
        <div class="form-group col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="description">
                {{ __('bugs.description') }} <span class="text-red-500">*</span>
            </label>
            <textarea name="description" id="description" rows="4" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>{{ old('description', $bug->description) }}</textarea>
        </div>

        <!-- Steps to Reproduce -->
        <div class="form-group col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="steps_to_reproduce">
                {{ __('bugs.steps_to_reproduce') }} <span class="text-red-500">*</span>
            </label>
            <textarea name="steps_to_reproduce" id="steps_to_reproduce" rows="4" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>{{ old('steps_to_reproduce', $bug->steps_to_reproduce) }}</textarea>
        </div>

        <!-- Context -->
        <div class="form-group col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="context">
                {{ __('bugs.context') }} <span class="text-red-500">*</span>
            </label>
            <textarea name="context" id="context" rows="4" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>{{ old('context', $bug->context) }}</textarea>
        </div>

        <!-- Attachments -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="attachments">
                {{ __('bugs.attachments') }}
            </label>
            <input type="file" name="attachments[]" id="attachments" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" multiple>
        </div>

        <!-- Branch -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="branch">
                {{ __('bugs.branch') }}
            </label>
            <input type="text" name="branch" id="branch" value="{{ old('branch', $bug->branch) }}" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        </div>

        <!-- Status -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="status">
                {{ __('bugs.status') }} <span class="text-red-500">*</span>
            </label>
            <select name="status" id="status" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                <option value="open" {{ $bug->status == 'open' ? 'selected' : '' }}>{{ __('bugs.status_open') }}</option>
                <option value="in_progress" {{ $bug->status == 'in_progress' ? 'selected' : '' }}>{{ __('bugs.status_in_progress') }}</option>
                <option value="resolved" {{ $bug->status == 'resolved' ? 'selected' : '' }}>{{ __('bugs.status_resolved') }}</option>
                <option value="closed" {{ $bug->status == 'closed' ? 'selected' : '' }}>{{ __('bugs.status_closed') }}</option>
            </select>
        </div>

        <!-- Priority -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="priority">
                {{ __('bugs.priority') }} <span class="text-red-500">*</span>
            </label>
            <select name="priority" id="priority" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                <option value="P1" {{ $bug->priority == 'P1' ? 'selected' : '' }}>P1</option>
                <option value="P2" {{ $bug->priority == 'P2' ? 'selected' : '' }}>P2</option>
                <option value="P3" {{ $bug->priority == 'P3' ? 'selected' : '' }}>P3</option>
                <option value="P4" {{ $bug->priority == 'P4' ? 'selected' : '' }}>P4</option>
                <option value="P5" {{ $bug->priority == 'P5' ? 'selected' : '' }}>P5</option>
            </select>
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="start_date">
                {{ __('bugs.start_date') }}
            </label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $bug->start_date ? $bug->start_date->toDateString() : '') }}" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        </div>

        <!-- End Date -->
        <div class="form-group">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100" for="end_date">
                {{ __('bugs.end_date') }}
            </label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $bug->end_date ? $bug->end_date->toDateString() : '') }}" class="form-control w-full bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        </div>
    </div>

    <!-- Save Button -->
    <div class="mt-4">
        <button type="submit" id="saveButton" 
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            <x-heroicon-o-check class="w-5 h-5 mr-2" />
            {{ __('general.save') }}
        </button>
    </div>
</form>