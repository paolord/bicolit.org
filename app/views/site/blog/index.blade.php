@extends('site.layouts.default')

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

@foreach ($posts as $post)
<div class="row">
    <div class="col-md-12">
        <!-- Post Title -->
        <div class="row">
            <div class="col-md-12">
                <h4><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong></h4>
            </div>
        </div>
        <!-- ./ post title -->

        <!-- Post Content -->
        <div class="row">
            <div class="col-md-2">
                <a href="{{{ $post->url() }}}" class="thumbnail"><img src="http://placehold.it/260x180" alt=""></a>
            </div>
            <div class="col-md-12">
                <p>
                    {{ String::tidy(Str::limit($post->content, 200)) }}
                </p>
                <p><a class="btn btn-mini btn-default" href="{{{ $post->url() }}}">Read more</a></p>
            </div>
        </div>
        <!-- ./ post content -->

        <!-- Post Footer -->
        <div class="row">
            <div class="col-md-12">
                <p></p>
                <p>
                    <span class="glyphicon glyphicon-user"></span> by <span class="muted">{{{ $post->author->username }}}</span>
                    | <span class="glyphicon glyphicon-time"></span> <!--Sept 16th, 2012-->{{{ $post->date() }}}
                    | <span class="glyphicon glyphicon-comment"></span> <a href="{{{ $post->url() }}}#comments"><fb:comments-count href={{ $post->url() }}></fb:comments-count> Comments</a>
                </p>
            </div>
        </div>
        <!-- ./ post footer -->
    </div>
</div>

<hr />
@endforeach

{{ $posts->links() }}

@stop
