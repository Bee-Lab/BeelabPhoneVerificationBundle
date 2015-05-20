<?php

namespace Beelab\PhoneVerificationBundle\Controller;

use Beelab\PhoneVerificationBundle\Event\PhoneEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VerificationController extends Controller
{
    /**
     * @Route("/verify/phone", name="beelab_phone_verification_phone")
     */
    public function phoneAction(Request $request)
    {
        $form = $this->createForm('beelab_verify_phone');
        if ($form->handleRequest($request)->isValid()) {
            $data = $form->getData();
            $phone = $this->get('beelab_phone_verification.manager.phone')->create($data['number']);
            $this->get('event_dispatcher')->dispatch('beelab_phone_verification.phone_creation', new PhoneEvent($phone));
            $this->get('beelab_phone_verification.manager.phone')->flush();
            $this->get('beelab_phone_verification.sender')->send($data['number'], $phone->getCodeMessage());

            return $this->redirect($this->generateUrl('beelab_phone_verification_code', ['number' => $data['number']]));
        }

        return $this->render('BeelabPhoneVerificationBundle:verification:phone.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/code/{number}", name="beelab_phone_verification_code")
     */
    public function codeAction($number, Request $request)
    {
        $phone = $this->get('beelab_phone_verification.manager.phone')->find($number);
        if (is_null($phone)) {
            throw $this->createNotFoundException(sprintf('Could not find number: %s.', $number));
        }
        $form = $this->createForm('beelab_verify_code', null, ['number' => $number]);
        if ($form->handleRequest($request)->isValid()) {
            $this->get('beelab_phone_verification.manager.phone')->save($phone);
            $successRoute = $this->container->getParameter('beelab_phone_verification.success_route');

            return $this->redirect($this->generateUrl($successRoute));
        }

        return $this->render('BeelabPhoneVerificationBundle:verification:code.html.twig', [
            'form'  => $form->createView(),
        ]);
    }
}
