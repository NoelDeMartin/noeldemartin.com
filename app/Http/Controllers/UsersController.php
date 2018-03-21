<?php namespace App\Http\Controllers;

use Hash;
use Validator;
use App\Models\User;
use App\Models\Invitation;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index');
    }
}
