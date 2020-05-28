<?php
namespace app\forms;

use std, gui, framework, app;

class Translator extends AbstractForm
{
    //In Memory of @NarkaZirkus the EMS First Responder who passed away due to COVID-19... (5/27/2020)
    //In Memory of George Floyd who became another victim of racism... (5/28/2020)
    public $from;
    public $to;
    /**
     * @event translateit.action 
     */
    function doTranslateitAction(UXEvent $e = null)
    {    
        $this->from = $this->validateLang($this->langfrom);
        $this->to = $this->validateLang($this->langto);
        if (($this->from == 0) || ($this->to == 0)) { $this->form("MainForm")->toast("Please, select language.", 5000); }
        elseif (($this->from == 1) xor ($this->to == 1)) {
            if (($this->from == "en") && ($this->to == 1)) { $this->textto = $this->translateFurryish("to", $this->textfrom); }
            elseif (($this->from == 1) && ($this->to == "en")) { $this->textto = $this->translateFurryish("from", $this->textfrom); }
            else { $this->form("MainForm")->toast("Only English <=> Furryish supported.", 5000); }
        } elseif ($this->from == $this->to) { $this->form("MainForm")->toast("Do u think u can troll me?", 5000); }
        else {
            $result = $this->translate($this->textfrom, 0, 'yi');
            $result = $this->translate($result, 'yi', 'mi');
            $this->textto = $this->translate($result, 'mi', 0);
        }
    }
    
    function validateLang($field){
        if ($field->value !== "Select language") {
            switch ($field->value) {
                case "English": $tlang = "en"; break;
                case "Italian": $tlang = "it"; break;
                case "Spanish": $tlang = "es"; break;
                case "Chinese": $tlang = "zh"; break;
                case "Korean": $tlang = "ko"; break;
                case "Latin": $tlang = "la"; break;
                case "German": $tlang = "de"; break;
                case "Polish": $tlang = "pl"; break;
                case "Portuguese": $tlang = "pt"; break;
                case "Russian": $tlang = "ru"; break;
                case "Turkish": $tlang = "tr"; break;
                case "Ukrainian": $tlang = "uk"; break;
                case "French": $tlang = "fr"; break;
                case "Czech": $tlang = "cs"; break;
                case "Japanese": $tlang = "ja"; break;
                case "Furryish": $tlang = 1; break;
                default: $tlang = 0;
            } return $tlang;
        } else return 0;
    } function translate($text, $from = 0, $to = 0){
        $link = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20191008T170847Z.f5f668f854939e20.48d2b9918d5a665eb00484025
        e114bfabd45b3f7&text=".urlencode($text->text)."&lang=";
        if ($from !== 0) $link .= $from; else $link .= $this->from;
        $link .= "-"
        if ($to !== 0) $link .= $to; else $link .= $this->to;
        $request = file_get_contents($link);
        return $request["text"][0];
    } function translateFurryish($switch, $text){
        //TODO
    }
}
