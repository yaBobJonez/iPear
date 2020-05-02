<?php
namespace app\forms;

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
        $val = "Hmm";
        if ($this->Screen->content == $this->form("WlanInfo")) $val = "WlanInfo";
        elseif ($this->Screen->content == $this->form("Settings")) $val = "Settings";
        elseif ($this->Screen->content == $this->form("DisplayS")) $val = "DisplayS";
        elseif ($this->Screen->content == $this->form("SecurityS")) $val = "SecurityS";
        elseif ($this->Screen->content == $this->form("SAMD")) $val = "SAMD";
        elseif ($this->Screen->content == $this->form("AccessibilityS")) $val = "AccessibilityS";
        elseif ($this->Screen->content == $this->form("SystemS")) $val = "SystemS";
        elseif ($this->Screen->content == $this->form("AboutS")) $val = "AboutS";
        elseif ($this->Screen->content == $this->form("ForDevsS")) $val = "ForDevsS";
        elseif ($this->Screen->content == $this->form("Calculator")) $val = "Calculator";
        elseif ($this->Screen->content == $this->form("Browser")) $val = "Browser";
        elseif ($this->Screen->content == $this->form("Phone")) $val = "Phone";
        else $this->toast("Whatcha tryna do, bruh?");
        $this->form($val)->free(); $this->form("MainMenu")->free();
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
            file_put_contents("data.json", "{
              \"active\": \"\",
              \"wallpapers\": \"\",
              \"sleep\": \"off\",
              \"samd\": \"\"
            }");
        }
    }


}