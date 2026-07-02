<?php

namespace App\Filament\Pages;

use App\Filament\Forms\ImageUpload;
use App\Models\SiteSetting;
use App\Support\FaviconProcessor;
use App\Support\UploadPath;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Site Settings';
    protected static ?string $title = 'Website Content Management';
    protected static string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $keys = [
            'site_name', 'tagline', 'hero_heading', 'hero_subheading', 'hero_message',
            'contact_email', 'contact_phone', 'whatsapp', 'whatsapp_message', 'address',
            'site_url', 'site_logo', 'site_favicon', 'seo_default_og_image',
        ];

        $settings = [];
        foreach ($keys as $key) {
            $value = SiteSetting::get($key);
            if (in_array($key, ['site_logo', 'site_favicon', 'seo_default_og_image']) && $value) {
                $settings[$key] = [$value];
            } else {
                $settings[$key] = $value;
            }
        }

        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Brand & Logo')->schema([
                    ImageUpload::headerLogo('site_logo', 'site')
                        ->label('Header logo'),
                    ImageUpload::favicon('site_favicon', 'site')
                        ->label('Favicon'),
                ])->columns(2),
                Forms\Components\Section::make('SEO Defaults')->schema([
                    Forms\Components\TextInput::make('site_url')
                        ->label('Public site URL')
                        ->url()
                        ->placeholder(config('app.url'))
                        ->helperText('Used for canonical URLs, sitemap, and social sharing.'),
                    ImageUpload::make('seo_default_og_image', 'seo')
                        ->label('Default social share image')
                        ->helperText('Fallback OG image when a page has no custom image (1200×630 recommended).'),
                ]),
                Forms\Components\Section::make('General')->schema([
                    Forms\Components\TextInput::make('site_name'),
                    Forms\Components\TextInput::make('tagline'),
                ]),
                Forms\Components\Section::make('Hero Section')->schema([
                    Forms\Components\TextInput::make('hero_heading'),
                    Forms\Components\Textarea::make('hero_subheading')->rows(3),
                    Forms\Components\Textarea::make('hero_message')->rows(2),
                ]),
                Forms\Components\Section::make('Contact & WhatsApp')->schema([
                    Forms\Components\TextInput::make('contact_email')->email(),
                    Forms\Components\TextInput::make('contact_phone'),
                    Forms\Components\TextInput::make('whatsapp')
                        ->helperText('Include country code, e.g. 919876543210'),
                    Forms\Components\Textarea::make('whatsapp_message')
                        ->rows(2)
                        ->default('Hi Pal Digital, I would like to know more about your software solutions.')
                        ->helperText('Pre-filled message when users click WhatsApp button'),
                    Forms\Components\TextInput::make('address'),
                ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            if (in_array($key, ['site_logo', 'site_favicon', 'seo_default_og_image'], true)) {
                if (UploadPath::isExplicitlyRemoved($value)) {
                    SiteSetting::set($key, null);
                } else {
                    $path = UploadPath::fromFilamentState($value);
                    if ($path !== null) {
                        if ($key === 'site_favicon') {
                            $processed = FaviconProcessor::applyCircleMask($path);
                            SiteSetting::set($key, $processed);
                        } else {
                            SiteSetting::set($key, $path);
                        }
                    }
                }
                continue;
            }

            if (is_array($value)) {
                $value = UploadPath::fromFilamentState($value);
            }

            SiteSetting::set($key, is_string($value) ? $value : null);
        }

        Notification::make()->title('Settings saved')->success()->send();
    }
}
