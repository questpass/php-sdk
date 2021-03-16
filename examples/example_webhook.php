<?php
ini_set('display_errors', 1);

include './vendor/autoload.php';

use Questpass\SDK\Content;
use Questpass\SDK\InMemoryStorage;
use Questpass\SDK\CurlHttpClient;
use Questpass\SDK\PositioningSettings;
use Questpass\SDK\ElementsContextProvider;

const API_URL = 'https://api.questpass.com/v1/publishers/services/';
const SERVICE_UUID = '__paste Service UUID here__';

$options = [
    'status' => 0,
    'subscription' => 0,
    'hasActiveCampaigns' => 0,
];
// dummy update_option and get_option implementation
// should persist option values
function update_option($name, $value) {
    global $options;
    $options[$name] = $value;
}
// should return array of Questpass service options
function get_options() {
    global $options;
    return $options;
}

// basic webhook endpoint example
$response = ['status' => 'OK'];
$action = isset($_POST['action']) ? strtolower($_POST['action']) : null;

switch ($action) {
    case 'questo_update_service_status_option':
    case 'questo_update_subscription_option':
        $service = new \Questpass\SDK\Service(
            new \Questpass\SDK\ServiceAPIUrl(API_URL, SERVICE_UUID),
            new CurlHttpClient
        );
        $serviceStatusResponse = $service->fetchStatus();
        if (!$serviceStatusResponse) {
            $response = [
                'status' => 'ERROR',
                'error' => 'Status fetch failed'
            ];
            break;
        }
        foreach (get_options() as $optionName => $optionValue) {
            update_option($optionName, (int)$serviceStatusResponse[$optionName]);
        }
        $response['options'] = get_options();
        break;
    case 'questo_force_update_javascript':
        $questpass = new Content(
            API_URL,
            SERVICE_UUID,
            new InMemoryStorage,
            new CurlHttpClient,
            PositioningSettings::factory(PositioningSettings::STRATEGY_UPPER)
        );
        try {
            $javascript = $questpass->requestJavascript(true);
        } catch (\Exception $e) {
            $response = [
                'status' => 'ERROR',
                'error' => 'Javascript fetch failed: ' . $e->getMessage()
            ];
            break;
        }
        $questpass->getStorage()->set($javascript);
        break;
    default:
        $response = [
            'status' => 'ERROR',
            'error' => 'Unsupported action'
        ];
}

header('Content-Type: application/json');
echo json_encode($response);
