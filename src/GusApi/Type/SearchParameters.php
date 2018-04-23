<?php

namespace GusApi\Type;

class SearchParameters
{
    /**
     * @var string|null
     */
    protected $Krs;

    /**
     * @var string|null
     */
    protected $Krsy;

    /**
     * @var string|null
     */
    protected $Nip;

    /**
     * @var string|null
     */
    protected $Nipy;

    /**
     * @var string|null
     */
    protected $Regon;

    /**
     * @var string|null
     */
    protected $Regony14zn;

    /**
     * @var string|null
     */
    protected $Regony9zn;

    public function getKrs(): ?string
    {
        return $this->Krs;
    }

    public function setKrs(?string $Krs): self
    {
        $this->Krs = $Krs;

        return $this;
    }

    public function getKrsy(): ?string
    {
        return $this->Krsy;
    }

    public function setKrsy(?string $Krsy): self
    {
        $this->Krsy = $Krsy;

        return $this;
    }

    public function getNip(): ?string
    {
        return $this->Nip;
    }

    public function setNip(?string $Nip): self
    {
        $this->Nip = $Nip;

        return $this;
    }

    public function getNipy(): ?string
    {
        return $this->Nipy;
    }

    public function setNipy(?string $Nipy): self
    {
        $this->Nipy = $Nipy;

        return $this;
    }

    public function getRegon(): ?string
    {
        return $this->Regon;
    }

    public function setRegon(?string $Regon): self
    {
        $this->Regon = $Regon;

        return $this;
    }

    public function getRegony14zn(): ?string
    {
        return $this->Regony14zn;
    }

    public function setRegony14zn(?string $Regony14zn): self
    {
        $this->Regony14zn = $Regony14zn;

        return $this;
    }

    public function getRegony9zn(): ?string
    {
        return $this->Regony9zn;
    }

    public function setRegony9zn(?string $Regony9zn): self
    {
        $this->Regony9zn = $Regony9zn;

        return $this;
    }
}
