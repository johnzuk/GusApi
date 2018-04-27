<?php

/**
 * JsonSerializable interface. This file provides backwards compatibility to PHP 5.3 and ensures
 * the interface is present in systems where JSON related code was removed.
 *
 * @link   http://www.php.net/manual/en/jsonserializable.jsonserialize.php
 */
interface JsonSerializable
{
    /**
     * Return data which should be serialized by json_encode().
     *
     * @return mixed
     */
    public function jsonSerialize();
}
