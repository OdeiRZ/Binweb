BinWeb 0.9
================================

Aplicación web que simula el funcionamiento de un bingo, generando múmeros y comprobando correspondencias
(aún en modo beta, no está lista para producción). Desplegada en fase de pruebas unicamente en 
un equipo local.

Desde ella se podrán generar números aleatorios, comprobar sus correspondencias, crear nuevas partidas, etc.,
añadiendo además efectos interactivos como reproducción de sonidos, estilos varios, etc., 
para una interación con el usuario más satisfactoria.

Para facilitar el desarrollo se proporciona un entorno [Vagrant] con todas las dependencias ya instaladas.

## Requisitos
- PHP 5.1 o superior
- Servidor web Apache2 (podría funcionar con nginx, pero no se ha probado)

## Entorno de desarrollo
Para poder ejecutar la aplicación en un entorno de desarrollo basta con tener [Vagrant] instalado junto con [VirtualBox]
y ejecutar el comando `vagrant up`. La aplicación será accesible desde la dirección http://192.168.33.10/

## Licencia
Esta aplicación se ofrece bajo licencia [AGPL versión 3].

[Vagrant]: https://www.vagrantup.com/
[VirtualBox]: https://www.virtualbox.org
[AGPL versión 3]: http://www.gnu.org/licenses/agpl.html
