<button @click="darkMode = !darkMode" class="focus:outline-none">
    <span x-show="!darkMode">
        <x-heroicon-o-sun class="w-6 h-6 text-gray-800" />
    </span>
    <span x-show="darkMode">
        <x-heroicon-o-moon class="w-6 h-6 text-gray-200" />
    </span>
</button>