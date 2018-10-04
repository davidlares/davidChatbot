## DavidChatbot

 DavidChatbot es un desarrollo para demostrar el consumo de las APIs de FB Messenger para construir un Chatbot e interactuar con el desde Facebook. Próximamente se agregarán mas features bajo una premisa o necesidad comercial establecida.

## Dependencias

 - PHP Slim Framework
 - Guzzle HTTP Client
 - PHPDotEnv
 - Facebook Application + Facebook Page + Facebook Webhook

##  Despliegue Local

  - Para efectos de pruebas bajo entornos locales https se tiene una alternativa ngrok para hacer un mirroring
    de un servidor local (en este caso LAMP), a una direccion https valida para la validación del Webhook

  - [ngRok](https://ngrok.com) - /.ngrok http 8000

## Suscripción a Mensajes (Eventos)

  - messages
  - messaging_postbacks

## Créditos
- [David E Lares S](https://twitter.com/@davidlares3)

## Licencia

[MIT](https://opensource.org/licenses/MIT)
