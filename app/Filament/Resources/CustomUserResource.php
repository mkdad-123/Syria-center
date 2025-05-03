<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomUserResource\Pages;
use App\Models\CustomUser;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class CustomUserResource extends Resource
{

    protected static ?string $model = CustomUser::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'User';
    protected static ?string $pluralModelLabel = 'Users';
    protected static ?string $navigationGroup = 'member management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\TextColumn::make('name')
                        ->label('الاسم')
                        ->searchable()
                        ->sortable()
                        ->weight('bold'),

                    Tables\Columns\TextColumn::make('email')
                        ->label('البريد')
                        ->searchable()
                        ->icon('heroicon-o-envelope')
                        ->iconPosition('after'),

                    Tables\Columns\TextColumn::make('created_at')
                        ->label('تاريخ التسجيل')
                        ->date('d/m/Y')
                        ->sortable(),
                ])
                    ->extraAttributes(['class' => 'bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow-sm'])
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([

                Tables\Filters\Filter::make('registered_this_month')
                    ->label('مسجلون هذا الشهر')
                    ->query(fn ($query) => $query->where('created_at', '>=', now()->startOfMonth())),

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DeleteAction::make()
                        ->icon('heroicon-o-trash')
                        ->requiresConfirmation()
                        ->modalHeading('حذف المستخدم')
                        ->modalDescription('هل أنت متأكد من رغبتك في حذف هذا المستخدم؟ سيتم إزالة جميع البيانات المرتبطة به بشكل دائم.')
                        ->modalSubmitActionLabel('نعم، احذف')
                        ->modalCancelActionLabel('إلغاء'),

                ])
                    ->dropdown(false)
                    ->icon('heroicon-s-cog-6-tooth')
                    ->size('sm')
                    ->color('gray'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),

                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->label('حسب تاريخ التسجيل')
                    ->date()
                    ->collapsible(),

            ]);
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
            'index' => Pages\ListCustomUsers::route('/'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return CustomUser::count();
    }
}
