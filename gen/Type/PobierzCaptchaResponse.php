<?php

namespace GusApi\Type;

class PobierzCaptchaResponse
{

    /**
     * @var string
     */
    private $PobierzCaptchaResult;

    /**
     * @return string
     */
    public function getPobierzCaptchaResult()
    {
        return $this->PobierzCaptchaResult;
    }

    /**
     * @param string $PobierzCaptchaResult
     * @return PobierzCaptchaResponse
     */
    public function withPobierzCaptchaResult($PobierzCaptchaResult)
    {
        $new = clone $this;
        $new->PobierzCaptchaResult = $PobierzCaptchaResult;

        return $new;
    }


}

