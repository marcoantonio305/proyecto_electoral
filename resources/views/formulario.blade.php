<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Composición de Mesa</title>
    @vite('resources/css/app.css')
</head>
<header class="bg-white h-28 pt-4">
    <a href="https://www.sanlucardebarrameda.es/es">
        <img src="https://www.sanlucardebarrameda.es/themes/custom/slctheme/logo1146x282.jpg" alt="Logo" class="w-80 h-20 ml-10">
    </a>
</header>
<body class="bg-gray-100">
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-10 mt-10">{{ $persona->descripcion ?? 'Buscador de Mesa' }}</h1>

        <form id="formBusqueda" class="mb-10">
            @csrf
            <input class="rounded border border-gray-300 p-2 mr-5" type="text" id="dni_input" placeholder="Introduce DNI" required>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Consultar</button>
        </form>

        <div class="bg-white p-5 rounded border border-gray-300 mb-10">
            <form id="formImportar" enctype="multipart/form-data">
                @csrf
                <label for="archivo_excel" class="font-bold">Importar Excel:</label>
                <input type="file" id="archivo_excel" name="archivo_excel" accept=".xlsx,.xls,.csv" class="ml-2">
                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded ml-2">Subir</button>
            </form>
        </div>

        <div id="contenedor-dinamico" class="hidden"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const miForm = document.getElementById('formBusqueda');
            const miExcelForm = document.getElementById('formImportar');
            const contenedor = document.getElementById('contenedor-dinamico');

            miForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const dni = document.getElementById('dni_input').value;
                contenedor.innerHTML = 'Cargando...';

                try {
                    const response = await fetch("/formulario/enviar", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ documento: dni })
                    });

                    const res = await response.json();
                    contenedor.innerHTML = '';

                    if (res.success) {
                        contenedor.classList.remove('hidden');
                        contenedor.className = "mt-8 rounded border border-gray-300 p-5 bg-blue-200 text-black";

                        const divFicha = document.createElement('div');
                        const fields = [
                            ['Nombre', `${res.datos.nombre} ${res.datos.apellido_1} ${res.datos.apellido_2}`],
                            ['Cargo', res.datos.cargo_nombre],
                            ['Colegio', res.datos.colegio_electoral],
                            ['Dirección', res.datos.direccion],
                            ['Mesa', res.datos.mesa],
                            ['Descripción', res.datos.descripcion]
                        ];

                        fields.forEach(field => {
                            const p = document.createElement('p');
                            p.innerHTML = `<strong>${field[0]}:</strong> ${field[1]}`;
                            divFicha.appendChild(p);
                        });

                        contenedor.appendChild(divFicha);
                    } else {
                        contenedor.classList.remove('hidden');
                        contenedor.className = "mt-8 p-4 bg-red-100 border border-red-400 text-red-800 rounded-lg";
                        contenedor.innerHTML = 'Usted no se encuentra en la mesa electoral';
                    }
                } catch (err) {
                    contenedor.innerHTML = '<p style="color:red">Error crítico al conectar con el servidor.</p>';
                }
            });

            miExcelForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(miExcelForm);

                try {
                    const response = await fetch("/formulario/importar", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const res = await response.json();
                    alert(res.success ? 'Éxito: ' + res.message : 'Error: ' + res.message);
                    if(res.success) location.reload();
                } catch (err) {
                    alert('Error crítico en la subida.');
                }
            });
        });
    </script>
</body>
</html>
