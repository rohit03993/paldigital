<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\FileUpload;

class ImageUpload
{
    public static function make(string $name, string $directory, bool $avatar = false): FileUpload
    {
        $field = FileUpload::make($name)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->imageEditor()
            ->imageEditorMode(1)
            ->imageEditorAspectRatios([
                null,
                '16:9',
                '4:3',
                '1:1',
            ])
            ->helperText('Upload an image — click to crop before saving.');

        if ($avatar) {
            $field->avatar()->imageEditorAspectRatios(['1:1']);
        }

        return $field;
    }

    public static function headerLogo(string $name, string $directory): FileUpload
    {
        return FileUpload::make($name)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->imageEditor()
            ->imageEditorMode(1)
            ->imageEditorViewportWidth(1200)
            ->imageEditorViewportHeight(400)
            ->imageEditorAspectRatios([
                '3:1',
                '16:9',
                '4:1',
                '1:1',
                null,
            ])
            ->imageEditorEmptyFillColor('#000000')
            ->helperText('Upload → click image → use zoom out (−) to see full image → drag crop → Save.');
    }

    public static function favicon(string $name, string $directory): FileUpload
    {
        return FileUpload::make($name)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->avatar()
            ->imageEditor()
            ->imageEditorMode(1)
            ->imageEditorViewportWidth(512)
            ->imageEditorViewportHeight(512)
            ->imageEditorAspectRatios(['1:1'])
            ->imageEditorEmptyFillColor('#000000')
            ->helperText('Crop tight around the PD icon only (zoom out first). Saved as a round favicon with transparent background.');
    }
}
