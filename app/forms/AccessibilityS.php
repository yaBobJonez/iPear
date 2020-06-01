<?php
namespace app\forms;

use windows;
use std, gui, framework, app;


class AccessibilityS extends AbstractForm
{

    /**
     * @event accbstartup.click-Left 
     */
    function doAccbstartupClickLeft(UXMouseEvent $e = null)
    {    
        /*if ($this->accbstartup->selected) {
            if (!Startup::isExists("./iPear.exe")) { Startup::add("./iPear.exe"); $this->toast("Added to startup!","5000"); }
        } else {
            if (Startup::isExists("./iPear.exe")) { Startup::find("./iPear.exe")->delete(); $this->toast("Removed from startup!", "5000"); }
        }*/
        $this->form("MainForm")->toast("We're sorry but this option is not available.\nReason: Internal library error.", 7000);
    }

    /**
     * @event accbblind.click-Left 
     */
    function doAccbblindClickLeft(UXMouseEvent $e = null)
    {    
        if ($this->accbblind->selected) { $this->panel->backgroundColor = UXColor::of("#000000"); } else { $this->panel->backgroundColor = UXColor::of("#FFFFFF"); }
    }

    /**
     * @event accbcaptions.click-Left 
     */
    function doAccbcaptionsClickLeft(UXMouseEvent $e = null)
    {    
        if ($this->accbcaptions->selected) $this->form("MainForm")->toast("There are no sounds, do you really need it?", "5000");
    }




    /**
     * @event accbread.action 
     */
    function doAccbreadAction(UXEvent $e = null)
    {    
        Windows::speak($this->edit->text);
    }

    /**
     * @event browser.globalKeyDown-Left 
     */
    function doBrowserGlobalKeyDownLeft(UXKeyEvent $e = null)
    {    
        $this->browser->engine->history->goBack();
    }

    /**
     * @event browser.globalKeyDown-Right 
     */
    function doBrowserGlobalKeyDownRight(UXKeyEvent $e = null)
    {    
        $this->browser->engine->history->goForward();
    }

    /**
     * @event browser.globalKeyDown-Up 
     */
    function doBrowserGlobalKeyDownUp(UXKeyEvent $e = null)
    {    
        $this->browser->engine->load("https://google.com");
    }

    /**
     * @event showing 
     */
    function doShowing(UXWindowEvent $e = null)
    {    
        $this->browser->engine->userAgent = "Mozilla/5.0 (Android 7.0; Mobile; rv:54.0) Gecko/54.0 Firefox/54.0";
    }

}
