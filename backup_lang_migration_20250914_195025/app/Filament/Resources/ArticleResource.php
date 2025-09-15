<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class ArticleResource extends Resource
{
    use Translatable;

    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament.article.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.article.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.article.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.article.navigation_group');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->label(__('filament.article.service.label'))
                    ->relationship('service', 'name')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label(__('filament.article.title.label'))
                    ->required()
                    ->maxLength(255),

                TinyEditor::make('content')
                    ->minHeight(300)
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('articles')
                    ->hint(__('filament.article.content.hint'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name')
                    ->label(__('filament.article.service.label'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('service.section.name')
                    ->label(__('filament.article.section.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.article.title.label'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.article.created_at.label'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament.article.updated_at.label'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('service')
                    ->label(__('filament.article.filters.service'))
                    ->relationship('service', 'name'),

                Tables\Filters\SelectFilter::make('section')
                    ->label(__('filament.article.filters.section'))
                    ->relationship('service.section', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
