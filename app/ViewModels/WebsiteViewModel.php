<?php
namespace App\ViewModels;

use Config;

/**
 * Created this class to contain information like the title of the website.
 */
class WebsiteViewModel
{
    public $navBarLabel;

    /**
     * Build values for the website by the config file.
     */
    public function __construct()
    {
        $this->navBarLabel = $value = Config::get('app.menu_title');
        $this->titleTag = $value = Config::get('app.title_tag');
    }
}