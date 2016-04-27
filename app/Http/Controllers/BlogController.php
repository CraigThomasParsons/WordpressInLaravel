<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class BlogController extends BaseController {

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
