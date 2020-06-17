<?php
namespace app\forms;

use facade\Json;
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

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {
        //$this->browser->engine->userAgent = "Mozilla/5.0 (Android 7.0; Mobile; rv:54.0) Gecko/54.0 Firefox/54.0";
        $country = Json::fromFile("http://ip-api.com/json/?fields=country")["country"];
        $available = explode(", ", "Algeria, Egypt, Morocco, South Africa, Tunisia, Bahrain, Hong Kong, India, Indonesia, Israel, Japan, Jordan, Kuwait, Lebanon, 
        Malaysia, Oman, Palestine, Philippines, Qatar, Saudi Arabia, Singapore, Taiwan, Thailand, United Arab Emirates, Vietnam, Andorra, Austria, Belgium, Bulgaria, 
        Cyprus, Czech Republic, Denmark, Estonia, Finland, France, Germany, Greece, Hungary, Iceland, Ireland, Italy, Latvia, Liechtenstein, Lithuania, Luxembourg, 
        Malta, Monaco, Netherlands, Norway, Poland, Portugal, Romania, Slovakia, Spain, Sweden, Switzerland, Turkey, United Kingdom, Canada, Costa Rica, Dominican Republic, 
        El Salvador, Guatemala, Honduras, Mexico, Nicaragua, Panama, United States, Argentina, Bolivia, Brazil, Chile, Colombia, Ecuador, Paraguay, Peru, Uruguay, 
        Australia, New Zealand");
        if (in_array($country, $available) == false) { $res = new ResourceStream("/.data/notavailable.html"); browse($res->toExternalForm()); }
    }

    /**
     * @event onlsavebtn.action 
     */
    function doOnlsavebtnAction(UXEvent $e = null)
    {    
        if (isset($this->saveurl->text) && isset($this->savename->text)) {
            $data = Json::fromFile("data.json");
            $data["peartifySaves"]["spotify"][$this->savename->text] = $this->saveurl->text;
            Json::toFile("data.json", $data);
        }
    }

    /**
     * @event onlopenbtn.action 
     */
    function doOnlopenbtnAction(UXEvent $e = null)
    {    
        if (substr($this->openurl->text, 0, 5) == "Name:") {
            $data = Json::fromFile("data.json");
            browse("https://open.spotify.com/embed/".$data["peartifySaves"]["spotify"][substr($this->openurl->text, 5)]);
        } else {
            browse("https://open.spotify.com/embed/".$this->openurl->text);
        }
    }

    /**
     * @event sc_openbtn.action 
     */
    function doSc_openbtnAction(UXEvent $e = null)
    {    
        if (substr($this->sc_openurl->text, 0, 5) == "Name:") {
            $data = Json::fromFile("data.json");
            browse("https://w.soundcloud.com/player/?url=https://soundcloud.com/".$data["peartifySaves"]["soundcloud"][substr($this->sc_openurl->text, 5)]);
        } else {
            browse("https://w.soundcloud.com/player/?url=https://soundcloud.com/".$this->sc_openurl->text);
        }
    }

    /**
     * @event sc_savebtn.action 
     */
    function doSc_savebtnAction(UXEvent $e = null)
    {    
        if (isset($this->sc_saveurl->text) && isset($this->sc_savename->text)) {
            $data = Json::fromFile("data.json");
            $data["peartifySaves"]["soundcloud"][$this->sc_savename->text] = $this->sc_saveurl->text;
            Json::toFile("data.json", $data);
        }
    }

}
