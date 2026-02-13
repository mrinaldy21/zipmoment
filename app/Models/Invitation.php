<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'groom_name',
        'groom_description',
        'groom_child_number',
        'groom_total_siblings',
        'groom_father_name',
        'groom_mother_name',
        'bride_name',
        'bride_description',
        'bride_child_number',
        'bride_total_siblings',
        'bride_father_name',
        'bride_mother_name',
        'event_date',
        'event_location',
        'map_link',
        'cover_photo',
        'template',
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Accessor for Groom's background text (Child order + Parents)
     */
    public function getGroomParentTextAttribute()
    {
        $lines = [];
        if ($this->groom_child_number) {
            $text = "Putra ke {$this->groom_child_number}";
            if ($this->groom_total_siblings) {
                $text .= " dari {$this->groom_total_siblings} bersaudara";
            }
            $lines[] = $text;
        }

        $parents = [];
        if ($this->groom_father_name) $parents[] = "Bpk. {$this->groom_father_name}";
        if ($this->groom_mother_name) $parents[] = "Ibu {$this->groom_mother_name}";

        if (count($parents) > 0) {
            $lines[] = implode(' & ', $parents);
        }

        if (count($lines) === 0) {
            return $this->groom_description;
        }

        return implode("\n", $lines);
    }

    /**
     * Accessor for Bride's background text (Child order + Parents)
     */
    public function getBrideParentTextAttribute()
    {
        $lines = [];
        if ($this->bride_child_number) {
            $text = "Putri ke {$this->bride_child_number}";
            if ($this->bride_total_siblings) {
                $text .= " dari {$this->bride_total_siblings} bersaudara";
            }
            $lines[] = $text;
        }

        $parents = [];
        if ($this->bride_father_name) $parents[] = "Bpk. {$this->bride_father_name}";
        if ($this->bride_mother_name) $parents[] = "Ibu {$this->bride_mother_name}";

        if (count($parents) > 0) {
            $lines[] = implode(' & ', $parents);
        }

        if (count($lines) === 0) {
            return $this->bride_description;
        }

        return implode("\n", $lines);
    }
}
