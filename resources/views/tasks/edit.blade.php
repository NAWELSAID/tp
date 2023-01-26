@extends("layouts.app")
@section("title", "Editer un post")
@section("content")

	<h1>Editer un post</h1>

	<!-- Si nous avons un Post $task -->
	@if (isset($task))

	<!-- Le formulaire est géré par la route "tasks.update" -->
	<form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data" >

		<!-- <input type="hidden" name="_method" value="PUT"> -->
		@method('PUT')

	@else

	<!-- Le formulaire est géré par la route "tasks.store" -->
	<form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data" >

	@endif

		<!-- Le token CSRF -->
		@csrf
		
		<p>
			<label for="title" >Titre</label><br/>

			<!-- S'il y a un $task->title, on complète la valeur de l'input -->
			<input type="text" name="titre" value="{{ isset($task->titre) ? $task->titre : old('title') }}"  id="titre" placeholder="Le titre du tache" >

			<!-- Le message d'erreur pour "title" -->
			@error("title")
			<div>{{ $message }}</div>
			@enderror
		</p>
		<input type="submit" name="valider" value="Valider" >

	</form>

@endsection