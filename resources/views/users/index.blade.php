@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All Users</h3>
    <div class="row">
        @foreach($users as $user)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $user->name }}</h5>
                        <p>{{ $user->email }}</p>
                        <form method="POST" action="{{ route('friend.request', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Send Friend Request</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
