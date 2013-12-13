<?php

use App\Storage\Post\PostEloquentRepository as Post;
use App\Storage\Page\PageEloquentRepository as Page;

class SitemapController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * Page Model
     * @var Page
     */
    protected $page;

    /**
     * Inject the models.
     * @param Post $post
     * @param Page $page
     */
    public function __construct(Post $post, Page $page)
    {
        parent::__construct();

        $this->post = $post;
        $this->page = $page;
    }

    /**
     * Sitemap.
     *
     * @return Sitemap
     */
    public function getIndex()
    {
        //get posts
        $posts = $this->post->orderBy('created_at', 'DESC')->get();
        //get pages
        $pages = $this->page->all();

        $sitemap = App::make("sitemap");

        foreach ($pages as $page)
        {
            // set item's url, date, priority, freq
            if ($page->slug != 'home')
            {
                $sitemap->add($page->url(), $page->updated_at, 'monthly', 1);
            }
            else
            {
                $sitemap->add(URL::to(''), $page->updated_at, 'monthly', 1);
            }
        }

        foreach ($posts as $post)
        {
            // set item's url, date, priority, freq
            $sitemap->add($post->url(), $post->updated_at, 'never', 0.5);
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
