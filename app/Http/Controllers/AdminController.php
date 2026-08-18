<?php

namespace App\Http\Controllers;

use App\Services\ElectionService;
use App\Models\Vote;

class AdminController extends Controller
{
    protected $electionService;

    public function __construct(ElectionService $electionService)
    {
        $this->electionService = $electionService;
    }

    public function dashboard()
    {
        $data = $this->electionService->getDashboardData();
        return view('admin.dashboard', $data);
    }

    public function hasil()
    {
        $data = $this->electionService->getHasilData();
        return view('admin.hasil', $data);
    }

    public function exportCsv()
    {
        $votes = Vote::with('candidate')->latest()->get();
        $filename = "hasil_pemilihan_rt.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($votes) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'Waktu Memilih', 'Nama Pemilih', 'Pilihan Kandidat']);

            $row = 1;
            foreach ($votes as $vote) {
                $pilihan = $vote->candidate_id ? $vote->candidate->name : 'Kotak Kosong';
                fputcsv($file, [
                    $row++,
                    $vote->created_at->format('Y-m-d H:i:s'),
                    $vote->voter_name,
                    $pilihan
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function resetHasil()
    {
        $this->electionService->resetAllVotes();
        return back()->with('success', 'Seluruh data suara berhasil dihapus! Sistem siap digunakan untuk pemilihan baru.');
    }
}
