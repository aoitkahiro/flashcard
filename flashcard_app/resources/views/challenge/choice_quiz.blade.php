@extends('layouts.app')
@section('title', 'チャレンジ - 選択問題')

@section('content')
    <div class="container">
        <div id="quiz-board">
            <div class="row text-center mb-5">
                <div class="col" id="game-status">
                </div>
                <template id="game-status-tpl">
                    Game Status: ${status}
                </template>
                <div class="col" id="timer">
                </div>
                <template id="timer-tpl">
                    Timer: ${time}
                </template>
                <div class="col" id="miss-counter">
                </div>
                <template id="miss-counter-tpl">
                    Miss: ${miss}/{{ count($challenge->questions) }}
                </template>
            </div>
            <div class="row mb-5">
                <div class="col-3 mx-auto">
                    <div class="card">
                        <img src={{ no_image_path() }} class="card-img-top" id="asked-card-image" width="100%" height="180">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item" id="asked-card-question"></li>
                            <template id="asked-card-question-tpl">
                                Q. ${question}
                            </template>
                            <li class="list-group-item">A. ??? </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                @for ($i = 0; $i < $challenge->setting->selections_num; $i++)
                    <div class="col-6 text-center mb-3">
                        <button type="button" class="btn btn-outline-dark choices w-75">???</button>
                    </div>
                @endfor
            </div>
        </div>
        <div id="result-board" style="display: none">
            <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Your Choice</th>
                    <th>Is Correct</th>
                  </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($challenge->questions); $i++)
                        <?php $q = $challenge->questions[$i] ?>
                        <tr class="result-row">
                            <th scope="row">{{ $i+1 }}</th>
                            <td>{{ $q->asked_card->question }}</td>
                            <td>{{ $q->asked_card->answer }}</td>
                            <td class="result-choice"></td>
                            <td class="result-is-correct"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('script')
    <script>
        window.Laravel = {};
        window.Laravel.challenge = {!! $challenge->toJson() !!};
        @for($i = 0; $i < count($challenge->questions); $i++)
            window.Laravel.challenge.questions[{{$i}}].askedCardimage = "{{ $challenge->questions[$i]->asked_card->image }}";
        @endfor
    </script>
    <script src="{{ secure_asset('js/choice_quiz.js') }}"></script>
@endsection