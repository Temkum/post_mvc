<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => 'Softech Posts',
            'description' => 'Simple social network build on PHP MVC framework'
        ];

        $this->view('index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us',
            'description' => 'App to share posts with other users'
        ];
        $this->view('about', $data);
    }
}
