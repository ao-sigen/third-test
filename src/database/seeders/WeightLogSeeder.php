<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ユーザー1名作成
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. 体重記録35件作成（ユーザーに紐づけ）
        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);

        // 3. 目標体重1件作成（ユーザーに紐づけ）
        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
