@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ String::title($page->title) }}}
@stop

{{-- Update the Meta Title --}}
@section('meta_title')
{{{ String::title($page->meta_title) }}}
@stop

{{-- Update the Meta Description --}}
@section('meta_description')
{{{ String::title($page->meta_description) }}}
@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')
{{{ String::title($page->meta_keywords) }}}
@stop

{{-- Content --}}
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Page Title -->
		<div class="row">
			<div class="col-md-12">
				<h4><strong>{{ String::title($page->title) }}</strong></h4>
			</div>
		</div>
		<!-- ./ page title -->

		<!-- Page Content -->
		<div class="row">
			<div class="col-md-12">
				<p>
					{{ String::tidy($page->content) }}
				</p>
			</div>
			<div class="col-md-8">
                <form class="form-horizontal" method="POST" action="{{ URL::to('contact-us') }}" accept-charset="UTF-8">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="name">{{ Lang::get('general.name') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" tabindex="1" placeholder="{{Lang::get('general.name') }}" type="text" name="name" id="name" value="{{ Input::old('name') }}">

                                @if($errors->has('name'))
                                    <p class="alert alert-danger">{{{ $errors->first('name', ':message') }}}</p>
                                @endif

                            </div>
                        </div>
                        <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="email">{{ Lang::get('general.email') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" tabindex="1" placeholder="{{Lang::get('general.email') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">

                                @if($errors->has('email'))
                                    <p class="alert alert-danger">{{{ $errors->first('email', ':message') }}}</p>
                                @endif

                            </div>
                        </div>
                        <div class="form-group {{{ $errors->has('message') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="message">
                                {{ Lang::get('general.message') }}
                            </label>
                            <div class="col-md-10">
                                <textarea class="form-control full-width" name="message" id="message" value="message" rows="10">{{{ Input::old('message') }}}</textarea>

                                @if($errors->has('message'))
                                    <p class="alert alert-danger">{{{ $errors->first('message', ':message') }}}</p>
                                @endif

                            </div>
                        </div>
                        <div class="form-group {{{ $errors->has('recaptcha_response_field') ? 'has-error' : '' }}}">
                            <label class="col-md-2 control-label" for="message">
                                {{ Lang::get('general.recaptcha') }}
                            </label>
                            <div class="col-md-10">
                                {{ Form::captcha(array('theme' => 'clean')); }}

                                @if($errors->has('recaptcha_response_field'))
                                    <p class="alert alert-danger">{{{ $errors->first('recaptcha_response_field', ':message') }}}</p>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-8">
                                <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('general.contact') }}</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
			</div>
		</div>
		<!-- ./ page content -->
	</div>
</div>

<hr />
@stop
