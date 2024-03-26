<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class createItem extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_create_new_item()
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'email' => 'dummy@dummy.de',
            'password' => bcrypt('beispiel1234'),
        ]);

        $this->actingAs($user);

        $photo = UploadedFile::fake()->image('unittest.png');

        $response = $this->post(route('items.storeItem'), [
            'title' => 'Test Artikel',
            'description' => 'Dies ist ein Testartikel',
            'price' => 10.99,
            'photo' => $photo,
        ]);

        $response->assertRedirect(route('startPage'));

        // Überprüfen Sie, ob der Artikel in der Datenbank erstellt wurde
        $this->assertDatabaseHas('items', [
            'title' => 'Test Artikel',
            'description' => 'Dies ist ein Testartikel',
            'price' => 10.99,
            'user_id' => $user->id,
        ]);

        // Überprüfen Sie, ob das Bild hochgeladen wurde
       // Storage::disk('public')->assertExists('photos/' . $photo->hashName());
       // {{ asset('storage/photos/' . $item->photo) }}
    }
}
