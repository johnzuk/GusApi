<?php
namespace GusApi;

class ActionReport
{
    private $code;
    private $name;
    private $type;

    public function __construct($report)
    {
        $this->code = $report->praw_pkdKod;
        $this->name = $report->praw_pkdNazwa;
        $this->type = $report->praw_pkdPrzewazajace;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}