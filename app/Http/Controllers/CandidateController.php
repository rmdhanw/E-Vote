<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Http\Requests\StoreCandidateRequest;
use App\Services\CandidateService;

class CandidateController extends Controller
{
    protected $candidateService;

    public function __construct(CandidateService $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    public function index()
    {
        $candidates = Candidate::all();
        return view('admin.kandidat', compact('candidates'));
    }

    public function store(StoreCandidateRequest $request)
    {
        $this->candidateService->createCandidate(
            $request->validated(),
            $request->file('photo')
        );

        return back()->with('success', 'Kandidat berhasil ditambahkan dan foto telah dioptimasi!');
    }

    public function destroy(Candidate $candidate)
    {
        $this->candidateService->deleteCandidate($candidate);

        return back()->with('success', 'Kandidat berhasil dihapus!');
    }
}
