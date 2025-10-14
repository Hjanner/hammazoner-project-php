# Hamazonner - Tienda Online

## Descripción General

**Hamazonner** es una aplicación web de comercio electrónico desarrollada completamente en PHP utilizando una arquitectura MVC (Modelo-Vista-Controlador) personalizada. El sistema permite la gestión integral de una tienda online, incluyendo administración de productos, categorías, usuarios y pedidos.

El proyecto implementa un patrón de diseño MVC sin depender de frameworks externos, lo que permite un control total sobre la arquitectura y facilita el aprendizaje de los conceptos fundamentales del desarrollo web con PHP orientado a objetos.

---

## Objetivos del Sistema

El sistema **Hamazonner** tiene como objetivos principales:

1. **Gestión de productos**: Permitir a los administradores crear, editar, eliminar y listar productos con sus respectivas imágenes, descripciones, precios y stock.

2. **Sistema de autenticación**: Implementar un sistema seguro de registro e inicio de sesión con roles diferenciados (usuario/administrador).

3. **Carrito de compras**: Facilitar a los usuarios la selección y compra de productos mediante un carrito de compras funcional.

4. **Gestión de categorías**: Organizar los productos en categorías para mejorar la navegación y búsqueda.

5. **Procesamiento de pedidos**: Registrar y gestionar pedidos de clientes con información detallada de productos, cantidades y datos de envío.

6. **Panel de administración**: Proveer una interfaz administrativa para la gestión completa del catálogo y usuarios.

---

## Estructura General del Código

El proyecto sigue una estructura MVC organizada de la siguiente manera:

```
proyectoIII/
│
├── config/                      # Configuraciones del sistema
│   ├── db.php                   # Conexión a base de datos
│   └── parametros.php           # Parámetros globales (URL base, rutas)
│
├── controllers/                 # Controladores (lógica de negocio)
│   ├── CarritoController.php   # Gestión del carrito de compras
│   ├── CategoriaController.php # Gestión de categorías
│   ├── ProductoController.php  # Gestión de productos
│   ├── PedidoController.php    # Gestión de pedidos
│   ├── UsuarioController.php   # Autenticación y gestión de usuarios
│   └── errorController.php     # Manejo de errores 404
│
├── models/                      # Modelos (acceso a datos)
│   ├── categoriaM.php          # Modelo de categorías
│   ├── productoM.php           # Modelo de productos
│   └── usuario.php             # Modelo de usuarios
│
├── views/                       # Vistas (presentación)
│   ├── layout/                 # Plantillas comunes (header, footer, menú)
│   ├── categoria/              # Vistas de categorías
│   ├── productos/              # Vistas de productos
│   └── registro.php            # Vista de registro
│
├── helpers/                     # Funciones auxiliares
│   └── utils.php               # Utilidades (validaciones, helpers)
│
├── recursos/                    # Recursos estáticos
│   ├── assets/                 # CSS, imágenes, documentación
│   └── database/               # Scripts SQL y diagramas de BD
│
├── uploads/                     # Directorio de imágenes subidas
│   └── images/                 # Imágenes de productos
│
├── .htaccess                   # Configuración de URLs amigables
├── index.php                   # Front Controller (punto de entrada)
├── inicio.php                  # Página de inicio
└── autoload.php                # Autocarga de controladores
```

### Funciones Principales por Componente

#### **Controladores**
- **ProductoController**: CRUD de productos, gestión de imágenes, filtrado por categorías
- **UsuarioController**: Registro, login, logout, gestión de sesiones
- **CategoriaController**: CRUD de categorías
- **CarritoController**: Añadir/eliminar productos del carrito (en desarrollo)
- **PedidoController**: Creación y gestión de pedidos

#### **Modelos**
- **Producto**: Consultas relacionadas con productos (getAll, getOne, save, edit, delete, getRandom)
- **Usuario**: Autenticación, registro, gestión de datos de usuario
- **Categoria**: Consultas de categorías

#### **Helpers**
- **Utils**: Funciones auxiliares como validación de administrador, eliminación de sesiones, carga de categorías

---

## Tecnologías Empleadas

### Backend
- **PHP 7.x/8.x** - Lenguaje principal con Programación Orientada a Objetos
- **MySQLi** - Extensión de PHP para conexión a MySQL/MariaDB
- **MySQL/MariaDB** - Sistema de gestión de base de datos relacional

### Frontend
- **HTML5** - Estructura de vistas
- **CSS3** - Estilos personalizados (`styles.css`, `stylesh.css`)
- **JavaScript** - Interactividad del lado del cliente (uso mínimo)

### Servidor Web
- **Apache** - Servidor web con `mod_rewrite` habilitado
- **.htaccess** - Configuración de URLs amigables y reescritura

### Arquitectura
- **MVC Personalizado** - Patrón Modelo-Vista-Controlador sin framework
- **Front Controller Pattern** - index.php como único punto de entrada
- **Autoload** - Carga automática de clases mediante `spl_autoload_register`

### Seguridad
- **password_hash()** - Encriptación de contraseñas con BCRYPT
- **real_escape_string()** - Sanitización de entradas para prevenir inyección SQL
- **Sesiones PHP** - Gestión de estado y autenticación

---

## Características del Sistema

### Funcionalidades Implementadas ✅
- ✅ Registro y autenticación de usuarios
- ✅ Sistema de roles (usuario/administrador)
- ✅ CRUD completo de productos
- ✅ CRUD completo de categorías
- ✅ Subida y almacenamiento de imágenes de productos
- ✅ Visualización de productos destacados (aleatorios)
- ✅ Filtrado de productos por categoría
- ✅ Panel de administración protegido
- ✅ URLs amigables mediante mod_rewrite

### Funcionalidades en Desarrollo 🚧
- 🚧 Sistema de carrito de compras (estructura básica presente)
- 🚧 Procesamiento completo de pedidos
- 🚧 Búsqueda de productos

---

## Base de Datos

### Esquema de Base de Datos

El sistema utiliza la base de datos **`tienda_master`** con las siguientes tablas:

#### **usuarios**
- Almacena información de usuarios y administradores
- Campos: id, nombre, apellidos, email, password (encriptada), rol, imagen

#### **categorias**
- Clasificación de productos
- Campos: id, nombre

#### **productos**
- Catálogo de productos disponibles
- Campos: id, categoria_id (FK), nombre, descripcion, precio, stock, oferta, fecha, imagen

#### **pedidos**
- Registro de pedidos realizados
- Campos: id, usuario_id (FK), provincia, localidad, direccion, coste, estado, fecha, hora

#### **lineas_pedidos**
- Detalle de productos por pedido
- Campos: id, pedido_id (FK), producto_id (FK), unidades

El script completo de la base de datos se encuentra en `recursos/database/database.sql`.

---

## Autor y Desarrollo

**Proyecto desarrollado con fines educativos** como parte de un curso de desarrollo web con PHP.

El sistema está diseñado para demostrar conceptos de:
- Arquitectura MVC sin frameworks
- Programación Orientada a Objetos en PHP
- Gestión de sesiones y autenticación
- Interacción con bases de datos relacionales
- Buenas prácticas de seguridad web

---

## Documentación Adicional

Para instrucciones detalladas sobre cómo configurar y ejecutar el proyecto en tu entorno local, consulta el archivo **[DEV_SETUP.md](DEV_SETUP.md)**.

---

## Licencia

Este proyecto es de código abierto y está disponible bajo fines educativos.

---

## Contacto y Soporte

Para dudas, sugerencias o contribuciones, por favor contacta al equipo de desarrollo o abre un issue en el repositorio del proyecto.
