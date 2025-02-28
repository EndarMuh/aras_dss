<?php

namespace App\Models;

use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlternativeCriteria extends Model
{
    use HasFactory;

    protected $table = 'alternative_criteria';
    protected $fillable = [
        'alternative_id',
        'criteria_id',
        'value'
    ];

    public function alternative(){
        return $this->belongsTo(Alternative::class);
    }
    public function criteria(){
        return $this->belongsTo(Criteria::class);
    }

}
