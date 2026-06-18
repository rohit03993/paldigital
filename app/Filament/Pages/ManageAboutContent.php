<?php

namespace App\Filament\Pages;

use App\Filament\Forms\ImageUpload;
use App\Models\SiteSetting;
use App\Support\UploadPath;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageAboutContent extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'About Page';
    protected static ?string $title = 'About Page — Story & Founder';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $textKeys = [
            'about_hero_label', 'about_hero_heading', 'about_hero_subheading',
            'about_ceo_name', 'about_ceo_title', 'about_ceo_education', 'about_ceo_tagline', 'about_ceo_linkedin',
            'about_story_intro_label', 'about_story_intro_heading', 'about_story_intro_text',
            'about_2024_heading', 'about_2024_text', 'about_2024_text_2',
            'about_why_label', 'about_why_heading', 'about_why_text',
            'about_mission_text', 'about_pull_quote',
            'about_help_label', 'about_help_heading', 'about_help_text',
            'about_cta_heading', 'about_cta_text',
            'about_stat_1_value', 'about_stat_1_label',
            'about_stat_2_value', 'about_stat_2_label',
            'about_stat_3_value', 'about_stat_3_label',
            'about_stat_4_value', 'about_stat_4_label',
        ];

        $settings = [];
        foreach ($textKeys as $key) {
            $settings[$key] = SiteSetting::get($key);
        }

        $photo = SiteSetting::get('about_ceo_photo');
        $settings['about_ceo_photo'] = $photo ? [$photo] : [];

        $settings['about_story_chapters'] = SiteSetting::getJson('about_story_chapters', []);
        $settings['about_focus_areas'] = SiteSetting::getJson('about_focus_areas', []);
        $settings['about_timeline'] = SiteSetting::getJson('about_timeline', []);

        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('About')->tabs([
                    Forms\Components\Tabs\Tab::make('Founder & Hero')->schema([
                        Forms\Components\Section::make('Profile')->schema([
                            ImageUpload::make('about_ceo_photo', 'about', true)
                                ->label('Founder photo')
                                ->helperText('Square headshot. Crop before saving.'),
                            Forms\Components\TextInput::make('about_ceo_name')->label('Name')->required(),
                            Forms\Components\TextInput::make('about_ceo_title')->label('Role / title'),
                            Forms\Components\TextInput::make('about_ceo_education')->label('Education'),
                            Forms\Components\TextInput::make('about_ceo_linkedin')
                                ->label('LinkedIn profile URL')
                                ->url()
                                ->helperText('Used for Google Person schema (sameAs). Strongly recommended for name SEO.'),
                            Forms\Components\TextInput::make('about_ceo_tagline')->label('Quote / tagline'),
                        ])->columns(2),
                        Forms\Components\Section::make('Hero')->schema([
                            Forms\Components\TextInput::make('about_hero_label')->label('Label'),
                            Forms\Components\TextInput::make('about_hero_heading')->label('Main heading'),
                            Forms\Components\Textarea::make('about_hero_subheading')->rows(3),
                        ]),
                    ]),
                    Forms\Components\Tabs\Tab::make('Story Chapters')->schema([
                        Forms\Components\Section::make('Story intro')->schema([
                            Forms\Components\TextInput::make('about_story_intro_label')->label('Label'),
                            Forms\Components\TextInput::make('about_story_intro_heading')->label('Heading'),
                            Forms\Components\Textarea::make('about_story_intro_text')->rows(3),
                        ]),
                        Forms\Components\Repeater::make('about_story_chapters')
                            ->label('Narrative chapters')
                            ->schema([
                                Forms\Components\TextInput::make('chapter')->label('#')->maxLength(3)->placeholder('01'),
                                Forms\Components\TextInput::make('label')->label('Chapter label')->required(),
                                Forms\Components\TextInput::make('title')->label('Chapter title')->required(),
                                Forms\Components\Textarea::make('body')->label('Story text')->rows(4)->required(),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['chapter'] ?? '') . ' ' . ($state['title'] ?? '')),
                    ]),
                    Forms\Components\Tabs\Tab::make('2024 & Why')->schema([
                        Forms\Components\Section::make('2024 — Full-time mission')->schema([
                            Forms\Components\TextInput::make('about_2024_heading')->label('Heading'),
                            Forms\Components\Textarea::make('about_2024_text')->label('Paragraph 1')->rows(4),
                            Forms\Components\Textarea::make('about_2024_text_2')->label('Paragraph 2')->rows(4),
                        ]),
                        Forms\Components\Section::make('Why Pal Digital')->schema([
                            Forms\Components\TextInput::make('about_why_label')->label('Label'),
                            Forms\Components\TextInput::make('about_why_heading')->label('Heading'),
                            Forms\Components\Textarea::make('about_why_text')->label('Paragraph 1')->rows(4),
                            Forms\Components\Textarea::make('about_mission_text')->label('Paragraph 2 / mission')->rows(4),
                            Forms\Components\Textarea::make('about_pull_quote')->label('Pull quote')->rows(2),
                        ]),
                        Forms\Components\Section::make('Who we help')->schema([
                            Forms\Components\TextInput::make('about_help_label')->label('Label'),
                            Forms\Components\TextInput::make('about_help_heading')->label('Heading'),
                            Forms\Components\Textarea::make('about_help_text')->rows(3),
                        ]),
                    ]),
                    Forms\Components\Tabs\Tab::make('Stats & More')->schema([
                        Forms\Components\Section::make('Stats')->schema([
                            Forms\Components\TextInput::make('about_stat_1_value')->label('Stat 1 value'),
                            Forms\Components\TextInput::make('about_stat_1_label')->label('Stat 1 label'),
                            Forms\Components\TextInput::make('about_stat_2_value')->label('Stat 2 value'),
                            Forms\Components\TextInput::make('about_stat_2_label')->label('Stat 2 label'),
                            Forms\Components\TextInput::make('about_stat_3_value')->label('Stat 3 value'),
                            Forms\Components\TextInput::make('about_stat_3_label')->label('Stat 3 label'),
                            Forms\Components\TextInput::make('about_stat_4_value')->label('Stat 4 value'),
                            Forms\Components\TextInput::make('about_stat_4_label')->label('Stat 4 label'),
                        ])->columns(2),
                        Forms\Components\Repeater::make('about_timeline')
                            ->label('Timeline (2024 section)')
                            ->schema([
                                Forms\Components\TextInput::make('year')->required(),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('description'),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => ($state['year'] ?? '') . ' — ' . ($state['title'] ?? '')),
                        Forms\Components\Repeater::make('about_focus_areas')
                            ->label('What we focus on')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('description'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                        Forms\Components\Section::make('Bottom CTA')->schema([
                            Forms\Components\TextInput::make('about_cta_heading')->label('Heading'),
                            Forms\Components\Textarea::make('about_cta_text')->rows(3),
                        ]),
                    ]),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $jsonKeys = ['about_focus_areas', 'about_timeline', 'about_story_chapters'];

        foreach ($data as $key => $value) {
            if ($key === 'about_ceo_photo') {
                if (UploadPath::isExplicitlyRemoved($value)) {
                    SiteSetting::set($key, null);
                } else {
                    $path = UploadPath::fromFilamentState($value);
                    if ($path !== null) {
                        SiteSetting::set($key, $path);
                    }
                }
                continue;
            }

            if (in_array($key, $jsonKeys, true)) {
                SiteSetting::setJson($key, is_array($value) ? $value : []);
                continue;
            }

            SiteSetting::set($key, is_string($value) ? $value : null);
        }

        Notification::make()->title('About page saved')->success()->send();
    }
}
