<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageInnerPages extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Inner Pages';
    protected static ?string $title = 'Inner Page Headings & Text';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $keys = [
            'inner_services_label', 'inner_services_heading', 'inner_services_subheading', 'inner_services_cta',
            'inner_contact_label', 'inner_contact_heading', 'inner_contact_subheading',
            'inner_portfolio_label', 'inner_portfolio_heading', 'inner_portfolio_subheading', 'inner_portfolio_empty',
            'inner_industries_label', 'inner_industries_heading', 'inner_industries_subheading',
            'inner_solutions_label', 'inner_solutions_heading', 'inner_solutions_subheading',
            'inner_case_studies_label', 'inner_case_studies_heading', 'inner_case_studies_subheading', 'inner_case_studies_empty',
            'inner_blog_label', 'inner_blog_heading', 'inner_blog_subheading', 'inner_blog_empty',
        ];

        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = SiteSetting::get($key);
        }

        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Inner Pages')->tabs([
                    self::pageTab('Services', 'services', true),
                    self::pageTab('Contact', 'contact'),
                    self::pageTab('Portfolio', 'portfolio', false, true),
                    self::pageTab('Industries', 'industries'),
                    self::pageTab('Solutions', 'solutions'),
                    self::pageTab('Case Studies', 'case_studies', false, true),
                    self::pageTab('Blog', 'blog', false, true),
                ]),
            ])
            ->statePath('data');
    }

    private static function pageTab(string $title, string $slug, bool $withCta = false, bool $withEmpty = false): Forms\Components\Tabs\Tab
    {
        $fields = [
            Forms\Components\TextInput::make("inner_{$slug}_label")->label('Section label (small text above heading)'),
            Forms\Components\TextInput::make("inner_{$slug}_heading")->label('Page heading (H1)')->required(),
            Forms\Components\Textarea::make("inner_{$slug}_subheading")->label('Intro paragraph')->rows(3),
        ];

        if ($withCta) {
            $fields[] = Forms\Components\TextInput::make("inner_{$slug}_cta")->label('Bottom button text');
        }

        if ($withEmpty) {
            $fields[] = Forms\Components\TextInput::make("inner_{$slug}_empty")->label('Empty state message (when no items)');
        }

        return Forms\Components\Tabs\Tab::make($title)->schema([
            Forms\Components\Section::make($title . ' page')->schema($fields),
        ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            SiteSetting::set($key, is_string($value) ? $value : null);
        }

        Notification::make()->title('Inner page content saved')->success()->send();
    }
}
