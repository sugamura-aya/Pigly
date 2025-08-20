<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 固定ユーザー作成
        $user = User::firstOrCreate(
            ['email' => 'test2@example.com'],
            [
                'name' => 'テストユーザー',
                'password' => bcrypt('password'),
            ]
        );

        // 目標体重（リレーションを利用）
        $user->weightTarget()->firstOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => 55.0]
        );

        // 体重ログ35件（ファクトリ + リレーション）
        WeightLog::factory()
            ->count(35)
            ->for($user)
            ->create();      
    }
}
