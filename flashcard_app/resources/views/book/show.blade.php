@extends('layouts.app')
@section('title', 'Book詳細')

@section('content')
<div class="container">
    <form action={{ route('mypage.cards.store') }} method="POST">
        <div class="row pr-3">
            <h3 class="col">{{ $book->title }} に登録されたカード一覧</h3>
            @auth
                <input class="col-2 btn btn-info" type="submit" value="習熟度を登録する">
            @endauth
        </div>
        <div class="row">
            @foreach($book->cards as $card)
                <div class="col-3 mt-4">
                    <div class="card">
                        <img src={{ $card->image }} class="card-img-top" width="100%" height="180">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">表： {{ $card->question }}</li>
                            <li class="list-group-item">裏： {{ $card->answer }}</li>
                            @auth
                                <li class="list-group-item">
                                    習熟度：
                                    @foreach ($lerning_levels as $level => $string)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="learning_levels[][{{ $card->id }}]" value={{ $level }}>
                                            {{ $string }}
                                            </label>
                                        </div>  
                                    @endforeach
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
        @csrf
    </form>
</div>
@endsection