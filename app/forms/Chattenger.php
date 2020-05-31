<?php
namespace app\forms;

use std, gui, framework, app;


class Chattenger extends AbstractForm
{

    /**
     * @event joinbtn.action 
     */
    function doJoinbtnAction(UXEvent $e = null)
    {
        if (empty($this->chatroom->text)) $this->chatroom->text = "Central";
        $this->browser->engine->loadContent("<!DOCTYPE html><html><body>
        <div id=\"tlkio\" data-channel=\"iPear-".$this->chatroom->text."\" style=\"width:100%;height:100%;\"></div>
        <script async src=\"http://tlk.io/embed.js\" type=\"text/javascript\"></script>
        </body></html>");
    }

    /**
     * @event headtocentral.action 
     */
    function doHeadtocentralAction(UXEvent $e = null)
    {
        $this->browser->engine->loadContent("<!DOCTYPE html><html><body>
        <div id=\"tlkio\" data-channel=\"iPear-Central\" style=\"width:100%;height:100%;\"></div>
        <script async src=\"http://tlk.io/embed.js\" type=\"text/javascript\"></script>
        </body></html>"); $this->chatroom->text = "Central";
    }

}
