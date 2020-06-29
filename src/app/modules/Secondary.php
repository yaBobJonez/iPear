<?php
namespace app\modules;

use std, gui, framework, app;


class Secondary extends AbstractModule
{

    /**
     * @event timer.action 
     */
    function doTimerAction(ScriptEvent $e = null)
    {    
        $this->slider->value = $this->player->position;
    }

}
