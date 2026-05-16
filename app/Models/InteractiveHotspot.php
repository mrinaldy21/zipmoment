<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteractiveHotspot extends Model
{
    protected $fillable = [
        'interactive_scene_id',
        'label',
        'icon_url',
        'icon_public_id',
        'x_percent',
        'y_percent',
        'width_percent',
        'target_type',
        'target_value',
        'custom_title',
        'custom_content',
        'is_active',
        'sort_order',
    ];

    public function scene()
    {
        return $this->belongsTo(InteractiveScene::class, 'interactive_scene_id');
    }
