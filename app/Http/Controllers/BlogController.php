<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * This isn't being used yet.
 */
class BlogController extends MainController {

    /**
     * This is for the testimonial section.
     *
     * @return view
     */
    public function getIndex()
    {
      // View name should be the same name as the template.
      $viewName = 'home';
      $arrNavBarActive = array();
      $arrNavBarActive[$viewName] = true;

      // The navBarActive variable tells main.blade.php which navbar to make
      // active.
      return View::make($viewName, array(
        'navBarActive' => $arrNavBarActive
      ));
  }
}
