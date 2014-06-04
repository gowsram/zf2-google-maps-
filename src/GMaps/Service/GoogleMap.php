<?php

namespace GMaps\Service;

/**
 * GMaps\Service\GoogleMap
 *
 * Zend Framework2 Google Map Class  (Google Maps API v3)
 *
 * An open source application development framework for PHP 5.1.6 or newer
 * 
 * This class enables the creation of google maps
 *
 * @package		Zend Framework 2
 * @author		Ramkumar 
 */
 
class GoogleMap {

    var $api_key = '';
    var $sensor = 'false';
    var $div_id = '';
    var $div_class = '';
    var $zoom = 10;
    var $lat = -300;
    var $lon = 300;
    var $markers = array();
    var $height = "100px";
    var $width = "100px";
    var $animation = '';
    var $icon = '';
    var $icons = array();

    /**
     * Constructor
     */
    function __construct($api_key) {
        $this->api_key = $api_key;
    }

    // --------------------------------------------------------------------

    /**
     * Initialize the user preferences
     *
     * Accepts an associative array as input, containing display preferences
     *
     * @access	public
     * @param	array	config preferences
     * @return	void
     */
    function initialize($config = array()) {
        foreach ($config as $key => $val) {
            if (isset($this->$key)) {
                $this->$key = $val;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Generate the google map
     *
     * @access	public
     * @return	string
     */
    function generate() {

        $out = '';

        $out .= '	<div id="' . $this->div_id . '" class="' . $this->div_class . '" style="height:' . $this->height . ';width:' . $this->width . ';"></div>';

        $out .= '	<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=' . $this->api_key . '&sensor=' . $this->sensor . '"></script>';

        $out .= '	<script type="text/javascript"> 
    	
						function doAnimation() 
						{
							if (marker.getAnimation() != null) 
							{
								marker.setAnimation(null); 
							} 
							else 
							{
								marker.setAnimation(google.maps.Animation.' . $this->animation . ');
							}
						}
		
    					function initialize() 
    					{
    						
    						var myOptions = {
    							center: new google.maps.LatLng(' . $this->lat . ',' . $this->lon . '), 
    							Zoom:' . $this->zoom . ', 
    							mapTypeId: google.maps.MapTypeId.ROADMAP 
							};';


        $out .= '			var map = new google.maps.Map(document.getElementById("' . $this->div_id . '"), myOptions);';

        $i = 0;
        foreach ($this->markers as $key => $value) {
            $out .="var marker" . $i . " = new google.maps.Marker({
									 												position: new google.maps.LatLng(" . $value . "), 
									 												map: map,";
            if ($this->animation != '') {
                $out .="animation: google.maps.Animation." . $this->animation . ",";
            }
            if ($this->icon != '') {
                $out .="icon:'" . $this->icon . "',";
            } elseif (count($this->icons) > 0) {
                $out .="icon:'" . $this->icons[$i] . "',";
            }
            $out .="title:'" . $key . "'});";
            if ($this->animation != '') {
                $out .="google.maps.event.addListener(marker" . $i . ", 'click', doAnimation);";
            }

            $i++;
        }

        $out .= '		} 
						
						initialize();
					
					</script>';

        return $out;
    }

}
