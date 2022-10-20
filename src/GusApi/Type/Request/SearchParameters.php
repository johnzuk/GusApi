<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class SearchParameters implements RequestInterface
{
    public function __construct(protected ?string $Krs, protected ?string $Krsy, protected ?string $Nip, protected ?string $Nipy, protected ?string $Regon, protected ?string $Regony14zn, protected ?string $Regony9zn)
    {
    }

    public function toArray(): array
    {
        return [
            'Krs' => $this->Krs,
            'Krsy' => $this->Krsy,
            'Nip' => $this->Nip,
            'Nipy' => $this->Nipy,
            'Regon' => $this->Regon,
            'Regony9zn' => $this->Regony9zn,
            'Regony14zn' => $this->Regony14zn,
        ];
    }
}
