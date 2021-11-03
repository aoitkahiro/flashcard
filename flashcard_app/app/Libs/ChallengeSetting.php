<?php
namespace App\Libs;

//FIXME: クラス名をSettingにするとエラー
//file_get_contents(/var/www/html/flashcard_app/app/Libs/Setting.php): failed to open stream: No such file or directory 
class ChallengeSetting {
    public function __construct($request){
        $this->q_num = $request->q_num;
        $this->selections_num = $request->selections_num;
        $this->asked_book_ids = $request->book_ids;
    }
}
?>