<?php

namespace App\Filament\Resources;

use App\Filament\Forms\ImageUpload;
use App\Filament\Resources\SeoMetaResource\Pages;
use App\Models\SeoMeta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeoMetaResource extends Resource
{
    protected static ?string $model = SeoMeta::class;
    protected static ?string $navigationIcon = 'heroicon-o-magnifying-glass';
    protected static ?string $navigationGroup = 'SEO Management';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'SEO Pages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('page')->required()->unique(ignoreRecord: true)
                ->helperText('Page key: home, about, services, industries, solutions, portfolio, case-studies, blog, contact'),
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Textarea::make('description')->rows(3),
            Forms\Components\Textarea::make('keywords')->rows(2),
            ImageUpload::make('og_image', 'seo')
                ->label('Social share image (OG)')
                ->helperText('1200×630 recommended. Crop before saving.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page')->searchable(),
                Tables\Columns\TextColumn::make('title')->limit(50),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeoMetas::route('/'),
            'create' => Pages\CreateSeoMeta::route('/create'),
            'edit' => Pages\EditSeoMeta::route('/{record}/edit'),
        ];
    }
}
