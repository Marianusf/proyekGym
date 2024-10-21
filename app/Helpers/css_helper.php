<?php
// File: app/Helpers/css_helper.php

if (!function_exists('load_css')) {
    function load_css($file) {
        return '<link href="' . base_url($file) . '" rel="stylesheet">';
    }
}