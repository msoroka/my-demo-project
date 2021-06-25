<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends FrontendController
{
    /**
     * @Template
     * @param Request $request
     */
    public function defaultAction(Request $request)
    {
    }
}
