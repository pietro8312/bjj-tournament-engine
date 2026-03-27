<?php 
    $css_stack = [];
    $js_stack = [];

    function add_css($file) {
        global $css_stack;

        if(!in_array($file, $css_stack)){
            $css_stack[] = $file;
        }
    }

    function render_css() {
        global $css_stack;

        foreach ($css_stack as $cs) {
            echo '<link rel="stylesheet" href="' . ASSETS_URL . $cs . '">' . PHP_EOL;
        }
    }
    
    function add_js($file) {
        global $js_stack;

        if(!in_array($file, $js_stack)) {
            $js_stack[] = $file;
        }
    }

    function render_js() {
        global $js_stack;

        foreach ($js_stack as $js) {
            echo '<script src="' . ASSETS_URL . $js . '" defer></script>' . PHP_EOL;
        }
    }

    
?>