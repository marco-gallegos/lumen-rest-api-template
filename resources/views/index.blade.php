<html>
	<header></header>
	<body>
		<h4>{{ $app->version() }}</h4>
		<span>API</span>
		@if (!empty($users))
			@foreach($users as $user)
				<ul>
					<li>{{$user->id}}</li>
					<li>{{$user->email}}</li>
					<li>{{$user->name}}</li>
				</ul>
			@endforeach
		@endif
	</body>
</html>