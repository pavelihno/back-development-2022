<?php

include 'app/models/Dessert.php';

class DessertsController extends Controller
{
    function index()
    {
        $this->view->generate('DessertsView.php', 'TemplateView.php', Dessert::get_data());
    }
}