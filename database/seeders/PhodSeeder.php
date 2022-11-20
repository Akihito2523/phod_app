<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhodSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (!DB::table('phods')->first()) {
            DB::table('phods')->insert([
                [
                    'id' => '1',
                    'title' => '春',
                    'place' => '大阪',
                    'image' => '1.jpg',
                    'body' => '春は、寒い冬から気温が上がり始め、朝晩はまだ肌寒さがあるけれど、日中が次第に暖かくなる時期。',
                    'user_id' => 1,
                    'tag_id' => 1
                ],
                [
                    'id' => '2',
                    'title' => '夏',
                    'place' => '大阪',
                    'image' => '2.jpg',
                    'body' => '夏は、四季のひとつで、春と秋にはさまれた季節。天文学的には夏至から秋分まで。',
                    'user_id' => 1,
                    'tag_id' => 1
                ],
                [
                    'id' => '3',
                    'title' => '秋',
                    'place' => '大阪',
                    'image' => '3.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'tag_id' => 1
                ],
                [
                    'id' => '4',
                    'title' => '秋',
                    'place' => '大阪',
                    'image' => '4.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'tag_id' => 1
                ],
                [
                    'id' => '5',
                    'title' => '秋',
                    'place' => '大阪',
                    'image' => '5.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'tag_id' => 1
                ],
                [
                    'id' => '6',
                    'title' => '秋',
                    'place' => '大阪',
                    'image' => '6.jpg',
                    'body' => '秋は、四季の1つであり夏の後、冬の前に位置する',
                    'user_id' => 1,
                    'tag_id' => 1
                ],
            ]);
        }
    }
}
