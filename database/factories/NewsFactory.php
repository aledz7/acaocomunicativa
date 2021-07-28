<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title'=>$title,
            'slug'=>str_replace(' ','-',strtolower($title)),
            'short_text'=>$this->faker->paragraph,
            'text'=>$this->faker->text,
            'user_id'=>1,
            'date'=>date('Y-'.rand(1,12).'-'.rand(1,28)),
            'published'=>rand(0,1)
        ];
    }
}
