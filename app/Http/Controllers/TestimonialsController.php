<?php
namespace App\Http\Controllers;

use DB;
use View;

/**
 * Display the testimonials page.
 */
class TestimonialsController extends MainController {

    /**
     * This is for the testimonials section.
     *
     * @return view
     */
    public function getIndex()
    {
        // View name should be the same name as the template.
        $viewName = 'testimonials';
        $arrNavBarActive = array();
        $arrNavBarActive[$viewName] = true;

        $results = DB::select('
          SELECT *
            FROM `phposts`
           WHERE `post_type` = "page"
             AND `post_name` = "testimonials"
             AND `post_status` != "trash"'
        );

        $postContent = '';
        foreach($results as $result) {
            $postContent .= $result->post_content;
        }

        // Used in main.blade.php.
        $menuItems = $this->menuRepository->fetchGalleryMenuItems();
        $contactContent = $this->contactModalRepository->getContactContent();
        $viewModel = $this->websiteViewModel;

        // The navBarActive variable tells main.blade.php which navbar to make
        // active.
        return View::make($viewName, array(
          'menuItems' => $menuItems,
          'navBarActive' => $arrNavBarActive,
          'postContent' => $postContent,
          'contactContent' => $contactContent,
          'viewModel' => $viewModel
        ));
    }
}
