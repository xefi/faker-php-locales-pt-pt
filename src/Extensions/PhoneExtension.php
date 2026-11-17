<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Extensions\PhoneExtension as BasePhoneExtension;

class PhoneExtension extends BasePhoneExtension
{
    public string $indicator = '+351';

    /**
     * Returns the locale of the extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'pt_PT';
    }

    protected array $landlineFormats = [
        '21{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '22{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '23{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '24{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '25{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '26{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '28{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '29{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
    ];

    protected array $cellFormats = [
        '91{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '92{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '93{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
        '96{d}{separator}{d}{d}{d}{separator}{d}{d}{d}',
    ];
}
