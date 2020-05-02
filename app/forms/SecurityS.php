<?php
namespace app\forms;

use std, gui, framework, app;


class SecurityS extends AbstractForm
{

    /**
     * @event secbfind.action 
     */
    function doSecbfindAction(UXEvent $e = null)
    {    
        $ipdata = file_get_contents("http://ip-api.com/json/?fields=countryCode,city,query");
        $this->devicelocation->text = $ipdata["city"].", ".$ipdata["countryCode"]." @ ".$ipdata["query"];
    }

    /**
     * @event secbdatacheck.action 
     */
    function doSecbdatacheckAction(UXEvent $e = null)
    {    
        $this->form("SAMD")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

}
