@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('user.list_user_title')</div>

                <div class="card-body">
                    <div class="form-group float-right">
                        <a href="{{ route('users.add') }}" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;@lang('user.add_new_user_button')</a>
                    </div>
                    <div class="col-xs-12">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                            @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ($user->isAdmin()) ? __('user.admin') : __('user.normal') }}</td>
                                <td>
                                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" type="button" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm del-btn" data-toggle="modal" data-target="#confirmModal" data-url="{{ route('users.delete', ['user' => $user->id]) }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @if($users->count() == 0)
                            <tr>
                                <td colspan="100%">@lang('user.no_users_message')</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>


<!-- Confirmation modal -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('user.confirmation_modal_header')</h4>
            </div>
            <div class="modal-body">
                <p>@lang('user.confirmation_modal_content')</p>
            </div>
            <div class="modal-footer">
                <a href="#" id="delete_confirmation_button" type="button" class="btn btn-success">@lang('user.confirmation_modal_confirm_button')</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('user.confirmation_modal_cancel_button')</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('myscript')
<script type="text/javascript">
    $('document').ready(function() {
        $(".del-btn").click(function() {
            var url = $(this).data('url');
            $('#delete_confirmation_button').attr("href", url);
        })
    });
</script>
@endsection

