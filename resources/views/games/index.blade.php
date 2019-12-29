@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(!empty($games))
                        @foreach($games as $game)
                            <div class="card">
                                <div class="card-header">
                                    {{ $game['id'] }} — <a href="{{ url('/games', $game['id']) }}">{{ $game['name'] }}</a>
                                    <div class="float-right">
                                        <i class="far fa-thumbs-up text-primary"></i>
                                        <i style="margin-right: 20px;" class="text-primary">{{ $game->likes->count() }}</i>

                                        <i class="far fa-thumbs-down text-danger"></i>
                                        <i class="text-danger">{{ $game->dislikes->count() }}</i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {{ $game['description'] }}
                                </div>
                                <div class="card-footer">
                                    Ce jeu est sorti en {{ \Carbon\Carbon::parse($game->release_date)->format('Y') }}
                                </div>
                            </div>
                            <br/>
                        @endforeach
                @else
                    <h3>aucun jeu</h3>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-header">
                        Liste des tags
                    </div>
                    <div class="card-body">
                        @if(count($tags) > 0)
                            <ul>
                                @foreach($tags as $tag)
                                    <li>
                                        {{ $tag['label'] }}
                                        @if(Auth::check() && Auth::user()->is_admin == 1)
                                            <form action="{{route('tag.destroy', $tag->id)}}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link text-danger" type="submit" name="delete" value="delete">Supprimer</button>
                                            </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <h3>Aucun tag</h3>
                        @endif
                    </div>
                </div>
                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <div class="card">
                        <div class="card-header">Ajouter un tag</div>
                        <div class="card-body">
                            <form action="{{ route('tag.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input name="tag" type="text" placeholder="Tag" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-light">Ajouter</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
