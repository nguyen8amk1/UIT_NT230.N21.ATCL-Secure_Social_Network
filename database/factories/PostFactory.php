<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jsonPath = database_path('factories/media.json');
        $media = json_decode(file_get_contents($jsonPath), true);

        $m = $this->faker->randomElement($media);

        return [
            'title' => $m['title'],
            'location' => $m['location'],
            'body' => $m['body_sentence'],
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];
    }
}
