<?php

namespace Tests\Feature\Api;

use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class JurnalApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_and_get_token(): void
    {
        User::factory()->create([
            'email' => 'peserta@metanouva.co.id',
            'password' => bcrypt('password123'),
            'role' => 'peserta',
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'peserta@metanouva.co.id',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => ['user', 'token', 'token_type'],
            ]);
    }

    public function test_unauthenticated_user_cannot_access_jurnals(): void
    {
        $this->getJson('/api/jurnals')->assertStatus(401);
    }

    public function test_authenticated_user_can_create_jurnal(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);
        $kategori = Kategori::factory()->create();
        Sanctum::actingAs($user);

        $payload = [
            'kategori_id' => $kategori->id,
            'tanggal' => '2026-11-18',
            'judul' => 'Membangun REST API Laravel',
            'deskripsi' => 'Implementasi Sanctum dan JurnalResource',
            'status' => 'proses',
            'kendala' => 'Tidak ada kendala',
        ];

        $response = $this->postJson('/api/jurnals', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['judul' => 'Membangun REST API Laravel']);

        $this->assertDatabaseHas('jurnals', [
            'user_id' => $user->id,
            'judul' => 'Membangun REST API Laravel',
        ]);
    }

    public function test_user_can_only_view_own_jurnals(): void
    {
        $userA = User::factory()->create(['role' => 'peserta']);
        $userB = User::factory()->create(['role' => 'peserta']);

        Jurnal::factory()->create(['user_id' => $userA->id, 'judul' => 'Jurnal Milik A']);
        Jurnal::factory()->create(['user_id' => $userB->id, 'judul' => 'Jurnal Milik B']);

        Sanctum::actingAs($userA);

        $response = $this->getJson('/api/jurnals');

        $response->assertStatus(200)
            ->assertJsonFragment(['judul' => 'Jurnal Milik A'])
            ->assertJsonMissing(['judul' => 'Jurnal Milik B']);
    }

    public function test_user_can_update_and_delete_own_jurnal(): void
    {
        $user = User::factory()->create(['role' => 'peserta']);
        $jurnal = Jurnal::factory()->create(['user_id' => $user->id, 'judul' => 'Judul Lama']);

        Sanctum::actingAs($user);

        $this->putJson("/api/jurnals/{$jurnal->id}", [
            'kategori_id' => $jurnal->kategori_id,
            'tanggal' => '2026-11-18',
            'judul' => 'Judul Baru Diperbarui',
            'deskripsi' => 'Deskripsi diperbarui melalui API',
            'status' => 'selesai',
        ])->assertStatus(200)
            ->assertJsonFragment(['judul' => 'Judul Baru Diperbarui']);

        $this->deleteJson("/api/jurnals/{$jurnal->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('jurnals', ['id' => $jurnal->id]);
    }

    public function test_user_cannot_access_or_modify_other_users_jurnal(): void
    {
        $userA = User::factory()->create(['role' => 'peserta']);
        $userB = User::factory()->create(['role' => 'peserta']);

        $jurnalMilikB = Jurnal::factory()->create(['user_id' => $userB->id]);

        Sanctum::actingAs($userA);

        $this->getJson("/api/jurnals/{$jurnalMilikB->id}")->assertStatus(403);

        $this->putJson("/api/jurnals/{$jurnalMilikB->id}", [
            'kategori_id' => $jurnalMilikB->kategori_id,
            'tanggal' => '2026-11-18',
            'judul' => 'Hack',
            'deskripsi' => 'Percobaan ubah data milik orang lain',
            'status' => 'selesai',
        ])->assertStatus(403);

        $this->deleteJson("/api/jurnals/{$jurnalMilikB->id}")->assertStatus(403);
    }
}
