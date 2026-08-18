<?php
namespace App\Services;

use App\Models\Candidate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class CandidateService
{
    /**
     * Menangani proses kompresi gambar dan penyimpanan kandidat baru.
     */
    public function createCandidate(array $data, UploadedFile $file): Candidate
    {
        $filename = time() . '_' . Str::slug($data['name']) . '.webp';
        $destinationPath = storage_path('app/public/candidates/');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Proses kompresi GD Library
        $extension = $file->getClientOriginalExtension();
        if (in_array(strtolower($extension), ['jpg', 'jpeg'])) {
            $image = imagecreatefromjpeg($file->getRealPath());
        } elseif (strtolower($extension) == 'png') {
            $image = imagecreatefrompng($file->getRealPath());
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }

        imagewebp($image, $destinationPath . $filename, 80);
        imagedestroy($image);

        // Simpan ke database
        return Candidate::create([
            'name' => $data['name'],
            'photo' => 'candidates/' . $filename,
        ]);
    }

    /**
     * Menangani proses penghapusan data dan file kandidat.
     */
    public function deleteCandidate(Candidate $candidate): void
    {
        if (Storage::disk('public')->exists($candidate->photo)) {
            Storage::disk('public')->delete($candidate->photo);
        }

        $candidate->delete();
    }
}
