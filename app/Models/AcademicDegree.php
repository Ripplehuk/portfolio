<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class AcademicDegree extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'title',
        'title_en',
        'title_uz',
        'field',
        'field_en',
        'field_uz',
        'institution',
        'institution_en',
        'institution_uz',
        'country',
        'country_en',
        'country_uz',
        'year',
        'description',
        'description_en',
        'description_uz',
        'sort_order',
    ];

    protected $casts = [
        'year' => 'integer',
        'sort_order' => 'integer',
    ];

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->getLocalizedValue('title');
    }

    public function getLocalizedFieldAttribute(): ?string
    {
        return $this->getLocalizedValue('field');
    }

    public function getLocalizedInstitutionAttribute(): ?string
    {
        return $this->getLocalizedValue('institution');
    }

    public function getLocalizedCountryAttribute(): ?string
    {
        return $this->getLocalizedValue('country');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->getLocalizedValue('description');
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getLocalizedTitleAttribute();
    }

    public function getFieldAttribute(): ?string
    {
        return $this->getLocalizedFieldAttribute();
    }

    public function getInstitutionAttribute(): ?string
    {
        return $this->getLocalizedInstitutionAttribute();
    }

    public function getCountryAttribute(): ?string
    {
        return $this->getLocalizedCountryAttribute();
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->getLocalizedDescriptionAttribute();
    }
}
