<?php

namespace GusApi\Type;

class SprawdzCaptcha
{

    /**
     * @var string
     */
    private $pCaptcha;

    /**
     * @return string
     */
    public function getPCaptcha()
    {
        return $this->pCaptcha;
    }

    /**
     * @param string $pCaptcha
     * @return SprawdzCaptcha
     */
    public function withPCaptcha($pCaptcha)
    {
        $new = clone $this;
        $new->pCaptcha = $pCaptcha;

        return $new;
    }


}

