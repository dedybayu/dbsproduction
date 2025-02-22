<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Category::factory(10)->create();

        Category::create(['name' => 'Programming', 'slug' => 'programming', 'color' => 'blue']);
        Category::create(['name' => 'Data Science', 'slug' => 'data-science', 'color' => 'green']);
        Category::create(['name' => 'Cyber Security', 'slug' => 'cyber-security', 'color' => 'red']);
        Category::create(['name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence', 'color' => 'purple']);
        Category::create(['name' => 'Cloud Computing', 'slug' => 'cloud-computing', 'color' => 'indigo']);
        Category::create(['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'color' => 'pink']);
        Category::create(['name' => 'DevOps', 'slug' => 'devops', 'color' => 'yellow']);
        Category::create(['name' => 'Mobile Development', 'slug' => 'mobile-development', 'color' => 'cyan']);
        Category::create(['name' => 'Game Development', 'slug' => 'game-development', 'color' => 'orange']);
        Category::create(['name' => 'Software Testing', 'slug' => 'software-testing', 'color' => 'teal']);
        


    }
}
