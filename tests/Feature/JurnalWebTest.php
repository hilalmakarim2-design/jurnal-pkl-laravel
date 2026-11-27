<?php

namespace Tests\Feature;

use App\Models\Jurnal;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JurnalWebTest extends TestCase
{
    use RefreshDatabase;

    public function test_peserta_dapat_mengakses_dashboard_dan_membuat_jurnal(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);
        $kategori = Kategori::create(['nama' => 'Pengembangan Aplikasi']);

        $this->actingAs($peserta)
            ->get('/dashboard')
            ->assertStatus(200);

        $response = $this->actingAs($peserta)->post(route('jurnal.store'), [
            'kategori_id' => $kategori->id,
            'tanggal' => now()->toDateString(),
            'judul' => 'Implementasi Refactoring Model',
            'deskripsi' => 'Memindahkan logika filter ke scopeFilter pada model Jurnal.',
            'status' => 'selesai',
            'kendala' => 'Tidak ada kendala berarti.',
        ]);

        $response->assertRedirect(route('jurnal.index'));
        $this->assertDatabaseHas('jurnals', [
            'judul' => 'Implementasi Refactoring Model',
            'user_id' => $peserta->id,
        ]);
    }

    public function test_peserta_tidak_dapat_mengedit_jurnal_milik_peserta_lain(): void
    {
        $pesertaA = User::factory()->create(['role' => 'peserta']);
        $pesertaB = User::factory()->create(['role' => 'peserta']);
        $kategori = Kategori::create(['nama' => 'Testing']);

        $jurnalMilikA = Jurnal::create([
            'user_id' => $pesertaA->id,
            'kategori_id' => $kategori->id,
            'tanggal' => now()->toDateString(),
            'judul' => 'Jurnal Rahasia Peserta A',
            'deskripsi' => 'Catatan harian A',
            'status' => 'proses',
        ]);

        $this->actingAs($pesertaB)
            ->get(route('jurnal.edit', $jurnalMilikA))
            ->assertStatus(403);
    }

    public function test_pembimbing_dapat_melihat_semua_jurnal_dan_memberi_komentar(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);
        $pembimbing = User::factory()->create(['role' => 'pembimbing']);
        $kategori = Kategori::create(['nama' => 'Dokumentasi']);

        $jurnal = Jurnal::create([
            'user_id' => $peserta->id,
            'kategori_id' => $kategori->id,
            'tanggal' => now()->toDateString(),
            'judul' => 'Pembuatan ERD dan README',
            'deskripsi' => 'Melengkapi dokumentasi repositori v1.0.',
            'status' => 'selesai',
        ]);

        $this->actingAs($pembimbing)
            ->get(route('jurnal.index'))
            ->assertStatus(200)
            ->assertSee('Pembuatan ERD dan README');

        // Sesuaikan nama route komentar di bawah ini dengan routes/web.php milikmu jika berbeda
        $this->actingAs($pembimbing)
            ->post(route('komentar.store', $jurnal), [
                'isi' => 'Dokumentasi sudah sangat rapi, lanjutkan persiapan demo.',
            ])
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('komentars', [
            'jurnal_id' => $jurnal->id,
            'user_id' => $pembimbing->id,
        ]);
    }

    public function test_filter_pencarian_jurnal_berfungsi_dengan_baik(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);
        $kategori = Kategori::create(['nama' => 'Backend']);

        Jurnal::create([
            'user_id' => $peserta->id,
            'kategori_id' => $kategori->id,
            'tanggal' => now()->toDateString(),
            'judul' => 'Setup Docker Compose',
            'deskripsi' => 'Konfigurasi container Laravel dan MySQL.',
            'status' => 'selesai',
        ]);

        Jurnal::create([
            'user_id' => $peserta->id,
            'kategori_id' => $kategori->id,
            'tanggal' => now()->toDateString(),
            'judul' => 'Desain Halaman Error',
            'deskripsi' => 'Membuat halaman 403, 404, dan 500.',
            'status' => 'selesai',
        ]);

        $this->actingAs($peserta)
            ->get(route('jurnal.index', ['search' => 'Docker']))
            ->assertStatus(200)
            ->assertSee('Setup Docker Compose')
            ->assertDontSee('Desain Halaman Error');
    }

    public function test_validasi_gagal_jika_form_jurnal_dikirim_kosong(): void
    {
        $peserta = User::factory()->create(['role' => 'peserta']);

        $this->actingAs($peserta)
            ->post(route('jurnal.store'), [])
            ->assertSessionHasErrors(['tanggal', 'judul', 'deskripsi', 'status']);
    }

    public function test_pembimbing_dapat_mengakses_fitur_export_jurnal(): void
    {
        $pembimbing = User::factory()->create(['role' => 'pembimbing']);

        $this->actingAs($pembimbing)
            ->get(route('jurnal.export_pdf'))
            ->assertStatus(200);
    }
}
