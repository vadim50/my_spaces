<a class="btn btn-success" href="{{ route('places.create') }}" title="">Add New Place...</a>
@if(isset($places))
<table>
	<caption>table title and/or explanatory text</caption>
	<thead>
		<tr>
			<th>Name of place</th>
			<th>Type of place</th>
			<th>Description of place</th>
			<th>Date</th>
			<th>Picture</th>
			<th>Link</th>
		</tr>
	</thead>
	<tbody>
		@foreach($places as $place)
		<tr>
			<td>{{ $place->name }}</td>
			<td>{{ $place->type }}</td>
			<td>{{ $place->desc }}</td>
			<td>{{ $place->created_at }}</td>
			<td><img src="{{ asset('assets/img/'.$place->image) }}" alt=""></td>
			<td><a class="btn btn-success" href="{{ route('places.show',['place'=>$place->id]) }}" title="">More..</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
	

	
	
@endif