<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistroAsistenciaResource\Pages;
use App\Filament\Resources\RegistroAsistenciaResource\RelationManagers;
use App\Models\RegistroAsistencia;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteAction;

class RegistroAsistenciaResource extends Resource
{
    protected static ?string $model = RegistroAsistencia::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('asistencia_id')
                    ->relationship('asistencia', 'fecha')
                    ->required(),



                    Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),


                Forms\Components\DateTimePicker::make('fecha_registro')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('asistencia.fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                   
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha_registro')
                    ->dateTime()
                    ->sortable(),
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
                DeleteAction::make(),
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
            'index' => Pages\ListRegistroAsistencias::route('/'),
            'create' => Pages\CreateRegistroAsistencia::route('/create'),
            'edit' => Pages\EditRegistroAsistencia::route('/{record}/edit'),
        ];
    }
}
