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
                <div class="card">
                    <div class="card-header">
                        Liste des tags
                    </div>
                    <div class="card-body">
                        @if(!empty($tags))
                            @foreach($tags as $tag)
                                <span class="btn btn-primary btn-sm index-tag tag">{{ $tag['label'] }}</span>
                            @endforeach
                        @else
                            <h3>Aucun tag pour ce jeu</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
