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
        'user_id',
        
        // NEW WEDDING FEATURES
        'groom_photo',
        'bride_photo',
        'groom_instagram',
        'bride_instagram',
        'akad_date',
        'akad_start',
        'akad_end',
        'akad_location',
        'akad_maps',
        'resepsi_date',
        'resepsi_start',
        'resepsi_end',
        'resepsi_location',
        'resepsi_maps',
        'gift_bank_pria',
        'gift_bank_pria_name',
        'gift_bank_wanita',
        'gift_bank_wanita_name',
        'music_path',
        'music_title',
        'contact_phone',
        'contact_instagram',
        'footer_website',

        // BUSINESS & MONETIZATION
        'package_type',
        'is_watermark_enabled',
        'custom_domain',
        'gallery_limit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function loveStories()
    {
        return $this->hasMany(LoveStory::class)->orderBy('sort_order');
    }

    public function events()
    {
        return $this->hasMany(Event::class)->orderBy('sort_order')->orderBy('date')->orderBy('start_time');
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

    public function getCoverPhotoUrlAttribute()
    {
        if (!$this->cover_photo) return null;
        return str_starts_with($this->cover_photo, 'http') ? $this->cover_photo : asset('storage/' . $this->cover_photo);
    }

    public function getGroomPhotoUrlAttribute()
    {
        if (!$this->groom_photo) return null;
        return str_starts_with($this->groom_photo, 'http') ? $this->groom_photo : asset('storage/' . $this->groom_photo);
    }

    public function getBridePhotoUrlAttribute()
    {
        if (!$this->bride_photo) return null;
        return str_starts_with($this->bride_photo, 'http') ? $this->bride_photo : asset('storage/' . $this->bride_photo);
    }

    public function getMusicUrlAttribute()
    {
        if (!$this->music_path) return null;
        return str_starts_with($this->music_path, 'http') ? $this->music_path : asset('storage/' . $this->music_path);
    }

    public function messages()
    {
        return $this->hasMany(GuestMessage::class);
    }

    /**
     * Business Logic: Package Checking
     */
    public function isBasic()
    {
        return $this->package_type === 'basic';
    }

    public function isPremium()
    {
        return in_array($this->package_type, ['premium', 'exclusive']);
    }

    public function isExclusive()
    {
        return $this->package_type === 'exclusive';
    }

    public function canRemoveWatermark()
    {
        return $this->isPremium();
    }

    public function canUseTheme($themeName)
    {
        if ($this->isExclusive()) return true;

        if ($this->isPremium()) {
            // Premium (not exclusive) can NOT use cinematic or modern
            return !in_array($themeName, ['cinematic', 'modern']);
        }
        
        // Basic can only use basic themes
        return in_array($themeName, ['elegant', 'minimalist']);
    }

    public function canAddGalleryPhoto()
    {
        if ($this->isPremium()) return true;
        return $this->galleries()->count() < $this->gallery_limit;
    }
}
