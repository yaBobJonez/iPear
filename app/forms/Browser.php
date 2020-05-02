<?php
namespace app\forms;

use std, gui, framework, app;


class Browser extends AbstractForm
{

    /**
     * @event browback.action 
     */
    function doBrowbackAction(UXEvent $e = null)
    {    
        $this->browser->engine->history->goBack();
    }

    /**
     * @event browreload.action 
     */
    function doBrowreloadAction(UXEvent $e = null)
    {    
        $this->browser->engine->refresh();
    }

    /**
     * @event browforward.action 
     */
    function doBrowforwardAction(UXEvent $e = null)
    {    
        $this->browser->engine->history->goForward();
    }

    /**
     * @event browsearch.action 
     */
    function doBrowsearchAction(UXEvent $e = null)
    {    
        $this->browser->engine->load($this->browurl->text);
    }


}
