@extends('layouts.app')
@section('title', 'Book一覧')

@section('content')
<div class="container">
    <div class="row">
        @foreach($books as $book)
            <div class="col-3">
                @component('component.book',['book' => $book])
                @endcomponent
            </div>
        @endforeach
    </div>
</div>
@endsection