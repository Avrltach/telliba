<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumens'; 
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'file_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}