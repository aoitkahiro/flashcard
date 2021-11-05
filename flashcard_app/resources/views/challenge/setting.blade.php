@extends('layouts.app')
@section('title', 'Game Setting')

@section('content')
<div class="container">
    <form action={{ route('challenge.choise_quiz') }} method="POST">
        <div class="row pr-3">
            <h3 class="col">Game Setting</h3>
            <div class="col-1">
              <label for="q_num">出題数</label>
              <select name="q_num">
                <option>5</option>
                <option>10</option>
              </select>
            </div>
            <div class="col-1">
                <label for="selections_num">選択肢数</label>
                <select name="selections_num">
                  <option>4</option>
                  <option>6</option>
                </select>
              </div>
            <input class="col-2 btn btn-danger" type="submit" value="PLAY">
        </div>
        <div class="row mt-3">
            @foreach($books as $book)
                <div class="col-3">
                    @component('component.book',['book' => $book])
                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="book_ids[]" value={{ $book->id }} checked>
                                このBookを出題する
                        </label>
                        </div>
                    @endcomponent
                </div>
            @endforeach
        </div>
        @csrf
    </form>
</div>
@endsection