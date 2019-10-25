<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Web\Register as RegisterRequest;
use App\Http\Services\UserService;

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

    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(RegisterRequest $request)
    {
        $this->userService->register($request->all());

        return redirect('home');
    }

    public function confirm()
    {
        return view('auth.confirm');
    }

    public function verify($signature)
    {
        $response = $this->userService->verify($signature);
        if ($response) {
            $type = 'success';
            $message = 'Verify Email Success';
        } else {
            $type = 'error';
            $message = 'Verify Email Error';
        }

        return redirect('register/confirm')->with([$type => $message]);
    }

    public function index()
    {
        return view('auth.register');
    }
}
