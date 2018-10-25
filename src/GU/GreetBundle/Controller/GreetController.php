<?php

namespace GU\GreetBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use GU\BaseBundle\Controller\BaseController;
use GU\GreetBundle\Criteria\GreetCriteria;
use GU\GreetBundle\Entity\Greet;
use GU\GreetBundle\Entity\RSVP;
use GU\GreetBundle\Form\GreetType;
use GU\GreetBundle\Form\RSVPType;
use GU\GreetBundle\Hydrator\GreetCriteriaHydrator;
use GU\GreetBundle\Service\RSVPService;
use GU\GreetBundle\Service\GreetService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;

class GreetController extends BaseController
{
    /**
     *
     * @QueryParam(name="user_id", nullable=true)
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getGreetsAction(ParamFetcher $paramFetcher)
    {
        $greetCriteria = new GreetCriteria();
        $greetCriteriaHydrator = $this->getGreetCriteriaHydrator();
        $greetCriteriaHydrator->hydrate($greetCriteria, $paramFetcher->all());

        $greets = $this->getGreetService()->getGreetsByCriteria($greetCriteria);

        $response = $this->createApiResponse($greets);
        return $response;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getGreetAction(int $id)
    {
        $greetService = $this->getGreetService();
        $greet = $greetService->getGreetById($id);

        if ($greet == null) {
            $this->createNotFoundException("Not found");
        }

        $response = $this->createApiResponse($greet, 201);
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postGreetsAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $greet = new Greet();
        $form = $this->createForm(GreetType::class, $greet);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $greetService = $this->getGreetService();
            $greetService->save($greet);
        }

        $response = $this->createApiResponse($greet, 201);
        return $response;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function putGreetAction(Request $request, int $id)
    {
        $greetService = $this->getGreetService();
        $greet = $greetService->getGreetById($id);

        if ($greet == null) {
            return $this->createNotFoundException("Not found");
        }

        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(GreetType::class, $greet);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $greetService = $this->getGreetService();
            $greetService->save($greet);
        }

        $response = $this->createApiResponse($greet, 201);
        return $response;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteGreetAction(int $id)
    {
        $greetService = $this->getGreetService();
        $greet = $greetService->getGreetById($id);

        if ($greet == null) {
            $this->createNotFoundException("Not found");
        }

        $greetService->remove($greet);

        return new Response(204);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response|NotFoundHttpException
     *
     * @POST("/greets/{id}/actions/rsvp", name="create_rsvp_greet")
     */
    public function createRSVPGreetAction(Request $request, $id)
    {
        $greetService = $this->getGreetService();
        $greet = $greetService->getGreetById($id);

        if ($greet == null) {
            $this->createNotFoundException("Not found");
        }

        $loggedInUser = $this->getLoggedInUser();

        $rsvpService = $this->getRSVPService();
        $existingRSVP = $rsvpService->getRSVPByGreetAndUser($greet, $loggedInUser);

        if ($existingRSVP) {
            $this->createNotFoundException("Existing found");
        }

        $rsvp = new RSVP();
        $rsvp->setUser($loggedInUser);
        $rsvp->setGreet($greet);

        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(RSVPType::class, $rsvp);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $rsvpService->save($rsvp);
        }

        $response = $this->createApiResponse($rsvp);
        return $response;
    }

    /**
     * @param int $id
     * @return Response|NotFoundHttpException
     *
     * @GET("/greets/{id}/actions/rsvp", name="get_rsvps_greet")
     */
    public function getRSVPsGreetAction($id)
    {
        $greetService = $this->getGreetService();
        $greet = $greetService->getGreetById($id);

        if ($greet == null) {
            $this->createNotFoundException("Not found");
        }

        $rsvpService = $this->getRSVPService();
        $rsvps = $rsvpService->getRSVPsByGreet($greet);

        $response = $this->createApiResponse($rsvps);
        return $response;
    }

    /**
     * @return RSVPService
     */
    private function getRSVPService()
    {
        return $this->get('gu.rsvp_service');
    }

    /**
     * @return GreetService
     */
    private function getGreetService()
    {
        return $this->get("gu.greet_service");
    }

    /**
     * @return GreetCriteriaHydrator
     */
    private function getGreetCriteriaHydrator()
    {
        return $this->get("gu.greet_criteria_hydrator");
    }
}