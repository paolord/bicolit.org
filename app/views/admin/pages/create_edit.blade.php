@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">Meta data</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Page Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($page)){{ URL::to('admin/pages/' . $page->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- Title -->
				<div class="form-group {{{ $errors->has('title') ? 'has-error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="title"> Title</label>
						<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($page) ? $page->title : null) }}}" />

						@if($errors->has('title'))
							<p class="alert alert-danger">{{{ $errors->first('title', ':message') }}}</p>
						@endif

					</div>
				</div>
				<!-- ./ title -->

				<!-- Content -->
				<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">Content</label>
						<textarea class="form-control full-width ckeditor" name="content" value="content" rows="10">{{{ Input::old('content', isset($page) ? $page->content : null) }}}</textarea>

						@if($errors->has('content'))
							<p class="alert alert-danger">{{{ $errors->first('content', ':message') }}}</p>
						@endif

					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-title">Meta Title</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($page) ? $page->meta_title : null) }}}" />

						@if($errors->has('meta-title'))
							<p class="alert alert-danger">{{{ $errors->first('meta-title', ':message') }}}</p>
						@endif

					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'has-error' : '' }}}">
					<div class="col-md-12 controls">
                        <label class="control-label" for="meta-description">Meta Description</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($page) ? $page->meta_description : null) }}}" />

						@if($errors->has('meta-description'))
							<p class="alert alert-danger">{{{ $errors->first('meta-description', ':message') }}}</p>
						@endif

					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($page) ? $page->meta_keywords : null) }}}" />

						@if($errors->has('meta-keywords'))
							<p class="alert alert-danger">{{{ $errors->first('meta-keywords', ':message') }}}</p>
						@endif

					</div>
				</div>
				<!-- ./ meta keywords -->
			</div>
			<!-- ./ meta data tab -->
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<button class="btn btn-default btn-small btn-inverse close_popup">Cancel</button>
				<button type="reset" class="btn btn-default">Reset</button>
				<button type="submit" class="btn btn-success">Update</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop
