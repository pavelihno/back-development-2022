<?php

include 'app/models/Drink.php';

class DrinksController extends Controller
{
    function index()
    {
        $this->view->generate('DrinksView.php', 'TemplateView.php', Drink::get_data());
    }
}