<?php

use Illuminate\Support\Facades\URL; # not sure why i need this here :c
use Robbo\Presenter\PresentableInterface;

/**
 * An Eloquent Model: 'Page'
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Page extends \LaravelBook\Ardent\Ardent implements PresentableInterface {

    public static $rules = array(
        'title'   => 'required|min:3',
        'content' => 'required|min:3'
    );

    /**
     * Get the date the page was created.
     *
     * @param \Carbon|null $date
     * @return string
     */
    public function date($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

    /**
     * Get the URL to the page.
     *
     * @return string
     */
    public function url()
    {
        return Url::to($this->slug);
    }

    /**
     * Returns the date of the page creation,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function created_at()
    {
        return $this->date($this->created_at);
    }

    /**
     * Returns the date of the page last update,
     * on a good and more readable format :)
     *
     * @return string
     */
    public function updated_at()
    {
        return $this->date($this->updated_at);
    }

    public function getPresenter()
    {
        return new PagePresenter($this);
    }
}
