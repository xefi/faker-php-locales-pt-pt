<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
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

    private array $companies = [
        'Ferreira & Filhos, Lda.', 'Tejo Tecnologias, S.A.', 'Construções Monteiro, Lda.',
        'Douro Vinhos e Azeites, Lda.', 'Atlântico Logística, S.A.', 'Serra da Estrela Queijaria, Lda.',
        'Alfama Design, Unipessoal Lda.', 'Ribeiro & Associados, Sociedade de Advogados', 'Minho Têxteis, S.A.',
        'Algarve Sol Turismo, Lda.', 'Cortiça Lusitana, S.A.', 'Mondego Engenharia, Lda.',
        'Azulejos do Norte, Lda.', 'Barcelos Cerâmicas, Lda.', 'Navegador Seguros, S.A.',
        'Marquês Imobiliária, Lda.', 'Saudade Digital, Unipessoal Lda.', 'Alentejo Agrícola, S.A.',
        'Pastelaria Belém Doces, Lda.', 'Ponte Vasco Transportes, Lda.', 'Ria Formosa Pescas, Lda.',
        'Bairro Alto Comunicação, Lda.', 'Pinhal Madeiras, S.A.', 'Costa Verde Farmacêutica, S.A.',
        'Sintra Sistemas, Lda.', 'Caravela Energia, S.A.', 'Gonçalves & Cunha, Lda.',
        'Açores Lacticínios, S.A.', 'Madeira Bordados, Lda.', 'Ribatejo Metalomecânica, Lda.',
    ];

    /**
     * Generate a company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Generate a company NIF (NIPC, Número de Identificação de Pessoa Coletiva) with a valid check digit.
     *
     * @return string
     */
    public function nif(): string
    {
        $digits = sprintf('%d%07d', $this->pickArrayRandomElement([5, 6, 9]), $this->randomizer->getInt(0, 9999999));

        $sum = 0;
        for ($i = 0; $i < 8; $i++) {
            $sum += (int) $digits[$i] * (9 - $i);
        }

        $remainder = $sum % 11;

        return $digits.($remainder < 2 ? 0 : 11 - $remainder);
    }

    /**
     * Generate an intra-community VAT number (PT followed by the company NIF).
     *
     * @return string
     */
    public function vat(): string
    {
        return 'PT'.$this->nif();
    }
}
