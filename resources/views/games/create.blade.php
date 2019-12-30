@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('games.store') }}" method="post" id="create-game-post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">Ajouter un jeu</div>
                        <div class="card-body">

                            @csrf

                            <div class="form-group">
                                <label for="name">Nom : </label>
                                <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}" />
                            </div>
                            <div class="form-group">
                                <label for="release_date">Date de sortie : </label>
                                <!-- TODO : Faire un input de type date -->
                                <input class="form-control" id="release_date" type="date" name="release_date" value="{{old('release_date')}}" />
                            </div>
                            <div class="form-group">
                                <label for="min_age">Age minimum : </label>
                                <input class="form-control" id="min_age" type="number" name="min_age" value="{{old('min_age')}}" />
                            </div>
                            <div class="form-group">
                                <label for="min_max_player">Nombre minimum et maximum de joueurs : </label>
                                <input class="form-control" id="min_max_player" type="text" name="min_max_player" placeholder="1-100" value="{{old('min_max_player')}}" />
                            </div>
                            <div class="form-group">
                                <label for="min_max_duration">Durée minimale et maximale : </label>
                                <input class="form-control" id="min_max_duration" type="text" name="min_max_duration" placeholder="1-100" value="{{old('min_max_duration')}}" />
                            </div>
                            <label>Liste des tags : </label> </br>
                            @foreach($tags as $tag)
                                <div class="form-group form-check-inline">
                                    <input id="{{ $tag->label }}" class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->label }}" />
                                    <label for="{{ $tag->label }}" class="form-check-label">{{ $tag->label }}</label>
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="add_tags">Ajouter des tag qui n'existent pas : (séparé par une virgule sans espace) </label>
                                <input class="form-control" id="add_tags" type="text" name="add_tags" />
                            </div>

                            <div class="form-group">
                                <label for="description">Description : </label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Image du jeu : </label>
                                <input type="file" name="image" class="form-control-file" id="image" placeholder="Choisir un fichier">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-raised btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

