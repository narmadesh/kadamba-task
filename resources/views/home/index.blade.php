@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <form method="post" action="{{ route('home.sendMessage') }}" class="col-sm-6 mx-auto">
        
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h1 class="h3 mb-3 fw-normal">Send SMS</h1>

                @include('layouts.partials.messages')

                <div class="form-group form-floating mb-3">
                    <input type="text" class="form-control" name="phone_numbers" placeholder="Enter comma separated numbers" required="required">
                    <label for="floatingPassword">Enter comma separated phone numbers with country codes</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Send</button>
            </form>
        @endauth
    </div>
@endsection