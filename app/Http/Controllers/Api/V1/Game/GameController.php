<?php

namespace App\Http\Controllers\Api\V1\Game;

use App\Http\Controllers\Controller;
use App\Http\Resources\GameDetailResource;
use App\Http\Resources\GameListResource;
use App\Models\Admin\GameList;
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
            ->get();
            return $this->success(GameListResource::collection($gameTypes), 'Game Detail Successfully');
        }

    public function gameList($provider_id, $game_type_id)
    {
        $gameLists = GameList::where('product_id', $provider_id)
            ->where('game_type_id', $game_type_id)->get();

        return $this->success(GameDetailResource::collection($gameLists), 'Game Detail Successfully');
    }

     public function getGameDetail($provider_id, $game_type_id)
    {
        $gameLists = GameList::where('provider_id', $provider_id)
            ->where('game_type_id', $game_type_id)->get();

        return $this->success(GameDetailResource::collection($gameLists), 'Game Detail Successfully');
    }
}