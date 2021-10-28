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
            ['title' => 'プログラミング英単語','user_id' => 1],
            ['title' => 'スターウォーズカルトクイズ','user_id' => 2],
        ];
        DB::table('books')->insert($datum);
    }
}
