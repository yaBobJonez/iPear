<?php
// yaWeather 2.1 library
// By ya_Bob_Jonez
class yaWeather {
    private $appkey;
    public $units;
    protected $data;
    public $u_temp, $u_ws, $u_p, $u_v, $u_vol;
    public $n_p, $n_v, $n_vol;
    
    function __construct($key) { $this->appkey = $key; }
    public function setUnits($units) {
        if ($units == "Imperial") {
            $this->units = "imperial";
            $this->u_temp = "°F"; $this->u_ws = " mph"; $this->u_p = " PSI"; $this->u_vol = " in";
            $this->n_p = 68.9475729; $this->n_vol = 25.4;
        } elseif ($units == "Metric") {
            $this->units = "metric";
            $this->u_temp = "°C"; $this->u_ws = " m/s"; $this->u_p = " hPa"; $this->u_vol = " mm";
            $this->n_p = 1; $this->n_vol = 1;
        } elseif ($units == "SI") {
            $this->units = "SI";
            $this->u_temp = "°K"; $this->u_ws = " m/s"; $this->u_p = " hPa"; $this->u_vol = " mm";
            $this->n_p = 1; $this->n_vol = 1;
        } else {
            $this->units = "imperial";
            $this->u_temp = "°F"; $this->u_ws = " mph"; $this->u_p = " PSI"; $this->u_vol = " in";
            $this->n_p = 68.9475729; $this->n_vol = 25.4;
        }
    }
    public function getByCoordinates($lat, $lon) {
        $edata = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?lat=".$lat."&lon=".$lon."&units=".$this->units."&appid=".$this->appkey);
        $this->data = json_decode($edata, true);
    } public function getByZip ($zip, $country) {
        $edata = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?zip=".$zip.",".$country."&units=".$this->units."&appid=".$this->appkey);
        $this->data = json_decode($edata, true);
    } public function getByCity ($city, $country) {
        $edata = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?q=".$city.",".$country."&units=".$this->units."&appid=".$this->appkey);
        $this->data = json_decode($edata, true);
    } public function getByID ($id) {
        $edata = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?id=".$id."&units=".$this->units."&appid=".$this->appkey);
        $this->data = json_decode($edata, true);
    }
    public function getUTCTime ($period) { return $this->data['list'][$period]['dt']; }
    public function getLocalTime ($period) { return $this->data['list'][$period]['dt'] + $this->data['city']['timezone']; }
    public function getLocation () { return $this->data['city']['name'].", ".$this->data['city']['country']; }
    public function getTemperature ($period) { return round($this->data['list'][$period]['main']['temp'], 1).$this->u_temp; }
    public function getMain ($period) { return $this->data['list'][$period]['weather'][0]['main']; }
    public function getDescription ($period) { return $this->data['list'][$period]['weather'][0]['description']; }
    public function getIconCode ($period) { return $this->data['list'][$period]['weather'][0]['icon']; }
    public function getDefIcon ($period) { return "http://openweathermap.org/img/wn/".$this->getIconCode($period)."@2x.png"; }
    public function getFeelsLike ($period) { return round($this->data['list'][$period]['main']['feels_like'], 1).$this->u_temp; }
    public function getMinTemp ($period) { return round($this->data['list'][$period]['main']['temp_min'], 1).$this->u_temp; }
    public function getMaxTemp ($period) { return round($this->data['list'][$period]['main']['temp_max'], 1).$this->u_temp; }
    public function getPressure ($period) { return round($this->data['list'][$period]['main']['pressure'] / $this->n_p, 1).$this->u_p; }
    public function getHumidity ($period) { return $this->data['list'][$period]['main']['humidity']."%"; }
    public function getWindSpeed ($period) { return $this->data['list'][$period]['wind']['speed'].$this->u_ws; }
    public function getWindDegree ($period) { return $this->data['list'][$period]['wind']['deg']; }
    public function getRainVolume ($period) { return round($this->data['list'][$period]['rain']['3h'] / $this->n_vol, 2).$this->u_vol; }
    public function getSnowVolume ($period) { return round($this->data['list'][$period]['snow']['3h'] / $this->n_vol, 2).$this->u_vol; }
    public function getClouds ($period) { return $this->data['list'][$period]['clouds']['all']."%"; }
    public function getUTCSunrise ($period) { return $this->data['city']['sunrise']; }
    public function getLocalSunrise ($period) { return $this->data['city']['sunrise'] + $this->data['city']['timezone']; }
    public function getUTCSunset ($period) { return $this->data['city']['sunset']; }
    public function getLocalSunset ($period) { return $this->data['city']['sunset'] + $this->data['city']['timezone']; }
    public function isRaining ($period) { if(isset($this->data['list'][$period]['rain']['3h'])) { return true; } else { return false; } }
    public function isSnowing ($period) { if(isset($this->data['list'][$period]['snow']['3h'])) { return true; } else { return false; } }
    public function getCode () { return $this->data['cod']; }
}
?>