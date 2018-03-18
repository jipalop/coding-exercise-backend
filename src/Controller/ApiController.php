<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends Controller
{

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction() {}

}
