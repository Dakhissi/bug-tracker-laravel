<form method="POST" action="{{ $action }}" id="projectForm">
    @csrf
    @if($method ?? false)
        @method($method)
    @endif

    <!-- Project Name -->
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.name') }} <span class="text-red-500">*</span>
        </label>
        <input type="text" name="name" id="name" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="e.g., E-commerce Platform">
    </div>

    <!-- Description -->
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-100 " for="description" >
            {{ __('projects.description') }} <span class="text-red-500">*</span>
        </label>
        <textarea name="description" id="description" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="e.g., A project to build a new e-commerce platform"></textarea>
    </div>

    <!-- team members -->
     <!-- multistelect dropdown -->
      <div class="form-group mb-4">
        <label for="team_members" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.team_members') }} <span class="text-red-500">*</span>
        </label>
        <select name="team_members[]" id="team_members" required multiple
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @foreach($users as $user)
                <option class="text-gray-700"
                value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

    <!-- Stack Technologies -->
    <div class="mb-4">
        <label for="stack_technologies" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.stack_technologies') }} <span class="text-red-500">*</span>
        </label>
        <input type="text" name="stack_technologies" id="stack_technologies" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="e.g., Laravel, Vue.js, TailwindCSS">
    </div>


    <!-- Deadline -->
    <div class="form-group mb-4">
        <label for="deadline" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.deadline') }} <span class="text-red-500">*</span>
        </label>
        <input type="date" name="deadline" id="deadline" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>

    <!-- Priority -->
    <div class="form-group mb-4">
        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.priority') }} <span class="text-red-500">*</span>
        </label>
        <select name="priority" id="priority" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <option value="low">{{ __('general.low') }}</option>
            <option value="medium">{{ __('general.medium') }}</option>
            <option value="high">{{ __('general.high') }}</option>
        </select>
    </div>

    <!-- Repository URL -->
    <div class="form-group mb-4">
        <label for="repository_url" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.repository_url') }} <span class="text-red-500">*</span>
        </label>
        <input type="url" name="repository_url" id="repository_url" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
            placeholder="https://github.com/your-repo">
    </div>

    <!-- Start Date -->
    <div class="form-group mb-4">
        <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
            {{ __('projects.start_date') }} <span class="text-red-500">*</span>
        </label>
        <input type="date" name="start_date" id="start_date" required
            class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <button type="submit" id="saveButton" disabled
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            <x-heroicon-o-check class="w-5 h-5 mr-2" />
            {{ __('general.save') }}
        </button>
    </div>
</form>

<!-- JavaScript to Enable/Disable the Save Button -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('projectForm');
        const saveButton = document.getElementById('saveButton');

        const validateForm = () => {
            const inputs = Array.from(form.querySelectorAll('input[required], textarea[required], select[required]'));
            const allFilled = inputs.every(input => {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    return input.checked;
                } else if (input.tagName.toLowerCase() === 'select' && input.multiple) {
                    return input.selectedOptions.length > 0;
                } else {
                    return input.value.trim() !== '';
                }
            });
            saveButton.disabled = !allFilled;
        };

        form.addEventListener('input', validateForm);
        form.addEventListener('change', validateForm);
    });
</script>
