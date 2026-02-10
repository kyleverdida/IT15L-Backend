<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $posts = [
            [
                'category' => 'Design',
                'title' => 'Simple Layouts',
                'description' => 'Use a clean grid, clear spacing, and one strong headline.',
            ],
            [
                'category' => 'Design',
                'title' => 'Readable Typography',
                'description' => 'Limit font sizes to a few steps and keep good line height.',
            ],
            [
                'category' => 'Development',
                'title' => 'MVC Basics',
                'description' => 'Controllers collect data, models handle DB logic, views render HTML.',
            ],
            [
                'category' => 'Development',
                'title' => 'Eloquent Relations',
                'description' => 'Use belongsTo and hasMany to connect posts and categories.',
            ],
            [
                'category' => 'Marketing',
                'title' => 'Clear Message',
                'description' => 'Keep the value statement short and consistent across the page.',
            ],
            [
                'category' => 'Business',
                'title' => 'Small Wins',
                'description' => 'Break goals into milestones that are easy to verify.',
            ],
        ];

        foreach ($posts as $post) {
            $category = $categories->get($post['category']);
            if (!$category) {
                continue;
            }

            Post::create([
                'category_id' => $category->id,
                'title' => $post['title'],
                'description' => $post['description'],
            ]);
        }
    }
}
