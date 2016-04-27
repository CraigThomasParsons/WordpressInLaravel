<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ContactController extends BaseController {

    /**
     * This is for the contact section.
     *
     * @return view
     */
    public function getIndex()
    {
        // View name should be the same name as the template.
        $viewName = 'contact';
        $arrNavBarActive = array();
        $arrNavBarActive[$viewName] = true;

        $results = DB::select('
          SELECT *
            FROM `phposts`
           WHERE `post_type` = "page"
             AND `post_name` = "contact"
             AND `post_status` != "trash"'
        );

        $postContent = '';
        foreach($results as $result) {
            $postContent .= $result->post_content;
        }

        // The navBarActive variable tells main.blade.php which navbar to make
        // active.
        return View::make($viewName, array(
          'navBarActive' => $arrNavBarActive,
          'postContent' => $postContent
        ));
    }
}