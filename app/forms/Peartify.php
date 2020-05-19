<?php
namespace app\forms;

use std, gui, framework, app;


class Peartify extends AbstractForm
{

    /**
     * @event openbtn.action 
     */
    function doOpenbtnAction(UXEvent $e = null)
    {    
        $this->player->open($this->audiochooser->file);
    }

    /**
     * @event playbtn.action 
     */
    function doPlaybtnAction(UXEvent $e = null)
    {    
        if ($this->player->status !== 'PLAYING') {
            $this->player->position = $this->slider->value;
            $this->player->play();
            $this->timer->start();
        }
    }

    /**
     * @event pausebtn.action 
     */
    function doPausebtnAction(UXEvent $e = null)
    {    
        if ($this->player->status == 'PLAYING') {
            $this->player->pause();
            $this->timer->stop();
        }
    }

    /**
     * @event stopbtn.action 
     */
    function doStopbtnAction(UXEvent $e = null)
    {    
        $this->player->stop();
        if ($this->timer->isRunning()) $this->timer->stop();
        $this->slider->value = 0;
    }

}
