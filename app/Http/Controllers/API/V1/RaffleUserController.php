<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\RaffleUserRequest;
use App\Http\Resources\RaffleUserResource;
use App\Models\Raffle;
use App\Models\RaffleUser;
use Illuminate\Http\Request;

class RaffleUserController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->role == RoleEnum::OWNER->value
            ? auth()->id()
            : auth()->user()->user_id;

        return RaffleUserResource::collection(
            RaffleUser::query()
                ->with([
                    'availability' => fn ($query) => $query->where('order', now()->dayOfWeek)
                ])
                ->addSelect([
                    'raffle_name' => Raffle::select('name')
                        ->whereColumn('id', 'raffle_user.raffle_id')
                        ->limit(1),
                    'raffle_image' => Raffle::select('image')
                        ->whereColumn('id', 'raffle_user.raffle_id')
                        ->limit(1),
                ])
                ->where('user_id', $user_id)
                ->get()
        );
    }

    public function update(RaffleUserRequest $request, $raffle)
    {
        RaffleUser::where('id', $raffle)->update($request->validated());

        return $this->index();
    }
}