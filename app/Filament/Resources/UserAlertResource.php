<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserAlertResource\Pages;
use App\Filament\Resources\UserAlertResource\RelationManagers;
use App\Models\UserAlert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserAlertResource extends Resource
{
    protected static ?string $model = UserAlert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $tenantRelationshipName = 'user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('alert_url')
                ->default(function () {
                    $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
                    $host = $_SERVER['HTTP_HOST'];
                    return $protocol. '://' . $host . '/' . auth()->user()->id . '/alertBox';
                    // return $host;
                })
                ->dehydrated()
                ->disabled(),
                Forms\Components\TextInput::make('name')
                    ->maxLength(255)
                    ->default('base'),
                Forms\Components\TextInput::make('message_template')
                    ->maxLength(255)
                    ->default('{tipper} tipped Rs.{amount}!!'),
                Forms\Components\Select::make('layout')
                ->options([
                    '1' => 'main',
                ]),
                Forms\Components\TextInput::make('text_animation')
                    ->maxLength(255),
                Forms\Components\TextInput::make('alert_animation_1')
                    ->maxLength(255),
                Forms\Components\TextInput::make('alert_animation_2')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\TextInput::make('sound')
                    ->maxLength(255),
                Forms\Components\TextInput::make('sound_volume')
                    ->numeric(),
                Forms\Components\TextInput::make('alert_duration')
                    ->numeric(),
                Forms\Components\TextInput::make('alert_delay')
                    ->numeric(),
                Forms\Components\Toggle::make('display_message'),
                Forms\Components\Toggle::make('custom_code_status'),
                Forms\Components\Textarea::make('custom_code_value')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alert_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('message_template')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layout')
                    ->searchable(),
                Tables\Columns\TextColumn::make('text_animation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alert_animation_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alert_animation_2')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('sound')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sound_volume')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alert_duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alert_delay')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('display_message')
                    ->boolean(),
                Tables\Columns\IconColumn::make('custom_code_status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUserAlerts::route('/'),
            'create' => Pages\CreateUserAlert::route('/create'),
            'edit' => Pages\EditUserAlert::route('/{record}/edit'),
        ];
    }
}
