<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogSeeder extends Seeder
{
    public function run(): void
    {
        // WeightLogSeeder.php

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'テストユーザー',
                'password' => bcrypt('testpassword'),
            ]
        );

        // ユーザーの既存データに追加で WeightLog と WeightTarget を作成
        if ($user->weightLogs()->count() === 0) {
            WeightLog::factory()->count(35)->create([
                'user_id' => $user->id,
            ]);
        }

        if (!$user->weightTarget) {
            WeightTarget::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
