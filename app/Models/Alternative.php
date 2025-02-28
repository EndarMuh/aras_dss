<?php

namespace App\Models;

use App\Models\ListDSS;
use App\Models\ArasResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alternative extends Model
{
    use HasFactory;

    protected $table = 'alternatives';
    protected $fillable = ['name_alternative', 'dss_id'];

    public function listDss(){
        return $this->belongsTo(ListDSS::class);
    }

    public function result(){
        return $this->hasMany(ArasResult::class);
    }

}
