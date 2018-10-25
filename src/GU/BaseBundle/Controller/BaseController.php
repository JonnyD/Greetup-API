<?php

namespace GU\BaseBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use GU\UserBundle\Entity\User;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends FOSRestController
{
    /**
     * @param $data
     * @param int $statusCode
     * @return Response
     */
    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->serialize($data);

        return new Response($json, $statusCode, array(
            'Content-Type' => 'application/json'
        ));
    }

    /**
     * @param $data
     * @param string $format
     * @return mixed
     */
    protected function serialize($data, $format = 'json')
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        return SerializerBuilder::create()->build()->serialize($data, $format, $context);
    }

    /**
     * @return User
     */
    protected function getLoggedInUser()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
}