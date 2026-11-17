<?php

namespace Xefi\Faker\PtPt;

use Xefi\Faker\PtPt\Extensions\AddressExtension;
use Xefi\Faker\PtPt\Extensions\ColorsExtension;
use Xefi\Faker\PtPt\Extensions\CompanyExtension;
use Xefi\Faker\PtPt\Extensions\FinancialExtension;
use Xefi\Faker\PtPt\Extensions\PersonExtension;
use Xefi\Faker\PtPt\Extensions\PhoneExtension;
use Xefi\Faker\PtPt\Extensions\TextExtension;
use Xefi\Faker\Providers\Provider;

class FakerPtPtServiceProvider extends Provider
{
    /**
     * Register the pt_PT extensions.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->extensions([
            AddressExtension::class,
            ColorsExtension::class,
            CompanyExtension::class,
            FinancialExtension::class,
            PersonExtension::class,
            PhoneExtension::class,
            TextExtension::class,
        ]);
    }
}
