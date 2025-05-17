<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'services';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('filament.service.fields.name'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\RichEditor::make('description')
                    ->label(__('filament.service.fields.description'))
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.service.fields.name')),

                Tables\Columns\TextColumn::make('articles_count')
                    ->label(__('filament.service.fields.articles_count'))
                    ->counts('articles'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament.service.fields.created_at'))
                    ->dateTime('d/m/Y H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label(__('filament.service.actions.create')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label(__('filament.service.actions.edit')),
                Tables\Actions\DeleteAction::make()
                    ->label(__('filament.service.actions.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.service.bulk_actions.delete')),
                ]),
            ]);
    }
}
