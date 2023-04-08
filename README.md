# Pet Hero

Nota: utilizamos wampserver (localhost) y phpmyadmin (bbdd) para el funcionamiento de la aplicación.

### Integrantes
* Agustin Lapenna
* Martin Cabrera
* Sofia Belber


#1 NARRATIVA INICIAL

Se requiere realizar una aplicación cuyo modelo de negocio consiste en que personas puedan brindar el servicio del cuidado de perros. Dicho cuidado se trata de una
estadía corta a cambio de una remuneración. 

Los usuarios que se registren como Keepers, tienen un perfil en el sitio donde exponen que tipo de perro están dispuestos a cuidar (pequeño, mediano o grande) y la remuneración esperada por la estadía.

Por otro lado, existe el tipo de usuario Owner que registra un nuevo perfil en la aplicación y será quien contrate el servicio de los Keepers. Los Owners deberán crearle un perfil a cada perro que poseen. Por cada perfil de mascota, deben cargar: una foto, raza, tamaño, plan de vacunación (como imagen) y observaciones generales de la misma. La aplicación también brinda la oportunidad de subir un video del perro.

La aplicación les permite a los usuarios Keepers, definir los días específicos que cuentan con disponibilidad para el cuidado de perros. Esta información será de utilidad para los Owners al momento de reservar el servicio. Con motivo de seguridad para las mascotas, un Keeper solamente puede cuidar a un perro por estadía.

Cuando un Owner selecciona un Keeper de su agrado, se generará una reserva en el sistema entre las fechas que requiere. El Keeper en cuestión, deberá aceptar o rechazar esta nueva reserva. En caso de que la reserva sea aceptada por el Keeper, se envía un cupón de pago al Owner con el 50% del costo del total de la estadía. Al momento de efectuar el pago, la reserva queda confirmada.

#2 SEGUNDA NARRATIVA

Nuevos requisitos agregados:

● Al tener un caso exitoso de desarrollo, se generarán nuevas validaciones para la aplicación:
● La aplicación ahora permite el cuidado de gatos. El perfil de un gato es exactamente igual al de un perro. Permitiendo cargar: una foto, raza, tamaño, plan de vacunación (como imagen), observaciones generales y un video (opcional).
● Todos los Keepers están habilitados a cuidar tanto Gatos como Perros.
● Se le habilita a un Keeper cuidar más de una mascota por estadía pero con una condición. No se puede cuidar mascotas de distinta especie en el mismo día.

Requisitos no funcionales:

● Programación en capas de la aplicación respetando la arquitectura de 3 capas lógicas vista durante la cursada. Esto implica el desarrollo de las clases que representen las entidades del modelo y controladoras de los casos de uso, las vistas y la capa de acceso a datos.
● Utilización de versionado de código para el desarrollo

#3 NARRATIVA FINAL

Se agregan los siguientes requisitos (RF) a desarrollar:

● A modo de agregar una comunicación directa entre Owners y Keepers, se generará un chat donde podrán dialogar sin restricciones.
● El cupón de pago para un Owner deberá ser enviado por mail.


SINTESIS REQUISITOS FUNCIONALES

Primera revisión:

RF1 - Ingresando nuevo Owner en la aplicación.
RF2 - Ingresando nueva mascota en la aplicación.
RF3 - Consultando mi listado de mascotas (Owner).
RF4 - Ingresar nuevo Keeper.
RF5 - Un Keeper podrá indicar la disponibilidad de estadías.
RF6 - Consultar listado de Keepers cómo Owner.

Segunda revisión:

RF7 - Consultando disponibilidad de Keepers en un rango de fechas
RF8 - Generando nueva reserva desde un Owner a un Keeper
RF9 - Consultando mis reservas programadas e históricas como Keeper
RF10 - Confirmando reserva como Keeper. Se agrega la validación de la raza por estadía.
RF11 - Ingresando nuevo gato (Owner)

Tercera revisión:

RF11 - Generando nuevo cupón de Pago para un Owner.
RF12 - Simulación de pago de cupón (confirmación de reserva).
RF13 - Chat entre Owner y Keeper.
RF14 - Enviando cupón de pago por mail.
