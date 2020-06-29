<?php
namespace app\forms;

use facade\Json;
use windows;
use std, gui, framework, app;

class ForDevsS extends AbstractForm
{
    public $included;
    /**
     * @event preset.action 
     */
    function doPresetAction(UXEvent $e = null)
    {
        $this->consoleinput->text = file_get_contents($this->debugchooser->file);
    }

    /**
     * @event evaluate.action 
     */
    function doEvaluateAction(UXEvent $e = null)
    {    
        $code = $this->consoleinput->text;
        $code = str_replace("echo", "return", $code);
        $precode = "use facade\Json; use windows; use std, gui, framework, app; ";
        $this->output->text .= eval($precode.$code)."\n";
    }

    /**
     * @event clear.action 
     */
    function doClearAction(UXEvent $e = null)
    {    
        $this->output->text = "";
    }

}
