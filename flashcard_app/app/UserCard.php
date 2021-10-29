<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserCard extends Pivot
{
    const HAS_KNOWN = 5;
    const REMEMBERD = 3;
    const NOT_REMEMBERD = 1;
    //FIXME: 表示順が配列の要素順に依存している
    const LERNING_LEVELS = [
        UserCard::NOT_REMEMBERD => "覚えていない",
        UserCard::REMEMBERD => "覚えた",
        UserCard::HAS_KNOWN => "知ってた",
    ];

    public function getStrLerningLevelAttribute(): string {
        return UserCard::LERNING_LEVELS[$this->learning_level];
    }
}
