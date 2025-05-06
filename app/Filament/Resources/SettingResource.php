<?php

namespace App\Filament\Resources;

use App\Enums\SectionEnum;
use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class SettingResource extends Resource
{
    use Translatable;

    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $modelLabel = 'Setting';

    protected static ?string $navigationLabel = 'Setting';

    protected static ?string $navigationGroup = 'Public Setting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Section::make()
                ->schema([
                    Select::make('section')
                        ->label('key')
                        ->required()
                        ->options([
                            SectionEnum::AboutUs->value =>  __('main.titles.about') ,
                            SectionEnum::Vision->value => __('main.titles.vision'),
                            SectionEnum::Mission->value => __('main.titles.mission'),
                            SectionEnum::TargetGroup->value => __('main.titles.target'),
                        ])
                        ->live()
                        ->afterStateUpdated(function ($state , Forms\Set $set){
                            $set('title' , Str::headline($state));
                        }),


                    TextInput::make('title')
                    ->label('title')
                    ->required(),

                    Forms\Components\FileUpload::make('image')
                    ->label('image')
                    ->directory('Setting')
                    ->image()
                    ->imageEditor(),

                    Forms\Components\RichEditor::make('content')
                        ->label('content')
                        ->toolbarButtons([
                            'bold',
                            'bulletList',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'undo',
                        ])
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\KeyValue::make('extra')
                        ->label('Additional setting')
                        ->keyLabel('field name')
                        ->valueLabel('value')
                        ->columnSpanFull(),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->circular()
                    ->size(50)
                    ->grow(false),


                Tables\Columns\TextColumn::make('title')
                    ->label('title')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->tooltip(fn ($record) => $record->title),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(' updated at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->color('gray'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
