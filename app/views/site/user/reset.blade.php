@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('user/user.forgot_password') }}}
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>Forgot Password</h1>
</div>
{{ Confide::makeResetPasswordForm($token)->render() }}
@stop
