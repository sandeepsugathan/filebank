@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('user.add_user_title')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                        @csrf
                        <input type="hidden" value="{{ $user->id }}"/>
                        <div class="form-group">
                            <label for="name">@lang('user.edit_user_name_label')</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"/>
                            @if ($errors->has('name'))
                            <em class="error invalid-feedback">{{ $errors->first('name') }}</em>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('user.edit_user_email_label')</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}"/>
                            @if ($errors->has('email'))
                            <em class="error invalid-feedback">{{ $errors->first('email') }}</em>
                            @endif
                        </div>
                        @if ($user->id)
                        <div class="form-group">
                            <p><i>@lang('user.edit_user_password_info')</i></p>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="password">@lang('user.edit_user_password_label')</label>
                            <input type="password" class="form-control" id="password" name="password" value=""/>
                            @if ($errors->has('password'))
                            <em class="error invalid-feedback">{{ $errors->first('password') }}</em>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">@lang('user.edit_user_confirm_password_label')</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value=""/>
                            @if ($errors->has('confirm_password'))
                            <em class="error invalid-feedback">{{ $errors->first('confirm_password') }}</em>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('user.edit_user_type_label')</label>
                            <div class="radio">
                                <label class="radio-inline"><input type="radio" name="type" value="{{ config('env.user.admin') }}" checked>&nbsp;@lang('user.admin')</label>&nbsp;
                                <label class="radio-inline"><input type="radio" name="type" value="{{ config('env.user.normal') }}" checked>&nbsp;@lang('user.normal')</label>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <input type="submit" class="btn btn-success" id="submit" name="submit" value="@lang('user.user_update_submit_button_text')"/>
                            <a href="{{ ($user->id) ? route('users.edit', ['user' => $user->id]) : route('users.add') }}" type="button" class="btn btn-danger">@lang('user.user_update_cancel_button_text')</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection