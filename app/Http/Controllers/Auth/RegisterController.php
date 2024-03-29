<?php

namespace App\Http\Controllers\Auth;

use App\Http\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Register as RegisterRequest;
use App\Http\Repositories\User as UserRepo;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/promo-code';

	protected $repo;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(UserRepo $repo)
	{
		$this->repo = $repo;
		$this->middleware('guest');
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Http\Models\User
	 */
	// protected function create(array $data)
	// {
	// 	return User::create([
	// 		'name' => $data['name'],
	// 		'email' => $data['email'],
	// 		'password' => Hash::make($data['password']),
	// 	]);
	// }

	public function store(RegisterRequest $request)
	{
		$input = $request->all();
		$this->repo->create($input);
		return redirect('promo-code');
	}


	public function index()
	{
		return view('auth.register');
	}
}
