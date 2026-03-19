<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'title',
        'title_en',
        'title_uz',
        'description',
        'description_en',
        'description_uz',
        'event_date',
        'location',
        'location_en',
        'location_uz',
        'organizer',
        'organizer_en',
        'organizer_uz',
        'image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'event_date' => 'date',
        'sort_order' => 'integer',
    ];

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->getLocalizedValue('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->getLocalizedValue('description');
    }

    public function getLocalizedLocationAttribute(): ?string
    {
        return $this->getLocalizedValue('location');
    }

    public function getLocalizedOrganizerAttribute(): ?string
    {
        return $this->getLocalizedValue('organizer');
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getLocalizedTitleAttribute();
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->getLocalizedDescriptionAttribute();
    }

    public function getLocationAttribute(): ?string
    {
        return $this->getLocalizedLocationAttribute();
    }

    public function getOrganizerAttribute(): ?string
    {
        return $this->getLocalizedOrganizerAttribute();
    }
}
