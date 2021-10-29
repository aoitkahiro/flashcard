<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserCardController extends Controller
{
    public function store(Request $request){
        $user_cards = [];
        foreach ($request->learning_levels as $learning_level) {
            //key($learning_level) == card_id
            $user_cards[key($learning_level)] = ['learning_level' => $learning_level[key($learning_level)]];
        }
        Auth::user()->cards()->syncWithoutDetaching($user_cards);
        return redirect()->back();
    }
}
