<?php

class AdminPagesController extends AdminController {


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
     * Show a list of all the pages.
     *
     * @return View
     */
    public function getIndex()
    {
        // Title
        $title = Lang::get('admin/pages/title.page_management');

        // Grab all the pages
        $pages = $this->page;

        // Show the page
        return View::make('admin/pages/index', compact('pages', 'title'));
    }

    /**
     * Display the specified resource.
     *
     * @param $page
     * @return Response
     */
	public function getShow($page)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $page
     * @return Response
     */
	public function getEdit($page)
	{
        // Title
        $title = Lang::get('admin/pages/title.page_update');

        // Show the page
        return View::make('admin/pages/create_edit', compact('page', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $page
     * @return Response
     */
	public function postEdit($page)
	{
        // Update the page  data
        $page->title            = Input::get('title');
        $page->content          = Input::get('content');
        $page->meta_title       = Input::get('meta-title');
        $page->meta_description = Input::get('meta-description');
        $page->meta_keywords    = Input::get('meta-keywords');

        // Was the page post updated?
        if($page->save())
        {
            // Redirect to the new page page
            return Redirect::to('admin/pages/' . $page->id . '/edit')->with('success', Lang::get('admin/pages/messages.update.success'));
        }

        return Redirect::to('admin/pages/' . $page->id . '/edit')->with('error', Lang::get('admin/pages/messages.update.error'))->withInput()->withErrors($page->errors());
	}

    /**
     * Show a list of all the pages formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $pages = Page::select(array('pages.id', 'pages.title', 'pages.created_at'));

        return Datatables::of($pages)


        ->add_column('actions', '<a href="{{{ URL::to(\'admin/pages/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>')

        ->remove_column('id')

        ->make();
    }

}
