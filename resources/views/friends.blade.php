@extends('layouts.app')
@section('content')
<h1>Friends</h1>
<ul>
    @foreach ($friends as $friend)
        <li>{{ $friend->receiver->name ?? $friend->sender->name }}</li>
    @endforeach
</ul>

<h1>Pending Friend Requests</h1>
<ul>
    @foreach ($pendingRequests as $request)
        <li>
            {{ $request->sender->name }}
            <form method="POST" action="{{ route('friend.accept', $request->id) }}">
                @csrf
                <button type="submit">Accept</button>
            </form>
            <form method="POST" action="{{ route('friend.decline', $request->id) }}">
                @csrf
                <button type="submit">Decline</button>
            </form>
        </li>
    @endforeach
</ul>

<h1>All Users</h1>
<ul>
    @foreach ($users as $user)
        <li>
            {{ $user->name }}
            <form method="POST" action="{{ route('friend.send', $user->id) }}">
                @csrf
                <button type="submit">Add Friend</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection