<?php return array (
  'ajthinking/tinx' => 
  array (
    'providers' => 
    array (
      0 => 'Ajthinking\\Tinx\\TinxServiceProvider',
    ),
  ),
  'barryvdh/laravel-cors' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Cors\\ServiceProvider',
    ),
  ),
  'barryvdh/laravel-dompdf' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\DomPDF\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'PDF' => 'Barryvdh\\DomPDF\\Facade',
    ),
  ),
  'beyondcode/laravel-dump-server' => 
  array (
    'providers' => 
    array (
      0 => 'BeyondCode\\DumpServer\\DumpServerServiceProvider',
    ),
  ),
  'cartalyst/sentinel' => 
  array (
    'providers' => 
    array (
      0 => 'Cartalyst\\Sentinel\\Laravel\\SentinelServiceProvider',
    ),
    'aliases' => 
    array (
      'Activation' => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Activation',
      'Reminder' => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Reminder',
      'Sentinel' => 'Cartalyst\\Sentinel\\Laravel\\Facades\\Sentinel',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/nexmo-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\NexmoChannelServiceProvider',
    ),
  ),
  'laravel/passport' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Passport\\PassportServiceProvider',
    ),
  ),
  'laravel/slack-notification-channel' => 
  array (
    'providers' => 
    array (
      0 => 'Illuminate\\Notifications\\SlackChannelServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'nwidart/laravel-modules' => 
  array (
    'providers' => 
    array (
      0 => 'Nwidart\\Modules\\LaravelModulesServiceProvider',
    ),
    'aliases' => 
    array (
      'Module' => 'Nwidart\\Modules\\Facades\\Module',
    ),
  ),
);