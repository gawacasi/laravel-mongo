@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Top Winning Combos</h1>
        <form action="{{ route('top.winning.combos') }}" method="GET">
            <div class="form-group">
                <label for="comboSize">Combo Size</label>
                <input type="number" id="comboSize" name="comboSize" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="winPercentage">Win Percentage</label>
                <input type="number" id="winPercentage" name="winPercentage" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="startTimestamp">Start Timestamp</label>
                <input type="datetime-local" id="startTimestamp" name="startTimestamp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="endTimestamp">End Timestamp</label>
                <input type="datetime-local" id="endTimestamp" name="endTimestamp" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
