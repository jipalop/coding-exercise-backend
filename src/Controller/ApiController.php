<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Rest\Get("/v1/recipe/{search}.{_format}", name="recipe_list", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets recipes based on passed search parameter."
     * )
     *
     *
     * @SWG\Parameter(
     *     name="search",
     *     in="path",
     *     type="string",
     *     description="The search string"
     * )
     *
     *
     * @SWG\Tag(name="Recipe")
     * @param Request $request
     * @param $search
     * @return Response
     */
    public function getRecipeAction(Request $request, $search)
    {
        $serializer = $this->get('jms_serializer');
        $client = new Client();
        $code = 200;
        $error = false;
        $message = '';
        $dataJson = '';
        $dataArray = array();

        try {
            $uri = 'http://www.recipepuppy.com/api/?q=' . $search;
            $res = $client->request('GET', $uri);
            $dataJson = $res->getBody()->getContents();
            $dataArray = json_decode($dataJson, true);

        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get the recipes - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $dataArray['results'] : $message,
        ];

        return new Response($serializer->serialize($response, 'json'));
    }
}
