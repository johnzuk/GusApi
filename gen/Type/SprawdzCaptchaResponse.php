<?php

namespace GusApi\Type;

class SprawdzCaptchaResponse
{

    /**
     * @var bool
     */
    private $SprawdzCaptchaResult;

    /**
     * @return bool
     */
    public function getSprawdzCaptchaResult()
    {
        return $this->SprawdzCaptchaResult;
    }

    /**
     * @param bool $SprawdzCaptchaResult
     * @return SprawdzCaptchaResponse
     */
    public function withSprawdzCaptchaResult($SprawdzCaptchaResult)
    {
        $new = clone $this;
        $new->SprawdzCaptchaResult = $SprawdzCaptchaResult;

        return $new;
    }


}

