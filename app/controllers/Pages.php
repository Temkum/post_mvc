<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = ['title' => 'Welcome'];
        $this->view('index', $data);
    }

    public function about()
    {
        $this->view('about');
    }
}
