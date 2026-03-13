<?php 
    $css_stack = [];

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
?>