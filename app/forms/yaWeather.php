<?php
namespace app\forms;

use facade\Json;
use std, gui, framework, app;
use addons\yaWeather as WeatherAPI;

class yaWeather extends AbstractForm
{
    public $data;
    public $time;
    /**
     * @event showing 
     */
    function doShowing(UXWindowEvent $e = null)
    {    
        $location = Json::fromFile("http://ip-api.com/json/?fields=lat,lon");
        $this->data = new WeatherAPI("INSERT_KEY_HERE"); //OpenWeatherMap API key
        $this->data->setUnits(Json::fromFile("data.json")["weatherUnits"]);
        $this->data->getByCoordinates($location['lat'], $location['lon']);
        $this->updateInfo(0);
    }
    
    function updateInfo($period){
        $this->dated->text = new Time($this->data->getLocalTime($period) * 1000)->toString("MM/dd/yyyy hh:mm a");
        $this->temp->text = $this->data->getTemperature($period);
        $this->pressure->text = $this->data->getPressure($period);
        $this->humidity->text = $this->data->getHumidity($period);
        $this->winddirection->rotate = $this->data->getWindDegree($period);
        $this->windspeed->text = $this->data->getWindSpeed($period);
        $this->main->text = $this->data->getMain($period);
        $desc = "The ".$this->data->getDescription($period)." is forecasted for ".$this->data->getLocation($period)." at ".$this->dated->text.". The temperature will be ".$this->data
        ->getMinTemp($period)."–".$this->data->getMaxTemp($period)." what feels like ".$this->data->getFeelsLike($period).". The pressure is presumed to be ".$this->data->getPressure(
        $period)." and the humidity of ".$this->data->getHumidity($period).". The wind is ".$this->data->getWindSpeed($period)." ".$this->data->getWindDegree($period)."°. ";
        if ($this->data->isRaining($period)) $desc .= "It's raining at the time, the volume is ".$this->data->getRainVolume($period).". ";
        if ($this->data->isSnowing($period)) $desc .= "There is a snowfall of ".$this->data->getSnowVolume($period).". ";
        $desc .= $this->data->getClouds($period)." of sky is covered with clouds. The local sunrise happens to be at ".new Time($this->data->getLocalSunrise($period) * 1000)->toString(
        "hh:mm a")." and sunset occurs at ".new Time($this->data->getLocalSunset($period) * 1000)->toString("hh:mm a").".";
        $this->desc->text = $desc;
    }
    
    /**
     * @event metric.action 
     */
    function doMetricAction(UXEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        $data["weatherUnits"] = "Metric";
        Json::toFile("data.json", $data);
        $this->data->setUnits("Metric");
        $location = Json::fromFile("http://ip-api.com/json/?fields=lat,lon");
        $this->data->getByCoordinates($location['lat'], $location['lon']);
    }

    /**
     * @event Imperial.action 
     */
    function doImperialAction(UXEvent $e = null)
    {    
        $data = Json::fromFile("data.json");
        $data["weatherUnits"] = "Imperial";
        Json::toFile("data.json", $data);
        $this->data->setUnits("Imperial");
        $location = Json::fromFile("http://ip-api.com/json/?fields=lat,lon");
        $this->data->getByCoordinates($location['lat'], $location['lon']);
    }

    /**
     * @event prev.action 
     */
    function doPrevAction(UXEvent $e = null)
    {    
        if ($this->time > 0) $this->updateInfo(--$this->time); else { $this->time = 39; $this->updateInfo($this->time); }
    }

    /**
     * @event next.action 
     */
    function doNextAction(UXEvent $e = null)
    {    
        if ($this->time < 39) $this->updateInfo(++$this->time); else { $this->time = 0; $this->updateInfo($this->time); }
    }

    /**
     * @event refresh.action 
     */
    function doRefreshAction(UXEvent $e = null)
    {    
        $this->updateInfo($this->time);
    }

}
