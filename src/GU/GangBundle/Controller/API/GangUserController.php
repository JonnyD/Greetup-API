<?php

namespace GU\GangBundle\Controller\API;

use GU\BaseBundle\Controller\BaseController;
use GU\GangBundle\Form\GangUserType;
use GU\GangBundle\Service\GangUserService;
use Symfony\Component\HttpFoundation\Request;

class GangUserController extends BaseController
{
    /**
     * @param Request $request
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function putAction(Request $request, int $id)
    {
        $gangUserService = $this->getGangUserService();
        $gangUser = $gangUserService->getGangUserById($id);

        if ($gangUser == null) {
            return $this->createNotFoundException("Not found");
        }

        $data = json_decode($request->getContent(), true);

        $form = $this->createForm(GangUserType::class, $gang);
        $form->submit($data);

        if ($form->isSubmitted()) {
            $gangUserService->save($gang);
        }

        $response = $this->createApiResponse($gangUser);
        return $response;
    }

    /**
     * @return GangUserService
     */
    private function getGangUserService()
    {
        return $this->get('gu.gang_user_service');
    }
}