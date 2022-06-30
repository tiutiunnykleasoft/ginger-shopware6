<?php declare(strict_types=1);

namespace GingerPlugin\Controller\Api;

use GingerPlugin\Components\BankConfig;
use GingerPlugin\Components\Redefiner;
use Shopware\Core\Framework\Validation\DataBag\RequestDataBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

# don't remove this 2 uses, important for shopware classes!
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"administration"})
 */
class ApiTestController
{
    private $client;

    public function __construct(Redefiner $redefiner)
    {
        $this->client = $redefiner;
    }

    /**
     * @Route(path="/api/_action/gingerpay/verify", methods={"POST"})
     */
    public function check(RequestDataBag $dataBag): JsonResponse
    {
        $success = true;
        $key = implode('.',[BankConfig::PLUGIN_TECH_PREFIX,"config","GingerAPIKey"]);
        if (!$dataBag->has($key)) {
            $success = false;
            return new JsonResponse(['success' => $success]);
        }

        try {
            $apiKey = $dataBag->get($key);
            $ginger_client = $this->client->getGingerClient($apiKey);
            $ginger_client->getIdealIssuers();
        } catch (\Exception $exception) {
            $success = false;
            return new JsonResponse(['success' => $success]);
        }
        return new JsonResponse(['success' => $success]);
    }
}
