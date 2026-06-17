<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemoRequestResource\Pages;
use App\Models\DemoRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DemoRequestResource extends Resource
{
    protected static ?string $model = DemoRequest::class;
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'Leads & Enquiries';
    protected static ?int $navigationSort = 0;
    protected static ?string $navigationLabel = 'Demo Requests';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Contact')->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->tel()->required(),
                Forms\Components\TextInput::make('company'),
                Forms\Components\TextInput::make('industry'),
            ])->columns(2),
            Forms\Components\Section::make('Demo Details')->schema([
                Forms\Components\Select::make('product')->options(DemoRequest::PRODUCTS)->required(),
                Forms\Components\DatePicker::make('preferred_date'),
                Forms\Components\Select::make('preferred_time')->options(DemoRequest::TIME_SLOTS),
                Forms\Components\DateTimePicker::make('demo_scheduled_at')->label('Scheduled Demo Date/Time'),
                Forms\Components\Textarea::make('message')->rows(3),
            ])->columns(2),
            Forms\Components\Section::make('Workflow')->schema([
                Forms\Components\Select::make('status')->options(DemoRequest::STATUSES)->required(),
                Forms\Components\Textarea::make('admin_notes')->rows(4)->label('Internal Notes'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('product')->badge()
                    ->formatStateUsing(fn ($state) => DemoRequest::PRODUCTS[$state] ?? $state),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'contacted' => 'info',
                        'demo_scheduled' => 'primary',
                        'demo_completed' => 'success',
                        'converted' => 'success',
                        'closed' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => DemoRequest::STATUSES[$state] ?? $state),
                Tables\Columns\TextColumn::make('preferred_date')->date()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(DemoRequest::STATUSES),
                Tables\Filters\SelectFilter::make('product')->options(DemoRequest::PRODUCTS),
            ])
            ->actions([
                Tables\Actions\Action::make('schedule')
                    ->icon('heroicon-o-calendar')
                    ->color('primary')
                    ->visible(fn (DemoRequest $record) => in_array($record->status, ['new', 'contacted']))
                    ->form([
                        Forms\Components\DateTimePicker::make('demo_scheduled_at')->required(),
                    ])
                    ->action(function (DemoRequest $record, array $data) {
                        $record->update([
                            'demo_scheduled_at' => $data['demo_scheduled_at'],
                            'status' => 'demo_scheduled',
                        ]);
                    }),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDemoRequests::route('/'),
            'edit' => Pages\EditDemoRequest::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
