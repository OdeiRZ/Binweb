# BinWeb

Aplicación web en PHP que simula una partida de bingo: sortea números y comprueba si el cartón rellenado por el jugador tiene línea o bingo.

## Características

- Sorteo de números del 1 al 90 sin repetición, almacenados en la sesión PHP (`$_SESSION['tombola']`).
- Tabla visual de 90 casillas que marca los números ya salidos y resalta el último número sorteado.
- Cartón de bingo de 3 filas x 9 columnas (15 casillas rellenables) donde el usuario introduce sus números.
- Comprobación del cartón contra los números sorteados, distinguiendo entre "Bingo" (las 3 filas completas), "Línea" (una fila completa) y "Sin premio".
- Reproducción automática de un sonido de victoria o derrota según el resultado de la comprobación.
- Botón "Nuevo Juego" que destruye la sesión actual y empieza una partida desde cero.
- Entorno de desarrollo reproducible con Vagrant (máquina `iesoretania/ubuntu-hlc-php`, IP privada `192.168.33.10`).

## Tecnologías

- PHP (sin framework, sesiones nativas `$_SESSION`)
- HTML5 / CSS3
- Vagrant + VirtualBox (entorno de desarrollo)

## Instalación / Cómo ejecutarlo

**Con Vagrant (recomendado):**
1. Instala [Vagrant](https://www.vagrantup.com/) y [VirtualBox](https://www.virtualbox.org).
2. Desde la raíz del proyecto ejecuta `vagrant up`.
3. Accede a la aplicación en `http://192.168.33.10/`.

**Con un servidor PHP propio:**
1. Sirve la carpeta `public/` con Apache o con el servidor embebido de PHP (`php -S localhost:8000 -t public`).
2. Requiere PHP 5.1 o superior.

Nota del propio autor: proyecto en fase beta, probado solo en entorno local, no pensado para producción.

## Licencia

GPL versión 3 (ver archivo [LICENSE](LICENSE)).
