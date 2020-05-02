<?php
namespace app\forms;

use std, gui, framework, app;


class ForDevsS extends AbstractForm
{

    /**
     * @event runtime.globalKeyDown-Up 
     */
    function doRuntimeGlobalKeyDownUp(UXEvent $e = null)
    {
        //$this->consoleout->text = file_get_contents("php://stdout");
    }

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
        $code = str_replace("echo ","return ",$this->consoleinput->text);
        $this->output->text .= eval($code)."\n";
    }

    /**
     * @event clear.action 
     */
    function doClearAction(UXEvent $e = null)
    {    
        $this->output->text = "";
    }

}
