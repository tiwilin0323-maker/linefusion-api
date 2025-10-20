<?php

// 此檔案定義使用者模型的假資料工廠設定。

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'role' => 'user',
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => [
            'role' => 'user',
        ]);
    }
}
