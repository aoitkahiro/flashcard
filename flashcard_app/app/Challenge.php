<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Libs\Q;
use App\Libs\ChallengeSetting;

class Challenge extends Model
{
    public function __construct(){
        parent::__construct();
        $this->questions = collect();
    }

    public function setQuestionsFromSetting(ChallengeSetting $setting) {
        $books = Book::find($setting->asked_book_ids);
        for ($i = 0; $i < $setting->q_num; $i++) {
            $book = $books->random();
            $answer = $book->cards->random();
            $book->cards = $book->cards->reject(function($value, $key) use($answer) {
                return $value->id == $answer->id;
            });
            $others = $book->cards->random($setting->selections_num - 1);
            $this->questions->push(new Q($answer, $others));
        }
    }
}
