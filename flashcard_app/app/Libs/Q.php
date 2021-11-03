<?php
namespace App\Libs;

//FIXME: クラス名をQuestionにするとエラー
//file_get_contents(/var/www/html/flashcard_app/app/Libs/Question.php): failed to open stream: No such file or directory
class Q {
    public function __construct($answer_card, $others){
        $this->answer = $answer_card;
        $this->others = $others;
        $this->isCorrect = false;
        $this->sec = 0.0;
    }
}
?>