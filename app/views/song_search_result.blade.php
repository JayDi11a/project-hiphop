<section>
	<br>
	<img class='cover' src='{{ $song['cover'] }}'>

	<h2>{{ $song['title'] }}</h2>

	<p>			
	{{ $song['artist']->name }} {{ $song['published'] }}
	</p>

	<p>
		@foreach($song['tags'] as $tag) 
			{{ $tag->name }}

		@endforeach
	</p>

	<a href='{{ $song['cover'] }}'>Yo go cop that song...</a> 
	<br>


	<a href='/song/edit/{{ $song->id }}'>Edit</a>
</section>