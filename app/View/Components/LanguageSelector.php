<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\App;

class LanguageSelector extends Component
{
    public $languages;

    public function __construct()
    {
        // Define available languages
        $this->languages = [
            'en' => 'English',
            'fr' => 'Français',
        ];
    }

    /**
     * Get the current locale.
     */
    public function currentLocale()
    {
        return App::getLocale();
    }

    /**
     * Render the component view.
     */
    public function render()
    {
        return view('components.language-selector');
    }
}
