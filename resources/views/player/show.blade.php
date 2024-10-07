<!-- resources/views/player/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>{{ $playerData->name }}</h1>
    <h2>Badges</h2>
    <ul>
        @foreach($playerData->badges as $badge)
            <li>
                <img src="{{ $badge->iconUrls->large }}" alt="{{ $badge->name }}" style="width: 30px; height: 30px;">
                {{ $badge->name }} 
                @if (isset($badge->level) && isset($badge->maxLevel))
                    ({{ $badge->level }}/{{ $badge->maxLevel }})
                @else
                    (N/A)
                @endif
            </li>
        @endforeach
    </ul>
@endsection
