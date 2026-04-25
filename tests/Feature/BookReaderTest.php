<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReaderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_sees_preview_container_when_only_free_pages_allowed()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(["free_pages" => 5, "file_path" => "dummy.pdf"]);

        $this->actingAs($user)
            ->get(route('books.read', $book->id))
            ->assertStatus(200)
            ->assertSee('pdf-container');
    }

    /** @test */
    public function user_with_purchase_can_view_full_pdf_if_file_exists()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(["free_pages" => 5, "file_path" => "dummy.pdf"]);
        // simulate purchase relation
        Purchase::factory()->create(["user_id" => $user->id, "book_id" => $book->id, "status" => "completed"]);

        $this->actingAs($user)
            ->get(route('books.read', $book->id))
            ->assertStatus(200)
            ->assertSee('iframe');
    }
}
