<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'title',
        'title_en',
        'title_uz',
        'description',
        'description_en',
        'description_uz',
        'achievement_date',
        'issuer',
        'issuer_en',
        'issuer_uz',
        'image',
        'certificate_file',
        'sort_order',
    ];

    protected $casts = [
        'achievement_date' => 'date',
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

    public function getLocalizedIssuerAttribute(): ?string
    {
        return $this->getLocalizedValue('issuer');
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getLocalizedTitleAttribute();
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->getLocalizedDescriptionAttribute();
    }

    public function getIssuerAttribute(): ?string
    {
        return $this->getLocalizedIssuerAttribute();
    }
}
