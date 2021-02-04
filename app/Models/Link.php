<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return $this->url();
    }

    public function url()
    {
        if ($this->type === 'track') {
            return route('shortlink.track', $this);
        }

        return route('shortlink.anon', $this);
    }
}
