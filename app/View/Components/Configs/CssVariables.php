<?php

namespace App\View\Components\Configs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CssVariables extends Component
{
    private $customizations;  

    public $custom_font_family;

    public $custom_primary;
    public $custom_success;
    public $custom_warning;
    public $custom_danger;
    public $custom_link_color;

    public $custom_primary_hover;
    public $custom_success_hover;
    public $custom_warning_hover;
    public $custom_danger_hover;
    public $custom_link_color_hover;

    public $custom_input_focus_primary;
    public $custom_input_focus_danger;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->customizations = config('website_customization');

        $this->setColors();
        $this->setFontFamily();
        $this->setColorsHover();
        $this->setInputFocus();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.configs.css-variables');
    }

    private function setColors()
    {
        $this->custom_primary = $this->customizations->getColor('primary');
        $this->custom_success = $this->customizations->getColor('success');
        $this->custom_warning = $this->customizations->getColor('warning');
        $this->custom_danger = $this->customizations->getColor('danger');
        $this->custom_link_color = $this->customizations->getColor('link');
    }

    private function setFontFamily()
    {
        $this->custom_font_family = $this->customizations->font_family;
    }

    private function setColorsHover()
    {
        $this->custom_primary_hover = $this->darkenColor($this->custom_primary, 10);
        $this->custom_success_hover = $this->darkenColor($this->custom_success, 10);
        $this->custom_warning_hover = $this->darkenColor($this->custom_warning, 10);
        $this->custom_danger_hover = $this->darkenColor($this->custom_danger, 10);
        $this->custom_link_color_hover = $this->darkenColor($this->custom_link_color, 10);
    }

    private function setInputFocus()
    {
        $this->custom_input_focus_primary = $this->generateBoxShadow($this->custom_primary);
        $this->custom_input_focus_danger = $this->generateBoxShadow($this->custom_danger);
    }

    private function darkenColor($hexColor, $percent)
    {
        $hexColor = ltrim($hexColor, '#');

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        $r = max(0, min(255, $r - ($r * $percent / 100)));
        $g = max(0, min(255, $g - ($g * $percent / 100)));
        $b = max(0, min(255, $b - ($b * $percent / 100)));

        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    private function generateBoxShadow($hexColor)
    {
        $darkColor = $this->darkenColor($hexColor, 20);
        $rgba = $this->hexToRgba($darkColor, 0.788);
        return "0px 0px 3px 0px $rgba";
    }

    private function hexToRgba($hexColor, $alpha)
    {
        $hexColor = ltrim($hexColor, '#');

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        return "rgba($r, $g, $b, $alpha)";
    }
}
