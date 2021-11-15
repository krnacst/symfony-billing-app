<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Order;
use AppBundle\Form\AddressListForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends Controller {

    /**
     * @Route("/order", name="order_index")
     */
    public function indexAction(Request $request) {
        //Create AddressListForm
        $form = $this->createForm(AddressListForm::class);
        $form->handleRequest($request);

        //Check form is submitted and valid
        if($form->isSubmitted() && $form->isValid()) {

            //Get form all data
            $formData = $form->getData();
            
            if($formData['addressList'] == NULL) {

                //Save new address to database
                $em_newAdd = $this->getDoctrine()->getManager();
                $em_newAdd->persist($formData['newAddress']);
                $em_newAdd->flush();

                //Create order object and set data
                $order = new Order();
                $order->setAddressId($formData['newAddress']->getId());
                $order->setType($formData['newAddress']->getType());
                $order->setName($formData['newAddress']->getName());
                $order->setPhone($formData['newAddress']->getPhone());
                $order->setTaxNumber($formData['newAddress']->getTaxNumber());
                $order->setCountry($formData['newAddress']->getCountry());
                $order->setPostCode($formData['newAddress']->getPostCode());
                $order->setCity($formData['newAddress']->getCity());
                $order->setAddress($formData['newAddress']->getAddress());

                //Save order to database
                $em_order = $this->getDoctrine()->getManager();
                $em_order->persist($order);
                $em_order->flush();

                //Success messages
                $this->addFlash(
                    'success', 
                    'Rendelésedet sikeresen rögzítettük!'
                );
                $this->addFlash(
                    'success',
                    'Számlázási címedet elmentettük!'
                );

                //Redirect to order list page
                return $this->redirect($this->generateUrl('order_list'));
            } else {

                //Create order object and set data
                $order = new Order();
                $order->setAddressId($formData['addressList']->getId());
                $order->setType($formData['addressList']->getType());
                $order->setName($formData['addressList']->getName());
                $order->setPhone($formData['addressList']->getPhone());
                $order->setTaxNumber($formData['addressList']->getTaxNumber());
                $order->setCountry($formData['addressList']->getCountry());
                $order->setPostCode($formData['addressList']->getPostCode());
                $order->setCity($formData['addressList']->getCity());
                $order->setAddress($formData['addressList']->getAddress());

                //Save order to database
                $em_order = $this->getDoctrine()->getManager();
                $em_order->persist($order);
                $em_order->flush();

                //Success message
                $this->addFlash(
                    'success',
                    'Rendelésedet sikeresen rögzítettük!'
                );
                
                //Redirect to order list page
                return $this->redirect($this->generateUrl('order_list'));
            }
        }

        //Rendering the order form page
        return $this->render('forms/order_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/order/list", name="order_list")
     */
    public function listAction() {

        //Get the Order repository and find all orders
        $em = $this->getDoctrine()->getRepository(Order::class);
        $orders = $em->findAll();

        //Rendering the order list page
        return $this->render('default/order_list.html.twig', [
            'orders' => $orders
        ]);
    }
}