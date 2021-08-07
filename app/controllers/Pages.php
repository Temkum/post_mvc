<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = ['title' => 'Welcome Home'];

        $this->view('index', $data);
    }

    public function about()
    {
        $data = ['title' => 'About Us'];
        $this->view('about', $data);
    }
}
