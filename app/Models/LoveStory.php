<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoveStory extends Model
{
    protected $fillable = [
        'invitation_id',
        'title',
        'description',
        'photo',
        'sort_order',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function getPhotoUrlAttribute()
    {
        if (!$this->photo) return null;
        return str_starts_with($this->photo, 'http') ? $this->photo : asset('storage/' . $this->photo);
    }
}
