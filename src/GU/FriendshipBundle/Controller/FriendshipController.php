<?php

namespace GU\FriendshipBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
use FOS\UserBundle\Model\UserManager;
use GU\BaseBundle\Controller\BaseController;
use GU\FriendshipBundle\Entity\Friendship;
use GU\FriendshipBundle\Form\FriendshipType;
use GU\FriendshipBundle\Service\FriendshipService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FriendshipController extends BaseController
{
    /**
     * @QueryParam(name="user_id", nullable=false)
     *
     * @param ParamFetcher $paramFetcher
     */
    public function getFriendshipsAction(ParamFetcher $paramFetcher)
    {
        $userId = $paramFetcher->get('user_id');

        $userManager = $this->getUserManger();
        $user = $userManager->findUserBy(['id' => $userId]);

        if ($user == null) {
            // throw not found exception @todo
        }

        $friendshipService = $this->getFriendshipService();
        $friendShips = $friendshipService->getAllFriendsForUser($user);

        $response = $this->createApiResponse($friendShips);
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postGreetsAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $friendship = new Friendship();
        $form = $this->createForm(FriendshipType::class, $greet);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $friendshipService = $this->getFriendshipService();
            $friendshipService->save($friendship);
        }

        $response = $this->createApiResponse($friendship, 201);
        return $response;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function putGreetAction(Request $request, int $id)
    {
        $friendshipService = $this->getFriendshipService();
        $friendship = $friendshipService->getFriendshipById($id);

        if ($friendship == null) {
            return $this->createNotFoundException("Not found");
        }

        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(FriendshipType::class, $greet);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $friendshipService->save($greet);
        }

        $response = $this->createApiResponse($greet, 201);
        return $response;
    }

    /**
     * @return UserManager
     */
    private function getUserManger()
    {
        return $this->get('fos_user.user_manager');
    }

    /**
     * @return FriendshipService
     */
    private function getFriendshipService()
    {
        return $this->get('gu.friendship_service');
    }
}