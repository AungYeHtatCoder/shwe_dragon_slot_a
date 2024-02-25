<?php

namespace App\Http\Controllers\Api\V1\game;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameListResource;
use App\Models\Admin\GameType;
use App\Traits\HttpResponses;

class GameController extends Controller
{
    use HttpResponses;

    public function gameType()
    {
        $gameType = GameType::all();

        return $this->success($gameType);
    }
    
    public function gameTypeProducts($gameTypeID)
    {
        $gameTypes = GameType::with(['products' => function ($query) {
            $query->orderBy('order', 'asc');
        }])->where('id', $gameTypeID)
            ->first();
        
            return $this->success(
                GameListResource::collection($gameTypes),
                'Game List Successfully'
            );
    }
}
