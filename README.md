# Task App
Esta aplicación está desarrollada con CodeIgniter 4. El Proyecto se generó con composer, como indica la documentación oficial del framework.

## Estructura del repositorio
Este repositorio contiene las siguientes carpetas:
- database: Contiene el script para crear la base de datos.
- docker: Contiene los archivos necesarios para ejecutar la aplicación en contenedores Docker.
- task-app: Contiene el código fuente de la aplicación desarrollada con CodeIgniter 4. Esta carpeta es la raíz del proyecto.

## Configuración
Se detalla a continuación la configuración necesaria para que la aplicación funcione correctamente en un entorno local o de producción.

### Instalar dependencias con Composer
1. Cambiar al directorio del proyecto:

   ```bash
   cd task-app
   ```

2. Instalar las dependencias utilizando Composer:

   ```bash
   composer install
   ```

### Carpetas
Asegurarse de tener creada estas carpetas desde la raiz del proyecto:
- Carpeta donde se almacenan las imagenes de perfil de usuarios: `public/uploads/profiles`.

### Servidor Apache (sin Docker)

Para ejecutar la aplicación en un entorno Linux con Apache instalado directamente:

1. **Copiar la configuración del sitio:**

   Copia el archivo de configuración personalizado:

   ```bash
   sudo cp docker/000-default.conf /etc/apache2/sites-available/000-default.conf
   ```

2. **Habilitar el sitio:**

   Activa el sitio virtual:

   ```bash
   sudo a2ensite 000-default.conf
   ```

3. **Habilitar el módulo de reescritura:**

   Este módulo es necesario para que CodeIgniter maneje URLs amigables:

   ```bash
   sudo a2enmod rewrite
   ```

4. **Reiniciar Apache:**

   Aplica los cambios reiniciando el servicio:

   ```bash
   sudo systemctl restart apache2
   ```

5. **Ubicar la aplicación en el directorio web:**

   Mueve el contenido de `task-app` directamente a `/var/www/html/`:

   ```bash
   sudo mv task-app/* /var/www/html/
   ```

   Esto asegura que el directorio `public/` quede en:

   ```
   /var/www/html/public
   ```

6. **Verificar la configuración de Apache:**

   Tu archivo `/etc/apache2/sites-available/000-default.conf` debe tener:

   ```apache
   <VirtualHost *:80>
       ServerAdmin webmaster@localhost
       DocumentRoot /var/www/html/public

       <Directory /var/www/html/public>
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>

       ErrorLog ${APACHE_LOG_DIR}/error.log
       CustomLog ${APACHE_LOG_DIR}/access.log combined
   </VirtualHost>
   ```

7. **Dar permisos adecuados:**

   Apache necesita acceso de lectura a los archivos:

   ```bash
   sudo chown -R www-data:www-data /var/www/html
   sudo chmod -R 755 /var/www/html
   ```

> **Importante:** Nunca apuntes Apache directamente al directorio raíz del proyecto (`task-app/`). Siempre debe apuntar a `public/`, ya que es el único directorio seguro para exponer públicamente.

---

### Variables de Entorno
Para que la aplicación funcione correctamente, es necesario configurar las variables de entorno. Primeramente, revisar si existe un archivo `.env` en el directorio raíz del proyecto. Si no existe, crear uno basado en el ejemplo siguiente:

```bash
#--------------------------------------------------------------------
# ENTORNO DE LA APLICACIÓN
#--------------------------------------------------------------------

CI_ENVIRONMENT = development # Entorno de desarrollo, para que la aplicación muestre errores detallados.
# CI_ENVIRONMENT = production # Entorno de producción, para que la aplicación oculte errores detallados.

#--------------------------------------------------------------------
# URL BASE DE LA APLICACIÓN
#--------------------------------------------------------------------
# Esto es importante para que los enlaces generados por la aplicación funcionen correctamente, por ejemplo, -
# los enlaces enviados por correo para activar cuentas o restablecer contraseñas.
# Puede ser una URL local o una URL pública, dependiendo de dónde se esté ejecutando la aplicación.

app.baseURL = 'http://192.168.1.104:8080/' # URL local con IP del host, cualquier dispositivo en la misma red puede acceder. Siempre y cuando el firewall lo permita.
# app.baseURL = 'http://localhost:8080/' # URL local, solo accesible desde el mismo dispositivo.
# app.baseURL = 'http://mi-dominio.com/' # URL pública, accesible para cualquier persona en Internet. Siempre y cuando se tenga un dominio válido y configurado.


#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
# En esta sección se configuran los parámetros de conexión a la base de datos.
# Los valores dependerán de donde esté alojada la base de datos.
database.default.hostname = mysql # Puede ser 'localhost' (si la bd está en el mismo servidor), una IP o dominio (si la bd está en otro servidor o en un contenedor de docker).
database.default.database = task-app # Nombre de la base de datos que usará la aplicación.
database.default.username = mysql # Nombre de usuario creado para la base de datos.
database.default.password = admin # Contraseña del usuario creado para la base de datos.
database.default.DBDriver = MySQLi # Sin cambios
database.default.DBPrefix = # Se queda vacío
database.default.port = 3306 # Puerto por defecto de MySQL. No cambiar a menos que en la configuración de mysql  se haya configurado un puerto diferente.


#--------------------------------------------------------------------
# EMAIL SETTINGS
#--------------------------------------------------------------------
# Configuración del servicio de correo electrónico para el envío de correos desde la aplicación.
# El siguiente ejemplo utiliza Gmail como proveedor de correo electrónico.
mail.fromEmail = 'some@gmail.com'
mail.fromName = 'Task App' # Remitente que verá el usuario al recibir el correo.
mail.protocol = 'smtp' # No cambiar.
mail.SMTPHost = 'smtp.gmail.com' # Servidor SMTP de Gmail. No cambiar.
mail.SMTPUser = 'some@gmail.com' # Misma dirección de correo electrónico utilizada como remitente.
mail.SMTPPass = 'mxeg goha pmnt axpl' # Contraseña del correo. Para gmail, se debe generar una "Application Passwords" (Contraseñas de Aplicaciones).
mail.SMTPPort = 587 # Puerto SMTP de Gmail. No cambiar.
mail.mailType = 'html' # No cambiar.

```

### Iniciar Aplicación
La aplicación ya está configurada. Para acceder, ingresar desde el navagador a `http://localhost/`, `http://[IP del host]/` o `http://[Mi dominio]/`. Apache por defecto está en el puerto 80 (por defecto no se coloca en las rutas), si se cambió, agregarlo a las rutas.
