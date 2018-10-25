<?php

namespace GU\UserBundle\Controller\API;

use FOS\UserBundle\Model\UserManager;
use GU\BaseBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    /**
     * @return Response
     */
    public function getUsersAction()
    {
        $data = $this->getUserManger()->findUsers();

        $response = $this->createApiResponse($data);
        return $response;
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getUserAction(int $id)
    {
        $data = $this->getUserManger()->findUserBy(['id' => $id]);

        $response = $this->createApiResponse($data);
        return $response;
    }

    /**
     * @return UserManager
     */
    private function getUserManger()
    {
        return $this->get('fos_user.user_manager');
    }
}