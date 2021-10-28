@extends('layouts.app')
@section('title', 'Book一覧')

@section('content')
<div class="container">
    <div class="row">
        @foreach($books as $book)
            <div class="col-3">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">作成者：{{ $book->user->name }}</div>
                    <div class="card-body text-dark">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text">{{ $book->introduction }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection