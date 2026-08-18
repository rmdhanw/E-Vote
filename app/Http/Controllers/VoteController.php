<?php
namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Http\Requests\StoreVoteRequest;
use App\Services\VoteService;

class VoteController extends Controller
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function index()
    {
        $candidates = Candidate::all();
        return view('pemilihan.index', compact('candidates'));
    }

    public function store(StoreVoteRequest $request)
    {
        $this->voteService->castVote($request->validated());
        return redirect()->route('pemilihan.sukses');
    }

    public function sukses()
    {
        return view('pemilihan.sukses');
    }
}
