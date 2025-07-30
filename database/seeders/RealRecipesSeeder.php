<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class RealRecipesSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();

        $recipes = [
            // ⚡ Quick Recipes
            [
                'title' => 'Garlic Butter Ramen (10-Minute Fix)',
                'body' => 'Boil instant ramen noodles (discard the packet). In a pan, melt butter, sauté minced garlic, and add the cooked noodles. Toss in soy sauce and garnish with scallions or a fried egg.',
                'category' => 'quick recipes',
            ],
            [
                'title' => 'Microwave Mug Omelette',
                'body' => 'Crack 2 eggs in a mug, add chopped onions, tomatoes, bell peppers, and a pinch of salt and pepper. Microwave for 1.5–2 minutes.',
                'category' => 'quick recipes',
            ],

            // 🥗 No-Cook Meals
            [
                'title' => 'Tuna Salad Lettuce Wraps',
                'body' => 'Mix canned tuna with mayo, mustard, chopped pickles, and onions. Scoop into romaine lettuce leaves and top with shredded carrots.',
                'category' => 'no-cook meals',
            ],
            [
                'title' => 'Peanut Butter Banana Oats',
                'body' => 'In a jar, combine ½ cup oats, 1 cup milk, 1 tbsp peanut butter, and sliced banana. Refrigerate overnight.',
                'category' => 'no-cook meals',
            ],

            // ♻️ Leftover Hacks
            [
                'title' => 'Fried Rice Remix',
                'body' => 'Use last night\'s rice, fry it with any leftover meat or veggies. Add an egg, soy sauce, and garlic.',
                'category' => 'leftover hacks',
            ],
            [
                'title' => 'Pizza Toast',
                'body' => 'Use old bread, spread tomato sauce or ketchup, top with cheese and leftover chicken or veggies. Toast in pan or oven.',
                'category' => 'leftover hacks',
            ],

            // 💰 Budget Meals
            [
                'title' => 'Egg Fried Noodles',
                'body' => 'Cook instant noodles, scramble an egg, and stir-fry with soy sauce and chopped onions.',
                'category' => 'budget meals',
            ],
            [
                'title' => 'Sardines with Rice & Egg',
                'body' => 'Sauté canned sardines in tomato sauce with garlic and onion. Serve with fried egg and rice.',
                'category' => 'budget meals',
            ],

            // ⏱ 5-Ingredient Recipes
            [
                'title' => 'Tomato Pasta',
                'body' => 'Boil pasta. In a pan, cook garlic in oil, add canned diced tomatoes, salt, and herbs. Toss with pasta.',
                'category' => '5-ingredient recipes',
            ],
            [
                'title' => 'Grilled Cheese Sandwich',
                'body' => 'Butter two slices of bread, place cheese in between. Grill on both sides in a pan.',
                'category' => '5-ingredient recipes',
            ],
        ];

        foreach ($recipes as $recipe) {
            DB::table('posts')->insert([
                'title' => $recipe['title'],
                'body' => $recipe['body'],
                'category' => $recipe['category'],
                'user_id' => $users[array_rand($users)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
