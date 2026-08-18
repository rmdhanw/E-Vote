<?php

namespace App\Services;

use App\Models\Vote;
use App\Models\Candidate;
class ElectionService
{
    public function getDashboardData(): array{
        return[
            'totalVotes' => Vote::count(),
            'candidates' => Candidate::withCount('votes')->get(),
            'kotakKosong' => Vote::whereNull('candidate_id')->count(),
        ];
    }

    public function getHasilData(): array{
        $data['votesData'] = Vote::with('candidate')->latest()->get();
        $data['chartData'] = $this->generateChartData($data['votesData'],$data['kotakKosong']);
        return $data;
    }

    private function generateChartData($candidates, $kotakKosong): array
    {
        $labels = [];
        $data = [];
        $backgroundColor = [];
        $redShades = ['#d32f2f', '#f44336', '#e57373', '#ffcdd2', '#b71c1c'];

        $i = 0;
        foreach ($candidates as $kandidat) {
            $labels[] = $kandidat->name;
            $data[] = $kandidat->votes_count;
            $backgroundColor[] = $redShades[$i % count($redShades)];
            $i++;
        }

        $labels[] = 'Kotak Kosong';
        $data[] = $kotakKosong;
        $backgroundColor[] = '#9e9e9e';

        return [
            'labels' => $labels,
            'data' => $data,
            'backgroundColor' => $backgroundColor
        ];
    }

    public function resetAllVotes(): void
    {
        Vote::truncate();
    }


}
