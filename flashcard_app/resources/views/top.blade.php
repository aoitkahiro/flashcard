@extends('layouts.app')
@section('title', 'top')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center">
        <a role="button" href={{ route('challenge.setting') }} class="btn btn-outline-info">Game Play</a>
    </div>
</div>
@endsection