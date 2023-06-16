<?php

namespace App\Controller;

use App\Entity\Bicycle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BicycleController extends AbstractController
{
    /**
     * @Route("/bike", name="bicycle")
     */
    public function index(Request $request): Response
    {
        $theme = $request->query->get('theme', 'light');
        $color = $request->query->get('color', 'Red');
        $brand = $request->query->get('brand', 'Brand X');
        $status = $request->query->get('status', 'Running');
        $currentSpeed = ($status === 'Stopped') ? 0 : $request->query->getInt('currentSpeed', 5);
        $accelerateStatus = $request->query->get('accelerateStatus', 'Deceleration');
        $geolocation = $request->query->get('geolocation');

        $bicycle = new Bicycle($color, $brand, $currentSpeed, $geolocation);
        $bicycle->setStatus($status);
        $bicycle->setAccelerateStatus($accelerateStatus);
        $bicycle->updateSpeed();

        return $this->render('bicycle.html.twig', [
            'bicycle' => [
                'theme' => $theme,
                'color' => $bicycle->getColor(),
                'brand' => $bicycle->getBrand(),
                'status' => $bicycle->getStatus(),
                'currentSpeed' => $bicycle->getCurrentSpeed(),
                'accelerateStatus' => $bicycle->getAccelerateStatus(),
                'geolocation' => $bicycle->getGeolocation(),
            ],
        ]);
    }
}
