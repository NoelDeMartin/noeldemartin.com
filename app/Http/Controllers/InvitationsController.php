<?php namespace App\Http\Controllers;

use App\Model\Invitation;
use View;
use Validator;
use Input;
use Mail;
use Redirect;

class InvitationsController extends Controller {

	/**
	 * Display a listing of invitations
	 *
	 * @return Response
	 */
	public function index()
	{
		$invitations = Invitation::orderBy('created_at', 'desc')->get();

		return View::make('invitations.index', compact('invitations'));
	}

	/**
	 * Show the form for creating a new invitation
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('invitations.create');
	}

	/**
	 * Store a newly created invitation in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Invitation::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		// Create Invitation
		$invitation = new Invitation($data);
		$invitation->token = md5($data['email']);
		$invitation->used = false;
		$invitation->save();

		// Send Email
		$email = $data['email'];
		Mail::send('emails.invite_reviewer', ['token' => $invitation->token], function($message) use($email) {
			$message->to($email)->subject('Are you ready to Review?');
		});

		return Redirect::route('invitations.index');
	}

	/**
	 * Remove the specified invitation from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Invitation::destroy($id);

		return Redirect::route('invitations.index');
	}

}