<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table): void {
            $table->text('short_bio_en')->nullable()->after('short_bio');
            $table->text('short_bio_uz')->nullable()->after('short_bio_en');
            $table->longText('full_bio_en')->nullable()->after('full_bio');
            $table->longText('full_bio_uz')->nullable()->after('full_bio_en');
            $table->string('position_en')->nullable()->after('position');
            $table->string('position_uz')->nullable()->after('position_en');
            $table->string('organization_en')->nullable()->after('organization');
            $table->string('organization_uz')->nullable()->after('organization_en');
            $table->string('address_en')->nullable()->after('address');
            $table->string('address_uz')->nullable()->after('address_en');
        });

        Schema::table('publications', function (Blueprint $table): void {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_uz')->nullable()->after('title_en');
            $table->string('authors_en')->nullable()->after('authors');
            $table->string('authors_uz')->nullable()->after('authors_en');
            $table->string('journal_en')->nullable()->after('journal');
            $table->string('journal_uz')->nullable()->after('journal_en');
            $table->longText('abstract_en')->nullable()->after('abstract');
            $table->longText('abstract_uz')->nullable()->after('abstract_en');
            $table->text('keywords_en')->nullable()->after('keywords');
            $table->text('keywords_uz')->nullable()->after('keywords_en');
        });

        Schema::table('events', function (Blueprint $table): void {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_uz')->nullable()->after('title_en');
            $table->longText('description_en')->nullable()->after('description');
            $table->longText('description_uz')->nullable()->after('description_en');
            $table->string('location_en')->nullable()->after('location');
            $table->string('location_uz')->nullable()->after('location_en');
            $table->string('organizer_en')->nullable()->after('organizer');
            $table->string('organizer_uz')->nullable()->after('organizer_en');
        });

        Schema::table('achievements', function (Blueprint $table): void {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_uz')->nullable()->after('title_en');
            $table->longText('description_en')->nullable()->after('description');
            $table->longText('description_uz')->nullable()->after('description_en');
            $table->string('issuer_en')->nullable()->after('issuer');
            $table->string('issuer_uz')->nullable()->after('issuer_en');
        });

        Schema::table('gallery_items', function (Blueprint $table): void {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_uz')->nullable()->after('title_en');
            $table->string('category_en')->nullable()->after('category');
            $table->string('category_uz')->nullable()->after('category_en');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description_uz')->nullable()->after('description_en');
        });

        Schema::table('academic_degrees', function (Blueprint $table): void {
            $table->string('title_en')->nullable()->after('title');
            $table->string('title_uz')->nullable()->after('title_en');
            $table->string('field_en')->nullable()->after('field');
            $table->string('field_uz')->nullable()->after('field_en');
            $table->string('institution_en')->nullable()->after('institution');
            $table->string('institution_uz')->nullable()->after('institution_en');
            $table->string('country_en')->nullable()->after('country');
            $table->string('country_uz')->nullable()->after('country_en');
            $table->text('description_en')->nullable()->after('description');
            $table->text('description_uz')->nullable()->after('description_en');
        });

        DB::table('profiles')
            ->whereNull('short_bio_en')
            ->update([
                'short_bio_en' => DB::raw('short_bio'),
                'full_bio_en' => DB::raw('full_bio'),
                'position_en' => DB::raw('position'),
                'organization_en' => DB::raw('organization'),
                'address_en' => DB::raw('address'),
            ]);

        DB::table('publications')
            ->whereNull('title_en')
            ->update([
                'title_en' => DB::raw('title'),
                'authors_en' => DB::raw('authors'),
                'journal_en' => DB::raw('journal'),
                'abstract_en' => DB::raw('abstract'),
                'keywords_en' => DB::raw('keywords'),
            ]);

        DB::table('events')
            ->whereNull('title_en')
            ->update([
                'title_en' => DB::raw('title'),
                'description_en' => DB::raw('description'),
                'location_en' => DB::raw('location'),
                'organizer_en' => DB::raw('organizer'),
            ]);

        DB::table('achievements')
            ->whereNull('title_en')
            ->update([
                'title_en' => DB::raw('title'),
                'description_en' => DB::raw('description'),
                'issuer_en' => DB::raw('issuer'),
            ]);

        DB::table('gallery_items')
            ->whereNull('title_en')
            ->update([
                'title_en' => DB::raw('title'),
                'category_en' => DB::raw('category'),
                'description_en' => DB::raw('description'),
            ]);

        DB::table('academic_degrees')
            ->whereNull('title_en')
            ->update([
                'title_en' => DB::raw('title'),
                'field_en' => DB::raw('field'),
                'institution_en' => DB::raw('institution'),
                'country_en' => DB::raw('country'),
                'description_en' => DB::raw('description'),
            ]);
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table): void {
            $table->dropColumn([
                'short_bio_en', 'short_bio_uz',
                'full_bio_en', 'full_bio_uz',
                'position_en', 'position_uz',
                'organization_en', 'organization_uz',
                'address_en', 'address_uz',
            ]);
        });

        Schema::table('publications', function (Blueprint $table): void {
            $table->dropColumn([
                'title_en', 'title_uz',
                'authors_en', 'authors_uz',
                'journal_en', 'journal_uz',
                'abstract_en', 'abstract_uz',
                'keywords_en', 'keywords_uz',
            ]);
        });

        Schema::table('events', function (Blueprint $table): void {
            $table->dropColumn([
                'title_en', 'title_uz',
                'description_en', 'description_uz',
                'location_en', 'location_uz',
                'organizer_en', 'organizer_uz',
            ]);
        });

        Schema::table('achievements', function (Blueprint $table): void {
            $table->dropColumn([
                'title_en', 'title_uz',
                'description_en', 'description_uz',
                'issuer_en', 'issuer_uz',
            ]);
        });

        Schema::table('gallery_items', function (Blueprint $table): void {
            $table->dropColumn([
                'title_en', 'title_uz',
                'category_en', 'category_uz',
                'description_en', 'description_uz',
            ]);
        });

        Schema::table('academic_degrees', function (Blueprint $table): void {
            $table->dropColumn([
                'title_en', 'title_uz',
                'field_en', 'field_uz',
                'institution_en', 'institution_uz',
                'country_en', 'country_uz',
                'description_en', 'description_uz',
            ]);
        });
    }
};
