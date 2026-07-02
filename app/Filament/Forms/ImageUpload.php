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
            ->imageEditorMode(3)
            ->imageEditorAspectRatios([
                '3:1',
                '16:9',
                '4:1',
                '1:1',
                null,
            ])
            ->imageEditorEmptyFillColor('#000000')
            ->helperText('Upload → click the image → drag the crop box to select what shows in the header → confirm → Save.');
    }
}
