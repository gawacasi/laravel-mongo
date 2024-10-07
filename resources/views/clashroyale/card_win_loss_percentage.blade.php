@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Card Win/Loss Percentage</h1>
        <form action="{{ route('card.win.loss.percentage') }}" method="GET">
            <div class="form-group">
                <label for="cardName">Card Name</label>
                <input type="text" id="cardName" name="cardName" class="form-control" required>
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
