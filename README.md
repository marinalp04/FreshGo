# 🥗 Fresh&Go

**Fresh&Go** es una plataforma de venta de platos preparados saludables, organizada por categorías, desarrollada con Symfony. Permite a los usuarios navegar por el catálogo, añadir productos a un carrito, gestionar pedidos y acceder a un panel administrativo con distintos niveles de permisos.

---
## 📂 Estructura del proyecto


```text
📂 Fresh&Go
│   .env
|   .env.dev
|   .gitattributes
|   .gitignore
|   composer.override.yaml
│   composer.json
│   .composer.lock
│   freshgo.sql
│   package-lock.json
│   package.json
│   postcss.config.mjs
│   README.md
│   symfony.lock
│   webpack.config.js
│
├───assets
├───bin
├───config
├───migrations
├───node_modules
├───public
├───src
├───templates
├───translations
├───var
└───vendor
```

---
## ✅ Requisitos del sistema

PHP 8.2 o superior

Composer

MySQL

Symfony CLI (opcional, pero recomendable)

---

## 🚀 Instrucciones básicas de despliegue

Sigue los siguientes pasos para ejecutar el proyecto en tu entorno local:

### 1. Clona el repositorio

```bash
git clone https://github.com/marinalp04/FreshGo.git
cd FreshGo
```

### 2. Instalar las dependencias del proyecto
Asegúrate de tener Composer instalado. Luego, ejecuta:
```bash
composer install
```

### 3. Configurar las variables de entorno
Copia el archivo .env y crea un archivo .env.local con tu configuración personalizada:
```bash
cp .env .env.local
```
Edita el archivo .env.local para configurar tu conexión a la base de datos. Por ejemplo:
```bash
DATABASE_URL="mysql://usuario:contraseña@127.0.0.1:3306/freshgo"
```
Sustituye usuario y contraseña por tus credenciales de MySQL.

### 4. Crear la base de datos
Ejecuta el siguiente comando para crear la base de datos:
```bash
php bin/console doctrine:database:create
```

### 5. Ejecutar las migraciones
Aplica las migraciones necesarias para generar las tablas:
```bash
php bin/console doctrine:migrations:migrate
```

### 6. Importar los datos iniciales
El proyecto no utiliza fixtures. Para cargar los datos iniciales como productos, categorías, ingredientes y usuarios, ejecuta el siguiente comando:
```bash
mysql -u tu_usuario -p freshgo < freshgo.sql
```
Se solicitará la contraseña. Asegúrate de que el archivo freshgo.sql se encuentre en la raíz del proyecto o en la ubicación desde donde ejecutes el comando.

### 7. Iniciar el servidor de desarrollo
Si tienes la CLI de Symfony instalada, puedes arrancar el servidor con:
```bash
symfony server:start
```
O usar el servidor de desarrollo de PHP:
```bash
php -S 127.0.0.1:8000 -t public
```
### 8. Acceder a la aplicación
Abre tu navegador y accede a la siguiente URL:
```text
http://127.0.0.1:8000
```






