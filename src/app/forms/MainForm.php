<?php
namespace app\forms;

use windows;
use facade\Json;
use std, gui, framework, app;

//Happy orthodox Easter!

class MainForm extends AbstractForm
{
    public $powered;
    /**
     * @event Power.action 
     */
    function doPowerAction(UXEvent $e = null)
    {    
        if ($this->powered == 1) {
            $this->form("Lock")->free();
            $this->form("FirstLaunch")->free();
            $this->form("MainMenu")->free();
            $this->form("WlanInfo")->free();
            $this->form("Off")->showInFragment($this->Screen); $this->powered = 0;
        } else {
            $this->form("Off")->free();
            $data = Json::fromFile("data.json");
            if ($data["active"] !== "") { $this->form("Lock")->showInFragment($this->Screen); }
            else { $this->form("FirstLaunch")->showInFragment($this->Screen); }
            $this->powered = 1;
        }
    }

    /**
     * @event HomeButton.click-Left 
     */
    function doHomeButtonClickLeft(UXMouseEvent $e = null)
    {    
        $val = $this->Screen->content->getName();
        $exemptions = ["FirstLaunch", "Lock", "MainMenu", "Off"];
        if (in_array($val, $exemptions)) unset($val);
        if (isset($val)) $this->form($val)->free();
        $this->form("MainMenu")->free();
        $this->form("MainMenu")->showInFragment($this->Screen);
    }

    /**
     * @event keyDown-Space 
     */
    function doKeyDownSpace(UXKeyEvent $e = null)
    {    
        if (Json::fromFile("data.json")["sleep"] == "space") $this->doPowerAction();
    }

    /**
     * @event keyDown-Enter 
     */
    function doKeyDownEnter(UXKeyEvent $e = null)
    {    
        if (Json::fromFile("data.json")["sleep"] == "enter") $this->doPowerAction();
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        if (!file_exists("data.json")) {
            file_put_contents("data.json", '{
              "active": "",
              "wallpapers": "",
              "sleep": "off",
              "samd": "",
              "peartifySaves": {
                "spotify": {
                }, "soundcloud": {
                }
              }, "weatherUnits":"Imperial"
            }');
        }
    }

    /**
     * @event VolumeUp.action 
     */
    function doVolumeUpAction(UXEvent $e = null)
    {    
        if (Windows::getVolumeLevel() <= 95) Windows::setVolumeLevel(Windows::getVolumeLevel() + 5);
    }

    /**
     * @event VolumeDown.action 
     */
    function doVolumeDownAction(UXEvent $e = null)
    {    
        if (Windows::getVolumeLevel() >= 5) Windows::setVolumeLevel(Windows::getVolumeLevel() - 5);
    }

    /**
     * @event BackButton.click-Left 
     */
    function doBackButtonClickLeft(UXMouseEvent $e = null)
    {    
        $val = $this->Screen->content->getName();
        switch ($val) {
            case "AboutS": $prev = "Settings"; break;
            case "AccessibilityS": $prev = "Settings"; break;
            case "DisplayS": $prev = "Settings"; break;
            case "ForDevsS": $prev = "Settings"; break;
            case "SAMD": $prev = "SecurityS"; break;
            case "SecurityS": $prev = "Settings"; break;
            case "SystemS": $prev = "Settings"; break;
            case "WlanInfo": $prev = "Settings"; break;
            default: $prev = "MainMenu"; break;
        } $this->form($val)->free();
        $this->form($prev)->free();
        $this->form($prev)->showInFragment($this->Screen);
    }


}
