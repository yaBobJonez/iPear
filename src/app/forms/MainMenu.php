<?php
namespace app\forms;

use facade\Json;
use windows;
use std, gui, framework, app;


class MainMenu extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        $this->timer->start();
        /*if (Lan::getActiveAdapter()->isNetworkEnabled()) {
            $this->wifi->text = Lan::getActiveAdapter()->getName()." (LAN)";
        } else {*/
            if (Wlan::getMainInterface()->getState() !== "disconnected") {
                $this->wifi->text = Wlan::getMainInterface()->getProfile()." (WLAN)";
            } else { $this->wifi->text = "No WLAN connection"; }
        //}
        if ($data["wallpapers"] !== "") {
            $this->image->image = new UXImage($data["wallpapers"]);
        }
    }


    /**
     * @event wifi.click-Left 
     */
    function doWifiClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("WlanInfo")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AISettings.click-Left 
     */
    function doAISettingsClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("Settings")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AICalc.click-Left 
     */
    function doAICalcClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("Calculator")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AIBrowser.click-Left 
     */
    function doAIBrowserClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("Browser")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AIPhone.click-Left 
     */
    function doAIPhoneClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("Phone")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AIPeartify.click-Left 
     */
    function doAIPeartifyClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("Peartify")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AITranslator.click-Left 
     */
    function doAITranslatorClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("TranslatePear")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AIChat.click-Left 
     */
    function doAIChatClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("Chattenger")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AIMaps.click-Left 
     */
    function doAIMapsClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("PearMaps")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event AIWeather.click-Left 
     */
    function doAIWeatherClickLeft(UXMouseEvent $e = null)
    {    
        $this->form("yaWeather")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }
    
}
