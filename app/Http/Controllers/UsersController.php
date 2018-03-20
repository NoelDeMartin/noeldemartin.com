<?php namespace App\Http\Controllers;

use Hash;
use Validator;
use App\Models\User;
use App\Models\Invitation;

class UsersController extends Controller
{
    /**
     * Display a listing of users
     *
     * @return Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index');
    }
}
