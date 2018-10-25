<?php

namespace GU\GangBundle\Controller\API;

use GU\BaseBundle\Controller\BaseController;
use GU\GangBundle\Entity\Gang;
use GU\GangBundle\Entity\GangUser;
use GU\GangBundle\Entity\JoinRequest;
use GU\GangBundle\Enum\Role;
use GU\GangBundle\Form\GangType;
use GU\GangBundle\Service\GangService;
use GU\GangBundle\Service\GangUserService;
use GU\GangBundle\Service\JoinRequestService;
use GU\GangBundle\Specification\CanViewGang;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;

class GangController extends BaseController
{
    /**
     * @return Response
     */
    public function getGangsAction()
    {
        $gangService = $this->getGangService();
        $gangs = $gangService->getGangsWithinRadius(55.55555, 56.55555, 25);

        $canViewGangSpecification = $this->getCanViewGangSpecification();

        $gangsThatCanBeViewed = [];
        foreach ($gangs as $gang) {
            if ($canViewGangSpecification->isSatisfiedBy($gang)) {
                $gangsThatCanBeViewed[] = $gang;
            }
        }

        $response = $this->createApiResponse($gangsThatCanBeViewed);
        return $response;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getGangAction(int $id)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        $response = $this->createApiResponse($gang);
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postGangsAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $gang = new Gang();
        $form = $this->createForm(GangType::class, $gang);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $gangService = $this->getGangService();
            $gangService->save($gang);

            $gangUser = new GangUser();
            $gangUser->setUser($this->getLoggedInUser());
            $gangUser->setGang($gang);
            $gangUser->setRole(Role::FOUNDER);

            $gangUserService = $this->getGangUserService();
            $gangUserService->save($gangUser);
        }

        $response = $this->createApiResponse($gang);
        return $response;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response|NotFoundHttpException
     */
    public function putGangAction(Request $request, int $id)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        if ($gang == null) {
            return $this->createNotFoundException("Not found");
        }

        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(GangType::class, $gang);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $gangService = $this->getGangService();
            $gangService->save($gang);
        }

        $response = $this->createApiResponse($gang);
        return $response;
    }

    /**
     * @param int $id
     * @return Response|NotFoundHttpException
     *
     * @POST("/gangs/{id}/actions/join", name="join_gang")
     */
    public function joinGangAction(int $id)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        if ($gang == null) {
            return $this->createNotFoundException("Not found");
        }

        $loggedInUser = $this->getLoggedInUser();

        $gangUserService = $this->getGangUserService();
        $gangUser = $gangUserService->getGangUserByGangAndUser($gang, $loggedInUser);

        if ($gangUser != null) {
            return $this->createNotFoundException("You are already a member");
        }

        $joinRequestService = $this->getJoinRequestService();
        $joinRequest = $joinRequestService->getJoinRequestByGangAndUser($gang, $loggedInUser);

        if ($joinRequest != null) {
            return $this->createNotFoundException("You already requested to join this gang");
        }

        $joinRequest = new JoinRequest();
        $joinRequest->setGang($gang);
        $joinRequest->setUser($loggedInUser);

        $response = $this->createApiResponse($joinRequest);
        return $response;
    }

    /**
     * @param int $id
     * @param int $joinRequestId
     * @return Response|NotFoundHttpException
     *
     * @POST("/gangs/{id}/actions/accept-join-request/{join_request_id}", name="accept-join-request")
     */
    public function acceptJoinRequestAction(int $id, int $joinRequestId)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        if ($gang == null) {
            return $this->createNotFoundException("Not found");
        }

        $joinRequestService = $this->getJoinRequestService();
        $joinRequest = $joinRequestService->getJoinRequestById($joinRequestId);

        if ($joinRequest == null) {
            return $this->createNotFoundException("Not found");
        }

        $gangUserService = $this->getGangUserService();
        $gangUser = $gangUserService->getGangUserByGangAndUser($joinRequest->getGang(), $joinRequest->getUser());

        if ($gangUser != null) {
            return $this->createNotFoundException("User is already a member");
        }

        $gangUser = new GangUser();
        $gangUser->setGang($joinRequest->getGang());
        $gangUser->setUser($joinRequest->getUser());
        $gangUser->setRole(Role::USER);

        $gangUserService->save($gangUser);
        $joinRequestService->remove($joinRequest);

        $response = $this->createApiResponse($joinRequest);
        return $response;
    }

    /**
     * @param int $id
     * @param int $joinRequestId
     * @return Response|NotFoundHttpException
     *
     * @POST("/gangs/{id}/actions/reject-join-request/{join_request_id}", name="reject-join-request")
     */
    public function rejectJoinRequestAction(int $id, int $joinRequestId)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        if ($gang == null) {
            return $this->createNotFoundException("Not found");
        }

        $joinRequestService = $this->getJoinRequestService();
        $joinRequest = $joinRequestService->getJoinRequestById($joinRequestId);

        if ($joinRequest == null) {
            return $this->createNotFoundException("Not found");
        }

        $gangUserService = $this->getGangUserService();
        $gangUser = $gangUserService->getGangUserByGangAndUser($joinRequest->getGang(), $joinRequest->getUser());

        if ($gangUser != null) {
            return $this->createNotFoundException("User is already a member");
        }

        $joinRequestService->remove($joinRequest);

        $response = $this->createApiResponse($joinRequest);
        return $response;
    }

    /**
     * @param int $id
     * @return Response|NotFoundHttpException
     *
     * @POST("/gangs/{id}/actions/leave", name="leave_gang")
     */
    public function leaveGangAction(int $id)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        if ($gang == null) {
            return $this->createNotFoundException("Not found");
        }

        $loggedInUser = $this->getLoggedInUser();

        $gangUserService = $this->getGangUserService();
        $gangUser = $gangUserService->getGangUserByGangAndUser($gang, $loggedInUser);

        if ($gangUser == null) {
            return $this->createNotFoundException("Not found");
        }

        $gangUserService->remove($gangUser);

        return new Response(204);
    }

    /**
     * @param int $id
     * @return Response|NotFoundHttpException
     *
     * @GET("/gangs/{id}/actions/listMembers", name="list_members_gang")
     */
    public function listMembersAction(int $id)
    {
        $gangService = $this->getGangService();
        $gang = $gangService->getGangById($id);

        if ($gang == null) {
            return $this->createNotFoundException("Not found");
        }

        $gangUserService = $this->getGangUserService();
        $gangUsers = $gangUserService->getGangUsersByGang($gang);

        $response = $this->createApiResponse($gangUsers);
        return $response;
    }

    /**
     * @return GangUserService
     */
    private function getGangUserService()
    {
        return $this->get('gu.gang_user_service');
    }

    /**
     * @return GangService
     */
    private function getGangService()
    {
        return $this->get('gu.gang_service');
    }

    /**
     * @return JoinRequestService
     */
    private function getJoinRequestService()
    {
        return $this->get('gu.join_request_service');
    }

    /**
     * @return CanViewGang
     */
    private function getCanViewGangSpecification()
    {
        return $this->get('gu.can_view_gang_specification');
    }
}