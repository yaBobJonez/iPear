<?php
namespace app\forms;

use std, gui, framework, app;


class PearMaps extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->browser->engine->userAgent = "Mozilla/5.0 (Linux; U; Android 4.4.2; en-us; SCH-I535 Build/KOT49H) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30";
        $this->browser->url = "https://openstreetmap.org/";
    }

}
