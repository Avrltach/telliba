<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factory\HasFactory;

class Dokumen extends Model
{

    use HasFactory;

    protected $table = 'dokumen';
    protected $primarykey = 'ID';
    
    protected $fillable =[
        'UserID', 
        'CategoryID', 
        'Title',
        'Description',
        'FilePath',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
    public function category()
    {
        return $this->belongsTo(Category::claas, 'CategoryID');
    }
}
