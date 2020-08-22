El Patrón Strategy define una familia de algoritmos, encapsula cada uno y luego los hace intercambiables. Esto se logra utilizando polimorfismo y nos permite desarrollar un sistema más flexible, puesto que, por ejemplo, agregar comportamientos adicionales no requerirá cambiar clases ya existentes en el sistema. En esta lección vamos a aplicar el Patrón Strategy en nuestro ejemplo, para ello utilizaremos diversos métodos de Refactorización y nos apoyaremos en las pruebas automatizadas escritas previamente con PHPUnit.

## Aplicación
Considera utilizar Strategy cuando requieras de varias maneras diferentes 
de lograr un mismo resultado o comportamiento, cuando tengas una clase 
que defina varios comportamientos diferentes separados por condicionales o 
cuando requieras reutilizar o combinar varios comportamientos en clases diferentes.

## Participantes del Patrón Strategy
 - **Strategy:** Interfaz o clase abstracta común, en el ejemplo es la clase abstracta ```Transport```
 - **Concrete Strategy:** Implementación concreta de Strategy, en el ejemplo son las clases ```ArrayTransport```, ```FileTransport``` y ```SmtpTransport```.
 - **Context:** clase configurada con una estrategia concreta, en el ejemplo es la clase ```Mailer```.
 - **Client:** clase que usa el contexto con una estrategia concreta, en el ejemplo el cliente vendría siendo las pruebas unitarias pero también podrían ser los controladores y el resto de la aplicación.

## Interacción entre objetos
- El Contexto pasa toda la data requerida a la estrategia en tiempo de ejecución, alternativamente el contexto puede pasarse a sí mismo (Mailer pasado a Transport), en caso de que se requiera pasar demasiada información del Contexto a la Estrategia.
- El Contexto redirige las llamadas de un método desde el Cliente a la Estrategia. Por ejemplo cada vez que se llama a $mail->send() en la prueba, se está llamando a $transport->send()
- El Cliente pasa una Estrategia Concreta al Contexto new Mailer(new SmtpTransport) y a partir de allí solo interactúa con el Contexto ($mail->send()). Es decir una vez creada la clase Mailer con el Transporte deseado, ya no volveremos a interactuar con el Transporte, solo con la clase Mailer.
- El Cliente puede elegir entre diferentes estrategias concretas (ArrayTransport, SmtpTransport, etc.)

## Pros de aplicar Strategy
Nos ayuda a eliminar lógica condicional
Nos ayuda a simplificar una clase moviendo parte de su funcionalidad a otras clases
Permite que un algoritmo pueda ser reemplazado por otro en tiempo de ejecución. En el ejemplo no hemos visto esto pero podríamos haber definido un método llamado setTransport en la clase Mailer para reemplazar un transporte por otro en cualquier momento.
Permite restringir el acceso de cierta información a determinadas clases, por ejemplo los datos para conectarse a SMTP ahora solamente se encuentran en la estrategia concreta SmtpTransport y son pasados desde el Cliente (nuestra prueba unitaria) pero ya no están dentro de la clase Mailer.
Te permite reutilizar las estrategias concretas en otras clases, por ejemplo, imagina que ahora requerimos crear una clase para enviar mensajes de Marketing o correos en lote, podríamos volver a usar los transportes que ya tenemos:
new BulkMailer(new SmtpTransport($credentials_here));
new CampaignMailer(new MailChimp($credentials_here));
Lograr lo anterior con herencia sería muy engorroso y llevaría a código repetitivo, por ejemplo LogBulkMailer, SmtpBulkMailer, MailChimpCampaignMailer, MailgunCampaignMailer.

## Contras de aplicar Strategy
Puede complicar un diseño de manera innecesaria, antes de aplicar Strategy piensa si aplicar herencia simple sería suficiente.
Además Strategy rompe el principio de OOP de combinar datos y métodos en una sola clase, puesto que ahora la clase Strategy utiliza data que se encuentra en el Contexto.
Conclusión
Strategy nos permite identificar los aspectos de nuestra aplicación que varían y separarlos de las partes comunes. Strategy favorece la composición sobre la herencia y nos p