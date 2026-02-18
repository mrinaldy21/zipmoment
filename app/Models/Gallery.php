<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['invitation_id', 'photo_path'];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    /**
     * Accessor for Photo URL (Cloudinary or local)
     */
    public function getPhotoUrlAttribute()
    {
        if (!$this->photo_path) return null;
        return str_starts_with($this->photo_path, 'http') ? $this->photo_path : asset('storage/' . $this->photo_path);
    }
}
