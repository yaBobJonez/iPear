<?php
namespace app\forms;

use std, gui, framework, app;


class Settings extends AbstractForm
{

    /**
     * @event sbnetwork.action 
     */
    function doSbnetworkAction(UXEvent $e = null)
    {    
        $this->form("WlanInfo")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event sbdisplay.action 
     */
    function doSbdisplayAction(UXEvent $e = null)
    {    
        $this->form("DisplayS")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event sbsecurity.action 
     */
    function doSbsecurityAction(UXEvent $e = null)
    {    
        $this->form("SecurityS")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event sbaccessibility.action 
     */
    function doSbaccessibilityAction(UXEvent $e = null)
    {    
        $this->form("AccessibilityS")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event sbsystem.action 
     */
    function doSbsystemAction(UXEvent $e = null)
    {    
        $this->form("SystemS")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event sbabout.action 
     */
    function doSbaboutAction(UXEvent $e = null)
    {    
        $this->form("AboutS")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

    /**
     * @event sbdevs.action 
     */
    function doSbdevsAction(UXEvent $e = null)
    {    
        $this->form("ForDevsS")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }

}
