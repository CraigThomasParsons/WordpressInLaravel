<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController {

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

        $query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 20,
                    'order' => 'ASC',
                    'orderby' => 'post_title',
        ));

        $arrPosts = $query->get_posts();

        // The navBarActive variable tells main.blade.php which navbar to make
        // active.
        return View::make($viewName, array(
          'navBarActive' => $arrNavBarActive,
          'posts'        => $arrPosts
        ));
    }
}
