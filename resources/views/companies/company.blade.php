@extends('layouts.master-layout')

@section('title', 'Companies')

@section('content')
	<h1 class="jumbotron text-center">{{ $company->name }}</h1>
	<div class="row">
		<div class="col-lg-offset-3 col-lg-6">
			@foreach($company->getAttributes() as $key => $attribute)
				@if ($attribute)
					<dl class="dl-horizontal">
					  <dt>{{ strtoupper($key) }}</dt>
					  <dd>{{ $attribute }}</dd>
					</dl>
				@endif
			@endforeach
		</div>
	</div>

	<div class="row">
		<a href="{{ url('companies') }}" class="btn btn-info">Go back</a>
	</div>
@endsection