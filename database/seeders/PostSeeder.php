<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [
            [
                'title' => 'Cheese Quesadilla',
                'description' => 'Only 2 ingredients, quick and filling.',
                'instructions' => [
                    'Place cheese in tortilla.',
                    'Fold and cook until golden.',
                    'Slice and serve.'
                ],
                'total_time' => '5 minutes',
                'category' => 'quick recipes',
            ],
            [
                'title' => 'Garlic Butter Pasta',
                'description' => 'A simple yet flavorful meal with minimal ingredients.',
                'instructions' => [
                    'Boil pasta until al dente.',
                    'Sauté garlic in butter.',
                    'Mix pasta with garlic butter and serve.'
                ],
                'total_time' => '15 minutes',
                'category' => 'budget meals',
            ],
            [
                'title' => 'Microwave Mug Omelette',
                'description' => 'A no-pan breakfast solution.',
                'instructions' => [
                    'Crack 2 eggs into a mug.',
                    'Add diced veggies, cheese, and seasonings.',
                    'Microwave for 1.5 minutes.'
                ],
                'total_time' => '4 minutes',
                'category' => 'no-cook meals',
            ],
            [
                'title' => 'Leftover Fried Rice',
                'description' => 'Transform old rice into a tasty meal.',
                'instructions' => [
                    'Heat oil in a pan.',
                    'Add leftover rice and chopped veggies.',
                    'Season with soy sauce and stir-fry.'
                ],
                'total_time' => '10 minutes',
                'category' => 'leftover hacks',
            ],
            [
                'title' => 'Peanut Butter Banana Toast',
                'description' => 'Great snack for after workouts.',
                'instructions' => [
                    'Toast bread slices.',
                    'Spread peanut butter.',
                    'Top with banana slices and a drizzle of honey.'
                ],
                'total_time' => '5 minutes',
                'category' => '5-ingredient recipes',
            ],
        ];

        $users = User::all();

        foreach ($recipes as $recipe) {
            Post::create([
                'user_id' => $users->random()->id,
                'title' => $recipe['title'],
                'body' => $this->formatBody($recipe),
                'category' => $recipe['category'],
            ]);
        }
    }

    private function formatBody(array $recipe): string
    {
        $instructionText = '';
        foreach ($recipe['instructions'] as $index => $step) {
            $instructionText .= ($index + 1) . '. ' . $step . "\n";
        }

        return "Description: {$recipe['description']}\n\n"
             . "Instructions:\n{$instructionText}\n"
             . "Total Time: {$recipe['total_time']}";
    }
}
