<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Services\Admin\Card\CardService;

class CardController extends Controller
{
    public function __construct(
        private CardService $cardService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = $this->cardService->getAllCards();
        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCardRequest $request)
    {
        $result = $this->cardService->createCard($request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to create card. Please try again.']);
        }
        return redirect()->route('admin.cards.index')->with('success', 'Card created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $card = $this->cardService->getCardById($id);
        if (!$card) {
            return redirect()->route('admin.cards.index')->withErrors(['error' => 'Card not found.']);
        }
        return view('admin.cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, string $id)
    {
        $result = $this->cardService->updateCard($id, $request->validated());
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to update card. Please try again.']);
        }
        return redirect()->route('admin.cards.index')->with('success', 'Card updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->cardService->deleteCard($id);
        if (!$result) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete card. Please try again.']);
        }
        return redirect()->route('admin.cards.index')->with('success', 'Card deleted successfully.');
    }
}
