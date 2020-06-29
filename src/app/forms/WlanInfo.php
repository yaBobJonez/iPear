<?php
namespace app\forms;

use windows;
use std, gui, framework, app;


class WlanInfo extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $foundarr = Wlan::getMainInterface()->getNetworks();
        $this->networks->items->clear();
        foreach ($foundarr as $found) {
            $temp = [];
            $temp["SSID"] = $found["SSID"];
            $temp["Signal"] = $found["Signal"];
            $temp["Authentication"] = $found["Authentication"];
            $temp["BSSID"] = $found["BSSID"];
            $this->networks->items->add($temp);
        } $connected = Wlan::getMainInterface();
        $this->currlist->items->clear();
        $this->currlist->items->add("Name: ".$connected->getName());
        $this->currlist->items->add("Desc: ".$connected->getDescription());
        $this->currlist->items->add("MAC: ".$connected->getMac());
        $this->currlist->items->add("Prof: ".$connected->getProfile());
        $this->currlist->items->add("Pass: ".$connected->getPassword());
        $this->currlist->items->add("State: ".$connected->getState());
    }

    /**
     * @event cnt.action 
     */
    function doCntAction(UXEvent $e = null)
    {    
        $sel = $this->networks->selectedItem;
        $pass = $this->password->text;
        $res = Wlan::getMainInterface()->connect($sel["SSID"], $pass);
        if ($res) { $this->doShow(); $this->form("MainForm")->toast("Connected successfully!", 5000); }
        else { $this->form("MainForm")->toast("Couldn't connect to the network! Try again.", 5000); }
    }

    /**
     * @event discnt.action 
     */
    function doDiscntAction(UXEvent $e = null)
    {    
        Wlan::getMainInterface()->disconnect();
    }

    /**
     * @event recnt.action 
     */
    function doRecntAction(UXEvent $e = null)
    {    
        Wlan::getMainInterface()->reconnect();
    }

    /**
     * @event refr.action 
     */
    function doRefrAction(UXEvent $e = null)
    {    
        $this->doShow();
    }

}
