<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\ChangePasswordService;
use App\Http\Requests\Web\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
	protected $changePasswordService;

	public function __construct(ChangePasswordService $changePasswordService){
		$this->changePasswordService = $changePasswordService;
	}

	public function index()
	{
		return view('change-password.index');
	}

	public function update(ChangePasswordRequest $request)
	{
        $response = $this->changePasswordService->update($request);

        if ($response) {
            $type = 'success';
            $message = 'Change password successful.';
        } else {
            $type = 'error';
            $message = 'Change password unsuccessful.';
        }

		return redirect('change-password')->with($type, $message);
    }
}
