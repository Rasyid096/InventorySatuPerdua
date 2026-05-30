<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'action', 'model', 'description', 'ip_address'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public static function log(string $action, string $model, string $description): void
    {
        self::create([
            'user_id'     => auth()->id(),
            'action'      => $action,
            'model'       => $model,
            'description' => $description,
            'ip_address'  => request()->ip(),
        ]);
    }
}
