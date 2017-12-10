<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Question extends Model
{
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            return true;
        });
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
