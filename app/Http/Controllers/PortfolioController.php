<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

/**
 * Class Portfolio Controller.
 * sets up the view for the portfolio index.
 */
Class PortfolioController extends BaseController {

    /**
     * Portfolio Controller Gallery View.
     *
     * @return view
     */
    public function getIndex($gallery)
    {
        $arrViewParameters = array();

        // View name should be the same name as the template.
        $viewName = 'portfolio';

        // Get the gallery ids from the one post
        // that we should find with the id we passed in.
        //
        // The post_content will look like this
        // [gallery ids="62,58,56,53,43,38,35,29"]
        // Contains all the child id's.
        $results = DB::select('SELECT *
            FROM   `phposts`
            WHERE  `ID` = '.$gallery.'
               AND `post_content` LIKE "%[gallery%"
               AND `post_status` !=  "trash"
            LIMIT 1'
        );

        // Removes everything up to the first ",
        // then removes the last two characters.
        // then removes the first character.
        // then parses the comma separated values.

        foreach($results as $result) {
          $arrGalleryIds = explode(
            ',',
            substr(
              substr(
                strstr(
                  $result->post_content,
                  '"'
                ), 0, -2
              ), 1
            )
          );
        }

        $images = new WP_Query(
            array(
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'post__in' => $arrGalleryIds,
                'orderby' => 'post__in',
                'posts_per_page' => -1
            )
        );

        if ($images->have_posts()) {
            $arrAllImages = $images->get_posts();
        }

        $columns = array();

        while (count($arrAllImages) > 0) {

            $imageRow = array();

            for ($incrementor = 0; ($incrementor < 4) && (count($arrAllImages) > 0); $incrementor++) {
                $imageRow[] = array_pop($arrAllImages);
            }

            $columns[] = $imageRow;
        }

        $arrViewParameters['images'] = $columns;

        return View::make($viewName, $arrViewParameters);
    }

    /**
     * Portfolio Controller main view.
     *
     * @return view
     */
    public function getAllGalleries()
    {
        $query = new WP_Query();

        $results = DB::select('SELECT *
            FROM   `phposts`
            WHERE  `post_type` = "page"
               AND `post_content` LIKE "[gallery%"
               AND `post_status` !=  "trash"'
        );

        foreach($results as $result) {

          $arrGalleryIds[$result->ID] = explode(
            ',',
            substr(
              substr(
                strstr(
                  $result->post_content,
                  '"'
                ), 0, -2
              ), 1
            )
          );
        }

        // View name should be the same name as the template.
        $viewName = 'portfolio';
        $arrNavBarActive = array();
        $arrNavBarActive[$viewName] = true;

        // The navBarActive variable tells main.blade.php which navbar to make
        // active.
        return View::make($viewName, array(
          'navBarActive' => $arrNavBarActive,
          'galleryIds' => $arrGalleryIds
        ));
    }

}
