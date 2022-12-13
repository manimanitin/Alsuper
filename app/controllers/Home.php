<?php
class Home extends Controller
{
    public function __construct()
    {
    }
    /**metodo default 
     * index
     */
    public function index()
    {
        # code..
        $this->view('index');
        
    }
}
