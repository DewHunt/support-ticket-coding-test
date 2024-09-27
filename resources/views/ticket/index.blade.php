@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="clearfix">
                            <div class="float-start">{{ __('Tickets') }}</div>
                            @if (Auth::user()->role == 'customer')
                                <div class="float-end">
                                    <a class="btn btn-outline-success btn-sm" href="{{ route('ticket.add') }}">Open a
                                        Ticket</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        @include('layouts.session_message')

                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th width="20px" scope="col">{{ __('SL') }}</th>
                                        <th width="150px" scope="col">{{ __('Customer Name') }}</th>
                                        <th width="150px" scope="col">{{ __('Title') }}</th>
                                        <th scope="col">{{ __('Description') }}</th>
                                        <th width="50px" scope="col">{{ __('Status') }}</th>
                                        <th width="20px" scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ __($count++) }}</td>
                                            <td>{{ __($ticket->user_name) }}</td>
                                            <td>{{ __($ticket->title) }}</td>
                                            <td>{{ __($ticket->description) }}</td>
                                            <td class="text-center">
                                                @if (Auth::user()->role == 'admin')
                                                    <a class="btn {{ $ticket->status == 'open' ? 'btn-success' : 'btn-danger' }} btn-sm"
                                                        href="{{ route('ticket.status', ['id' => $ticket->id]) }}">{{ __(ucfirst($ticket->status)) }}</a>
                                                @else
                                                    {{ __(ucfirst($ticket->status)) }}
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (Auth::user()->role == 'customer')
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('ticket.edit', ['id' => $ticket->id]) }}">Edit</a>
                                                @endif
                                                @if (Auth::user()->role == 'admin')
                                                    <a class="btn btn-info btn-sm"
                                                        href="{{ route('ticket.response', ['id' => $ticket->id]) }}">Response</a>
                                                @endif
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
