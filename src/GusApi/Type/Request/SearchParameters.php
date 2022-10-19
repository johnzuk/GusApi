<?php

declare(strict_types=1);

namespace GusApi\Type\Request;

class SearchParameters implements RequestInterface
{
    protected ?string $Krs = null;
    protected ?string $Krsy = null;
    protected ?string $Nip = null;
    protected ?string $Nipy = null;
    protected ?string $Regon = null;
    protected ?string $Regony14zn = null;
    protected ?string $Regony9zn = null;

    public function __construct(
        ?string $Krs,
        ?string $Krsy,
        ?string $Nip,
        ?string $Nipy,
        ?string $Regon,
        ?string $Regony14zn,
        ?string $Regony9zn
    ) {
        $this->Krs = $Krs;
        $this->Krsy = $Krsy;
        $this->Nip = $Nip;
        $this->Nipy = $Nipy;
        $this->Regon = $Regon;
        $this->Regony14zn = $Regony14zn;
        $this->Regony9zn = $Regony9zn;
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
