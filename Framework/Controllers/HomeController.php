<?php

namespace Framework\Controllers;

class HomeController {
    public function __construct() {}
    public function index() {
        loadview('home');
    }
}