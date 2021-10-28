@extends('layouts.app')
@section('title', 'Book詳細')

@section('content')
<div class="container">
    <h3>{{ $book->title }} に登録されたカード一覧</h3>
    <div class="row">
        @foreach($book->cards as $card)
            <div class="col-3 mt-4">
                <div class="card">
                    <img src={{ $card->image }} class="card-img-top" width="100%" height="180">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">表. {{ $card->question }}</li>
                        <li class="list-group-item">裏. {{ $card->answer }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection