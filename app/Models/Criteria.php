<?php

namespace App\Models;

use App\Models\ListDSS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criteria extends Model
{
    use HasFactory;
    protected $table = 'criterias';
    protected $fillable = [
        'dss_id',
        'name_criteria',
        'weight',
        'category'
    ];

    public function listDss(){
        return $this->belongsTo(ListDSS::class);
    }
}
