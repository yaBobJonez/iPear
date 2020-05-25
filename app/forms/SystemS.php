<?php
namespace app\forms;

use facade\Json;
use std, gui, framework, app;


class SystemS extends AbstractForm
{

    /**
     * @event radioGroup3.action 
     */
    function doRadioGroup3Action(UXEvent $e = null)
    {    
        $this->radioGroup3->selectedIndex = 0;
    }

    /**
     * @event radioGroup.action 
     */
    function doRadioGroupAction(UXEvent $e = null)
    {    
        if ($this->radioGroup->selectedIndex == 2) { $this->form("MainForm")->toast("Яжесказалчтотутнетрускаваязыка#!@", 5000); }
    }

    /**
     * @event sysbcheckup.action 
     */
    function doSysbcheckupAction(UXEvent $e = null)
    {    
        $rdata = Json::decode(file_get_contents("https://raw.githubusercontent.com/yaBobJonez/iPear/master/sysconfig.pearjd"));
        $this->remoteversion->text = $rdata["AppVersion"];
        $fremv = str_replace(".","",$this->remoteversion->text);
        $fcurv = str_replace(".","",$this->currversion->text);
        if (strpos($fremv, "-") !== false) return "No new: only In-Dev.";
        if ($fremv > $fcurv) {
            $this->isupavail->text = "New version available!";
            $this->isupavail->textColor = UXColor::of("#336633");
            $this->sysbupdate->enabled = true;
        }
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        $data = Json::decode(file_get_contents("res://sysconfig.pearjd"));
        $this->currversion->text = $data["AppVersion"];
    }

    /**
     * @event sysbupdate.action 
     */
    function doSysbupdateAction(UXEvent $e = null)
    {    
        //$this->toast("This is ALPHA Test feature only.",  5000);
        echo "[PAUS]: PearAutoUpdateSystem is ALPHA feature, only for testing purposes; expect bugs to occur.";
        $apilink = Json::decode(file_get_contents("https://api.github.com/repos/yaBobJonez/iPear/releases/latest"));
        $file = file_get_contents($apilink["assets"]["0"]["browser_download_url"]);
        file_put_contents("./iPear".Json::decode(file_get_contents("https://raw.githubusercontent.com/yaBobJonez/iPear/master/sysconfig.pearjd"))["AppVersion"].".exe", $file);
    }

    /**
     * @event sysbreset.action 
     */
    function doSysbresetAction(UXEvent $e = null)
    {    
        if ($this->syscreset->selected) {
            file_get_contents("data.json", '{
              "active": "",
              "wallpapers": "",
              "sleep": "off",
              "samd": "",
              "peartifySaves": {
                "spotify": {
                }, "soundcloud": {
                }
              }
            }');
            $this->form("MainForm")->toast("Successfully reset all to defaults!", 5000);
        } else { $this->form("MainForm")->toast("Please confirm the reset.", 3000); }
    }

}
