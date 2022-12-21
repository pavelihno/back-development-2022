<?php

class MainController extends Controller
{
    function index()
    {
        $this->view->generate('MainView.php', 'TemplateView.php');
    }
}