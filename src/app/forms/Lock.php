<?php
namespace app\forms;

use std, gui, framework, app;


class Lock extends AbstractForm
{

    /**
     * @event Slider.mouseUp-Left 
     */
    function doSliderMouseUpLeft(UXMouseEvent $e = null)
    {    
        if ($this->Slider->value == 100) $this->form("MainMenu")->showInFragment($this->form("MainForm")->Screen);
        else $this->Slider->value = 0;
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->lldate->text = (Time::now())->toString("MMMM d, yyyy");
        $this->timerAlt->start();
    }


}
