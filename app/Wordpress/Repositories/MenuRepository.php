<?php
namespace App\Wordpress\Repositories;
use DB;

/**
 * The reason I created this class is to make sure that
 * any view that is displayed, that is including the main view.
 * specifically filename: main.blade.php
 * passes the right information into that view.
 */
class MenuRepository
{
    /**
     * Fetch all the gallery menu items.
     * It really returns page objects but we only need
     * them for that names of the pages and Pageids.
     *
     * @return array
     */
    public function fetchGalleryMenuItems()
    {
        // There shouldn't be a query right here.
        // Will need to move this to a more maintainable area.
        $results = DB::select('
            SELECT *
              FROM `phposts`
             WHERE `post_type` = "page"
               AND `post_content` LIKE "%[gallery%"
               AND `post_status` !=  "trash"'
        );

        return $results;
    }

}