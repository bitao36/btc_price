<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client();
const API_URL="https://api.yadio.io/exrates/USD";

$ok=true;

try {
    
    $response = $client->get(API_URL);
    
    $body = $response->getBody();    

    $contents = $body->getContents();

    $data = json_decode($contents, true);

    $valorBTC = $data['BTC'];    
    $valorCOP = $data['USD']['COP'];
    $valorCOP_format = number_format($data['USD']['COP'],2);
    $valorBTC_COP=number_format($valorBTC*$valorCOP,2);


    $btc_string="Dólares es: $valorBTC USD";
    $cop_string="Pesos es: $valorBTC_COP COP";
    $btc_cop_string="pesos es: $valorCOP_format COP";

} catch (Exception $e) {
    // Manejar cualquier excepción que pueda ocurrir durante la solicitud
    echo 'Error: ' . $e->getMessage();
    $ok=false;
}

?>

<html>
<head>
<title>Valor de Bitcoin</title>
<!-- Centered viewport --> 
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"
/>
</head>
<body>
  <main>
   <?php if ($ok): ?>
    <section style="width: 480px; margin: 0 auto 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; text-align: center;">
      <h3>El precio de 1 Bitcoin  en</h3>
      <p><?= $btc_string ?></p>
      <p><?= $cop_string ?></p>
   
    </section>
   <section style="width: 480px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; text-align: center;">
      <h3>El precio de 1 Dólar en</h3>
      <p><?= $btc_cop_string ?></p>      
    </section>
    <?php else: ?>
    <section style="width: 480px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; text-align: center;">
      
      <p>Ocurrió un error</p>      
    </section>
    <?php endif ?>
  </main>
</body>
</html>