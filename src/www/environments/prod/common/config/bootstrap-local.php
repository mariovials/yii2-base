<?php

use Transbank\Webpay\WebpayPlus;

/**
 * Configuración del sistema
 */
define('FRONTEND_HOST', 'https://molecvet.cl');
define('BACKEND_HOST', 'https://admin.molecvet.cl');

/**
 * Configuración de Transbank
 */
WebpayPlus::configureForProduction(
  597049028778,
  'e36d115d-bec6-40b4-a3e5-b326e14d4535');
