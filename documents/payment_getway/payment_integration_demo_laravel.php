<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

public function payment(Request $request)
{
	$name   = $request->input('name');
	$phone  = $request->input('contact');
	$amount = $request->input('amount');
	$trnxId = 'trnx_' . Str::uuid();     // must be unique
	
	try {
		$responsejSON = Http::withHeaders([
			'client-id'     => env('PL_CLIENT_ID'),
			'client-secret' => env('PL_CLIENT_SECRET')
		])->post(env('PL_URL') . '/v1/ecom-payment/initiate', [
			'customer_name'   => $name,
			'customer_mobile' => $phone,
			'amount'          => $amount,
			'transaction_id'  => $trnxId,
			'success_url'     => 'https://myurl.com/success',  // success url
			'fail_url'        => 'https://myurl.com/failed'    // failed url
		])->json();

		$code    = $responsejSON['code'];
		$message = $responsejSON['message'];

		if ($code !== 200) {
			return Redirect::back()
                ->withErrors([$message]);
		}

		$response['plInitiateUrl'] = $responsejSON['data']['link'];
		
		$response = Http::get($response['plInitiateUrl']);
	} catch (\Exception $ex) {
		return Redirect::back()
                ->withErrors([$ex->getMessage()]);
	}
}