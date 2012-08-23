<?php

namespace Antistatique\Twig\Extension;

class Url extends \Twig_Extension
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getFunctions() 
    {
        return array(
            'is_current_route' => new \Twig_Function_Method($this, 'isCurrentRoute'),
        );
    }

    public function isCurrentRoute($routeName)
    {
        return $routeName == $this->request->get('_route');
    }

    public function getName()
    {
        return 'antistatique_url';
    }
}