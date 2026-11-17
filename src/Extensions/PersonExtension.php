<?php

namespace Xefi\Faker\PtPt\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
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

    protected $firstNameMale = [
        'João', 'José', 'António', 'Francisco', 'Manuel', 'Rodrigo', 'Martim', 'Santiago', 'Tomás', 'Afonso',
        'Duarte', 'Miguel', 'Gonçalo', 'Diogo', 'Pedro', 'Rafael', 'Tiago', 'Guilherme', 'Gabriel', 'Lourenço',
        'Salvador', 'Simão', 'Henrique', 'Bernardo', 'Vasco', 'Rui', 'Nuno', 'Paulo', 'Luís', 'Carlos',
        'Jorge', 'Fernando', 'Ricardo', 'Hugo', 'Bruno', 'Sérgio', 'Vítor', 'Joaquim', 'Mário', 'Fábio',
    ];

    protected $firstNameFemale = [
        'Maria', 'Ana', 'Leonor', 'Matilde', 'Beatriz', 'Carolina', 'Mariana', 'Inês', 'Margarida', 'Francisca',
        'Alice', 'Benedita', 'Constança', 'Madalena', 'Clara', 'Sofia', 'Lara', 'Íris', 'Joana', 'Rita',
        'Catarina', 'Teresa', 'Isabel', 'Helena', 'Filipa', 'Sara', 'Marta', 'Patrícia', 'Cláudia', 'Sónia',
        'Susana', 'Vera', 'Fátima', 'Rosa', 'Conceição', 'Graça', 'Luísa', 'Raquel', 'Daniela', 'Andreia',
    ];

    protected $lastName = [
        'Silva', 'Santos', 'Ferreira', 'Pereira', 'Oliveira', 'Costa', 'Rodrigues', 'Martins', 'Jesus', 'Sousa',
        'Fernandes', 'Gonçalves', 'Gomes', 'Lopes', 'Marques', 'Alves', 'Almeida', 'Ribeiro', 'Pinto', 'Carvalho',
        'Teixeira', 'Moreira', 'Correia', 'Mendes', 'Nunes', 'Soares', 'Vieira', 'Monteiro', 'Cardoso', 'Rocha',
        'Raposo', 'Neves', 'Coelho', 'Cruz', 'Cunha', 'Pires', 'Ramos', 'Reis', 'Simões', 'Antunes',
    ];

    protected $titleMale = ['Sr.', 'Dr.', 'Eng.', 'Prof.'];

    protected $titleFemale = ['Sra.', 'Dra.', 'Eng.ª', 'Prof.ª'];

    /**
     * Generate a personal NIF (Número de Identificação Fiscal) with a valid check digit.
     *
     * @return string
     */
    public function personalNif(): string
    {
        $digits = sprintf('%d%07d', $this->randomizer->getInt(1, 3), $this->randomizer->getInt(0, 9999999));

        return $digits.$this->nifCheckDigit($digits);
    }

    /**
     * Generate a Cartão de Cidadão document number (civil ID, its check digit, version and final check digit).
     *
     * @param bool $formatted Whether to return the number as 00000000 0 ZZ0
     *
     * @return string
     */
    public function cartaoCidadao(bool $formatted = true): string
    {
        $civilNumber = sprintf('%08d', $this->randomizer->getInt(1000000, 39999999));
        $civilCheckDigit = $this->civilNumberCheckDigit($civilNumber);
        $version = 'Z'.$this->pickArrayRandomElement(['Z', 'Y', 'X', 'W']);

        $document = $civilNumber.$civilCheckDigit.$version;
        $document .= $this->cartaoCidadaoCheckDigit($document);

        if (!$formatted) {
            return $document;
        }

        return sprintf('%s %s %s', substr($document, 0, 8), substr($document, 8, 1), substr($document, 9, 3));
    }

    /**
     * Compute the NIF check digit (mod 11) of the first eight digits.
     *
     * @param string $digits
     *
     * @return int
     */
    private function nifCheckDigit(string $digits): int
    {
        $sum = 0;

        for ($i = 0; $i < 8; $i++) {
            $sum += (int) $digits[$i] * (9 - $i);
        }

        $remainder = $sum % 11;

        return $remainder < 2 ? 0 : 11 - $remainder;
    }

    /**
     * Compute the check digit (mod 11) of an eight-digit civil identification number.
     *
     * @param string $civilNumber
     *
     * @return int
     */
    private function civilNumberCheckDigit(string $civilNumber): int
    {
        $sum = 0;

        for ($i = 0; $i < 8; $i++) {
            $sum += (int) $civilNumber[$i] * (9 - $i);
        }

        return (11 - $sum % 11) % 11 % 10;
    }

    /**
     * Compute the final Cartão de Cidadão check digit (Luhn over base-36 character values).
     *
     * @param string $document The eleven first characters of the document number
     *
     * @return int
     */
    private function cartaoCidadaoCheckDigit(string $document): int
    {
        $sum = 0;
        $double = true;

        for ($i = strlen($document) - 1; $i >= 0; $i--) {
            $value = (int) base_convert($document[$i], 36, 10);

            if ($double) {
                $value *= 2;
                $value = $value > 9 ? $value - 9 : $value;
            }

            $sum += $value;
            $double = !$double;
        }

        return (10 - $sum % 10) % 10;
    }
}
