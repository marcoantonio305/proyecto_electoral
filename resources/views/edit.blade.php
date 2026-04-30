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
        <div class="flex flex-row">
        <h1 class="text-2xl font-bold mb-10 mt-10">{{ $titulo }}</h1>
        <form id="formTitulo">
                <button type="submit" class="bg-yellow-600 text-white py-2 px-4 rounded ml-10 mt-9" >Editar</button>
            </form>
            </div>

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



        <div id="contenedor-dinamico" class="hidden mb-5"></div>
        <div id="contenedor-dinamico2" class="hidden mb-5"></div>
        <div class="bg-white text-black border border-black rounded w-250 p-5 font-bold justify-center mt-5">
            <p>Aviso Importante: Carácter Provisional de la Designación</p>
            <br>

<p>El resultado de esta consulta es de carácter informativo y no es definitivo.</p>
<br>

<p>Conforme a la normativa electoral, las personas designadas como miembros de una mesa electoral disponen de un plazo legal para presentar, si procede, causas justificadas y documentadas que les impidan aceptar el cargo. Estas alegaciones deben ser resueltas por la Junta Electoral de Zona correspondiente.</p>
<br>

<p>Por tanto, la composición final de las mesas electorales puede cambiar a medida que se admitan dichas excusas y se notifique a los suplentes. La designación solo se considerará definitiva una vez concluido este proceso.</p>
<br>

<p>Este procedimiento se regula en el Artículo veintisiete de la Ley Orgánica del Régimen Electoral General.</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded ml-2 mt-5 mb-5">Cerrar Sesión</button>
</form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const miForm = document.getElementById('formBusqueda');
    const contenedor = document.getElementById('contenedor-dinamico');

    if (miForm) {
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
                        ['Mesa', `0${res.datos.dist}${(res.datos.sec.length === 3 ? res.datos.sec : '0' + res.datos.sec)}${res.datos.mesa}`],
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
    }

    const miExcelForm = document.getElementById('formImportar');
    if (miExcelForm) {
        miExcelForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const input = document.getElementById('archivo_excel');
            if (!input.files[0]) return alert('Selecciona un archivo');

            const formData = new FormData(miExcelForm);
            try {
                const response = await fetch("/formulario/importar", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                const res = await response.json();
                alert(res.message);
                if (response.ok) location.reload();
            } catch (err) {
                alert('Error al importar el archivo.');
            }
        });
    }

    const formTitulo = document.getElementById('formTitulo');
    if (formTitulo) {
        formTitulo.addEventListener('submit', async (e) => {
            e.preventDefault();
            const nuevoTexto = prompt("Introduce un nuevo título:", "ELECCIONES...");
            if (!nuevoTexto) return;

            try {
                const response = await fetch("/guardar-titulo", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ titulo: nuevoTexto })
                });
                if (response.ok) {
                    alert("Título actualizado.");
                    location.reload();
                }
            } catch (err) {
                alert("Error de conexión.");
            }
        });
    }
});
    </script>
</body>
</html>
