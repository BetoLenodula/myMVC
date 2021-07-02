<?php
  //nombre de dominio
  define("DOMAIN", "localhost");

  //constantes de email SMTP
  define("EMAIL", "@".DOMAIN);

  define("EMAIL_PORT", ":25");

  define("EMAIL_HOST", DOMAIN.EMAIL_PORT);

  define("EMAIL_PASSWORD", "");

  //constantes de entorno
  define("PROTOCOL", "http");

	define("DS", DIRECTORY_SEPARATOR);

	define("ROOT", realpath(dirname(__FILE__)."/..").DS);

	define("URL", PROTOCOL."://".DOMAIN."/");

	define("DEFAULT_CONTROLLER", "indexes");

	define("DEFAULT_METHOD", "index");

 ?>
