<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        # We will use the withTrashed() method to display the deactivate users
        $all_users = $this->user->withTrashed()->latest()->paginate(5);

        # Check if a search query is present in the request
        if ($request->search)
        {
            # If a search query exists, filter users by name, including soft deleted ones, paginate the results, and append the search query to pagination links
            $all_users = $this->user->where('name', 'like', '%'. $request->search. '%')
                ->withTrashed()->paginate(5)->appends(['search' => $request->search]);
        }

        # Pass the users and search query to the view
        return view('admin.users.index')
            ->with('all_users', $all_users)
            ->with('search', $request->search);
    }

    public function deactivate($id)
    {
        $this->user->destroy($id);

        return redirect()->back();
    }

    public function activate($id)
    {
        # The onlyTrashed() retrieved the soft deleted records only
        $this->user->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }
}
