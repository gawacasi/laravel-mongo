@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Combo Losses</h1>
        <form action="{{ route('combo.losses') }}" method="GET">
            <div class="form-group">
                <label for="combo">Combo (separated by commas)</label>
                <input type="text" id="combo" name="combo" class="form-control" required>
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
