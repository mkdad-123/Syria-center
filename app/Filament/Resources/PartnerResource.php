<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    use Translatable;

    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $modelLabel = 'Partner';
    protected static ?string $pluralModelLabel = 'Partners';
    protected static ?string $navigationGroup = 'member management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('شعار الشريك')
                            ->directory('partners/logos')
                            ->image()
                            ->imageEditorViewportWidth('500')
                            ->imageEditorViewportHeight('300')
                            ->imageResizeMode('cover')
                            ->imageEditor()
                            ->columnSpanFull(),

                        Forms\Components\Tabs::make('الترجمات')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('العربية')
                                    ->schema([
                                        Forms\Components\TextInput::make('name.ar')
                                            ->label('الاسم بالعربية')
                                            ->required(),
                                        Forms\Components\RichEditor::make('description.ar')
                                            ->label('الوصف بالعربية')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'link',
                                                'bulletList', 'orderedList',
                                            ]),
                                    ]),
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\TextInput::make('name.en')
                                            ->label('Name (English)')
                                            ->required(),
                                        Forms\Components\RichEditor::make('description.en')
                                            ->label('Description (English)'),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([
                        Tables\Columns\ImageColumn::make('image')
                            ->label('الشعار')
                            ->size(100)
                            ->grow(false)
                            ->extraImgAttributes(['class' => 'rounded-lg']),

                        Tables\Columns\TextColumn::make('name')
                            ->label('الاسم')
                            ->searchable()
                            ->weight('bold')
                            ->size('lg'),


                        Tables\Columns\Layout\Split::make([
                            Tables\Columns\TextColumn::make('description')
                                ->label('الوصف')
                                ->html()
                                ->wrap(),
                        ])->extraAttributes(['class' => 'px-4 pb-4 border-t border-gray-100']),

                ])->extraAttributes(['class' => 'bg-white dark:bg-gray-800 p-4 rounded-xl shadow hover:shadow-md transition-shadow']),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\EditAction::make()
                        ->icon('heroicon-o-pencil'),

                    Tables\Actions\DeleteAction::make()
                        ->modalHeading('حذف الشريك')
                        ->modalDescription('هل أنت متأكد من رغبتك في حذف هذا الشريك؟ سيتم حذف جميع البيانات المرتبطة به.')
                        ->successNotificationTitle('تم حذف الشريك بنجاح'),
                ])
                    ->dropdown(false)
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('sm')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('حذف المحدد')
                        ->modalHeading('حذف الشركاء المحددين'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label('حسب تاريخ الإضافة')
                    ->date()
                    ->collapsible(),
            ])
            ->emptyStateHeading('لا يوجد شركاء مسجلين بعد')
            ->emptyStateDescription('اضغط على زر "إضافة شريك" لبدء التسجيل');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }

}
