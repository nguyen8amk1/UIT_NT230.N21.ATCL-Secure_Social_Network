<?php

namespace Database\Factories;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

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
            'post_id' => function () {
                return Post::factory()->create()->id;
            },
            'path' => '/post-photos/' . $this->faker->image('storage/app/public/post-photos', 640, 480, "hello world", false),
            'is_image' => true,
        ];
    }
}
