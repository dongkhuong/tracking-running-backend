<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
	use Queueable, SerializesModels;

	public $object;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($object)
	{
		$this->object = $object;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{	
		return $this->subject('[' . config('app.name') . '] Verify email')
			->view('mail.verify-email')
			->with(['verifyEmailContent' => $this->object]);
	}
}
