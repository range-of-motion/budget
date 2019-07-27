<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Activity extends Model {
    protected $fillable = ['space_id', 'user_id', 'entity_id', 'entity_type', 'action'];

    public function space() {
        return $this->belongsTo(Space::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function description() {
        $activity = DB::table($this->entity_type . 's')->where('id', $this->entity_id);
        switch($this->entity_type) {
            case 'earning':
            case 'spending':
            case 'recurring':
                $description = $activity->value('description');
                break;
            case 'import':
            case 'tag':
                $description = $activity->value('name');
                break;
            default:
                $description = null;
                break;
        }

        if($description === null) {
            return '';
        }

        return '(' . $description . ')';
    }
}
