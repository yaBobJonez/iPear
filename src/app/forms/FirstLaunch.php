<?php
namespace app\forms;

use facade\Json;
use windows;
use std, gui, framework, app;


class FirstLaunch extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $this->lname->text = Windows::getUsers()[0]["Domain"]."?";
        $this->lcpu->text = Windows::getCpuProduct();
        $this->lram->text = round(Windows::getTotalRAM()/1073741824)."GB.";
        $this->lgpu->text = Windows::getVideoProduct();
        $this->idesk->image = Windows::getWallpaper();
    }

    /**
     * @event btndone.action 
     */
    function doBtndoneAction(UXEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        $data["active"] = "1";
        Json::toFile("data.json", $data);
        if ($this->cinfo->selected) {
            $msg = "User Name: ".$this->lname->text."\nCPU (Product): ".$this->lcpu->text."\nRAM: ".$this->lram->text."\nGPU: ".$this->lgpu->text;
            $this->mailer->send(["to"=>"yaBobJonez@gmail.com", "subject"=>"iPear Basic - ".$this->lname->text." data", "message"=>$msg]);
        } $this->form("MainMenu")->showInFragment($this->form("MainForm")->Screen);
        $this->free();
    }


}
