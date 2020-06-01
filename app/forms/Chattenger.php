<?php
namespace app\forms;

use std, gui, framework, app;


class Chattenger extends AbstractForm
{
    //Thank you, Joseph, for being there.
    
    /**
     * @event link.action 
     */
    function doLinkAction(UXEvent $e = null)
    {    
        browse("https://forms.gle/YDWTmFi39g8Xr97x9");
    }

    /**
     * @event fbmessenger.action 
     */
    function doFbmessengerAction(UXEvent $e = null)
    {    
        browse("https://www.messenger.com");
    }

    /**
     * @event twitter.action 
     */
    function doTwitterAction(UXEvent $e = null)
    {    
        browse("https://twitter.com/home");
    }

    /**
     * @event instagram.action 
     */
    function doInstagramAction(UXEvent $e = null)
    {    
        browse("https://www.instagram.com/");
    }

    /**
     * @event fb.action 
     */
    function doFbAction(UXEvent $e = null)
    {    
        browse("https://www.facebook.com/");
    }

    /**
     * @event discord.action 
     */
    function doDiscordAction(UXEvent $e = null)
    {    
        browse("https://discord.com/channels/@me");
    }

    /**
     * @event twitch.action 
     */
    function doTwitchAction(UXEvent $e = null)
    {    
        browse("https://www.twitch.tv/");
    }

    /**
     * @event telegram.action 
     */
    function doTelegramAction(UXEvent $e = null)
    {    
        browse("https://web.telegram.org/");
    }

    /**
     * @event reddit.action 
     */
    function doRedditAction(UXEvent $e = null)
    {    
        browse("https://www.reddit.com/");
    }

    /**
     * @event vk.action 
     */
    function doVkAction(UXEvent $e = null)
    {    
        browse("https://vk.com/");
    }

    /**
     * @event gmail.action 
     */
    function doGmailAction(UXEvent $e = null)
    {    
        browse("https://mail.google.com/mail/u/0/#inbox");
    }

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {    
        if (file_get_contents("https://vk.com/") == false) $this->vk->enabled = false;
    }

}
