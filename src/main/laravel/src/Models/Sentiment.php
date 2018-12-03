<?php

namespace Tweeconomics\Models;

use Illuminate\Database\Eloquent\Model;

class Sentiment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sentiments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
}
