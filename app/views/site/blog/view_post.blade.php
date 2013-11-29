@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
    {{{ String::title($post->title) }}} ::
    @parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')
    {{{ String::title($post->meta_title) }}} ::
@stop

{{-- Update the Meta Description --}}
@section('meta_description')
    {{{ String::title($post->meta_description) }}}
@stop

{{-- Update the Meta Keywords --}}
    @section('meta_keywords')
    {{{ String::title($post->meta_keywords) }}}
@stop

{{-- Content --}}
@section('content')

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=170290096496218";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<h3>{{ $post->title }}</h3>

<div class="row">
	<div class="col-md-11">
        <p>
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_google_plusone_share"></a>
                <a class="addthis_button_pinterest_share"></a>
                <a class="addthis_button_compact"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=michaellouieloria"></script>
        <p>
    </div>
</div>

<p>{{ $post->content }}</p>

<div>
	<span class="badge badge-info">Posted {{{ $post->date() }}}</span>
</div>

<hr />

<a id="comments"></a>
<h4><fb:comments-count href={{ $post->url() }}></fb:comments-count> Comments</h4>

<div class="row">
	<div class="col-md-11">          
        <div class="fb-comments" data-href="{{ $post->url() }}" data-numposts="5" data-colorscheme="light"></div>
	</div>
</div>
<hr />

@stop
