<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
        'type_id',
        'file',
        'key',
        'created_by'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }
}
