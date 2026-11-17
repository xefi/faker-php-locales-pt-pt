<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Calculators\Iban;
use Xefi\Faker\Extensions\FinancialExtension as BaseFinancialExtension;

class FinancialExtension extends BaseFinancialExtension
{
    /**
     * Returns the locale of the extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'pt_PT';
    }

    /**
     * Generate a NIB (Número de Identificação Bancária): bank, branch, account and two check digits.
     *
     * @return string
     */
    public function nib(): string
    {
        $bank = $this->pickArrayRandomElement(['0007', '0010', '0018', '0023', '0033', '0035', '0036', '0045', '0079', '0193', '0269']);
        $number = $bank.$this->randomizer->getBytesFromString('0123456789', 15);

        return sprintf('%s%02d', $number, 98 - Iban::mod97($number.'00'));
    }

    /**
     * Generate a Portuguese IBAN built around a valid NIB.
     *
     * @param ?string $countryCode
     * @param ?string $format      [{d} => digit, {l} => letter, {a} => any]
     *
     * @return string
     */
    public function iban(?string $countryCode = null, ?string $format = null): string
    {
        if ($countryCode === null) {
            $countryCode = 'PT';
        }

        if ($format === null) {
            $format = $this->nib();
        }

        return parent::iban($countryCode, $format);
    }
}
