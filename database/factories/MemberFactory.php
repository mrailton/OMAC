<?php

namespace Database\Factories;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'omac_id_number' => $this->faker->word(),
            'clinical_level' => $this->faker->randomElement(ClinicalLevel::toArray()),
            'cfr_level' => $this->faker->randomElement(CFRLevel::toArray()),
        ];
    }
}
