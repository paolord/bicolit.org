@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.register') }}}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
	<h1>Signup</h1>
</div>
{{ Confide::makeSignupForm()->render() }}
@stop
