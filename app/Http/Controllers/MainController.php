<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Wordpress\Repositories\MenuRepository;
use App\Wordpress\Repositories\ContactModalRepository;
use App\ViewModels\WebsiteViewModel;

/**
 * The reason I created this class is to make sure that
 * any view that is displayed that is including the main view.
 * filename: main.blade.php
 * passes the right information.
 */
class MainController extends BaseController {

    protected $menuRepository;
    protected $contactModalRepository;
    protected $websiteViewModel;

    /**
     * Class HomeController constructor.
     * Dependency inject the menu helper.
     *
     * @param MenuRepository $menuRepository
     */
    public function __construct(
        MenuRepository $menuRepository,
        ContactModalRepository $contactModalRepository,
        WebsiteViewModel $websiteViewModel
    )
    {
        $this->menuRepository = $menuRepository;
        $this->contactModalRepository = $contactModalRepository;
        $this->websiteViewModel = $websiteViewModel;
    }
}
