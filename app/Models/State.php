<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App;

class State extends Model
{
    use HasFactory;

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $state_translation = $this->state_translations->where('lang', $lang)->first();
        return $state_translation != null ? $state_translation->$field : $this->$field;
    }

    public function state_translations()
    {
        return $this->hasMany(StateTranslation::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }
}
