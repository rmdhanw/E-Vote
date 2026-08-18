<?php
namespace App\Services;

use App\Models\Vote;

class VoteService
{
    public function castVote(array $data)
    {
        return Vote::create([
            'voter_name' => $data['voter_name'],
            'candidate_id' => $data['candidate_id'],
        ]);
    }
}
