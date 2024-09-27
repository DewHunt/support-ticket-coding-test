@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-start">{{ __('Users') }}</div>
                            <div class="float-end">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('user.add') }}">Add
                                    User</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.session_message')

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('SL') }}</th>
                                        <th scope="col">{{ __('Role') }}</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('User Name') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td scop="col">{{ __($count++) }}</td>
                                            <td scop="col">{{ __($user->role) }}</td>
                                            <td scop="col">{{ __($user->name) }}</td>
                                            <td scop="col">{{ __($user->user_name) }}</td>
                                            <td scop="col">{{ __($user->email) }}</td>
                                            <td class="text-center" scop="col">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('user.edit', ['id' => $user->id]) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('user.delete', ['id' => $user->id]) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
