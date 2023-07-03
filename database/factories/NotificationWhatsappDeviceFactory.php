<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\NotificationWhatsappDevice;

class NotificationWhatsappDeviceFactory extends Factory
{

    protected $model = NotificationWhatsappDevice::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => strtoupper($this->faker->name),
            'uuid' => strtoupper($this->faker->uuid),
            'code' => 'DEVICE-' . strtoupper($this->faker->lexify),
            'phone' => $this->faker->phoneNumber,
            'secret_token' => $this->faker->lexify,
            'actived' => true,
        ];
    }
}
