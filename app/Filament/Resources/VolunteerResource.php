<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerResource\Pages;
use App\Models\Volunteer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VolunteerResource extends Resource
{
    protected static ?string $model = Volunteer::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $modelLabel = 'volunteer';
    protected static ?string $pluralModelLabel = 'volunteers';
    protected static ?string $navigationGroup = 'member management';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\FileUpload::make('profile_photo')
                            ->label('صورة شخصية')
                            ->directory('volunteers/profile')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull()
                            ->avatar(),

                        Forms\Components\TextInput::make('name')
                            ->label('الاسم بالكامل')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\TextInput::make('national_id')
                            ->label('رقم الهوية')
                            ->maxLength(20),

                        Forms\Components\DatePicker::make('birth_date')
                            ->label('تاريخ الميلاد')
                            ->native(false)
                            ->maxDate(now()),

                        Forms\Components\Select::make('gender')
                            ->label('الجنس')
                            ->options([
                                'male' => 'ذكر',
                                'female' => 'أنثى',
                                'other' => 'أخرى',
                            ])
                            ->native(false),
                    ])->columns(2),

                Forms\Components\Section::make('المعلومات المهنية')
                    ->schema([
                        Forms\Components\TextInput::make('profession')
                            ->label('المهنة')
                            ->maxLength(255),

                        Forms\Components\TagsInput::make('skills')
                            ->label('المهارات')
                            ->placeholder('أضف مهارة جديدة')
                            ->suggestions([
                                'قيادة فرق',
                                'الترجمة',
                                'التصميم',
                                'البرمجة',
                                'التدريس',
                                'الإسعافات الأولية',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('CV')
                            ->label('السيرة الذاتية')
                            ->directory('volunteers/cvs')
                            ->acceptedFileTypes(['application/pdf'])
                            ->downloadable()
                            ->openable()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('التوفر والإدارة')
                    ->schema([
                        Forms\Components\Select::make('availability')
                            ->label('التوفر')
                            ->options([
                                'full_time' => 'دوام كامل',
                                'part_time' => 'دوام جزئي',
                                'weekends' => 'عطلات نهاية الأسبوع',
                            ])
                            ->native(false),

                        Forms\Components\DatePicker::make('join_date')
                            ->label('تاريخ الانضمام')
                            ->native(false)
                            ->default(now()),

                        Forms\Components\Toggle::make('is_active')
                            ->label('متطوع نشط')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true),

                        Forms\Components\Textarea::make('notes')
                            ->label('ملاحظات')
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
                    ->label('الاسم')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Volunteer $record) => $record->profession),

                Tables\Columns\TextColumn::make('email')
                    ->label('البريد')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->iconPosition('before'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('الهاتف')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->iconPosition('before'),

                Tables\Columns\TextColumn::make('join_date')
                    ->label('تاريخ الانضمام')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('gender')
                    ->label('الجنس')
                    ->options([
                        'male' => 'ذكر',
                        'female' => 'أنثى',
                        'other' => 'أخرى',
                    ]),

                Tables\Filters\SelectFilter::make('availability')
                    ->label('التوفر')
                    ->options([
                        'full_time' => 'دوام كامل',
                        'part_time' => 'دوام جزئي',
                        'weekends' => 'عطلات نهاية الأسبوع',
                    ]),

                Tables\Filters\Filter::make('is_active')
                    ->label('المتطوعين النشطين فقط')
                    ->query(fn ($query) => $query->where('is_active', true)),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('primary'),

                    Tables\Actions\EditAction::make()
                        ->color('success'),

                    Tables\Actions\Action::make('cv')
                        ->label('عرض السيرة الذاتية')
                        ->icon('heroicon-o-document-text')
                        ->color('info')
                        ->url(fn (Volunteer $record) => asset('storage/' . $record->CV))
                        ->hidden(fn (Volunteer $record) => !$record->CV),

                    Tables\Actions\DeleteAction::make()
                        ->requiresConfirmation()
                        ->modalHeading('حذف المتطوع')
                        ->modalDescription('هل أنت متأكد من رغبتك في حذف هذا المتطوع؟')
                        ->modalSubmitActionLabel('نعم، احذف')
                        ->modalCancelActionLabel('إلغاء'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('تفعيل المحدد')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true])),

                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('تعطيل المحدد')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                ]),
            ])

            ->defaultSort('join_date', 'desc')

            ->groups([
                Tables\Grouping\Group::make('availability')
                    ->label('حسب التوفر')
                    ->collapsible(),

                Tables\Grouping\Group::make('is_active')
                    ->label('حسب الحالة')
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

    public static function getNavigationBadge(): ?string
    {
        return Volunteer::where('is_active', true)->count();
    }
}
