<?php

namespace App\Services;

use App\Enums\UserType;
use App\Models\User;
use App\Models\UserTree;

class UserTreeService
{
    public static function getUserTree(User $user)
    {
        $user_tree = UserTree::with('parent')->where('user_id', $user->id)->get()->keyBy('parent_type');

        $parent_user_types = collect(UserType::cases())->filter(function ($user_type) use ($user) {
            return $user_type->value <= $user->type->value;
        })->pluck('value');

        return $parent_user_types->map(function ($user_type) use ($user_tree) {
            return data_get($user_tree, $user_type);
        });
    }

    /**
     * @param  array<int, User>  $users
     */
    public static function getUserTreeByUserList($users)
    {
        $user_ids = collect($users)->pluck('id');

        return UserTree::with('parent')->whereIn('user_id', $user_ids)->orderBy('parent_type')->get()->groupBy('user_id');
    }

    public static function getChildUsers(User $user, UserType $target_user_type)
    {
        return UserTree::with('user')->where('parent_id', $user->id)->where('type', $target_user_type)->get();
    }
}
