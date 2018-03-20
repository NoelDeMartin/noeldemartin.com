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
     * Show the form for creating a new user
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store()
    {
        $invitation = $invitation = Invitation::where('token', request()->get('invitation_token', ''))->first();

        if (($invitation === null || $invitation->used) && (auth()->guest() || !auth()->user()->is_admin)) {
            return redirect()->back();
        }

        $validator = Validator::make($data = request()->all(), User::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create User
        $user = new User($data);
        $user->password = Hash::make($data['password']);
        $user->is_admin = false;
        $user->is_reviewer = false;

        if ($invitation !== null) {
            $user->is_reviewer = true;
            $user->save();

            $invitation->used = true;
            $invitation->save();

            auth()->login($user);

            return redirect()->route('home');
        } else {
            $user->save();

            return redirect()->route('users.index');
        }
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
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($data = request()->all(), User::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->update($data);

        return redirect()->route('users.index');
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
