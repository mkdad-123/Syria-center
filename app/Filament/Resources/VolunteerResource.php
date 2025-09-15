<?php

namespace App\Filament\Resources;

use App\Enums\GenderEnum;
use App\Enums\VolunteerAvailabilityEnum;
use App\Filament\Resources\VolunteerResource\Pages;
use App\Models\Volunteer;
use App\Services\Dashboard\DashboardCountsService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class VolunteerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Volunteer::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 6;

    public static function getNavigationLabel(): string
    {
        return __('filament.volunteer.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.volunteer.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.volunteer.plural_model_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.volunteer.navigation_group');
    }

    public static function getNavigationBadge(): ?string
    {
        return DashboardCountsService::get('volunteers_active');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament.volunteer.sections.basic_info'))
                    ->schema([
                        Forms\Components\FileUpload::make('profile_photo')
                            ->label(__('filament.volunteer.fields.profile_photo'))
                            ->directory('volunteers/profile')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull()
                            ->avatar(),

                        Forms\Components\TextInput::make('name')
                            ->label(__('filament.volunteer.fields.full_name'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label(__('filament.volunteer.fields.email'))
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label(__('filament.volunteer.fields.phone'))
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('national_id')
                            ->label(__('filament.volunteer.fields.national_id'))
                            ->maxLength(20),

                        Forms\Components\DatePicker::make('birth_date')
                            ->label(__('filament.volunteer.fields.birth_date'))
                            ->native(false)
                            ->maxDate(now()),

                        Forms\Components\Select::make('gender')
                            ->label(__('filament.volunteer.fields.gender'))
                            ->options([
                                GenderEnum::Male->value => __('filament.volunteer.gender.male'),
                                GenderEnum::Female->value => __('filament.volunteer.gender.female'),
                                GenderEnum::Other->value => __('filament.volunteer.gender.other'),
                            ])
                            ->native(false),
                    ])->columns(2),

                Forms\Components\Section::make(__('filament.volunteer.sections.professional_info'))
                    ->schema([
                        Forms\Components\TextInput::make('profession')
                            ->label(__('filament.volunteer.fields.profession'))
                            ->maxLength(255),

                        Forms\Components\TagsInput::make('skills')
                            ->label(__('filament.volunteer.fields.positions'))
                            ->placeholder(__('filament.volunteer.fields.positions_placeholder'))
                            ->suggestions([
                                __('filament.volunteer.skills.team_leadership'),
                                __('filament.volunteer.skills.translation'),
                                __('filament.volunteer.skills.design'),
                                __('filament.volunteer.skills.programming'),
                                __('filament.volunteer.skills.teaching'),
                                __('filament.volunteer.skills.first_aid'),
                            ])
                            ->columnSpanFull(),

                        TinyEditor::make('CV')
                            ->minHeight(300)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('volunteers/cvs')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make(__('filament.volunteer.sections.availability_management'))
                    ->schema([
                        Forms\Components\Select::make('availability')
                            ->label(__('filament.volunteer.fields.availability'))
                            ->options([
                                VolunteerAvailabilityEnum::Full_Time->value => __('filament.volunteer.availability.full_time'),
                                VolunteerAvailabilityEnum::Part_time->value => __('filament.volunteer.availability.part_time'),
                                VolunteerAvailabilityEnum::Weekends->value => __('filament.volunteer.availability.weekends'),
                            ])
                            ->native(false),

                        Forms\Components\DatePicker::make('join_date')
                            ->label(__('filament.volunteer.fields.join_date'))
                            ->native(false)
                            ->default(now()),

                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament.volunteer.fields.is_active'))
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true),

                        Forms\Components\Textarea::make('notes')
                            ->label(__('filament.volunteer.fields.notes'))
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo')
                    ->label('')
                    ->disk('public')
                    ->width(50)
                    ->height(50)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament.volunteer.fields.name'))
                    ->searchable()
                    ->sortable()
                    ->description(fn (Volunteer $record) => $record->profession),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament.volunteer.fields.email'))
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->iconPosition('before'),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('filament.volunteer.fields.phone'))
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->iconPosition('before'),

                Tables\Columns\TextColumn::make('join_date')
                    ->label(__('filament.volunteer.fields.join_date'))
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament.volunteer.fields.status'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gender')
                    ->label(__('filament.volunteer.fields.gender'))
                    ->options([
                        'male' => __('filament.volunteer.gender.male'),
                        'female' => __('filament.volunteer.gender.female'),
                        'other' => __('filament.volunteer.gender.other'),
                    ]),

                Tables\Filters\SelectFilter::make('availability')
                    ->label(__('filament.volunteer.fields.availability'))
                    ->options([
                        'full_time' => __('filament.volunteer.availability.full_time'),
                        'part_time' => __('filament.volunteer.availability.part_time'),
                        'weekends' => __('filament.volunteer.availability.weekends'),
                    ]),

                Tables\Filters\Filter::make('is_active')
                    ->label(__('filament.volunteer.filters.active_only'))
                    ->query(fn ($query) => $query->where('is_active', true)),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('primary')
                        ->label(__('filament.volunteer.actions.view')),

                    Tables\Actions\EditAction::make()
                        ->color('success')
                        ->label(__('filament.volunteer.actions.edit')),

                    Tables\Actions\Action::make('cv')
                        ->label(__('filament.volunteer.actions.view_cv'))
                        ->icon('heroicon-o-document-text')
                        ->color('info')
                        ->url(fn (Volunteer $record) => asset('storage/' . $record->CV))
                        ->hidden(fn (Volunteer $record) => !$record->CV),

                    Tables\Actions\DeleteAction::make()
                        ->requiresConfirmation()
                        ->modalHeading(__('filament.volunteer.actions.delete.modal_heading'))
                        ->modalDescription(__('filament.volunteer.actions.delete.modal_description'))
                        ->modalSubmitActionLabel(__('filament.volunteer.actions.delete.modal_submit'))
                        ->modalCancelActionLabel(__('filament.volunteer.actions.delete.modal_cancel'))
                        ->label(__('filament.volunteer.actions.delete.label')),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label(__('filament.volunteer.bulk_actions.delete')),

                    Tables\Actions\RestoreBulkAction::make()
                        ->label(__('filament.volunteer.bulk_actions.restore')),

                    Tables\Actions\BulkAction::make('activate')
                        ->label(__('filament.volunteer.bulk_actions.activate'))
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label(__('filament.volunteer.bulk_actions.deactivate'))
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ]),
            ])
            ->defaultSort('join_date', 'desc')
            ->groups([
                Tables\Grouping\Group::make('availability')
                    ->label(__('filament.volunteer.groups.by_availability'))
                    ->collapsible(),

                Tables\Grouping\Group::make('is_active')
                    ->label(__('filament.volunteer.groups.by_status'))
                    ->collapsible(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVolunteers::route('/'),
            'create' => Pages\CreateVolunteer::route('/create'),
            'edit' => Pages\EditVolunteer::route('/{record}/edit'),
        ];
    }
}
