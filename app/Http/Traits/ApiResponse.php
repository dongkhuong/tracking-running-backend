<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
	public function jsonOut($response)
	{
		$response = array_merge(['success' => true], $response);

		$statusCode = JsonResponse::HTTP_OK;
		if (isset($response['statusCode'])) {
			$statusCode = $response['statusCode'];
			unset($response['statusCode']);
		}

		return response()->json($response, $statusCode);
	}
}
