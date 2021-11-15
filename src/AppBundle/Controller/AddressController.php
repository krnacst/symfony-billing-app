<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Form\AddressForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AddressController extends Controller {

    //Get Address repository and find all address
    public function indexAction() {
        $em = $this->getDoctrine()->getRepository(Address::class);
        $addresses = $em->findAll();

        return $addresses;
    }

    /**
     * @Route("/address/create", name="address_create")
     */
    public function createAction(Request $request) {
        //Create Address object and create AddressForm
        $address = new Address();
        $form = $this->createForm(AddressForm::class, $address);

        $form->handleRequest($request);

        //Check form validation
        if ($form->isSubmitted() && $form->isValid()) {
            //Get datas from form
            $address = $form->getData();

            //Save datas to database
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();

            //Create success message
            $this->addFlash(
                'success', 
                'Számlázási cím sikeresen létrehozva!'
            );

            //Redirect to address create page
            return $this->redirect($this->generateUrl('address_create'));
        }

        //Save addresses to the $addresses
        $addresses = $this->indexAction();

        //Rendering add form page and add addresses and create form view
        return $this->render('forms/add_form.html.twig', [
            'addresses' => $addresses,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="address_edit")
     */
    public function editAction(Request $request, Address $address) {
        //Create entity manager
        $entityManager = $this->getDoctrine()->getManager();

        //Create AddressForm
        $form = $this->createForm(AddressForm::class, $address);
        $form->handleRequest($request);

        //Check form validation
        if($form->isSubmitted() && $form->isValid()){
            //Save edited data to database
            $entityManager->flush();

            //Create success message
            $this->addFlash(
                'success',
                'Sikeresen módosítottad a számlázási címet!'
            );

            //Redirect to address create page
            return $this->redirect($this->generateUrl('address_create'));
        } else if($form->isSubmitted() && !$form->isValid()){
            //If the form is not valid create error message
            $this->addFlash(
                'danger',
                'A *-al jelölt mezők kitöltése kötelező!'
            );
        }


        //Save addresses to the $addresses
        $addresses = $this->indexAction();
    
        //Rendering edit form page and add addresses and create form view
        return $this->render('forms/edit_form.html.twig', [
            'addresses' => $addresses,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="address_remove")
     */
    public function removeAction(Address $address) {
        //Create entity manager
        $em = $this->getDoctrine()->getManager();

        //Remove selected address from database
        $em->remove($address);
        $em->flush();

        //Create success message
        $this->addFlash(
            'success', 
            'Sikeresen törölted a számlázási címet!'
        );

        //Redirect to address create page
        return $this->redirect($this->generateUrl('address_create'));
    }
}
