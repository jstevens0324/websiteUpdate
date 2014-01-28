<?php

/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 1/22/14
 * Time: 11:30 AM
 */
class Db extends PDO
{
    public function __construct()
    {
        parent::__construct("mysql:host=mcallister.servers.deltasys.com;dbname=vetlogic_live", "vetlogic_live", "?yW13F{*=?");
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // always disable emulated prepared statement when using the MySQL driver
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}