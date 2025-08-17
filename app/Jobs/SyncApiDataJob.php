<?php

namespace App\Jobs;

use App\Models\BestStudent as CalonSiswa;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class SyncApiDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function handle(): void
    {
        if (!$this->userId) return;

        $user = User::find($this->userId);
        if (!$user) return;

        try {
            // Notifikasi mulai sinkronisasi
            Notification::make()
                ->title('Sinkronisasi Dimulai...')
                ->body('Proses sinkronisasi data sedang berjalan di latar belakang.')
                ->info()
                ->sendToDatabase($user);

            // Ambil data dari API
            $response = Http::get('https://recruitment.savanait.com/api_recruitment.php?table=calon_siswa');

            if (!$response->successful()) {
                throw new \Exception('Gagal mengambil data dari API.');
            }

            $allStudents = collect($response->json()['data'] ?? []);

            // Filter sesuai status
            $filteredStudents = $allStudents->filter(function ($studentData) {
                $status = $studentData['status_progress'] ?? '';
                return Str::contains($status, 'Pendidikan', true) || Str::contains($status, 'Penempatan', true);
            });

            $syncedCount = 0;
            $filteredStudents->each(function ($studentData) use (&$syncedCount) {
                if (isset($studentData['id'])) {
                    CalonSiswa::updateOrCreate(
                        ['id' => $studentData['id']],
                        [
                            'calon_siswa_id' => $studentData['user_id'],
                            'nama_lengkap'   => $studentData['nama_lengkap']
                        ]
                    );
                    $syncedCount++;
                }
            });

            // Notifikasi selesai (meskipun 0 data)
            Notification::make()
                ->title('Sinkronisasi Selesai')
                ->body("Berhasil menyinkronkan {$syncedCount} data.")
                ->success()
                ->sendToDatabase($user);

        } catch (\Exception $e) {
            Log::error('SyncApiDataJob gagal: ' . $e->getMessage());

            // Notifikasi gagal
            Notification::make()
                ->title('Sinkronisasi Gagal')
                ->body('Terjadi kesalahan saat memproses data.')
                ->danger()
                ->sendToDatabase($user);
        }
    }
}
