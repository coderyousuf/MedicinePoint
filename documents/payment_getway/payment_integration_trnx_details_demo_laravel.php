<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

public function paymentDetails($tran_id)
{
	try {
		$responsejSON = Http::withHeaders([
			'client-id'     => env('PL_CLIENT_ID'),
			'client-secret' => env('PL_CLIENT_SECRET')
		])->get(env('PL_URL') . '/v1/ecom-payment/details', [
			'transaction_id'   => $tran_id,
		])->json();

		$code    = $responsejSON['code'];
		$message = $responsejSON['message'];

		if ($code !== 200) {
			return Redirect::back()
                ->withErrors([$message]);
		}
	} catch (\Exception $ex) {
		return Redirect::back()
                ->withErrors([$ex->getMessage()]);
	}
}
