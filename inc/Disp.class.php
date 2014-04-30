<?php

class Disp {

    public static $meta = array();
    public static $content = "";
    
    public static function addMeta($meta) {
        if (is_array($meta)) {
            self::$meta = array_merge(self::$meta, $meta);
        }
    }
    
    public static function render()
    {
        global $path; 
        $disp = file_get_contents(Config::$template['index']);
        
        $init = show(self::loadingPanels($disp),array("content" => self::$content));        
        $init = show($init, convertMatchDyn(searchBetween("[dyn_", $init, "]")));
        $init = preg_replace("/\s+/", " ", $init);
        self::$meta['copyright'] = Config::$settings->copyright;
        self::$meta['google_analytics'] = Config::$settings->google_analytics;
        self::$meta['domain'] = $_SERVER['HTTP_HOST'];

        self::$meta['css'] = $path['css'];
        self::$meta['style'] = $path['style'];
        self::$meta['include'] = $path['include'];
        self::$meta['js'] = $path['js'];
        
        if (!isset(self::$meta['google_plus'])) {
            self::$meta['google_plus'] = "";
        }

        $init = show($init,self::$meta);
        $init = show($init, convertMatch(searchBetween("[s_", $init, "]")));
        self::display($init);
    }
    
    function renderMin() {
        $init = show(self::$content, convertMatch(searchBetween("[s_", self::$content, "]")));
        self::display($init);
    }
    
    function initMinStyle($init) {
        $init = show($init, convertMatch(searchBetween("[s_", $content, "]")));
        $init = show(getFile($path['style_index']), array('content' => $init));
        display($init);
    }

    private function display($content) {
        echo $content;
    }
    function loadingPanels($disp)
    {
        global $path;
        $panels = opendir($path['panels']);
        
        while ($panel = readdir($panels))
        {
                if ($panel != ".." && $panel != "." && $panel != "disable") 
                {
                        include($path['panels'].$panel);
                        $panel = substr($panel,0,-4);
                        if (function_exists($panel)){
                            $disp = show($disp, array( $panel => $panel() ));
                        }
                }
        }
        closedir($panels);

        return $disp;
    }
}