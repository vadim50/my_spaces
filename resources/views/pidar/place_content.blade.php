@if($place)

	<h1>{{ $place->name }}</h1>

	<p>{{ $place->desc }}</p>

	<p>{{ $place->type }}</p>

	<p>{{ $place->created_at }}</p>

	<div>

		<img src="{{ asset('assets/img/'.$place->image) }}" alt="">
		
	</div>
	<br>
	<br>
	<a class="btn btn-success" href="{{ route('places.edit',['place'=>$place->id]) }}" title="">Edit...</a>

@endif