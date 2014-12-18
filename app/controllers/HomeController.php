<?php
class HomeController extends BaseController {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Default Home Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | You may wish to use controllers instead of, or in addition to, Closure
	 * | based routes. That's great! Here is an example controller method to
	 * | get you started. To route to this controller, just add the route:
	 * |
	 * |	Route::get('/', 'HomeController@showWelcome');
	 * |
	 */
	public function showWelcome() {
		return View::make ( 'hello' );
	}
	public function userRegister() {
		$rules = array (
				'firstname' => 'required|alpha|min:2',
				'lastname' => 'required|alpha|min:2',
				'company' => 'required|alpha|min:2',
				'email' => 'required|email|unique:users',
				'password' => 'required|alpha_num|between:6,12|confirmed',
				'password_confirm' => 'required|alpha_num|between:6,12'
		);
		$validator = Validator::make ( Input::all (), $rules );
		if ($validator->passes ()) {
			$user = new User ();
			$user->firstname = Input::get ( 'firstname' );
			$user->lastname = Input::get ( 'lastname' );
			$user->email = Input::get ( 'email' );
			$user->password = Hash::make ( Input::get ( 'password' ) );
			
			$user->save ();
			
			return Redirect::to ( 'users/login' )->with ( 'message', 'Thanks for registering!' );
		} else {
			return Redirect::to ( 'users/register' )->with ( 'message', 'The following errors occurred' )->withErrors ( $validator )->withInput ();
		}
	}
	public function userLogin() {
	}
}
