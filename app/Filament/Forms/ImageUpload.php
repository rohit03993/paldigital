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
}
