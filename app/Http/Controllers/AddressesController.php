<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Addresses;

class AddressesController extends Controller {

 /**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
 public function index(Addresses $address = null) {

	$addresses = Addresses::where('user_id', Auth::id())->paginate(25);
	$send = ['addresses' => $addresses];

	if (!is_null($address)) $send['current'] = $address;

	return view('addresses.records-accordion', $send);
 }

 /**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create() {
		return view('addresses.addnew', ['address' => (new Addresses())]);
	}

 /**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request) {

		$validation = validator($request->all(), [
			'first_name' => 'required|string|max:191',
			'last_name' => 'required|string|max:191',
			'email' => 'required|email|unique:App\Addresses,email',
			'prim_phone' => 'required|min:9|max:16|alpha_dash|unique:App\Addresses,prim_phone',
			'city' => 'required|string|max:191',
			'country' => 'required|string|max:45',
			'street' => 'required|string|max:255',
			'home' => 'required|min:1|max:10|alpha_dash',
			'home' => 'nullable|image|mimes:jpeg,bmp,png,jpg',
			'address2' => 'nullable|string|max:255',
			'sec_email' => 'nullable|email|unique:App\Addresses,sec_email',
			'sec_phone' => 'nullable|min:9|max:16|alpha_dash|unique:App\Addresses,sec_phone',
			'fb_account_url' => 'nullable|url|regex:/.+facebook.com\/.+/i|unique:App\Addresses,fb_account_url'
		]);

		if ($validation->fails())
		{
			return redirect(url()->previous())
							->with('errors', $validation->errors())
							->with('address', $request->all());
		}
		else unset($validation);

		$address = new Addresses();
		$address->user_id = Auth::id();
		$address->fill($request->post())->save();

		return redirect()->route('addresses.index', ['address' => $address]);
	}

	/**
		* Display the specified resource.
		*
		* @param  \App\Addresses  $addresses
		* @return \Illuminate\Http\Response
		*/
		public function show(Addresses $address) {}

	/**
		* Show the form for editing the specified resource.
		*
		* @param  \App\AddressBook  $addressBook
		* @return \Illuminate\Http\Response
		*/
		public function edit(Addresses $address)
		{
			return view('addresses.addnew', ['address' => $address]);
		}

 /**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Addresses  $addresses
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Addresses $address) {

		$validation = validator($request->all(), [
			'first_name' => 'required|string|max:191',
			'last_name' => 'required|string|max:191',
			'email' => 'required|email|unique:App\Addresses,email,'.$address->id.',id',
			'prim_phone' => 'required|min:9|max:16|alpha_dash|unique:App\Addresses,prim_phone,'.$address->id.',id',
			'city' => 'required|string|max:191',
			'country' => 'required|string|max:45',
			'street' => 'required|string|max:255',
			'home' => 'required|min:1|max:10|alpha_dash',
			'address2' => 'nullable|string|max:255',
			'sec_email' => 'nullable|email|unique:App\Addresses,sec_email,'.$address->id.',id',
			'sec_phone' => 'nullable|min:9|max:16|alpha_dash|unique:App\Addresses,sec_phone,'.$address->id.',id',
			'fb_account_url' => 'nullable|url|regex:/.+facebook.com\/.+/i|unique:App\Addresses,fb_account_url,'.$address->id.',id',
		]);

		if ($validation->fails()) {

			return redirect(url()->previous())
				->with('errors', $validation->errors())
				->with('address', $request->all());
		}
		else unset($validation);

		$address->update($request->post());

		return redirect()->route('addresses.index', ['address' => $address]);
	}

 /**
	* Remove the specified resource from storage.
	*
	* @param  \App\Addresses  $addresses
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Addresses $address)
	{
		$address->delete();
		return back();
	}
}
