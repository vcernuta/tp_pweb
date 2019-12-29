@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card" id="game-show">
                    <div class="card-header">
                        <b>{{ $game['name'] }}</b>
                        @auth
                            <div class="float-right">
                                {{-- DISLIKE --}}
                                <div class="float-right">
                                    <form action="{{ route('dislike', $game->id) }}" method="get">
                                        @method('GET')
                                        <button type="submit" id="like">
                                            <i class="far fa-thumbs-down text-danger"></i>
                                            <i class="text-danger">{{ $dislikes }}</i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- LIKE --}}
                            <div class="float-right">
                                <form action="{{ route('like', $game->id) }}" method="get">
                                    @method('GET')
                                    <button type="submit" id="like">
                                        <i class="far fa-thumbs-up text-primary"></i>
                                        <i  class="text-primary">{{ $likes }}</i>
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                    <div class="card-body">
                        {{-- AFFICHE LES TAGS --}}
                        @if(!empty($tags))
                            @foreach($tags as $tag)
                                <span class="btn btn-primary btn-sm tag">{{ $tag['label'] }}</span>
                            @endforeach
                        @else
                            <h3>Aucun tag pour ce jeu</h3>
                        @endif
                        <p></p>
                        <p>{{ $game['description'] }}</p>
                    </div>
                    <div class="card-footer">
                        Ce jeu est sorti le {{ date('d F Y', strtotime($game->release_date)) }}
                        @if(Auth::check() && Auth::user()->is_admin == 1)
                            <span class="float-right">
                                <a class="d-inline" href="{{ route('games.edit', $game->id) }}">Modifier</a>
                                <form action="{{route('games.destroy', $game->id)}}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-link text-danger" type="submit" name="delete" value="delete">Supprimer</button>
                                </form>
                            </span>
                        @endif
                    </div>
                </div>

                {{-- POSTER UN COMMENTAIRE --}}
                @if(Auth::check())
                    <div class="card" id="game-show">
                        <div class="card-body">
                            <form method="POST" action="{{ route('comments.store') }}">
                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label for="title">Titre :</label>
                                    <input id="title" type="text" class="form-control" aria-label="Titre" aria-describedby="basic-addon1" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="body">Commentaire :</label>
                                    <textarea id="body" name="body" class="form-control" aria-label="With textarea">
                                    </textarea>
                                </div>
                                <input type="number" name="game_id" value="{{ $game['id'] }}" hidden>

                                <button class="btn btn-primary" type="submit">Poster</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card" id="game-show">
                        <div class="card-body">
                            Vous devez être authentifié pour poster un commentaire
                        </div>
                    </div>
                @endif

                {{-- LES COMMENTAIRES --}}
                @if(!empty($comments))
                    @foreach($comments as $c)

                        <div class="card" id="game-show">
                            <div class="card-header">
                                {{ $c->title }}
                                @if(Auth::check() && (Auth::user()->id_admin == 1 || Auth::user()->name == $c->author))
                                    <form action="{{route('comments.destroy', $c->id)}}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger" type="submit" name="delete" value="delete">Supprimer</button>
                                    </form>
                                @endif
                                <div class="float-right">
                                    Le commentaire <b>{{ $c->titre }}</b> a été posté par <b>{{ $c->author }}</b> le {{ date('d/m/Y', strtotime($game->created_at)) }}
                                </div>
                            </div>
                            <div class="card-body">
                                {{ $c->body }}
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3>Aucun commentaire pour ce jeu</h3>
                @endif

            </div>
        </div>
    </div>
@endsection
