<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        $totalPages = $this->faker->numberBetween(10, 200);
        $freePages = $this->faker->numberBetween(0, min(20, $totalPages));

        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug,
            'author' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'isbn' => $this->faker->isbn13,
            'published_year' => $this->faker->year,
            'publisher' => $this->faker->company,
            'language' => 'en',
            'total_pages' => $totalPages,
            'free_pages' => $freePages,
            'price' => $this->faker->randomFloat(2, 0, 100),
            'cover_url' => null,
            'file_url' => null,
            'file_path' => null,
            'file_type' => 'pdf',
            'file_size' => null,
            'views' => 0,
            'downloads' => 0,
            'is_featured' => false,
            'is_published' => true,
        ];
    }
}
