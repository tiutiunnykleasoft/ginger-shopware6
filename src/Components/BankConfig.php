<?php
namespace GingerPlugin\Components;

use GingerPlugin\Components\GingerConfig;

class BankConfig extends GingerConfig
{
    const PAYMENT_METHODS_PREFIX = "Ginger Payments";
    const FILE_PREFIX = "ginger_payments";
    const API_ENDPOINT = 'https://api.dev.gingerpayments.com/';
    const PLUGIN_TECH_PREFIX = 'gingerpay';
    const PLUGIN_NAME = 'ginger-payments';
}