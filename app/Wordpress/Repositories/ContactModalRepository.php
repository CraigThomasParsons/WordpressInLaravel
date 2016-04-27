<?php
namespace App\Wordpress\Repositories;
use DB;

/**
 * The reason I created this class is to make sure that
 * any view that is displayed, that is including the main view.
 * specifically filename: main.blade.php
 * passes the right information into that view.
 */
class ContactModalRepository
{
    /**
     * Does what wordpress usually does for pages,
     * Find the contact post that wasn't trashed.
     *
     * @return string
     */
    public function getContactContent()
    {
        // There shouldn't be a query right here.
        // Will need to move this to a more maintainable area.
        $results = DB::select('
          SELECT *
            FROM `phposts`
           WHERE `post_type` = "page"
             AND `post_name` = "contact"
             AND `post_status` != "trash"'
        );

        $contactContent = '';
        foreach($results as $result) {
            $contactContent .= $result->post_content;
        }

        return $contactContent;
    }

}