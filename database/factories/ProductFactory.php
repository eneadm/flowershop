<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(45),
            'price' => $this->faker->numberBetween(1000, 9000),
            'image' => $this->faker->randomElement([
                "https://images.unsplash.com/photo-1500508484808-e6eaa5fd820d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258MXwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1440749395129-76b2ae3df520?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258MnwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1508808703020-ef18109db02f?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258M3wzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1469259943454-aa100abba749?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258NHwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1471696035578-3d8c78d99684?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258NXwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1498814117408-e396f5507073?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258NnwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1437275537121-331a0457c8d6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258N3wzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1492950103599-127d2be251b7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258OHwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1528756514091-dee5ecaa3278?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258OXwzOTYzOTE1Mnx8fHx8Mnw&ixlib=rb-1.2.1&q=80&w=400",
                "https://images.unsplash.com/photo-1468327768560-75b778cbb551?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MXwyMDAyMjh8MHwxfGNvbGxlY3Rpb258MTB8Mzk2MzkxNTJ8fHx8fDJ8&ixlib=rb-1.2.1&q=80&w=400"
            ])
        ];
    }
}
