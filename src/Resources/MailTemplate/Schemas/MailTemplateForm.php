<?php

declare(strict_types=1);

namespace JeffersonGoncalves\FilamentMail\Resources\MailTemplate\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class MailTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        $locales = config('filament-mail.template_editor.locales', ['en']);

        return $schema
            ->columns(null)
            ->components([
                Section::make('General')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled(fn (?string $operation) => $operation === 'edit')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('mailable_class')
                            ->label('Mailable Class')
                            ->placeholder('App\\Mail\\WelcomeMail')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                        Forms\Components\TextInput::make('layout')
                            ->label('Layout')
                            ->placeholder('emails.layout')
                            ->helperText('Blade layout to wrap the template content')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),

                Section::make('Content')
                    ->schema([
                        Tabs::make('locale_tabs')
                            ->tabs(
                                collect($locales)->map(fn (string $locale) => Tab::make(strtoupper($locale))
                                    ->schema([
                                        Forms\Components\TextInput::make("translations.{$locale}.subject")
                                            ->label('Subject')
                                            ->required($locale === config('filament-mail.template_editor.default_locale', 'en')),
                                        Forms\Components\Textarea::make("translations.{$locale}.html_body")
                                            ->label('HTML Body')
                                            ->required($locale === config('filament-mail.template_editor.default_locale', 'en'))
                                            ->rows(15),
                                        Forms\Components\Textarea::make("translations.{$locale}.text_body")
                                            ->label('Plain Text Body')
                                            ->rows(8),
                                    ])
                                )->all()
                            ),
                    ]),

                Section::make('Variables')
                    ->schema([
                        Forms\Components\Repeater::make('variables')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Select::make('type')
                                    ->options([
                                        'string' => 'String',
                                        'int' => 'Integer',
                                        'bool' => 'Boolean',
                                        'array' => 'Array',
                                        'model' => 'Model',
                                    ])
                                    ->default('string')
                                    ->required(),
                                Forms\Components\TextInput::make('example')
                                    ->label('Example Value'),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->addActionLabel('Add Variable')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    ])
                    ->collapsible(),
            ]);
    }
}
