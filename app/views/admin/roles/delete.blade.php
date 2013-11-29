@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
    {{-- Delete Role Form --}}
    <form class="form-horizontal form-delete" method="post" action="" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $role->id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="control-group">
            <div class="controls">
                <button class="btn btn-default close_popup">Cancel</button>
                <button type="submit" class="btn btn-danger close_popup">Delete</button><img id="loading" style="display:none;" src="{{{ asset('assets/img/colorbox/loading.gif') }}}">
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop
