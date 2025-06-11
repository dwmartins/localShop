<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteCustomization extends Model
{
    use HasFactory;

    /**
     * Colors: primary, success, warning, danger, link
     */

    protected $fillable = [
        'colors',
        'default_colors',
        'font_family',
    ];

    protected $casts = [
        'colors' => 'array',
        'default_colors' => 'array',
    ];

    public function getDefaultColor($colorName)
    {
        $colors = json_decode($this->default_colors, true);
        return $colors[$colorName];
    }

    public function getColor($colorName)
    {
        $colors = json_decode($this->colors, true);
        return $colors[$colorName];
    }
}
