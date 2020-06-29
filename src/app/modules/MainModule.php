<?php
namespace app\modules;

use windows;
use std, gui, framework, app;


class MainModule extends AbstractModule
{

    /**
     * @event timer.action 
     */
    function doTimerAction(ScriptEvent $e = null)
    {    
        $time = Time::now();
        $this->time->text = $time->toString("hh:mm a");
    }

    /**
     * @event timerAlt.action 
     */
    function doTimerAltAction(ScriptEvent $e = null)
    {    
        $time = Time::now();
        $this->lltime->text = $time->toString("hh:mm a");
    }

}
