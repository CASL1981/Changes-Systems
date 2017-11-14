<?php

namespace App;

use App\Center;
use App\Document;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ChangesSystem extends Model
{
    use SoftDeletes;
	
    protected $fillable = [
        'number', 'rs', 'client', 'permission', 'module', 'detailpermission', 'other', 'which', 'justification', 'observation', 'user_id', 'solicitud_id', 'center_id', 'document_id', 'director'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function findField($id)
    {
        return ChangesSystem::findOrFail($id);
    }

    public function hasApproved($id)
    {
        $approved = $this->findField($id);

        return $approved->toArray()['director'];
    }

    public function hasRun($id)
    {
        $approved = $this->findField($id);

        return $approved->toArray()['state'];
    }

    public function approved($id)
    {
        $approved = $this->findField($id);
        
        ($this->hasApproved($id) > 0) ? $approved->director = 0 : $approved->director = Auth::user()->id;

        $approved->update();

        return true;
    }

    public function run($id)
    {
        $run = $this->findField($id);
        
        ($this->hasRun($id) > 0) ? $run->state = false : $run->state = true;

        $run->update();

        return true;
    }
}
