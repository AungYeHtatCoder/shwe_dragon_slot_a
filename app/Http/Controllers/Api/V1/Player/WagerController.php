<?php

namespace App\Http\Controllers\Api\V1\Player;

use App\Http\Controllers\Controller;
use App\Http\Resources\WagerResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class WagerController extends Controller
{
    use HttpResponses;

    public function index(Request $request){
        $type = $request->get("type");

        [$from, $to] = match ($type) {
            "yesterday" => [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()],
            "this_week" => [now()->startOfWeek(), now()->endOfWeek()],
            "last_week" => [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()],
            default => [now()->startOfDay(), now()],
        };

        $user = auth()->user();

        $wagers = $user->wagers()->with(["transactions"])->whereBetween("created_at", [$from, $to])
        ->latest()
        ->paginate();

        return $this->success(WagerResource::collection($wagers));
    }
}
