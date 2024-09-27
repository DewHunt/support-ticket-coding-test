@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group">
                            <li class="list-group-item">Name: {{ __(Auth::user()->name) }}</li>
                            <li class="list-group-item">Role: {{ __(Auth::user()->role) }}</li>
                            <li class="list-group-item">User Name: {{ __(Auth::user()->user_name) }}</li>
                            <li class="list-group-item">Email: {{ __(Auth::user()->email) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
