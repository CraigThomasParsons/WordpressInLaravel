<?php
namespace App\Http\Controllers;

use App\Http\Controllers\MainController;
use View;

/**
 * Home view really doesn't do much except grab the first post
 * and pass it to the view.
 */
class HomeController extends MainController {

    protected $menuRepository;

    /**
     * Home Controller main view.
     *
     * @return view
     */
    public function getIndex()
    {
        // View name should be the same name as the template.
        $viewName = 'home';
        $arrNavBarActive = array();
        $arrNavBarActive[$viewName] = true;

        $query = new \WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 20,
                    'order' => 'ASC',
                    'orderby' => 'post_title',
        ));

        $arrPosts = $query->get_posts();

        // Used in main.blade.php.
        $menuItems = $this->menuRepository->fetchGalleryMenuItems();
        $contactContent = $this->contactModalRepository->getContactContent();

        // The navBarActive variable tells main.blade.php which navbar to make
        // active.
        return View::make($viewName, array(
          'menuItems' => $menuItems,
          'contactContent' => $contactContent,
          'navBarActive' => $arrNavBarActive,
          'posts' => $arrPosts
        ));
    }
}
