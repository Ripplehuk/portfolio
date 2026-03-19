<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'full_name',
        'position',
        'position_en',
        'position_uz',
        'organization',
        'organization_en',
        'organization_uz',
        'short_bio',
        'short_bio_en',
        'short_bio_uz',
        'full_bio',
        'full_bio_en',
        'full_bio_uz',
        'photo',
        'email',
        'phone',
        'address',
        'address_en',
        'address_uz',
        'telegram',
        'google_scholar',
        'orcid',
        'scopus',
        'researchgate',
        'cv_file',
    ];

    public function getLocalizedPositionAttribute(): ?string
    {
        return $this->getLocalizedValue('position');
    }

    public function getLocalizedOrganizationAttribute(): ?string
    {
        return $this->getLocalizedValue('organization');
    }

    public function getLocalizedShortBioAttribute(): ?string
    {
        return $this->getLocalizedValue('short_bio');
    }

    public function getLocalizedFullBioAttribute(): ?string
    {
        return $this->getLocalizedValue('full_bio');
    }

    public function getLocalizedAddressAttribute(): ?string
    {
        return $this->getLocalizedValue('address');
    }

    public function getPositionAttribute(): ?string
    {
        return $this->getLocalizedPositionAttribute();
    }

    public function getOrganizationAttribute(): ?string
    {
        return $this->getLocalizedOrganizationAttribute();
    }

    public function getShortBioAttribute(): ?string
    {
        return $this->getLocalizedShortBioAttribute();
    }

    public function getFullBioAttribute(): ?string
    {
        return $this->getLocalizedFullBioAttribute();
    }

    public function getAddressAttribute(): ?string
    {
        return $this->getLocalizedAddressAttribute();
    }
}
