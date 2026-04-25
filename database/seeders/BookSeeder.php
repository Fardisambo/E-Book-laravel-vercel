<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Fiksi', 'slug' => 'fiksi', 'description' => 'Buku-buku fiksi dan novel'],
            ['name' => 'Non-Fiksi', 'slug' => 'non-fiksi', 'description' => 'Buku-buku non-fiksi dan referensi'],
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Buku tentang teknologi dan programming'],
            ['name' => 'Sejarah', 'slug' => 'sejarah', 'description' => 'Buku-buku sejarah'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'description' => 'Buku-buku pendidikan'],
            ['name' => 'Bisnis', 'slug' => 'bisnis', 'description' => 'Buku tentang bisnis dan ekonomi'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Sample Books
        $books = [
            [
                'title' => 'Laravel: The Complete Guide',
                'author' => 'John Doe',
                'description' => 'Panduan lengkap untuk mempelajari framework Laravel dari dasar hingga advanced.',
                'published_year' => 2024,
                'publisher' => 'Tech Publisher',
                'language' => 'id',
                'total_pages' => 450,
                'cover_url' => 'https://placehold.co/400x600?text=Laravel+Guide',
                'is_featured' => true,
                'categories' => ['Teknologi', 'Pendidikan'],
            ],
            [
                'title' => 'Sejarah Indonesia Modern',
                'author' => 'Prof. Ahmad Hidayat',
                'description' => 'Buku komprehensif tentang sejarah Indonesia dari masa kolonial hingga era modern.',
                'published_year' => 2023,
                'publisher' => 'Sejarah Publishing',
                'language' => 'id',
                'total_pages' => 680,
                'cover_url' => 'https://placehold.co/400x600?text=Sejarah+Indonesia',
                'is_featured' => true,
                'categories' => ['Sejarah', 'Non-Fiksi'],
            ],
            [
                'title' => 'Startup Success Stories',
                'author' => 'Sarah Johnson',
                'description' => 'Kisah sukses berbagai startup dari seluruh dunia dan pelajaran yang bisa dipetik.',
                'published_year' => 2024,
                'publisher' => 'Business Books',
                'language' => 'id',
                'total_pages' => 320,
                'cover_url' => 'https://placehold.co/400x600?text=Startup+Stories',
                'categories' => ['Bisnis'],
            ],
            [
                'title' => 'Petualangan di Hutan Rimba',
                'author' => 'Budi Santoso',
                'description' => 'Novel petualangan seru tentang perjalanan seorang penjelajah di hutan rimba Indonesia.',
                'published_year' => 2023,
                'publisher' => 'Novel Indonesia',
                'language' => 'id',
                'total_pages' => 280,
                'cover_url' => 'https://placehold.co/400x600?text=Petualangan+Hutan',
                'categories' => ['Fiksi'],
            ],
            [
                'title' => 'Python Programming untuk Pemula',
                'author' => 'Dr. Muhammad Ali',
                'description' => 'Buku panduan belajar Python dari nol untuk pemula yang ingin menjadi programmer.',
                'published_year' => 2024,
                'publisher' => 'Code Academy',
                'language' => 'id',
                'total_pages' => 520,
                'cover_url' => 'https://placehold.co/400x600?text=Python+Programming',
                'categories' => ['Teknologi', 'Pendidikan'],
            ],
            [
                'title' => 'Strategi Marketing Digital',
                'author' => 'Lisa Wijaya',
                'description' => 'Panduan praktis untuk menguasai marketing digital di era modern.',
                'published_year' => 2024,
                'publisher' => 'Marketing Pro',
                'language' => 'id',
                'total_pages' => 380,
                'cover_url' => 'https://placehold.co/400x600?text=Marketing+Digital',
                'categories' => ['Bisnis'],
            ],
            [
                'title' => 'Misteri di Pulau Terpencil',
                'author' => 'Rina Kartika',
                'description' => 'Novel misteri yang mengisahkan petualangan sekelompok remaja di pulau terpencil.',
                'published_year' => 2023,
                'publisher' => 'Fiksi Nusantara',
                'language' => 'id',
                'total_pages' => 350,
                'cover_url' => 'https://placehold.co/400x600?text=Misteri+Pulau',
                'categories' => ['Fiksi'],
            ],
            [
                'title' => 'Sejarah Peradaban Dunia',
                'author' => 'Dr. Robert Smith',
                'description' => 'Tinjauan komprehensif tentang sejarah peradaban manusia dari zaman kuno hingga modern.',
                'published_year' => 2022,
                'publisher' => 'World History Press',
                'language' => 'id',
                'total_pages' => 750,
                'cover_url' => 'https://placehold.co/400x600?text=Sejarah+Peradaban',
                'categories' => ['Sejarah', 'Non-Fiksi'],
            ],
            [
                'title' => 'JavaScript Modern Development',
                'author' => 'Alex Chen',
                'description' => 'Panduan lengkap untuk pengembangan aplikasi modern menggunakan JavaScript.',
                'published_year' => 2024,
                'publisher' => 'Web Dev Books',
                'language' => 'id',
                'total_pages' => 600,
                'cover_url' => 'https://placehold.co/400x600?text=JavaScript+Modern',
                'categories' => ['Teknologi'],
            ],
            [
                'title' => 'Kisah Cinta di Musim Hujan',
                'author' => 'Dewi Lestari',
                'description' => 'Novel romantis yang mengisahkan perjalanan cinta di tengah hujan tropis.',
                'published_year' => 2023,
                'publisher' => 'Romance Publishing',
                'language' => 'id',
                'total_pages' => 290,
                'cover_url' => 'https://placehold.co/400x600?text=Kisah+Cinta',
                'categories' => ['Fiksi'],
            ],
        ];

        foreach ($books as $bookData) {
            $categories = $bookData['categories'];
            unset($bookData['categories']);

            $bookData['slug'] = Str::slug($bookData['title']);
            $book = Book::create($bookData);

            // Attach categories
            $categoryIds = Category::whereIn('name', $categories)->pluck('id');
            $book->categories()->attach($categoryIds);
        }
    }
}
