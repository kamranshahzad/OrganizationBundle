<?php

namespace Kamran\OrganizationBundle\Controller\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;


/**
 * @Route("/api/organizations")
 */
class ApiController extends FOSRestController
{

    /**
     * @Route(
     *      "/all",
     *      name = "api.organization.get_organizations",
     *      defaults = {
     *          "_format" = "json"
     *      },
     *      requirements = {
     *          "_method" = "GET"
     *      },
     *      options = {
     *          "expose" = true
     *      },
     * )
     * @Rest\View
     */
    public function getOrganizationsAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("KamranOrganizationBundle:Organization")->findAll();
        $department = $em->getRepository("KamranOrganizationBundle:Department")->findAll();
        $outputArray = array();
        $count = 0;
        $subarray = array();

        foreach($entity as $obj){
            $array = array();
            $array['id']    = $obj->getId();
            $array['title']  = $obj->getTitle();
            $array['description']  = $obj->getDescription();
            foreach ($department as $departments) {
                if($departments->getOrganization()->getId() == $obj->getId()){
                    $subarray['title'] = $departments->getTitle();
                    $subarray['description'] = $departments->getDescription();
                    $array['department'][$count] = $subarray;
                    $count = $count + 1 ;
                }
            }
            $outputArray[]  = $array;
        }

        return new Response(json_encode($outputArray));

    }


    /**
     * @Route(
     *      "/offices/all",
     *      name = "api.organization.office.all",
     *      defaults = {
     *          "_format" = "json"
     *      },
     *      requirements = {
     *          "_method" = "GET"
     *      },
     *      options = {
     *          "expose" = true
     *      },
     * )
     * @Rest\View
     */
    public function getOfficeAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository("Kamran\OrganizationBundle\Entity\Office")->findAll();
        $outputArray = array();
        foreach($users as $user){
            $array = array();
            $array['id']    = $user->getId();
            $array['name']  = $user->getName();
            $array['address']  = $user->getAddress();
            $array['phone']  = $user->getPhone();
            $array['fax']  = $user->getFax();
            $array['website']  = $user->getWebSite();
            $outputArray[]  = $array;
        }

        return new Response(json_encode($outputArray));

    }

}//@

