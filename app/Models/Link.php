<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function url()
    {
        if ($this->type === 'track') {
            return route('shortlink.track', $this);
        }

        return route('shortlink.anon', $this);
    }
}
