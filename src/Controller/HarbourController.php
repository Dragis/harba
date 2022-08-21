<?php

namespace App\Controller;

use App\Entity\Harbour;
use App\Repository\HarbourRepository;
use http\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HarbourController extends AbstractController
{
    public function __construct(
        private HarbourRepository $harbourRepository,
        private ParameterBagInterface $parameterBag,
        private HttpClientInterface $httpClient,
    ) {
    }

    #[Route('/harbours', name: 'get_harbours', methods: ['GET'])]
    public function getCollection(Request $request): JsonResponse
    {
        $allHarbours = $this->harbourRepository->findAll();

        foreach ($allHarbours as $harbour) {
            $harboursArray[] = [
                'name' => $harbour->getName(),
                'image' => $harbour->getImage(),
                'url' => sprintf('%s/%s', $request->getUri(), $harbour->getId())
            ];
        }

        return new JsonResponse($harboursArray ?? null, Response::HTTP_OK);
    }

    #[Route('/harbours/{id}', name: 'get_harbour', methods: ['GET'])]
    public function getItem(int $id): JsonResponse
    {
        $harbour = $this->harbourRepository->find($id);
        $weatherData = $this->getWeatherData($harbour);

        $response = [
            'name' => $harbour->getName(),
            'temperature' => $weatherData['main']['temp'],
            'weatherProvider' => 'Open weather map',
        ];

        return new JsonResponse($response, Response::HTTP_OK);
    }

    private function getWeatherData(Harbour $harbour): array
    {
        $openWeatherApiKey = $this->parameterBag->get('open_weather_api_key');

        if ('cahnge_me' === $openWeatherApiKey) {
            throw new InvalidArgumentException('Configure the open weather api key in .env.local');
        }

        $url = sprintf(
            'https://api.openweathermap.org/data/2.5/weather?lat=%s&lon=%s&appid=%s',
            $harbour->getLat(),
            $harbour->getLon(),
            $openWeatherApiKey,
        );

        $response = $this->httpClient->request(Request::METHOD_GET, $url);

        return json_decode($response->getContent(), true);
    }
}
