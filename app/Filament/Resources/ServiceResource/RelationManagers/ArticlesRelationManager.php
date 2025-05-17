<?php

namespace App\Filament\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\Concerns\Translatable;

class ArticlesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'articles';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('filament.article.fields.title'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('content')
                    ->label(__('filament.article.fields.content'))
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament.article.fields.title'))
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.article.fields.publish_date'))
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('filament.article.actions.create')),
                Tables\Actions\LocaleSwitcher::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('filament.article.actions.edit')),
                Tables\Actions\DeleteAction::make()
                    ->label(__('filament.article.actions.delete')),
                Tables\Actions\ViewAction::make()
                    ->label(__('filament.article.actions.view')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.article.bulk_actions.delete')),
                ]),
            ]);
    }
}
