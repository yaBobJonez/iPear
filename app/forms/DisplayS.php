<?php
namespace app\forms;

use windows;
use facade\Json;
use std, gui, framework, app;

class DisplayS extends AbstractForm
{

    /**
     * @event wallset.action 
     */
    function doWallsetAction(UXEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        $data["wallpapers"] = $this->walledit->text;
        Json::toFile("data.json", $data);
    }

    /**
     * @event wallreset.action 
     */
    function doWallresetAction(UXEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        $data["wallpapers"] = "";
        Json::toFile("data.json", $data);
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        if ($data["wallpapers"] !== "") {
            $this->image->image = new UXImage($data["wallpapers"]);
        } else { $this->image->image = new UXImage("res://.data/img/OhPapers.png"); }
        if ($data["sleep"] == "off") {}
        elseif ($data["sleep"] == "space") {$this->sleephot->selectedIndex = 1; $this->sleepsel->text = $this->sleephot->selected; }
        elseif ($data["sleep"] == "enter") {$this->sleephot->selectedIndex = 2; $this->sleepsel->text = $this->sleephot->selected; }
    }

    /**
     * @event sleephot.action 
     */
    function doSleephotAction(UXEvent $e = null)
    {    
        switch ($this->sleephot->selectedIndex) {
            case 0: $val = "off"; break;
            case 1: $val = "space"; break;
            case 2: $val = "enter"; break;
            default: $val = "off"; break;
        } $data = Json::fromFile("data.json");
        $data["sleep"] = $val;
        Json::toFile("data.json", $data);
        $this->sleepsel->text = $this->sleephot->selected;
    }

}
