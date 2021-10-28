<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datum = [
            ['title' => 'プログラミング英単語', 'introduction' => '英語を制すものはプログラミングを制す！' ,'user_id' => 1],
            ['title' => 'スターウォーズカルトクイズ', 'introduction' => 'May the Force be with you.' ,'user_id' => 2],
        ];
        DB::table('books')->insert($datum);
    }
}
