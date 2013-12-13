<?php

use App\Storage\Page\PageEloquentRepository as Page;

class HomeController extends BaseController {

    /**
     * Page Model
     * @var Page
     */
    protected $page;

    /**
     * Inject the models.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        parent::__construct();

        $this->page = $page;
    }

    /**
     * View home.
     *
     * @return View
     */
    public function getIndex()
    {
        $page = $this->page->where('slug', '=', 'home');

        // Show the page
        return View::make('site/home/index', compact('page'));
    }
}
