<?php

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datum = [
            ['book_id' => 1,'question' => '変数','answer' => 'variable'],
            ['book_id' => 1,'question' => '定数','answer' => 'constant'],
            ['book_id' => 1,'question' => '関数','answer' => 'function'],
            ['book_id' => 1,'question' => '引数','answer' => 'argument'],
            ['book_id' => 1,'question' => '属性','answer' => 'attribute'],
            ['book_id' => 1,'question' => '定義する','answer' => 'define'],
            ['book_id' => 1,'question' => '列','answer' => 'column'],

            ['book_id' => 2,'question' => 'ヴェイダーの本名','answer' => 'アナキン・スカイウォーカー'],
            ['book_id' => 2,'question' => 'ルークの育て親の名字','answer' => 'ラーズ'],
            ['book_id' => 2,'question' => 'TIEファイターのTIEの正式名称','answer' => 'Twin Ion Engine'],
            ['book_id' => 2,'question' => 'ヴェイダーの居城がある惑星名','answer' => 'ムスタファー'],
            ['book_id' => 2,'question' => 'ジョージ・ルーカスの誕生日','answer' => '1944年5月14日'],
            ['book_id' => 2,'question' => 'ルーカスの処女作','answer' => 'THX-1138'],
            ['book_id' => 2,'question' => 'ハリソン・フォードの処女作','answer' => '現金作戦'],
            ['book_id' => 2,'question' => 'ハン・ソロのケッセルランの記録','answer' => '12パーセク'],
            ['book_id' => 2,'question' => '帝国の逆襲でスニーカーが映る場所','answer' => 'アステロイドベルト'],
        ];
        DB::table('cards')->insert($datum);
    }
}
