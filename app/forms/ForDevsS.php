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
        if (substr($code, 0, 4) == "SYS_") {
            $explcode = explode(" ", $code);
            $this->output->text .= call_user_func([$this, $explcode[0]], $explcode[1])."\n";
        } else {
            if (is_array($this->included)) foreach ($this->included as $item) $precode .= "use ".$item."; ";
            $this->output->text .= eval($precode.$code)."\n";
        }
    }

    /**
     * @event clear.action 
     */
    function doClearAction(UXEvent $e = null)
    {    
        $this->output->text = "";
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        if (isset($data["forDevIncl"])) $this->included = $data["forDevIncl"];
    }

    function SYS_include($class){
        if (in_array($class, $this->included) == false) { $this->included[] = $class; return "Included $class successfully."; }
        else { return "$class already included."; }
    } function SYS_exclude($class){ //Fix it
        if (in_array($class, $this->included)) {
            foreach ($this->included as $key => $value) { if ($value == $class) unset($this->included[$key]); }
            return "Removed $class from included."; 
        } else { return "$class is not included."; }
    } function SYS_save_incl($not_used) {
        if (isset($this->included)) {
            $data = Json::fromFile("data.json");
            $data["forDevIncl"] = $this->included;
            Json::toFile("data.json", $data);
            return "Saved auto-includes successfully.";
        } else { return "Nothing included to save."; }
    }
}
