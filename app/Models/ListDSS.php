<?php

namespace App\Models;

use App\Models\Criteria;
use App\Models\ArasResult;
use App\Models\Alternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListDSS extends Model
{
    use HasFactory;

    protected $table = 'list_dss';
    protected $fillable = [
        'dss_title',
        'altCount',
        'critCount',
        'isCounted',
        'isPrepared'
    ];

    public function alternatives(){
        return $this->hasMany(Alternative::class);
    }
    public function criterias(){
        return $this->hasMany(Criteria::class);
    }
    public function result(){
        return $this->hasMany(ArasResult::class);
    }

}
