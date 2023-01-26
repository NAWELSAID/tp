@extends("layouts.app")
@section("title", "home")
@section("content")

<h1>PLAN</h1>

<!-- Le tableau pour lister les articles/tasks -->
<table border="1">
    <tbody>
        <!-- On parcourt la collection de Post -->
        @foreach ($tasks as $t)
        <tr>
            <td>
                <!-- Lien pour afficher un Post : "tasks.show" -->
                <!--  <output href="{{ route('tasks.index', $t) }}" title="Lire l'article">{{ $t->titre }}</output>-->
                <a type="text" name="titre" value="{{ old('titre') }}" id="titre">{{ $t->titre }}</a>
                <a href="{{ route('tasks.edit', $t) }}" title="Modifier l'article"><input type="submit" name="valider" value="Edit"></a>
            </td>
            <td>
                <!-- Formulaire pour supprimer un Post : "tasks.destroy" -->
                <form method="POST" action="{{ route('tasks.destroy', $t) }}">
                    <!-- CSRF token -->
                    @csrf
                    <!-- <input type="hidden" name="_method" value="DELETE"> -->
                    @method("DELETE")
                    <input type="submit" value="Sup">
                </form>
            </td>
            <td>
                @php 
                $etat = $t->etat;
                @endphp
            @if($etat == 0)
            <form method="POST" action="{{ route('update_etat' , $t )}}">
                    @csrf
                    @method("PUT")
                    <button type="submit"  class="btn btn-danger">valider</button>
                </form>
                @else
              
                    <button class="btn btn-success" type="submit"  >validerr</button>
                  

                @endif
            </td> 
        </tr>
        @endforeach

        @if(!isset($task))
        <form method="POST" action="{{ route('tasks.store') }}" >

            @csrf

            <p>
                <input type="text" name="titre" value="{{ old('titre') }}" id="titre" placeholder="Le titre du tache">

                @error("title")
            <div>{{ $message }}</div>
            @enderror
            <input type="submit" name="valider" value="save">
            </p>
        </form>
        @else
        <form method="POST" action="{{ route('tasks.update' , $task) }}" >
            @csrf
            @method('PUT')
            <p>
                <input type="text" name="titre" value="{{ isset($task->titre) ? $task->titre : old('titre') }}" id="titre" placeholder="Le titre du tache">


                @error("title")
            <div>{{ $message }}</div>
            @enderror
            <input type="submit" name="valider" value="edit">
            </p>
        </form>
        @endif
        @endsection
    </tbody>
</table>