<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rewards;
use App\Models\User;
//Rewards = Amount spent * 0.1 on every purchase

class OrderbaseController extends Controller
{
    public function giveRewards(Request $request)
    {
        // $orderID = $request->orderID;
        $orderID = $this->gen_uid();
        $userID = $request->userID;
        $rewards = $request->amt__spent * 0.1;

        $rwds = new Rewards;
        $rwds->order_id = $orderID;
        $rwds->user_id = $userID;
        $rwds->rewards = $rewards;
        $rwds->status = 1;
        $rwds->save();

        //Update user balance points in rewards bucket
        $user = User::findOrFail($userID);
        $rewardBAL = $user->rewards;
        $rewardBAL =  $rewardBAL + $rewards;
        $user->update(['rewards' =>  $rewardBAL]);
        return (['orderID' => $orderID, 'userID' => $userID, 'rewards' => $rewards, 'status' => $rwds->status, 'user' => $user]);
    }
    public function voidRewards(Request $request, $orderID)
    {
        $reward = Rewards::firstWhere('order_id', $orderID);
        $currRewards =  $reward->rewards;
        $userID = $reward->user_id;
        $user = User::findOrFail($userID);
        $userRewards = $user->rewards;
        if ($reward && $reward->status) {
            $reward->status = 0;
            $reward->update(['status' =>  $reward->status]);
            //change reward balance now...
            $userRewards = $userRewards - $currRewards;
            $user->update(['rewards' =>  $userRewards]);
            return (['message' => 'Transaction points are cancelled', 'rewards' => $reward]);
        } else {
            return (['message' => 'No records/already cancelled']);
        }
    }

    public function getAllRewards(Request $request, $userID)
    {
        $all__rewards = Rewards::whereUserId($userID)->get();
        if ($all__rewards) {
            return (['message' => 'List of points earned by user', 'rewards' => $all__rewards]);
        } else {
            return (['message' => 'No records']);
        }
    }

    public function rewardBalance(Request $request, $userID)
    {
        $user = User::findOrFail($userID);
        $rewardBAL = $user->rewards;
        $actBAL = $user->balance;
        $totalBAL = $rewardBAL + $actBAL;
        return (['message' => 'The reward point balance is:', 'reward balance' => $rewardBAL, 'actual balance' => $actBAL, 'total balance' => $totalBAL]);
    }
    //generate unique id refer: https://stackoverflow.com/questions/307486/short-unique-id-in-php
    private function gen_uid($l = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $l);
    }
}
