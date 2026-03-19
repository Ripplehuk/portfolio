<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedAttributes;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasLocalizedAttributes;

    public const TYPE_ARTICLE = 'article';
    public const TYPE_BOOK = 'book';
    public const TYPE_TEXTBOOK = 'textbook';
    public const TYPE_MONOGRAPH = 'monograph';
    public const TYPE_MANUAL = 'manual';
    public const TYPE_THESIS = 'thesis';
    public const TYPE_PATENT = 'patent';
    public const TYPE_OTHER = 'other';

    protected $fillable = [
        'title',
        'title_en',
        'title_uz',
        'authors',
        'authors_en',
        'authors_uz',
        'journal',
        'journal_en',
        'journal_uz',
        'type',
        'publication_year',
        'abstract',
        'abstract_en',
        'abstract_uz',
        'keywords',
        'keywords_en',
        'keywords_uz',
        'doi',
        'link',
        'pdf_file',
        'cover_image',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'publication_year' => 'integer',
    ];

    public static function typeOptions(): array
    {
        return [
            self::TYPE_ARTICLE => __('frontend.publication_types.article'),
            self::TYPE_BOOK => __('frontend.publication_types.book'),
            self::TYPE_TEXTBOOK => __('frontend.publication_types.textbook'),
            self::TYPE_MONOGRAPH => __('frontend.publication_types.monograph'),
            self::TYPE_MANUAL => __('frontend.publication_types.manual'),
            self::TYPE_THESIS => __('frontend.publication_types.thesis'),
            self::TYPE_PATENT => __('frontend.publication_types.patent'),
            self::TYPE_OTHER => __('frontend.publication_types.other'),
        ];
    }

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->getLocalizedValue('title');
    }

    public function getLocalizedAuthorsAttribute(): ?string
    {
        return $this->getLocalizedValue('authors');
    }

    public function getLocalizedJournalAttribute(): ?string
    {
        return $this->getLocalizedValue('journal');
    }

    public function getLocalizedAbstractAttribute(): ?string
    {
        return $this->getLocalizedValue('abstract');
    }

    public function getLocalizedKeywordsAttribute(): ?string
    {
        return $this->getLocalizedValue('keywords');
    }

    public function getTypeLabelAttribute(): string
    {
        return static::typeOptions()[$this->type] ?? __('frontend.publication_types.other');
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getLocalizedTitleAttribute();
    }

    public function getAuthorsAttribute(): ?string
    {
        return $this->getLocalizedAuthorsAttribute();
    }

    public function getJournalAttribute(): ?string
    {
        return $this->getLocalizedJournalAttribute();
    }

    public function getAbstractAttribute(): ?string
    {
        return $this->getLocalizedAbstractAttribute();
    }

    public function getKeywordsAttribute(): ?string
    {
        return $this->getLocalizedKeywordsAttribute();
    }
}
