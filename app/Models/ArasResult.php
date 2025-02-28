<?php

namespace App\Models;

use App\Models\ListDSS;
use App\Models\Alternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArasResult extends Model
{
    use HasFactory;
    protected $table = 'aras_results';
    protected $fillable = ['dss_id', 'name_alternative_res', 'score', 'rank'];

    public function listDss()
    {
        return $this->belongsTo(ListDSS::class);
    }
}
