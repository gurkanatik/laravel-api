<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserContact extends Model
{
    use HasFactory;

    public function scopeForCurrentUser(Builder $query, $id = false)
    {
        $query = $query->where('user_id', Auth::guard('api')->user()->id);
        if ($id) {
            $query->where('id', $id);
        }
        return $query->orderBy('id', 'desc');
    }

    public function scopeSearch($query, $params)
    {
        $query = $query->where(function ($query) use ($params) {
            if (isset($params['name'])) {
                $query->where('name', 'LIKE', $params['name'] . '%');
            }
            if (isset($params['phone'])) {
                $query->where('phone', 'LIKE', $params['phone'] . '%');
            }
        });

        if (isset($params['offset'])) {
            $query->offset($params['offset']);
        }

        if (isset($params['limit'])) {
            $query->limit($params['limit']);
        }

        return $query;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
