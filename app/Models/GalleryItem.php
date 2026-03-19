<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasLocalizedAttributes;

    protected $fillable = [
        'title',
        'title_en',
        'title_uz',
        'image',
        'category',
        'category_en',
        'category_uz',
        'description',
        'description_en',
        'description_uz',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->getLocalizedValue('title');
    }

    public function getLocalizedCategoryAttribute(): ?string
    {
        return $this->getLocalizedValue('category');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->getLocalizedValue('description');
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getLocalizedTitleAttribute();
    }

    public function getCategoryAttribute(): ?string
    {
        return $this->getLocalizedCategoryAttribute();
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->getLocalizedDescriptionAttribute();
    }
}
