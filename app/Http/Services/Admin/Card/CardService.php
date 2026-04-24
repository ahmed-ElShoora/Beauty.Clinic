<?php

namespace App\Http\Services\Admin\Card;
use App\Models\Card;
use App\Traits\ManegeFiles;

class CardService
{
    use ManegeFiles;
    public function getAllCards()
    {
        return Card::all();
    }

    public function getCardById($id)
    {
        return Card::find($id);
    }

    public function createCard($data)
    {
        return Card::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'icon' => $this->uploadFile($data['icon'], 'cards'),
        ]);
    }

    public function updateCard($id, $data)
    {
        $card = $this->getCardById($id);
        if (!$card) {
            return false;
        }

        $card->name = $data['name'];
        $card->description = $data['description'];

        if (isset($data['icon'])) {
            $this->deleteFile($card->icon);
            $card->icon = $this->uploadFile($data['icon'], 'cards');
        }

        return $card->save();
    }

    public function deleteCard($id)
    {
        $card = $this->getCardById($id);
        if (!$card) {
            return false;
        }
        $card->delete();
        return true;
    }
}