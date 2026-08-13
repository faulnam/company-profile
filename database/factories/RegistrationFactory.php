<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'origin_school' => 'SMP ' . $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'parent_name' => $this->faker->name(),
            'parent_email' => $this->faker->unique()->safeEmail(),
            'parent_password' => bcrypt('password'), // Or whatever default
            'status' => $this->faker->randomElement(['Pending', 'Diterima', 'Ditolak']),
            'payment_status' => $this->faker->randomElement(['Unpaid', 'Paid']),
            'payment_method' => $this->faker->randomElement(['QRIS', 'Bank Transfer (VA)', 'E-Wallet', 'Merchant']),
        ];
    }
}
