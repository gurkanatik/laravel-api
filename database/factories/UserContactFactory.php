<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserContact>
 */
class UserContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => fake()->name(),
            'phone' => $this->generateRandomTRPhoneNumber(),
        ];
    }

    private function generateRandomTRPhoneNumber()
    {
        $area_codes = ['212', '216', '222', '224', '262', '266', '312', '322', '324', '326', '342', '352', '362', '372', '382', '384', '412', '422', '424', '426', '432', '436', '442', '452', '454', '456', '462', '464', '472', '474', '482', '484', '506', '522', '530', '542', '544', '546', '552', '554', '556', '558', '566', '576', '582', '592', '594', '596', '212', '216', '222', '224', '262', '266', '312', '322', '324', '326', '342', '352', '362', '372', '382', '384', '412', '422', '424', '426', '432', '436', '442', '452', '454', '456', '462', '464', '472', '474', '482', '484', '506', '522', '530', '542', '544', '546', '552', '554', '556', '558', '566', '576', '582', '592', '594', '596'];
        $rand_keys = array_rand($area_codes);
        return '5' . $area_codes[$rand_keys] . mt_rand(100000, 999999);
    }
}
