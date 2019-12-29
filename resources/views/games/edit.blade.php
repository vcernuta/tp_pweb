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

                <form action="{{ route('games.update', $game->id) }}" method="post">

                    {!! csrf_field() !!}
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">Modifier un jeu</div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Nom : </label>
                                <input class="form-control" id="name" type="text" name="name" value="{{ $game->name }}" />
                            </div>
                            <div class="form-group">
                                <label for="release_date">Date de sortie : </label>
                                <input class="form-control" id="release_date" type="text" name="release_date" value="{{ $game->release_date }}" />
                            </div>
                            <div class="form-group">
                                <label for="min_max_duration">Durée minimale et maximale : </label>
                                <input class="form-control" id="min_max_duration" type="text" name="min_max_duration" placeholder="1-100" value="{{ $game->min_max_duration }}" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description : </label>
                                <textarea class="form-control" id="description" name="description">
                                    {{ $game->description }}
                                </textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

