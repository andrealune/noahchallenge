@extends('layouts.master-layout')

@section('title', 'Companies')

@section('content')
	<h1 class="jumbotron text-center">Companies View</h1>
	<table class="table">
	  <thead>
	      @foreach($companies->first()->getAttributes() as $key => $attribute)
	      	<th>{{ $key }}</th>
	      @endforeach
	      <th>Action</th>
	  </thead>
	  <tbody>
		  	@foreach($companies as $company)
	  			<tr>
				@foreach($company->getAttributes() as $attribute)
					<td>{{ $attribute or '-' }}</td>
				@endforeach
					<td class="text-center">
						<a href="{{ url('companies', $company->id) }}"><i class="fa fa-eye"></i></a>
					</td>
				</tr>
		  	@endforeach
	  </tbody>
	</table>
	
	<div class="row text-center">
		{{ $companies->render() }}
	</div>
@endsection
