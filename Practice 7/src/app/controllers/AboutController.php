<?php

class AboutController extends Controller
{
    function index()
    {
        $this->view->generate('AboutView.php', 'TemplateView.php');
    }
}