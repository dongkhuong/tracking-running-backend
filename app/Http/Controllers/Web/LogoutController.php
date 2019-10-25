<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
	public function store()
	{
		Auth::logout();
		return redirect('login');
	}
}
