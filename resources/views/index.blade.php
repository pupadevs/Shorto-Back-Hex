<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shorto - Acortador de URLs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CDN para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Estilo para modal */
        .modal-bg {
            background-color: rgba(5, 104, 58, 0.5);
        }
        .modal-content {
            background-color: #fff; /* Fondo sólido blanco */
            border: solid 2px #aa00b3; /* Bordes negros */
            border-radius: 0.5rem; /* Bordes redondeados */
            box-shadow: 0 4px 6px rgba(156, 0, 188, 0.1); /* Sombra */
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-700 to-purple-600">
    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <!-- Imagen de Shorto -->
        <img src="{{ asset('img/shortologo.png') }}" class="w-34 h-34 sm:w-44 sm:h-44 md:w-48 md:h-48 lg:w-56 lg:h-56 xl:w-64 xl:h-64 text-white mb-2 object-contain" alt="Shorto">
        <h1 class="text-2xl md:text-4xl font-bold mb-2 text-center text-white">Bienvenido a Shorto - Acortador de URLs</h1>
        <p class="text-base md:text-lg text-gray-200 mb-2 text-center">Esta API proporciona endpoints para acortar tus URLs largas y compartir fácilmente.</p>
        
        <!-- Botones para abrir modales -->
        <div class="mt-4 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <button onclick="openModal('stackModal')" class="bg-indigo-500 bg-opacity-75 hover:bg-opacity-100 text-white font-semibold px-4 py-2 rounded-md shadow-md transition duration-300 ease-in-out w-full md:w-auto text-sm md:text-base">Tecnologías Utilizadas</button>
            <button onclick="openModal('summaryModal')" class="bg-indigo-500 bg-opacity-75 hover:bg-opacity-100 text-white font-semibold px-4 py-2 rounded-md shadow-md transition duration-300 ease-in-out w-full md:w-auto text-sm md:text-base">Resumen de la API</button>
            <button onclick="openModal('postmanModal')" class="bg-indigo-500 bg-opacity-75 hover:bg-opacity-100 text-white font-semibold px-4 py-2 rounded-md shadow-md transition duration-300 ease-in-out w-full md:w-auto text-sm md:text-base">Cómo Usar con Postman</button>
        </div>

        <!-- Botón para descargar PDF de endpoints -->
        <div class="mt-4">
            <a href="ruta/a/tu/pdf" class="bg-blue-500 bg-opacity-75 hover:bg-opacity-100 text-white font-semibold px-4 py-2 rounded-md shadow-md transition duration-300 ease-in-out text-sm md:text-base">Descargar PDF de Endpoints</a>
        </div>

        <!-- Modales -->
        <div id="stackModal" class="fixed inset-0 modal-bg flex justify-center items-center hidden">
            <div class="modal-content p-4 md:p-8 rounded-md relative">
                <button onclick="closeModal('stackModal')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out"><i class="fas fa-times"></i></button>
                <h2 class="text-lg md:text-2xl font-semibold mb-4">Tecnologías Utilizadas</h2>
                <div class="flex items-center mb-2">
                    <i class="fab fa-laravel text-2xl md:text-3xl mr-2"></i>
                    <p class="text-sm md:text-base">Laravel Framework</p>
                </div>
                <div class="flex items-center mb-2">
                    <i class="fab fa-mysql text-2xl md:text-3xl mr-2"></i>
                    <p class="text-sm md:text-base">MySql</p>
                </div>
                <div class="flex items-center">
                    <i class="fab fa-php text-2xl md:text-3xl mr-2"></i>
                    <p class="text-sm md:text-base">PHP</p>
                </div>
            </div>
        </div>

        <div id="summaryModal" class="fixed inset-0 modal-bg flex justify-center items-center hidden">
            <div class="modal-content p-4 md:p-8 rounded-md relative">
                <button onclick="closeModal('summaryModal')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out"><i class="fas fa-times"></i></button>
                <h2 class="text-lg md:text-2xl font-semibold mb-4">Resumen de la API</h2>
                <p class="text-base md:text-lg">1. El proyecto sigue la arquitectura hexagonal para una mejor modularidad y escalabilidad.</p>
                <p class="text-base md:text-lg">2. Se aplican los principios SOLID para un diseño limpio y mantenible del código.</p>
                <p class="text-base md:text-lg">3. Se utiliza el patrón CQRS para separar las operaciones de lectura y escritura en la base de datos.</p>
                <p class="text-base md:text-lg">4. Se implementa el patrón Repository para abstraer el acceso a los datos.</p>
                <p class="text-base md:text-lg">5. Se emplea el patrón Value Object para representar valores inmutables y asegurar la integridad de los datos.</p>
                <p class="text-base md:text-lg">6. Se utilizan servicios para encapsular la lógica de negocio y facilitar la reutilización y mantenimiento del código.</p>
            </div>
        </div>

        <div id="postmanModal" class="fixed inset-0 modal-bg flex justify-center items-center hidden">
            <div class="modal-content p-4 md:p-8 rounded-md relative">
                <button onclick="closeModal('postmanModal')" class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 hover:text-gray-900 transition duration-300 ease-in-out"><i class="fas fa-times"></i></button>
                <h2 class="text-lg md:text-2xl font-semibold mb-4">Cómo Usar con Postman</h2>
                <ol class="list-decimal pl-4">
                    <li>Abre Postman.</li>
                    <li>Crea una nueva solicitud.</li>
                    <li>Selecciona el método HTTP deseado (GET, POST, etc.).</li>
                    <li>Ingresa la URL del endpoint de la API.</li>
                    <li>Agrega los parámetros necesarios en el cuerpo o la URL, según corresponda.</li>
                    <li>Agrega los encabezados necesarios, como los tokens de autenticación si es necesario.</li>
                    <li>Envía la solicitud y espera la respuesta.</li>
                </ol>
            </div>
        </div>

        <!-- Iconos de GitHub, LinkedIn y PayPal -->
        <div class="mt-4 flex space-x-4">
            <a href="https://github.com/tu_usuario" target="_blank" class="text-gray-200 hover:text-white"><i class="fab fa-github text-2xl md:text-3xl"></i></a>
            <a href="https://www.linkedin.com/in/tu_usuario" target="_blank" class="text-gray-200 hover:text-white"><i class="fab fa-linkedin text-2xl md:text-3xl"></i></a>
            <a href="https://www.paypal.com/donate?hosted_button_id=TU_ID_DE_BOTON_DE_DONACION" target="_blank" class="text-gray-200 hover:text-white"><i class="fab fa-paypal text-2xl md:text-3xl"></i></a>
        </div>
    </div>

    <!-- JavaScript para controlar los modales -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</body>
</html>
