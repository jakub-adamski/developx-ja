@extends('layouts.app')

@section('content')
    <div class="container">

{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">Dashboard</div>--}}
{{--                    <div class="card-body">--}}
{{--                        @if (session('status'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ session('status') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        You are logged in!--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row justify-content-center mt-4">
            <div class="col-md-7">
                <user-transactions-component></user-transactions-component>
            </div>
            <div class="col-md-5">
                <user-withdraw-component :available_notes="'{!! json_encode(config('developx-ja.available_notes')) !!}'"></user-withdraw-component>
            </div>
        </div>

    </div>
@endsection
