<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengumuman>
 */
class PengumumanFactory extends Factory
{
  public function definition(): array
  {
    return [
      'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
      'judul'   => $this->faker->sentence(),
      'isi'     => $this->faker->paragraph(4),
    ];
  }
}
