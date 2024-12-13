<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function sendRequest($friendId)
    {
        Friendship::create([
            'user_id' => auth()->id(),
            'friend_id' => $friendId,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Friend request sent.');
    }

    public function acceptRequest($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);
        $friendship->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Friend request accepted.');
    }

    public function declineRequest($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);
        $friendship->delete();

        return redirect()->back()->with('success', 'Friend request declined.');
    }

    public function listFriends()
    {
        $friends = auth()->user()->friends()->with(['sender', 'receiver'])->get();
        $pendingRequests = auth()->user()->receivedFriendRequests()->where('status', 'pending')->get();
        $users = User::where('id', '!=', auth()->id())->get();
        

        return view('friends', compact('friends', 'pendingRequests', 'users'));
    }
}
