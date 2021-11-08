<?php
class Errors extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function noFunciona()
    {
        $this->view->getView($this, "404");
    }
}
$obnotFunciona = new Errors();
$obnotFunciona->noFunciona();
