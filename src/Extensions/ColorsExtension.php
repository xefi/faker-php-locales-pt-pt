<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Extensions\ColorsExtension as BaseColorsExtension;

class ColorsExtension extends BaseColorsExtension
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

    protected array $safeColorNames = [
        'Preto', 'Grená', 'Verde', 'AzulMarinho', 'Azeitona',
        'Roxo', 'VerdeAzulado', 'Lima', 'Azul', 'Prateado',
        'Cinzento', 'Amarelo', 'Fúcsia', 'Água', 'Branco',
    ];

    protected array $colorNames = [
        'Preto', 'Grená', 'Verde', 'AzulMarinho', 'Azeitona',
        'Roxo', 'VerdeAzulado', 'Lima', 'Azul', 'Prateado',
        'Cinzento', 'Amarelo', 'Fúcsia', 'Água', 'Branco',
        'Bege', 'Chocolate', 'Coral', 'Ciano', 'Carmim',
        'AzulEscuro', 'LaranjaEscuro', 'Tijolo', 'VerdeMar', 'BrancoFloral',
        'VerdeFloresta', 'Dourado', 'CorDeRosa', 'Índigo', 'Caqui',
        'Lavanda', 'AzulClaro', 'CoralClaro', 'VerdeClaro', 'SalmãoClaro',
        'Linho', 'Magenta', 'AzulMédio', 'OrquídeaMédia', 'Mocassim',
        'Laranja', 'Vermelho', 'Ameixa', 'Peru', 'AzulReal',
        'Salmão', 'CastanhoAreia', 'AzulCéu', 'Neve', 'Turquesa',
        'Violeta', 'BrancoFumo',
    ];
}
