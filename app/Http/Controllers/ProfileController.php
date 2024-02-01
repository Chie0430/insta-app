<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User; // this model represents the users table

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        # search for the user
        $user = $this->user->findOrFail($id);

        # Return to homepage with the user profile data
        return view('users.profile.show')->with('user', $user);
        //return redirect()->route('index')->with('user', $user);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);
        # Note: The Auth::user()->id ---> refers to the user who is currently logged-in
        # ex: Logged-in user: Test User2
        # $user['id' => 3, 'name' => 'Test User2', 'avatar' => null, 'email' => 'xxxxxx@gmail.com', 'password' => xxxxxxxxxxxxxx, .....]

        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        # 1. Validate the data coming from the form first
        $request->validate([
            'name' => 'required|min:1|max:50',
            'email' => 'required|email|max:50|unique:users,email,'. Auth::user()->id,
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'introduction' => 'max:100'
        ]);

        # 2. If the validation above don't have any errors, then received the data coming from the form if
        $user = $this->user->findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;

        # Check if there is an uploaded avatar/image
        if ($request->avatar)
        {
            $user->avatar = 'data:image/'. $request->avatar->extension(). ';base64,'. base64_encode(file_get_contents($request->avatar));
        }

        # 3. Save the info into the users table
        $user->save();

        # 4. Redirect to the profile page
        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function followers($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.followers')->with('user', $user);
    }

    public function following($id)
    {
        $user = $this->user->findOrFail($id);
        return view('users.profile.following')->with('user', $user);
    }
}
