<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompliantResource\Pages;
use App\Models\Compliants;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CompliantResource extends Resource
{
    protected static ?string $model = Compliants::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $modelLabel = 'شكوى/مقترح';
    protected static ?string $pluralModelLabel = 'الشكاوى والمقترحات';
    protected static ?string $navigationGroup = 'Public Setting';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([

//                    Tables\Columns\TextColumn::make('custom_user.name')
//                        ->label('المستخدم')
//                        ->description(fn ($record) => $record->email)
//                        ->searchable()
//                        ->sortable()
//                        ->color('primary')
//                        ->icon('heroicon-o-user-circle')
//                        ->iconPosition('before')
//                        ->weight('bold')
//                        ->extraAttributes(['class' => 'px-4 pt-4']),

                    Tables\Columns\TextColumn::make('content')
                        ->label('محتوى الشكوى')
                        ->limit(200)
                        ->searchable()
                        ->wrap()
                        ->markdown()
                        ->extraAttributes(['class' => 'px-4 py-3']),

                    Tables\Columns\Layout\Split::make([

                        Tables\Columns\TextColumn::make('date')
                            ->label('')
                            ->date('d/m/Y')
                            ->icon('heroicon-o-calendar')
                            ->color('gray-500')
                            ->size('sm'),

                        Tables\Columns\TextColumn::make('created_at')
                            ->label('')
                            ->since()
                            ->icon('heroicon-o-clock')
                            ->color('gray-500')
                            ->size('sm'),

                    ])->extraAttributes(['class' => 'px-4 pb-4 border-t border-gray-100']),

                ])->extraAttributes(['class' => 'bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow']),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
//                Tables\Filters\SelectFilter::make('custom_user_id')
//                    ->label('تصفية بالمستخدم')
//                    ->relationship('custom_user', 'name')
//                    ->searchable()
//                    ->preload(),

                Tables\Filters\Filter::make('today')
                    ->label('شكاوى اليوم')
                    ->query(fn ($query) => $query->whereDate('date', today())),
            ])
            ->actions([
//                Tables\Actions\ViewAction::make()
//                    ->icon('heroicon-o-eye')
//                    ->color('gray')
//                    ->modalHeading('تفاصيل الشكوى')
//                    ->modalDescription(fn ($record) => Str::limit($record->content, 200))
//                    ->modalContent(fn ($record) => static::getCompliantDetails($record)),

                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->modalHeading('حذف الشكوى')
                    ->modalDescription('سيتم حذف الشكوى بشكل دائم ولا يمكن استرجاعها لاحقاً.')
                    ->modalSubmitActionLabel('تأكيد الحذف')
                    ->modalCancelActionLabel('إلغاء'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('حذف المحدد')
                        ->modalHeading('حذف الشكاوى المحددة'),

                    Tables\Actions\BulkAction::make('mark_as_important')
                        ->label('وضع علامة مهم')
                        ->icon('heroicon-o-flag')
                        ->color('warning'),
                ]),
            ])
            ->defaultSort('date', 'desc')
            ->groups([
//                Tables\Grouping\Group::make('custom_user.name')
//                    ->label('حسب المستخدم')
//                    ->collapsible(),

                Tables\Grouping\Group::make('date')
                    ->label('حسب التاريخ')
                    ->date()
                    ->collapsible(),
            ])
            ->emptyStateHeading('لا توجد شكاوى مسجلة')
            ->emptyStateDescription('سيتم عرض الشكاوى هنا تلقائياً عند إرسالها من الموقع');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompliants::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Compliants::count();
    }
}
