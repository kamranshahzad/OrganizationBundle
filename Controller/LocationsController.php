<?php
namespace Kamran\OrganizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * LocationsController
 * @Route("/locations")
 */
class LocationsController extends Controller
{

    /**
     * @Route("/", name="locations_index")
     * @Template()
     */
    public function indexAction(Request $request){
        return array();
    }



}//@
