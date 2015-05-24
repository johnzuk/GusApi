<?php
namespace GusApi;

class AbstractFullReport
{
    protected $reportsType = [];

    /**
     * Return name of available reports types
     *
     * @return array all name of reports types
     */
    public function getAvailableReportsType()
    {
        return $this->reportsType;
    }
}