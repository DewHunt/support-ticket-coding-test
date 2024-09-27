@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-start">{{ __('Update Opened Ticket') }}</div>
                            <div class="float-end">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('ticket.index') }}">All
                                    Tickets</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.session_message')

                        <form method="POST" action="{{ route('ticket.update') }}">
                            @csrf

                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            <div class="row mb-3">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ $ticket->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea cols="30" rows="10" id="description" class="form-control @error('description') is-invalid @enderror"
                                        name="description" required autocomplete="description" autofocus>{{ $ticket->description }}</textarea>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-primary float-end">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
