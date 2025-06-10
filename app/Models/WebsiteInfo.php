<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteInfo extends Model
{
    protected $table = 'website_info';

    protected $fillable = [
        'website_name', 'email', 'phone', 'country', 'city', 'state', 'address',
        'instagram', 'facebook', 'x', 'description', 'keywords',
        'favicon', 'logo_image', 'cover_image', 'default_image',
    ];

    private $imagesPath = "/storage/uploads/site/images";

    private $defaultImages = [
        'favicon'       => '/assets/images/favicon.png',
        'logo_image'     => '/assets/images/logo_image.webp',
        'cover_image'    => '/assets/images/cover_image.webp',
        'default_image'  => '/assets/images/default_image.webp'
    ];

    public function getWebsiteName() {
        return $this->website_name ? $this->website_name : 'My website';
    }

    public function getFavicon() {
        if(!$this->favicon) {
            return $this->defaultImages['favicon'];
        }

        return "$this->imagesPath/$this->favicon";
    }

    public function getImage(string $imageType) {
        $imageProperty = $this->{$imageType} ?? null;

        if(!$imageProperty) {
            return $this->defaultImages[$imageType];
        }

        return "$this->imagesPath/$imageProperty";
    }
}
