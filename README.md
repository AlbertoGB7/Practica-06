# # Alberto González Benítez, 2n DAW, Pràctica 06 - APIRest, Ajax i codis QR

## Enllaç al Projecte

Accedeix al projecte [aquí](https://agonzalez.cat/Practica-06/):

## Usuari de Prova (Es admin)
- **Usuari**: Xavi
- **Correu**: xmartin@sapalomera.cat
- **Contrasenya**: P@ssw0rd

## Usuari normal:
- **Usuari**: Alberto
- **Correu**: alberto.gb222@gmail.com
- **Contrasenya**: P@ssw0rd

## Descripció
Aquest projecte és una aplicació web que permet als usuaris gestionar articles, compartir-los mitjançant codis QR i interactuar amb una API REST. A més, inclou una integració amb l'API oficial de Clash of Clans per mostrar informació sobre clans i jugadors.

## Temàtica
La temàtica del projecte està inspirada en el videojoc **Clash of Clans**.

## 🔥 Noves Funcionalitats Implementades (Part 6)

### 🏷️ Articles Compartits (AJAX i Fetch Automàtic)

S'ha afegit una nova opció en el navbar per accedir a la secció d'Articles Compartits.

Aquesta vista es carrega automàticament amb un fetch AJAX, que consulta la base de dades en temps real.

Cada article compartit té un botó de copiar, que permet editar-lo i guardar-lo en el perfil de l'usuari loguejat.

#### 📂 Fitxers involucrats:
- `Vistes/vistaAjax.php`
- `Controlador/controladorAjax.php`

### 📥 Copiar Articles Compartits (`copiarAjax.php`)

Quan un usuari vol copiar un article compartit, es redirigeix a una nova vista (`copiarAjax.php`).

En aquesta vista, l'usuari pot modificar el contingut de l'article abans de guardar-lo al seu perfil.

#### 📂 Fitxers involucrats:
- `Vistes/copiarAjax.php`
- `Controlador/controladorAjax.php`

### 📲 Generació i Descàrrega de Codis QR

Cada article creat per un usuari té una opció per generar un codi QR.

Aquest QR conté informació bàsica de l'article (titol i cos) i pot ser descarregat en format PNG.

#### 📂 Fitxers involucrats:
- `qr-code/qr_generar.php`

### 📤 Lectura de Codis QR

Al navbar, s'ha afegit una opció de Lectura QR, on es pot pujar un fitxer per llegir-lo.

Una vegada llegit, l'article es guarda automàticament a la secció d'Articles Compartits.

#### 📂 Fitxers involucrats:
- `Vistes/lectura_qr.php`
- `Controlador/procesar_qr.php`

### 🌐 Creació d'una API REST

S'ha creat una API REST per gestionar articles de manera estructurada.

Permet operacions CRUD (Create, Read, Update, Delete).

Per fer peticions, s'ha d'usar Postman o un altre client HTTP amb una URL similar a:

http://localhost/Practiques/Practica-06/api/api.php/articles

(Cadascú ha d'adaptar la ruta segons on tingui el projecte.)

#### 📂 Fitxers involucrats:
- `api/api_controlador.php`
- `api/api.php`

### ⚔️ Lectura de l'API Oficial de Clash of Clans

Al navbar, s'ha afegit una opció de Lectura API.

Es fa una petició a l'API oficial de Clash of Clans per mostrar:

- Informació d'un clan.
- Perfil d'un jugador.

⚠️ **Nota:** Aquesta funcionalitat pot donar errors si no es configura correctament la API de Clash of Clans.  
Per poder provar-la, cal accedir a la web oficial de la **API de Clash of Clans**, afegir la **IP pública** i copiar el **token** generat. Després, cal substituir aquest token en el següent fitxer:
- `Controlador/lectura_api_controlador.php`

Si no es vol fer aquesta configuració manual, es pot veure un exemple funcional en aquesta web:  
🔗 [https://agonzalez.cat/Practica-06/](https://agonzalez.cat/Practica-06/)

#### 📂 Fitxers involucrats:
- `Vistes/lectura_api.php`
- `Controlador/lectura_api_controlador.php`

## 🛠️ Tecnologies Utilitzades

- **PHP** per la lògica del servidor.
- **JavaScript** (AJAX, Fetch) per interaccions dinàmiques.
- **HTML & CSS** per l'estructura i el disseny.
- **MySQL** per l'emmagatzematge de dades.
- **API Clash of Clans** per obtenir dades externes.

## 📌 Com Utilitzar l'API

1. Obrir Postman o un navegador.
2. Fer una petició a l'URL de l'API:
http://localhost/Practiques/Practica-06/api/api.php/articles
3. Es poden fer operacions **GET, POST, PUT, DELETE** segons la necessitat.

## 📞 Suport

Qualsevol dubte: agonzalez7@sapalomera.cat 😃

