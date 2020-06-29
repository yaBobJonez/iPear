<?php
namespace app\forms;

use facade\Json;
use windows;
use std, gui, framework, app;


class AboutS extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $rdata = Json::decode(file_get_contents("res://sysconfig.pearjd"));
        $this->label4->text = "OS: ".$rdata["OSVersion"];
        $this->label5->text = "Last update: ".$rdata["AppUpdated"];
        $this->label6->text = "JVM version: ".System::getProperty("java.version");
    }

}
