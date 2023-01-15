<?php
namespace App\Controller;

use App\Entity\ApiQuery;
use App\Helper\StackexchangeHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class QuestionsController extends AbstractController
{
    private StackexchangeHelper $stackexchangeHelper;
    private string $url;

    public function __construct(StackexchangeHelper $stackexchangeHelper)
    {
        $this->stackexchangeHelper = $stackexchangeHelper;
        $this->url = 'questions';
    }

    /**
     * @Route("/questions", name="get_questions")
     */
    public function getQuestions(Request $request, ValidatorInterface $validator): Response
    {

        // Validación con entity
        $data = $request->query->all();
        $apiQueryData = new ApiQuery($data);
        
        $errors = $validator->validate($apiQueryData);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return $this->json([
                        'status'  => 'error',
                        'message' => $errorsString
                    ], 422);
        }
        
        
        // En caso de recibir otro formato de fecha habría que pasar a timestamp antes de hacer la llamada, no está especificado

        $response =$this->stackexchangeHelper->getData($this->url, $request->query->all()); // Pasa la url de la api y todos los paràmetros que llegan a la petición por url
       return new JsonResponse($response, $response ? 200 : 500, ["Content-Type" => "application/json"]);

    }
}