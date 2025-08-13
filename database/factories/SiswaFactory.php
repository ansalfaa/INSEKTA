<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Jurusan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Siswa>
 */
class SiswaFactory extends Factory
{
  public function definition(): array
  {
    return [
      'user_id'    => User::factory(),
      'kelas_id'   => Kelas::inRandomOrder()->first()->id ?? Kelas::factory(),
      'jurusan_id' => Jurusan::inRandomOrder()->first()->id ?? Jurusan::factory(),
    ];
  }
}
