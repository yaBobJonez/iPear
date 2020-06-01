<?php
namespace app\forms;

use std, gui, framework, app;


class Calculator extends AbstractForm
{

    /**
     * @event button.action 
     */
    function doButtonAction(UXEvent $e = null) { $this->edit->text .= 1; }

    /**
     * @event buttonAlt.action 
     */
    function doButtonAltAction(UXEvent $e = null) { $this->edit->text .= 2; }

    /**
     * @event button3.action 
     */
    function doButton3Action(UXEvent $e = null) { $this->edit->text .= 3; }

    /**
     * @event button4.action 
     */
    function doButton4Action(UXEvent $e = null) { $this->edit->text .= 4; }

    /**
     * @event button5.action 
     */
    function doButton5Action(UXEvent $e = null) { $this->edit->text .= 5; }

    /**
     * @event button6.action 
     */
    function doButton6Action(UXEvent $e = null) { $this->edit->text .= 6; }

    /**
     * @event button7.action 
     */
    function doButton7Action(UXEvent $e = null) { $this->edit->text .= 7; }

    /**
     * @event button8.action 
     */
    function doButton8Action(UXEvent $e = null) { $this->edit->text .= 8; }

    /**
     * @event button9.action 
     */
    function doButton9Action(UXEvent $e = null) { $this->edit->text .= 9; }

    /**
     * @event button10.action 
     */
    function doButton10Action(UXEvent $e = null) { $this->edit->text .= 0; }

    /**
     * @event button16.action 
     */
    function doButton16Action(UXEvent $e = null) { $this->edit->text .= "."; }

    /**
     * @event button11.action 
     */
    function doButton11Action(UXEvent $e = null) { $this->edit->text .= "+"; }

    /**
     * @event button12.action 
     */
    function doButton12Action(UXEvent $e = null) { $this->edit->text .= "-"; }

    /**
     * @event button13.action 
     */
    function doButton13Action(UXEvent $e = null) { $this->edit->text .= "*"; }

    /**
     * @event button14.action 
     */
    function doButton14Action(UXEvent $e = null) { $this->edit->text .= "/"; }

    /**
     * @event button17.action 
     */
    function doButton17Action(UXEvent $e = null) { $this->edit->text .= "sqrt("; }


    /**
     * @event button19.action 
     */
    function doButton19Action(UXEvent $e = null) { $this->edit->text .= "("; }


    /**
     * @event button21.action 
     */
    function doButton21Action(UXEvent $e = null) { $this->edit->text .= ")"; }

    /**
     * @event button27.action 
     */
    function doButton27Action(UXEvent $e = null) { $this->edit->text = ""; }

    /**
     * @event button15.action 
     */
    function doButton15Action(UXEvent $e = null)
    {    
        if ($this->edit->text == "sqrt(621)") { browse("http://e621.net"); }
        elseif ($this->edit->text == "sqrt(420)") { browse("https://warriorcats.com/"); }
        else {
            $this->edit->text = eval("return ".$this->edit->text.";");
        }
    }

}
