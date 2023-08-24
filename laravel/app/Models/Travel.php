<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'destinations';

    protected $fillable = ['name', 'location', 'image', 'description'];
    
    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // 'user_id' es el nombre de la columna en la tabla 'destinations'
}

}
