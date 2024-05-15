<div align="center">
    <img src="https://github.com/pupadevs/Shorto-Back-Hex/assets/121895258/5e27f13c-08b2-416f-a459-cc1eb3d96997" alt="Shorto Logo">
</div>

# Shorto - API Acortador de URLs

Shorto es una API construida en PHP utilizando el framework Laravel que te permite acortar URLs largas de forma rápida y sencilla. Esta API implementa una variedad de principios y patrones de diseño para garantizar un código limpio, modular y mantenible.

## Características

- **Acortamiento de URLs:** Permite convertir URLs largas en versiones más cortas y manejables.
- **Personalización de URLs:** Proporciona opciones para personalizar las URLs acortadas según tus preferencias.
- **Registro y Logeo de Usuarios:** Permite a los usuarios registrarse y autenticarse para gestionar sus URLs acortadas y acceder a estadísticas personalizadas.
- **Generación de Códigos QR:** Ofrece la capacidad de generar códigos QR para las URLs acortadas, facilitando su uso en impresiones y escaneos.
- **Estadísticas:** Registra estadísticas sobre el uso de las URLs acortadas para su análisis y seguimiento.

## Principios y Patrones Utilizados

### Arquitectura Hexagonal

Shorto sigue una arquitectura hexagonal para una mejor modularidad y separación de preocupaciones. Esto permite una fácil extensibilidad y mantenibilidad del código.

### Principios SOLID

Los principios SOLID (Single Responsibility, Open/Closed, Liskov Substitution, Interface Segregation, Dependency Inversion) se aplican en todo el código para asegurar un diseño limpio y coherente.

### Patrón CQRS (Command Query Responsibility Segregation)

Se utiliza el patrón CQRS para separar las operaciones de lectura y escritura en la base de datos. Esto permite una gestión más eficiente de las consultas y comandos.

### Patrón Repository

El patrón Repository se implementa para abstraer el acceso a los datos, proporcionando una capa de abstracción entre la lógica de negocio y el almacenamiento de datos.

### Patrón Value Object

Se emplea el patrón Value Object para representar valores inmutables, como las URLs, y asegurar la integridad de los datos.

## Contribución

Si deseas contribuir a Shorto, ¡eres bienvenido! Siempre estamos abiertos a nuevas ideas, correcciones de errores y mejoras. Siéntete libre de abrir un issue o enviar un pull request.

## Licencia

Shorto se distribuye bajo la licencia [MIT License](LICENSE).
