<?php

class Load
{
    public function view($nameView, $data = null)
    {
        $path = __DIR__ . '/../views/' . $nameView;

        if (file_exists($path)) {
            include_once $path;
        } else {
            die("View not found: $nameView");
        }
    }
}
