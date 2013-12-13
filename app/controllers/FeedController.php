<?php

use App\Storage\Post\PostEloquentRepository as Post;

class FeedController extends BaseController {

    /**
     * Post Model
     * @var Post
     */
    protected $post;

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct();

        $this->post = $post;
    }

    /**
     * Feed.
     *
     * @return Feed
     */
    public function getIndex()
    {
        // creating rss feed with our most recent 20 posts
        $posts = $this->post->orderBy('created_at', 'DESC')->take(20)->get();

        $feed = Feed::make();

        // set your feed's title, description, link, pubdate and language
        $feed->title = 'BicolIT';
        $feed->description = 'BicolIT Feed';
        $feed->logo = asset('assets/ico/apple-touch-icon-144-precomposed.png');
        $feed->link = URL::to('feed');
        $feed->pubdate = $posts[0]->created_at;
        $feed->lang = 'en';

        foreach ($posts as $post)
        {
            // set item's title, author, url, pubdate and description
            $feed->add($post->title, $post->author->username, $post->url(), $post->created_at, Str::limit($post->content, 200));
        }

        // show your feed (options: 'atom' (recommended) or 'rss')
        return $feed->render('atom');
	}
}
