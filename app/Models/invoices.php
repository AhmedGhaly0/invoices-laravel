<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class invoices extends Model
{
    use Notifiable;
    use HasFactory;
    protected $table = 'invoices';
    use SoftDeletes;

    public function section()
    {
        return $this->belongsTo(section::class);
    }

}
