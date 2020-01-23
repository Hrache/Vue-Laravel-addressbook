@extends('layouts.app')

@section('content')
<section class="project container" id="accordionwrapper">
	<header class="mb-4">
		<section id="tools" class="btn-group p-2">
			<a class="btn btn-primary" href="{{ route('addresses.create') }}"><span class="p-2">&#10133;</span>Add new record</a>
			<select @change="sortby(event)" class="btn btn-dark" data-sort-type="sorttype">
				<option value="">Sort</option>
				<optgroup label="Main">
					<option value="first_name">First name</option>
					<option value="last_name">Last name</option>
					<option value="email">E-Mail</option>
					<option value="phone">Phone</option>
					<option value="city">City</option>
					<option value="country">Country</option>
					<option value="street">Street</option>
					<option value="home">Home</option>
					<option value="facebook">Facebook account</option>
				</optgroup>
				<optgroup label="Alternative">
					<option value="alternative phone">Phone</option>
					<option value="alternative email">E-Mail</option>
				</optgroup>
			</select>
			<button class="btn btn-dark" @click="toggleSortOrder()">@{{ sort_order }}</button>
		</section>
	</header>

	<main class="accordion book-background" id="accordion">
	@if ($addresses->count())
@php $counter = 0; @endphp
		@foreach ($addresses as $address)
@php
	$counter++;
	$extended = false;

	if (!empty($current) && $current === $address->id) $extended = true;
	elseif (empty($current) && $counter === 1) $extended = true;
@endphp
		<div class="card z-depth-0 border-0 pointer-cursor" style="background: transparent;">

			<div class="card-header p-1 row pointer-cursor" id="heading{{ $counter }}">
				<div class="col-4">
					<button class="btn btn-hover" type="button" data-toggle="collapse" data-target="#collapse{{ $counter }}" aria-expanded="{!! $extended !!}" aria-controls="collapse{{ $counter }}">
						<h5 class="text-light"><strong class="h6">#{{ $address->id }}</strong>&nbsp;<span data-sort="first_name">{{ $address->first_name }}</span>&nbsp;<span data-sort="last_name">{{ $address->last_name }}</span></h5>
					</button>
				</div>
				<div class="col-8 d-flex justify-content-end">
					<form action="{{ route('addresses.destroy', ['address' => $address]) }}" class="btn btn-group" method="POST">
						@csrf
						@method('delete')
						<input class="btn" type="submit" value="&#9932;" title="Destroy record #{{ $address->id }}" />
						<a class="btn" href="{{ route('addresses.edit', ['address' => $address]) }}" title="Edit record #{{ $address->id }}">&#9874;</a>
					</form>
				</div>
			</div>

			<div id="collapse{{ $counter }}" class="collapse {{ ($extended)? 'show': '' }}" aria-labelledby="heading{{ $counter }}" data-parent="#accordion">
				<div class="card-body row">
					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 row p-2">
						<h3 class="col-sm-12 col-md-12 col-lg-12 col-xl-12">Main info</h3>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>E-Mail</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="email">{{ $address->email }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Phone</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="phone">{{ $address->prim_phone }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>City</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="city">{{ $address->city }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Country</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="country">{{ $address->country }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Street</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="street">{{ $address->street }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Home</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="home">{{ $address->home }}</div>
					</div>

					<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 row p-2">
						<h3 class="col-sm-12 col-md-12 col-lg-12 col-xl-12">Alternative</h3>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Phone</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="alternative phone">{{ $address->sec_phone }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>E-Mail</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="alternative email">{{ $address->sec_email }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Address</h5></div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-8" data-sort="alternative address">{{ $address->address2 }}</div>
						<div class="col-sm-12 col-md-3 col-lg-4 col-xl-4"><h5>Facebook account</h5></div>
						<div class="pointer-cur col-sm-12 col-md-8 col-lg-8 col-xl-8 text-link" @click="dohref('{{ $address->fb_account_url }}')" data-sort="facebook">{{ $address->fb_account_url }}</div>
					</div>
				</div>
			</div>
		</div>
		@endforeach
	@endif
	</main>

	<footer class="p-2">{{ $addresses->links() }}</footer>
</section>
@endsection

@push('bodyground')
<script type="text/javascript">
"use strict";

options.data.sort_order = 'Asc';

options.methods.dohref = function (url)
{
	location.href = url;
};

options.methods.toggleSortOrder = function()
{
	if (this.sort_order === 'Asc')
	{
		this.sort_order = 'Desc';
	} else this.sort_order = 'Asc';

	this.sortby();
};

options.methods.sortby = function ()
{
	let stype = document.querySelector('[data-sort-type="sorttype"]').value,
			values = [],
			original_order = [],
			cards_parent = document.querySelector('#accordion .card').parentNode,
			cards_original = document.querySelectorAll('#accordion .card'),
			dataSortData = document.querySelectorAll('#accordion .card [data-sort="' + stype + '"]'),
			sorted = [];

	for (let item of dataSortData)
	{
		original_order.push(item.textContent);
		values.push(item.textContent);
	}

	dataSortData = null;

	values.sort();

	if (this.sort_order === 'Desc') values.reverse();
	else values.sort();

	for (let item of values)
	{
		let index = original_order.indexOf(item);
		let current_card = cards_original.item(index);
		delete original_order[index];

		sorted.unshift(current_card.cloneNode(true));
		current_card.remove();
	}

	sorted.forEach((val) => {
		cards_parent.prepend(val);
	});
};
</script>
@endpush

@push('headstyles')
<style type="text/css">
	.book-background {
		background: url("{{ asset('images/bookbg.png') }}") no-repeat center center;
		background-size: cover; background-attachment: fixed;
		color: white !important;
	}
	#accordion .card-body { background-color: rgba(32, 32, 32, 0.5); }
	#accordion .card-footer { background-color: rgba(32, 32, 64, 0.5); }
	.pointer-cur {cursor: pointer;}
</style>
@endpush