<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageHomepageContent extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Homepage Sections';
    protected static ?string $title = 'Homepage Content';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $textKeys = [
            'message_line_1', 'message_line_2', 'message_line_3',
            'hero_stat_1_value', 'hero_stat_1_label',
            'hero_stat_2_value', 'hero_stat_2_label',
            'hero_stat_3_value', 'hero_stat_3_label',
            'section_services_label', 'section_services_heading', 'section_services_subheading', 'section_services_tagline', 'section_services_btn',
            'section_industries_label', 'section_industries_heading', 'section_industries_subheading', 'section_industries_link',
            'section_flagship_label', 'section_flagship_subtitle', 'section_flagship_badge', 'section_flagship_note',
            'section_demo_label', 'section_demo_heading', 'section_demo_text', 'section_demo_panel_title',
            'section_process_label', 'section_process_heading', 'section_process_subheading',
            'section_testimonials_label', 'section_testimonials_heading',
            'section_cta_label', 'section_cta_heading', 'section_cta_subheading', 'section_cta_btn_primary', 'section_cta_btn_secondary',
        ];

        $settings = [];
        foreach ($textKeys as $key) {
            $settings[$key] = SiteSetting::get($key);
        }

        $settings['demo_bullets'] = SiteSetting::getJson('demo_bullets', [
            ['text' => 'Live walkthrough — not a slideshow'],
            ['text' => 'Features picked for YOUR business'],
            ['text' => 'Dev team on the call, not just sales'],
        ]);

        $settings['demo_cards'] = SiteSetting::getJson('demo_cards', [
            ['title' => 'Education ERP', 'subtitle' => '11 modules', 'detail' => 'Admissions · Fees · Attendance · CRM', 'icon' => 'erp'],
            ['title' => 'CRM Platform', 'subtitle' => 'Lead → Close', 'detail' => 'Pipeline · Follow-ups · Reports', 'icon' => 'crm'],
            ['title' => 'Mobile Apps', 'subtitle' => 'iOS + Android', 'detail' => 'Portals · Field apps · Notifications', 'icon' => 'mobile'],
            ['title' => 'Automation', 'subtitle' => 'WhatsApp & more', 'detail' => 'Workflows · Alerts · Integrations', 'icon' => 'automation'],
        ]);

        $settings['demo_agenda'] = SiteSetting::getJson('demo_agenda', [
            ['time' => '0–10 min', 'step' => 'Your goals & workflow — we listen first'],
            ['time' => '10–25 min', 'step' => 'Live demo tailored to your industry'],
            ['time' => '25–30 min', 'step' => 'Q&A with the dev team — no sales script'],
        ]);

        $settings['process_steps'] = SiteSetting::getJson('process_steps', [
            ['number' => '01', 'title' => 'We Listen', 'description' => 'You talk. We actually pay attention.'],
            ['number' => '02', 'title' => 'We Map It', 'description' => 'Your process, documented — every step.'],
            ['number' => '03', 'title' => 'We Design It', 'description' => 'UI your team won\'t hate using.'],
            ['number' => '04', 'title' => 'We Build It', 'description' => 'Clean code. Modern stack. No duct tape.'],
            ['number' => '05', 'title' => 'We Break It', 'description' => 'QA until it\'s bulletproof.'],
            ['number' => '06', 'title' => 'We Ship It', 'description' => 'Go live without the chaos.'],
            ['number' => '07', 'title' => 'We Stick Around', 'description' => 'Updates, fixes, new features — we\'re here.'],
        ]);

        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Homepage')->tabs([
                    Forms\Components\Tabs\Tab::make('Message & Stats')->schema([
                        Forms\Components\Section::make('Message Band')->schema([
                            Forms\Components\TextInput::make('message_line_1'),
                            Forms\Components\TextInput::make('message_line_2'),
                            Forms\Components\TextInput::make('message_line_3'),
                        ]),
                        Forms\Components\Section::make('Hero Stats')->schema([
                            Forms\Components\TextInput::make('hero_stat_1_value')->label('Stat 1 value'),
                            Forms\Components\TextInput::make('hero_stat_1_label')->label('Stat 1 label'),
                            Forms\Components\TextInput::make('hero_stat_2_value')->label('Stat 2 value'),
                            Forms\Components\TextInput::make('hero_stat_2_label')->label('Stat 2 label'),
                            Forms\Components\TextInput::make('hero_stat_3_value')->label('Stat 3 value'),
                            Forms\Components\TextInput::make('hero_stat_3_label')->label('Stat 3 label'),
                        ])->columns(2),
                    ]),
                    Forms\Components\Tabs\Tab::make('Services & Industries')->schema([
                        Forms\Components\Section::make('Services Section')->schema([
                            Forms\Components\TextInput::make('section_services_label')->label('Label'),
                            Forms\Components\TextInput::make('section_services_heading')->label('Heading'),
                            Forms\Components\Textarea::make('section_services_subheading')->rows(2),
                            Forms\Components\TextInput::make('section_services_tagline')->label('Side tagline'),
                            Forms\Components\TextInput::make('section_services_btn')->label('Button text'),
                        ]),
                        Forms\Components\Section::make('Industries Section')->schema([
                            Forms\Components\TextInput::make('section_industries_label')->label('Label'),
                            Forms\Components\TextInput::make('section_industries_heading')->label('Heading'),
                            Forms\Components\Textarea::make('section_industries_subheading')->rows(2),
                            Forms\Components\TextInput::make('section_industries_link')->label('Link text'),
                        ]),
                    ]),
                    Forms\Components\Tabs\Tab::make('Flagship & Demo')->schema([
                        Forms\Components\Section::make('Flagship Section')->schema([
                            Forms\Components\TextInput::make('section_flagship_label')->label('Label'),
                            Forms\Components\Textarea::make('section_flagship_subtitle')->rows(2),
                            Forms\Components\TextInput::make('section_flagship_badge')->label('Badge text'),
                            Forms\Components\Textarea::make('section_flagship_note')->rows(2)->label('Highlight note'),
                        ]),
                        Forms\Components\Section::make('Demo CTA')->schema([
                            Forms\Components\TextInput::make('section_demo_label')->label('Label'),
                            Forms\Components\TextInput::make('section_demo_heading')->label('Heading'),
                            Forms\Components\Textarea::make('section_demo_text')->rows(3),
                            Forms\Components\TextInput::make('section_demo_panel_title')->label('Right panel title')->default('What You Can Explore'),
                            Forms\Components\Repeater::make('demo_bullets')
                                ->schema([Forms\Components\TextInput::make('text')->required()])
                                ->defaultItems(3)
                                ->collapsible(),
                            Forms\Components\Repeater::make('demo_cards')
                                ->label('Demo topics (right panel grid)')
                                ->schema([
                                    Forms\Components\TextInput::make('title')->required(),
                                    Forms\Components\TextInput::make('subtitle'),
                                    Forms\Components\TextInput::make('detail')->label('Feature line'),
                                    Forms\Components\Select::make('icon')->options([
                                        'erp' => 'ERP / Education',
                                        'crm' => 'CRM',
                                        'mobile' => 'Mobile',
                                        'automation' => 'Automation',
                                    ])->default('erp'),
                                ])
                                ->columns(2)
                                ->defaultItems(4)
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                            Forms\Components\Repeater::make('demo_agenda')
                                ->label('30-min session agenda')
                                ->schema([
                                    Forms\Components\TextInput::make('time')->required()->placeholder('0–10 min'),
                                    Forms\Components\TextInput::make('step')->required(),
                                ])
                                ->columns(2)
                                ->defaultItems(3)
                                ->collapsible(),
                        ]),
                    ]),
                    Forms\Components\Tabs\Tab::make('Process & CTA')->schema([
                        Forms\Components\Section::make('Process Section')->schema([
                            Forms\Components\TextInput::make('section_process_label')->label('Label'),
                            Forms\Components\TextInput::make('section_process_heading')->label('Heading'),
                            Forms\Components\Textarea::make('section_process_subheading')->rows(2),
                            Forms\Components\Repeater::make('process_steps')
                                ->schema([
                                    Forms\Components\TextInput::make('number')->label('Step #')->maxLength(3),
                                    Forms\Components\TextInput::make('title')->required(),
                                    Forms\Components\TextInput::make('description'),
                                ])
                                ->columns(3)
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null),
                        ]),
                        Forms\Components\Section::make('Testimonials Section')->schema([
                            Forms\Components\TextInput::make('section_testimonials_label')->label('Label'),
                            Forms\Components\TextInput::make('section_testimonials_heading')->label('Heading'),
                        ]),
                        Forms\Components\Section::make('Bottom CTA')->schema([
                            Forms\Components\TextInput::make('section_cta_label')->label('Label'),
                            Forms\Components\TextInput::make('section_cta_heading')->label('Heading'),
                            Forms\Components\Textarea::make('section_cta_subheading')->rows(2),
                            Forms\Components\TextInput::make('section_cta_btn_primary')->label('Primary button'),
                            Forms\Components\TextInput::make('section_cta_btn_secondary')->label('Secondary button'),
                        ]),
                    ]),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $jsonKeys = ['demo_bullets', 'demo_cards', 'process_steps', 'demo_agenda'];

        foreach ($data as $key => $value) {
            if (in_array($key, $jsonKeys, true)) {
                SiteSetting::setJson($key, is_array($value) ? $value : []);
                continue;
            }

            SiteSetting::set($key, is_string($value) ? $value : null);
        }

        Notification::make()->title('Homepage content saved')->success()->send();
    }
}
