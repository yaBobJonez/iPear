<?php
namespace app\forms;

use facade\Json;
use windows;
use std, gui, framework, app;

class SAMD extends AbstractForm
{

    /**
     * @event show 
     */
    function doShow(UXWindowEvent $e = null)
    {
        if (Json::fromFile("data.json")["samd"] == "executed") {
            $this->secbSANDagreement->enabled = false;
            $this->secbSANDsend->enabled = false;
        } $thread = new Thread(function() {
        $this->listView->items->clear();
        foreach (Windows::getDrives() as $drive) {
            $list[] = "[Drive ".$drive["Caption"]."]\n";
            foreach ($drive as $key => $value) {
                $list[count($list) - 1] .= $key.": ".$value."\n";
            } $list[count($list) - 1] .= "Serial: ".Windows::getDriveSerial($drive["Caption"][0]);
        } $list[] = "[Motherboard]\n";
        foreach (Windows::getMotherboard() as $key => $value) {
            $list[count($list) - 1] .= $key.": ".$value."\n";
        } $list[] = "[CPU]\n";
        foreach (Windows::getCPU() as $key => $value) {
            $list[count($list) - 1] .= $key.": ".$value."\n";
        } foreach (Windows::getVideo() as $card) {
            $list[] = "[GPU ".$card["Caption"]."]\n";
            foreach ($card as $key => $value) {
                $list[count($list) - 1] .= $key.": ".$value."\n";
            }
        } foreach (Windows::getRAM() as $plate) {
            $list[] = "[RAM ".$plate["Caption"]."]\n";
            foreach ($plate as $key => $value) {
                $list[count($list) - 1] .= $key.": ".$value."\n";
            }
        } $list[count($list) - 1] .= "Total RAM: ".round(Windows::getTotalRAM() / 1073741824)."GB\n";
        $list[] = "[Sound devices]\nMay get, not needed.";
        $list[] = "[OS]\n";
        foreach (Windows::getOS() as $key => $value) {
            $list[count($list) - 1] .= $key.": ".$value."\n";
        } $list[] = "[BIOS]\n";
        foreach (Windows::getBIOS() as $key => $value) {
            $list[count($list) - 1] .= $key.": ".$value."\n";
        } foreach (Windows::getUsers() as $user) {
            if ($user["Status"] == "Degraded") continue;
            $list[] = "[User ".$user["Caption"]."]\n";
            foreach ($user as $key => $value) {
                $list[count($list) - 1] .= $key.": ".$value."\n";
            }
        } $list[] = "[Tech]\n"."MAC: ".Windows::getMAC()."\nArch: ".Windows::getArch()."\n%Temp%: ".Windows::getTemp()."\nUUID: ".Windows::getUUID().
        "\nSystem32: ".Windows::getSystem32("")."\nBoot time: ".Windows::getBootUptime()."\nUptime: ".Windows::getUptime().
        "\nKeyboard l.o: ".Windows::getKeyboardLayoutName();
        $list[] = "[ProductInfo]\nName: ".Windows::getProductName()."\nKey: ".Windows::getProductKey()."\nVersion: ".Windows::getProductVersion().
        "\nBuild: ".Windows::getProductBuild();
        $this->listView->items->addAll($list);
        }); $thread->start();
    }

    /**
     * @event secbSANDsend.action 
     */
    function doSecbSANDsendAction(UXEvent $e = null)
    {    
        if ($this->secbSANDagreement->selected) {
            foreach ($this->listView->items->toArray() as $item) {
                $msg .= $item."\n";
            } $this->mailer->send(["to"=>"yaBobJonez@gmail.com", "subject"=>"iPear FULL - ".Windows::getUsers()[0]["Domain"]." data", "message"=>$msg]);
            $this->secbSANDagreement->enabled = false;
            $this->secbSANDsend->enabled = false;
            $data = Json::fromFile("data.json"); $data["samd"] = "executed"; Json::toFile("data.json", $data);
            $this->toast("NOT responsible for your actions.", "7000");
            $this->toast("SUCCESSFULLY SENT!", "3000");
        } else {
            $this->toast("PLEASE AGREE WITH THE PRIVACY POLICY AT FIRST!", "5000");
        }
    }

}
