# Servipymes Gramalote

**Autor:** Daniel Antonio Velandia – Estudiante ADSO SENA  
**Repositorio:** [https://github.com/velandia-123/servipyme-gramalote](https://github.com/velandia-123/servipyme-gramalote)  
**Fecha:** Febrero 2026  

---

## **Descripción del Proyecto**

*Servipymes Gramalote* es una plataforma web diseñada para la **gestión de negocios y servicios profesionales** en la región de Gramalote, Norte de Santander.  
Permite a los usuarios registrar sus negocios o servicios, editar perfiles, subir imágenes y consultar información de manera intuitiva y segura.  
El sistema está desarrollado en **PHP procedural con sesiones seguras**, conectado a **MySQL**, y con un diseño moderno y responsivo en colores corporativos blanco y azul.

---

## **Tecnologías utilizadas**

- PHP 7+  
- MySQL  
- HTML5 / CSS3 / JavaScript  
- XAMPP (entorno local)  
- Git / GitHub (control de versiones)  
- Visual Studio Code (editor de código)  

---

## **Funcionalidades principales**

1. **Registro de negocios y servicios profesionales** con validaciones seguras.  
2. **Inicio de sesión seguro** con control de sesiones.  
3. **Perfil de usuario completo**, con información detallada y foto.  
4. **Editar perfil**, incluyendo reemplazo de imagen de manera segura.  
5. **Visualización de perfiles** de otros negocios o servicios.  
6. **Diseño moderno y responsivo**, compatible con dispositivos móviles y escritorio.  
7. **Seguridad básica implementada**, incluyendo prepared statements y sanitización de datos.  

---

## **Instrucciones para instalar y ejecutar localmente**

1. Copia la carpeta `mi_negocio` en tu entorno local (ej. `C:\xampp\htdocs\`).  
2. Asegúrate de tener XAMPP instalado y Apache + MySQL en ejecución.  
3. Configura la conexión a la base de datos en `conexion.php`:

```php
$host = "localhost";
$usuario = "root";
$password = "";
$baseDatos = "registro_negocios";
