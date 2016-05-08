<?php
namespace App\Http\Controllers;

use App\Http\Controllers\MainController;
use DB;
use View;

/**
 * Display the about page.
 */
class AboutController extends MainController {

    /**
     * This is for the about section.
     *
     * @return view
     */
    public function getIndex()
    {
        // View name should be the same name as the template.
        $viewName = 'about';
        $arrNavBarActive = array();
        $arrNavBarActive[$viewName] = true;

        $results = DB::select('
          SELECT *
            FROM `phposts`
           WHERE `post_type` = "page"
             AND `post_name` = "about"
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
