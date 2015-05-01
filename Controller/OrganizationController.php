<?php
namespace Cogilent\OrganizationBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use Cogilent\OrganizationBundle\Entity\Organization;
use Cogilent\OrganizationBundle\Form\Type\OrganizationType;

use Cogilent\OrganizationBundle\Entity\Office;
use Cogilent\OrganizationBundle\Form\Type\OfficeType;


/**
 * OrganizationController
 * @Route("/organizations")
 */
class OrganizationController extends Controller
{

    /**
     * @Route("/", name="organizations_index")
     * @Template()
     */
    public function indexAction(Request $request){
        return array();
    }

    /**
     * @Route("/Details/{id}", name="organizations_details")
     * @Template()
     */
    public function detailsAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository("CogilentOrganizationBundle:Organization")->findAll();
        $department = $em->getRepository("CogilentOrganizationBundle:Department")->findAll();
        $outputArray = array();
        $count = 0;
        $subarray = array();

        foreach($entity as $obj){
            $array = array();
            if($obj->getId() == $id){
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
        }

        return array(
            'details' => $outputArray,
        );
    }

    /**
     * @Route("/add", name="organizations_add")
     * @Template()
     */
    public function addAction(Request $request){

        $entity = new Organization();
        $form = $this->createForm(new OrganizationType(), $entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();
                foreach($entity->getDepartments() as $dept) {
                    $dept->setOrganization($entity);
                    $em->persist($dept);
                }
                $em->flush();
                return $this->redirect($this->generateUrl('organizations_index'));
            }else{
                foreach ($form->getErrors() as $key => $error) {
                    $errors[] = $error->getMessage();
                }
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/edit/{id}", name="organizations_edit")
     * @Template()
     */
    public function editAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CogilentOrganizationBundle:Organization')->findOneBy(array('id' => $id));
        $form = $this->createForm(new OrganizationType(), $entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                foreach($entity->getDepartments() as $dept) {
                    $dept->setOrganization($entity);
                }
                $em->flush();
                return $this->redirect($this->generateUrl('organizations_index'));
            }else{
                foreach ($form->getErrors() as $key => $error) {
                    $errors[] = $error->getMessage();
                }
            }
        }

        return array(
            'form' => $form->createView(),
            'id' => $id,
        );
    }

    /**
     * @Route("/remove/{id}",
     *         name="organizations_remove",
     *         requirements={"id" = "\d+"})
     */
    public function removeAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CogilentOrganizationBundle:Organization")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Organization with id=' . $id . ' not found');
        }
        $department = $em->getRepository("CogilentOrganizationBundle:Department")->findAll();

        foreach ($department as $departments) {
            if($departments->getOrganization()->getId() == $id){

                $entitydepartment = $em->getRepository("CogilentOrganizationBundle:EmployeeEmail")->find($departments->getId());
                $em->remove($entitydepartment);
            }
        }
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Selected Organisation removed successfully.');
        return $this->redirect($this->generateUrl('organizations_index'));
    }

    /**
     * @Route("/office", name="organizations_office_index")
     * @Template()
     */
    public function officeIndexAction(Request $request){

    }

    /**
     * @Route("/addoffice", name="organizations_office_add")
     * @Template()
     */
    public function addOfficeAction(Request $request){
        $entity = new Office();
        $form = $this->createForm(new OfficeType(), $entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('organizations_index'));

        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/editoffice/{id}", name="organizations_office_edit")
     * @Template()
     */
    public function editOfficeAction(Request $request,$id){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CogilentOrganizationBundle:Office')->findOneBy(array('id' => $id));
        $form = $this->createForm(new OfficeType(), $entity);

        if ($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            $em->flush();
            return $this->redirect($this->generateUrl('organizations_index'));

        }

        return array(
            'form' => $form->createView(),
            'id' => $id,
        );
    }

    /**
     * @Route("/removeoffice/{id}",
     *         name="organizations_office_remove",
     *         requirements={"id" = "\d+"})
     */
    public function removeOfficeAction($id) {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CogilentOrganizationBundle:Office")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Office with id=' . $id . ' not found');
        }
        $em->remove($entity);
        $em->flush();

        $this->get('session')->getFlashBag()->add('notice', 'Selected Office removed successfully.');
        return $this->redirect($this->generateUrl('organizations_office_index'));
    }

}//@
