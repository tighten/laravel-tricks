<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trick>
 */
class TrickFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'name' => 'Test Trick',
            'slug' => 'test-trick',
            'description' => 'Tricks are a great way to share code',
            'code' => '<?php echo "Hello World";',
            'like_cache' => 0,
            'view_cache' => 0,
        ];
    }
}
