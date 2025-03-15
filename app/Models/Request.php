<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'department_id',
        'text',
        'file',
        'faculty',
        'telegram',
        'phone',
        'status',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function exists($id)
    {
        $request = Request::find($id);

        if (!$request) {
            return null;
        }

        if (empty($request->status) || $request->status == 'waiting' || !in_array($request->status, ['rejected', 'accepted'])) {
            return $request;
        }

        return null;
    }

}
