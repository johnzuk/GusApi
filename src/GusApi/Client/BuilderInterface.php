<?php

namespace GusApi\Client;

interface BuilderInterface
{
    /**
     * @return GusApiClient
     */
    public function build(): GusApiClient;
}
