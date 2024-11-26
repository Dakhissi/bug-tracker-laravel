<div x-data="{ open: false }" class="relative inline-block text-left">
    <div>
        <button 
            @click="open = !open" 
            type="button" 
            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none "
            id="menu-button"
            aria-expanded="true"
            aria-haspopup="true">
            {{ $languages[$currentLocale()] }}
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div 
        x-show="open"
        @click.away="open = false"
        class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="menu-button"
        tabindex="-1">
        @foreach ($languages as $locale => $name)
            <a 
                href="{{ route('change-language', $locale) }}" 
                class="block px-4 py-2 text-sm
                    {{ $locale === $currentLocale() 
                        ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' 
                        : 'text-gray-700 hover:bg-gray-200 hover:text-gray-800 dark:hover:bg-gray-600 dark:hover:text-gray-200' }}"
                role="menuitem"
                tabindex="-1">
                {{ $name }}
            </a>
        @endforeach
    </div>
</div>
