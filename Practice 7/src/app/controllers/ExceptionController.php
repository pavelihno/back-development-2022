<?php

class ExceptionController extends Controller
{
    function index()
    {
      $this->view->generate('ExceptionView.php', 'TemplateView.php');
    }
}