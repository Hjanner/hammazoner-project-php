# Guía de Configuración del Entorno de Desarrollo - Hamazonner

Esta guía te ayudará a configurar y ejecutar el proyecto **Hamazonner** en tu entorno de desarrollo local paso a paso.

---

## Tabla de Contenidos

1. [Requisitos del Sistema](#requisitos-del-sistema)
2. [Instalación del Entorno](#instalación-del-entorno)
3. [Configuración de la Base de Datos](#configuración-de-la-base-de-datos)
4. [Configuración del Proyecto](#configuración-del-proyecto)
5. [Ejecución del Proyecto](#ejecución-del-proyecto)
6. [Configuración Avanzada](#configuración-avanzada)
7. [Solución de Problemas Comunes](#solución-de-problemas-comunes)

---

## Requisitos del Sistema

### Software Requerido

Para ejecutar este proyecto necesitas tener instalado:

| Software | Versión Mínima | Versión Recomendada | Propósito |
|----------|----------------|---------------------|-----------|
| **PHP** | 7.4 | 8.0 o superior | Lenguaje de programación del backend |
| **MySQL/MariaDB** | 5.7 / 10.2 | 8.0 / 10.6 | Sistema de base de datos |
| **Apache** | 2.4 | 2.4.x | Servidor web con mod_rewrite |
| **WAMP/XAMPP/MAMP** | - | Última versión | Stack de desarrollo (opcional pero recomendado) |

### Extensiones de PHP Requeridas

Asegúrate de que las siguientes extensiones de PHP estén habilitadas en tu `php.ini`:

```ini
extension=mysqli      # Para conexión a MySQL
extension=pdo_mysql   # PDO MySQL (opcional para este proyecto)
extension=mbstring    # Manejo de cadenas multibyte
extension=fileinfo    # Para subida de archivos
```

### Herramientas Opcionales

- **Git** - Para clonar el repositorio y control de versiones
- **phpMyAdmin** - Para gestión visual de la base de datos (incluido en WAMP/XAMPP)
- **VSCode/PHPStorm** - Editor de código recomendado
- **Postman** - Para pruebas de endpoints (si desarrollas API)

---

## Instalación del Entorno

### Opción 1: Usando XAMPP (Recomendado para Windows)

1. **Descargar XAMPP**
   - Visita: https://www.apachefriends.org/
   - Descarga la versión para tu sistema operativo
   - Ejecuta el instalador

2. **Instalar XAMPP**
   - Selecciona los componentes: Apache, MySQL, PHP, phpMyAdmin
   - Instala en la ruta por defecto: `C:\xampp\`

3. **Iniciar los servicios**
   - Abre el XAMPP Control Panel
   - Inicia Apache y MySQL
   - Verifica que los puertos 80 (Apache) y 3306 (MySQL) no estén ocupados

### Opción 2: Usando WAMP (Alternativa para Windows)

1. **Descargar WAMP**
   - Visita: https://www.wampserver.com/
   - Descarga la versión 64-bit o 32-bit según tu sistema

2. **Instalar WAMP**
   - Ejecuta el instalador
   - Instala en la ruta por defecto: `C:\wamp64\`

3. **Iniciar WAMP**
   - Ejecuta WAMP
   - Espera a que el ícono se ponga verde (todos los servicios activos)

### Opción 3: Instalación Manual (Linux/Mac)

```bash
# Ubuntu/Debian
sudo apt update
sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql

# Habilitar mod_rewrite
sudo a2enmod rewrite
sudo systemctl restart apache2

# macOS usando Homebrew
brew install php
brew install mysql
brew services start mysql
brew services start httpd
```

---

## Configuración de la Base de Datos

### Paso 1: Acceder a MySQL

#### Usando phpMyAdmin (XAMPP/WAMP)
- Abre tu navegador y ve a: `http://localhost/phpmyadmin`
- Usuario: `root`
- Contraseña: (vacía por defecto)

#### Usando línea de comandos
```bash
# Windows (XAMPP)
cd C:\xampp\mysql\bin
mysql -u root -p

# Linux/Mac
mysql -u root -p
```

### Paso 2: Crear la Base de Datos

Puedes hacerlo de dos formas:

#### Método 1: Importar el script SQL completo (Recomendado)

1. Localiza el archivo: `recursos/database/database.sql`
2. En phpMyAdmin:
   - Haz clic en "Importar"
   - Selecciona el archivo `database.sql`
   - Haz clic en "Continuar"

3. Desde línea de comandos:
```bash
mysql -u root -p < recursos/database/database.sql
```

#### Método 2: Ejecutar manualmente el SQL

Copia y ejecuta el contenido del archivo `database.sql`:

```sql
CREATE DATABASE tienda_master;
USE tienda_master;

-- Las tablas se crearán automáticamente
-- Usuario admin por defecto:
-- Email: admin@admin.com
-- Password: contraseña (debe cambiarse)
```

### Paso 3: Verificar la instalación

Ejecuta esta consulta para verificar que todo se creó correctamente:

```sql
USE tienda_master;
SHOW TABLES;
-- Deberías ver: usuarios, categorias, productos, pedidos, lineas_pedidos

SELECT * FROM usuarios;
-- Deberías ver el usuario admin creado
```

### Paso 4: Conexión MCP SQL Server (Opcional)

Si estás utilizando el MCP `sql-db-proyectoIII`, asegúrate de configurar la conexión:

```json
{
  "mcpServers": {
    "sql-db-proyectoIII": {
      "command": "uvx",
      "args": [
        "mcp-server-sqlserver",
        "--connection-string",
        "Server=localhost;Database=tienda_master;User Id=root;Password=;"
      ]
    }
  }
}
```

**Nota**: Ajusta la cadena de conexión según tus credenciales de MySQL.

Para ejecutar consultas SQL a través del MCP, puedes usar:

```sql
-- Ver todas las tablas
SHOW TABLES;

-- Ver estructura de una tabla
DESCRIBE productos;

-- Consultar datos
SELECT * FROM productos LIMIT 10;
```

---

## Configuración del Proyecto

### Paso 1: Clonar o Copiar el Proyecto

#### Si usas Git:
```bash
cd C:\xampp\htdocs   # o C:\wamp64\www
git clone <url-del-repositorio> proyectoIII
```

#### Si tienes el proyecto en ZIP:
- Extrae la carpeta en: `C:\xampp\htdocs\proyectoIII` (XAMPP)
- O en: `C:\wamp64\www\proyectoIII` (WAMP)

### Paso 2: Configurar la Conexión a la Base de Datos

Edita el archivo `config/db.php`:

```php
<?php 
class Database
{
    public static function connect(){
        // Configura estos valores según tu entorno
        $host = 'localhost';      // Servidor de BD
        $user = 'root';           // Usuario de MySQL
        $password = '';           // Contraseña (vacía por defecto en XAMPP/WAMP)
        $database = 'tienda_master'; // Nombre de la BD
        
        $db = new mysqli($host, $user, $password, $database);
        
        // Verificar conexión
        if ($db->connect_error) {
            die("Error de conexión: " . $db->connect_error);
        }
        
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
?>
```

### Paso 3: Configurar los Parámetros del Sistema

Edita el archivo `config/parametros.php`:

```php
<?php 
// Configuración de URLs base
define('base_url', 'http://localhost/proyectoIII/');

// Controladores por defecto
define('controller_default', 'productoController');					
define('action_default', 'index');
?>
```

**Importante**: Ajusta `base_url` según tu configuración:
- XAMPP: `http://localhost/proyectoIII/`
- WAMP: `http://localhost/proyectoIII/`
- Puerto personalizado: `http://localhost:8080/proyectoIII/`

### Paso 4: Configurar Apache y mod_rewrite

#### Verificar que mod_rewrite está habilitado

##### En XAMPP:
1. Abre `C:\xampp\apache\conf\httpd.conf`
2. Busca la línea: `#LoadModule rewrite_module modules/mod_rewrite.so`
3. Elimina el `#` para descomentar
4. Reinicia Apache desde el XAMPP Control Panel

##### En WAMP:
1. Click izquierdo en el ícono de WAMP
2. Apache → Apache Modules → Marca "rewrite_module"
3. Reinicia todos los servicios

#### Configurar .htaccess

El archivo `.htaccess` ya está configurado en la raíz del proyecto. Verifica que contenga:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine on
    ErrorDocument 404 http://localhost/proyectoIII/error/

    RewriteCond %{SCRIPT_FILENAME} !-d
    RewriteCond %{SCRIPT_FILENAME} !-f

    RewriteRule ^(.*)/(.*) index.php?controller=$1&action=$2
</IfModule>
```

**Actualiza la URL del ErrorDocument** según tu configuración.

#### Permitir .htaccess en Apache

Edita el archivo de configuración de Apache:

**XAMPP**: `C:\xampp\apache\conf\httpd.conf`  
**WAMP**: `C:\wamp64\bin\apache\apacheX.X.X\conf\httpd.conf`

Busca la sección `<Directory>` y cambia `AllowOverride None` a `AllowOverride All`:

```apache
<Directory "C:/xampp/htdocs">
    Options Indexes FollowSymLinks
    AllowOverride All  # <- Cambia esto
    Require all granted
</Directory>
```

Reinicia Apache después de este cambio.

### Paso 5: Configurar Permisos de Carpetas

Asegúrate de que la carpeta `uploads/images` tenga permisos de escritura:

#### Windows (XAMPP/WAMP):
- No suele ser necesario, pero si tienes problemas:
- Click derecho en `uploads` → Propiedades → Seguridad
- Asegúrate de que "Usuarios" tenga permisos de "Modificar"

#### Linux/Mac:
```bash
chmod 755 uploads/
chmod 755 uploads/images/
```

---

## Ejecución del Proyecto

### Paso 1: Iniciar los Servicios

1. **Inicia Apache y MySQL**
   - XAMPP: Abre XAMPP Control Panel y presiona "Start" en Apache y MySQL
   - WAMP: Ejecuta WAMP y espera que el ícono se ponga verde

### Paso 2: Acceder al Proyecto

Abre tu navegador y visita:

```
http://localhost/proyectoIII/inicio.php
```

O con URLs amigables (si mod_rewrite funciona):

```
http://localhost/proyectoIII/producto/index
```

### Paso 3: Probar la Autenticación

#### Iniciar sesión como administrador:
- **Email**: `admin@admin.com`
- **Password**: `contraseña`

**IMPORTANTE**: Cambia la contraseña del administrador después del primer inicio de sesión.

#### Registrar un nuevo usuario:
1. Haz clic en "Registro"
2. Completa el formulario
3. Inicia sesión con tus credenciales

### Paso 4: Probar Funcionalidades

1. **Ver productos destacados**: Página de inicio
2. **Crear categorías**: Panel de administración → Categorías → Crear
3. **Crear productos**: Panel de administración → Productos → Crear
4. **Subir imágenes**: Al crear un producto, sube una imagen PNG/JPG/JPEG
5. **Editar productos**: Desde el panel de gestión
6. **Eliminar productos**: Desde el panel de gestión

---

## Configuración Avanzada

### Configuración de Variables de Entorno (.env)

Aunque el proyecto actualmente no usa archivos `.env`, puedes implementar uno para mayor seguridad:

1. **Instala vlucas/phpdotenv** (requiere Composer):
```bash
composer require vlucas/phpdotenv
```

2. **Crea un archivo `.env` en la raíz**:
```env
# Configuración de Base de Datos
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=
DB_NAME=tienda_master

# Configuración de la Aplicación
APP_URL=http://localhost/proyectoIII/
APP_ENV=development
APP_DEBUG=true

# Configuración de Sesión
SESSION_LIFETIME=7200
```

3. **Modifica `config/db.php`** para leer desde .env:
```php
<?php 
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class Database
{
    public static function connect(){
        $db = new mysqli(
            $_ENV['DB_HOST'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            $_ENV['DB_NAME']
        );
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
?>
```

### Configuración de Sesiones

Para mejorar la seguridad de las sesiones, agrega al inicio de `index.php`:

```php
<?php
// Configuración segura de sesiones
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', 0); // Cambia a 1 si usas HTTPS
session_start();
?>
```

### Modo de Depuración

Para activar reportes de errores durante el desarrollo, agrega al inicio de `index.php`:

```php
<?php
// Solo en desarrollo - NUNCA en producción
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
```

---

## Solución de Problemas Comunes

### Error: "No se puede conectar a la base de datos"

**Causa**: Credenciales incorrectas o MySQL no está ejecutándose.

**Solución**:
1. Verifica que MySQL esté corriendo en XAMPP/WAMP
2. Revisa las credenciales en `config/db.php`
3. Prueba la conexión manualmente:
```bash
mysql -u root -p
```

### Error: "404 Not Found" en todas las rutas

**Causa**: mod_rewrite no está habilitado o .htaccess no funciona.

**Solución**:
1. Verifica que mod_rewrite esté habilitado
2. Asegúrate de que `AllowOverride All` esté configurado
3. Prueba accediendo a: `http://localhost/proyectoIII/index.php?controller=producto&action=index`

### Error: "Permission denied" al subir imágenes

**Causa**: La carpeta `uploads/images` no tiene permisos de escritura.

**Solución**:
```bash
# Linux/Mac
chmod 755 uploads/images/

# Windows: Cambia permisos desde Propiedades → Seguridad
```

### Error: "Call to undefined function password_verify()"

**Causa**: Versión de PHP menor a 5.5 o función deshabilitada.

**Solución**:
1. Actualiza PHP a la versión 7.4 o superior
2. Verifica que la extensión `password` esté habilitada

### Error: "Headers already sent"

**Causa**: Salida antes de llamadas a `header()`.

**Solución**:
1. Asegúrate de que no haya espacios o texto antes de `<?php`
2. Verifica que los archivos estén guardados sin BOM (UTF-8 sin BOM)
3. No uses `echo` o `var_dump` antes de redirecciones

### Error: "Class 'mysqli' not found"

**Causa**: La extensión mysqli no está habilitada.

**Solución**:
1. Abre `php.ini`
2. Busca `;extension=mysqli`
3. Elimina el `;` para descomentar
4. Reinicia Apache

### Las imágenes no se muestran

**Causa**: Ruta incorrecta o archivo no existe.

**Solución**:
1. Verifica que las imágenes estén en `uploads/images/`
2. Revisa la configuración de `base_url` en `parametros.php`
3. Verifica permisos de lectura en la carpeta

### Error: "Failed to load resource" en CSS/JS

**Causa**: Ruta incorrecta a los assets.

**Solución**:
1. Verifica que `base_url` esté correctamente configurado
2. Asegúrate de que los archivos CSS existan en `recursos/assets/css/`
3. Revisa la consola del navegador para ver la ruta exacta que intenta cargar

---

## Comandos Útiles

### Limpiar caché de sesiones
```bash
# Linux/Mac
rm -rf /tmp/sess_*

# Windows
# Elimina archivos en: C:\xampp\tmp o C:\wamp64\tmp
```

### Reiniciar servicios
```bash
# XAMPP (Windows - CMD como administrador)
net stop Apache2.4
net start Apache2.4
net stop mysql
net start mysql

# Linux
sudo systemctl restart apache2
sudo systemctl restart mysql
```

### Ver logs de errores
```bash
# XAMPP
# Apache: C:\xampp\apache\logs\error.log
# PHP: C:\xampp\php\logs\php_error_log

# WAMP
# Apache: C:\wamp64\logs\apache_error.log
# PHP: C:\wamp64\logs\php_error.log
```

---

## Próximos Pasos

Una vez que tengas el proyecto funcionando:

1. **Cambiar la contraseña del admin**: 
   - Inicia sesión como admin
   - Ve a configuración de usuario (si existe)
   - O actualiza directamente en la BD con una contraseña hasheada

2. **Agregar productos de prueba**:
   - Crea al menos 2-3 categorías
   - Agrega 5-10 productos con imágenes
   - Prueba editar y eliminar productos

3. **Explorar el código**:
   - Revisa los controladores en `controllers/`
   - Estudia los modelos en `models/`
   - Personaliza las vistas en `views/`

4. **Implementar nuevas funcionalidades**:
   - Completar el sistema de carrito
   - Implementar búsqueda de productos
   - Agregar filtros por precio/categoría
   - Implementar sistema de pedidos completo

---

## Recursos Adicionales

### Documentación Oficial
- [PHP Manual](https://www.php.net/manual/es/)
- [MySQL Reference](https://dev.mysql.com/doc/)
- [Apache mod_rewrite](https://httpd.apache.org/docs/current/mod/mod_rewrite.html)

### Tutoriales Recomendados
- [PHP The Right Way](https://phptherightway.com/)
- [MySQL Tutorial](https://www.mysqltutorial.org/)
- [MVC Pattern in PHP](https://www.phptutorial.net/php-tutorial/php-mvc/)

### Herramientas de Desarrollo
- [Composer](https://getcomposer.org/) - Gestor de dependencias PHP
- [Git](https://git-scm.com/) - Control de versiones
- [VSCode](https://code.visualstudio.com/) - Editor de código

---

## Soporte

Si encuentras algún problema no cubierto en esta guía:

1. Revisa los logs de error de Apache y PHP
2. Verifica la configuración en `config/`
3. Asegúrate de que todos los servicios estén corriendo
4. Consulta la documentación oficial de PHP/MySQL

---

**¡Feliz desarrollo! 🚀**
