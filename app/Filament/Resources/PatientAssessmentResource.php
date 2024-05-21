<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientAssessmentResource\Pages;
use App\Models\Patient;
use App\Models\PatientAssessment;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Set;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

use Filament\Forms\Components\DateTimePicker;
use Carbon\Carbon;

class PatientAssessmentResource extends Resource
{
    protected static ?string $model = PatientAssessment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        // dd(Carbon::now()->toDateTimeString());
        
        return $form
            ->schema([
                Section::make('Patient Details')
                ->schema([
                    Select::make('patient_id')->required()->label('Select')
                        ->relationship(name: 'patient', titleAttribute: 'name')
                        ->searchable(['name', 'mobile'])
                        ->preload()
                        ->reactive()
                        ->lazy()
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            if(blank($state)) return;
                            $patient = Patient::find($state);
                            $set('email', $patient->email);
                            $set('mobile', $patient->mobile);
                            $set('occupation', $patient->occupation);
                            $set('address', $patient->address);
                            $set('age', $patient->age);
                            $set('gender', $patient->gender);
                            $set('blood_group', $patient->blood_group);
                            $set('notes', $patient->notes);
                        }), 
                    DateTimePicker::make('visited')
                        ->default(Carbon::now()->toDateTimeString())
                        ->native(false), 
                        // ->displayFormat("Y-m-d H:i:s"), 
                    Section::make('view more ...')
                        // ->description('The items you have selected for purchase')
                        ->schema([
                            TextInput::make('email')->email()->disabled(), 
                            TextInput::make('mobile')->tel()->disabled(), 
                            TextInput::make('occupation')->disabled(), 
                            TextInput::make('address')->disabled(), 
                            TextInput::make('age')->disabled(), 
                            Select::make('gender')->disabled() 
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ]), 
                            Select::make('blood_group')->disabled() 
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
                            Textarea::make('notes')->disabled(), 
                    ])->collapsed()
                    ->columns(2),
                ])->columns(2),

                Section::make('Patient Assessment')
                ->schema([
                    Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Chief Complaint')
                            ->schema([
                                Textarea::make('chief_complaint')->required()
                                    ->label("The primary reason the patient is seeking medical attention."), 

                                Textarea::make('presenting_symptoms')->helperText('Details about the symptoms the patient is currently experiencing, including their severity, duration, and any factors that worsen or alleviate them.'), 
                                Textarea::make('physical_examination')->helperText("Observation and assessment of the patient's physical appearance, vital signs (such as blood pressure, heart rate, respiratory rate, temperature), and examination of specific body systems."), 
                                Textarea::make('review_of_systems')->label('Review of Systems (ROS)')->helperText("A systematic inquiry about the patient's overall health, including symptoms affecting various body systems such as cardiovascular, respiratory, gastrointestinal, neurological, musculoskeletal, and others"), 
                                ]),
                        Tabs\Tab::make('Medical History')
                            ->schema([
                                Textarea::make('past_illnesses'), 
                                Textarea::make('surgeries'), 
                                Textarea::make('medications'), 
                                Textarea::make('allergies'), 
                                Textarea::make('family_medical_history'), 
                                Textarea::make('diagnostic_tests_and_results')->helperText("Documentation of any laboratory tests, imaging studies, or other diagnostic procedures performed and their results."), 
                            ]),
                        Tabs\Tab::make('Other Observations')
                            ->schema([

                                Textarea::make('psychosocial_assessment')->helperText("Evaluation of the patient's mental health, emotional state, stressors, coping mechanisms, and social support networks."), 
                                Textarea::make('functional_assessment')->helperText("Inquiry into the patient's ability to perform activities of daily living, mobility, and any limitations or disabilities."), 
                                Textarea::make('assessment_and_plan')->helperText("Summarizing the findings from the patient assessment and outlining a plan of action, which may include further diagnostic workup, treatment, referrals, or follow-up."), 
                            ]),
                    ]),
                ])
                //
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.name'), 
                TextColumn::make('chief_complaint'), 
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
            'index' => Pages\ListPatientAssessments::route('/'),
            'create' => Pages\CreatePatientAssessment::route('/create'),
            'edit' => Pages\EditPatientAssessment::route('/{record}/edit'),
        ];
    }
}
