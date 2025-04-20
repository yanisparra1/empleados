<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PersonalResource\Pages;
use App\Filament\Resources\PersonalResource\RelationManagers;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Support\Enums\IconPosition;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action as FilamentAction;

class PersonalResource extends Resource
{
    protected static ?string $model = Personal::class;

    protected static ?string $navigationIcon = 'fas-people-carry-box';
    protected static ?string $navigationLabel = 'Personal';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                ->image()
                    ->required(),
                    Forms\Components\TextInput::make('nombre')
                    ->required(),

                    Forms\Components\TextInput::make('apellido')
                    ->required(),
      
                Forms\Components\TextInput::make('cedula')
                    ->required()
                    ->unique(ignoreRecord: true) 
                    ->numeric()
                    ->disabled(fn ($operation) => $operation === 'edit'),
                Forms\Components\DatePicker::make('fecha_ingreso')
                    ->required(),
                Forms\Components\Select::make('tipo_personal_id')
                    ->relationship('tipoPersonal', 'descripcion')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('cedula')
                    ->numeric()
                    ->sortable(),
                   // Tables\Columns\TextColumn::make('image')
                    ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('fecha_ingreso')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipoPersonal.descripcion')
                   
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                        Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    Tables\Columns\TextColumn::make('qr')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                FilamentAction::make('CARNET')
                ->color('success')
            //    ->url(fn ($record) => 'https://ejemplo.com/ruta/' . $record->id)
                ->icon('heroicon-s-cloud-arrow-down')
                ->url(
                    fn ($record) => route('pdf.example', ['user' => $record->qr]), // Pasar el ID del registro
                    shouldOpenInNewTab: true
                ),               
                EditAction::make(),
                DeleteAction::make()
               
              
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
            'index' => Pages\ListPersonals::route('/'),
            'create' => Pages\CreatePersonal::route('/create'),
            'edit' => Pages\EditPersonal::route('/{record}/edit'),
        ];
    }
}
