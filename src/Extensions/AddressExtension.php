<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
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

    protected $regions = [
        'Norte', 'Centro', 'Oeste e Vale do Tejo', 'Grande Lisboa', 'Península de Setúbal', 'Alentejo', 'Algarve',
        'Região Autónoma dos Açores', 'Região Autónoma da Madeira',
    ];

    protected $districts = [
        'Aveiro', 'Beja', 'Braga', 'Bragança', 'Castelo Branco', 'Coimbra', 'Évora', 'Faro', 'Guarda', 'Leiria',
        'Lisboa', 'Portalegre', 'Porto', 'Santarém', 'Setúbal', 'Viana do Castelo', 'Vila Real', 'Viseu',
    ];

    protected $cities = [
        'Lisboa', 'Porto', 'Vila Nova de Gaia', 'Amadora', 'Braga', 'Funchal', 'Coimbra', 'Setúbal', 'Almada', 'Agualva-Cacém',
        'Queluz', 'Rio Tinto', 'Barreiro', 'Aveiro', 'Viseu', 'Odivelas', 'Leiria', 'Guimarães', 'Faro', 'Évora',
        'Matosinhos', 'Póvoa de Varzim', 'Viana do Castelo', 'Ponta Delgada', 'Covilhã', 'Santarém', 'Castelo Branco',
        'Portimão', 'Vila Real', 'Bragança',
    ];

    protected $streetTypes = [
        'Rua', 'Avenida', 'Travessa', 'Largo', 'Praça', 'Calçada', 'Estrada', 'Alameda', 'Beco', 'Rotunda',
    ];

    protected $streetNames = [
        'da Liberdade', 'Augusta', 'de Santa Catarina', 'dos Aliados', '25 de Abril', '5 de Outubro', 'da República',
        'Almirante Reis', 'do Comércio', 'Luís de Camões', 'Infante Dom Henrique', 'Marquês de Pombal', 'Dom João II',
        'da Boavista', 'Fernão de Magalhães', 'Vasco da Gama', 'Miguel Bombarda', 'Sá da Bandeira', 'Gago Coutinho',
        'Combatentes da Grande Guerra', 'Alexandre Herculano', 'Almeida Garrett', 'Eça de Queirós', 'Fernando Pessoa',
        'Dom Afonso Henriques', 'Dom Dinis', 'Cidade de Coimbra', 'do Carmo', 'das Flores', 'da Junqueira', 'de Ceuta',
        'Mouzinho da Silveira', 'Elias Garcia', 'Rainha Dona Leonor', 'dos Bombeiros Voluntários', 'Heróis do Ultramar',
    ];

    /**
     * Generate a Portuguese NUTS II region.
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Generate a mainland Portuguese district.
     *
     * @return string
     */
    public function district(): string
    {
        return $this->pickArrayRandomElement($this->districts);
    }

    /**
     * Generate a Portuguese city name.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomElement($this->cities);
    }

    /**
     * Generate a código postal in the 0000-000 format.
     *
     * @return string
     */
    public function postcode(): string
    {
        return sprintf('%04d-%03d', $this->randomizer->getInt(1000, 9999), $this->randomizer->getInt(0, 999));
    }

    /**
     * Generate a house number.
     *
     * @return int
     */
    public function houseNumber(): int
    {
        return $this->randomizer->getInt(1, 500);
    }

    /**
     * Generate a street name prefixed by its street type.
     *
     * @return string
     */
    public function streetName(): string
    {
        return sprintf('%s %s', $this->pickArrayRandomElement($this->streetTypes), $this->pickArrayRandomElement($this->streetNames));
    }

    /**
     * Generate a street address, such as "Rua Augusta, 125".
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s, %d', $this->streetName(), $this->houseNumber());
    }

    /**
     * Generate a full address, such as "Rua Augusta, 125, 1100-053 Lisboa".
     *
     * @return string
     */
    public function fullAddress(): string
    {
        return sprintf('%s, %s %s', $this->streetAddress(), $this->postcode(), $this->city());
    }
}
