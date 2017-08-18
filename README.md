BinWeb 0.92
================================

Aplicación web que simula el funcionamiento de un bingo, generando múmeros y comprobando correspondencias
(aún en modo beta, no está lista para producción). Desplegada en fase de pruebas unicamente en 
un equipo local.

Desde ella se podrán generar números aleatorios, comprobar sus correspondencias, crear nuevas partidas, etc.,
añadiendo además efectos interactivos como reproducción de sonidos, estilos varios, etc., 
para una interacción con el usuario más satisfactoria.

Para facilitar el desarrollo se proporciona un entorno [Vagrant] con todas las dependencias ya instaladas.

## Requisitos
- PHP 5.1 o superior
- Navegador Web [Chrome], [Firefox], [Opera], [Microsoft Edge], etc..
- Servidor web Apache2 (podría funcionar con nginx, pero no se ha probado)

## Entorno de desarrollo
Para poder ejecutar la aplicación en un entorno de desarrollo basta con tener [Vagrant] instalado junto con [VirtualBox]
y ejecutar el comando `vagrant up`. La aplicación será accesible desde la dirección http://192.168.33.10/.

## Licencia
Esta aplicación se ofrece bajo licencia [GPL versión 3].

[Vagrant]: https://www.vagrantup.com/
[VirtualBox]: https://www.virtualbox.org
[Chrome]: https://www.google.es/chrome/browser/desktop/index.html
[Firefox]: https://www.mozilla.org/es-ES/firefox/new/
[Opera]: http://www.opera.com/es
[Microsoft Edge]: https://www.microsoft.com/es-es/windows/microsoft-edge
[GPL versión 3]: https://www.gnu.org/licenses/gpl-3.0.en.html
