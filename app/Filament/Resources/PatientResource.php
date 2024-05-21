<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Models\Patient;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(), 
                TextInput::make('email')->email(), 
                TextInput::make('mobile')->tel()->required(), 
                TextInput::make('occupation')->required(), 
                TextInput::make('address'), 
                TextInput::make('age')->numeric(), 
                Select::make('gender')->required()
                ->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'other' => 'Other',
                ]), 
                Select::make('blood_group')->required()
                ->options([
                    'a+' => 'A+',
                    'a-' => 'A-',
                    'b+' => 'B+',
                    'b-' => 'B+',
                    'O+' => 'O+',
                    'O-' => 'O-',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-',
                ]), 

                Textarea::make('notes'), 

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'), 
                TextColumn::make('mobile'), 
                TextColumn::make('address')
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
