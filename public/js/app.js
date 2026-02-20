// Configuración de los campos por modelo para cada endpoint
const camposPorModelo = {
    "/api/sesiones": ["nombre", "fecha", "id_plan", "completada"],
    "/api/planes": [
        "nombre",
        "descripcion",
        "fecha_inicio",
        "fecha_fin",
        "objetivo",
        "activo",
        "id_ciclista",
    ],
    "/api/resultados": [
        "fecha",
        "duracion",
        "kilometros",
        "recorrido",
        "pulso_medio",
        "pulso_max",
        "potencia_media",
        "potencia_normalizada",
        "velocidad_media",
        "puntos_estres_tss",
        "factor_intensidad_if",
        "ascenso_metros",
        "comentario",
        "id_ciclista",
        "id_sesion",
        "id_bicicleta",
    ],
    "/api/bloques": [
        "nombre",
        "descripcion",
        "tipo",
        "duracion_estimada",
        "potencia_pct_min",
        "potencia_pct_max",
        "pulso_pct_max",
        "pulso_reserva_pct",
        "comentario",
    ],
    "/api/sesion-bloques": [
        "id_sesion_entrenamiento",
        "id_bloque_entrenamiento",
        "orden",
        "repeticiones",
    ],
};

// ===================== INICIO =====================

window.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".nav-links a").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            cargarSeccion(link.dataset.api);
        });
    });
});

// ===================== CARGA =====================

function cargarSeccion(url) {
    const contenido = document.getElementById("contenido");
    
    console.log("Cargando sección de URL: ", url);

    fetch(url, {
        headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((res) => {
            console.log("Respuesta obtenida: ", res);
            if (!res.ok) throw new Error();
            return res.json();
        })
        .then((data) => {
            console.log("Datos recibidos: ", data);
            
            contenido.innerHTML = "";

            if (!Array.isArray(data) || !data.length) {
                contenido.innerHTML = "<p>No hay datos disponibles.</p>";
                return;
            }

            if (url.includes("resultados")) renderResultados(data, url);
            else if (url.includes("planes")) renderPlanes(data, url);
            else if (url.includes("sesion-bloques")) renderSesionBloques(data, url);
            else if (url.includes("sesiones")) renderSesiones(data, url);
            else if (url.includes("bloques")) renderBloques(data, url);
        })
        .catch(() => {
            contenido.innerHTML = "<p>Error al cargar los datos.</p>";
        });
}

// ===================== RENDERS =====================

function renderBloques(data, apiUrl) {
    const headers = [
        "ID",
        "Nombre",
        "Tipo",
        "Duración",
        "Potencia Min",
        "Potencia Max",
    ];
    const table = crearTabla(headers);

    data.forEach((b) => {
        agregarFila(
            table,
            [
                b.id,
                b.nombre,
                b.tipo,
                b.duracion_estimada,
                b.potencia_pct_min,
                b.potencia_pct_max,
            ],
            b.id,
            apiUrl,
        );
    });

    mostrarTabla(table, apiUrl);
}

function renderSesionBloques(data, apiUrl) {
    const headers = ["ID Sesión", "ID Bloque", "Orden", "Repeticiones"];
    const table = crearTabla(headers);

    data.forEach((sb) => {
        agregarFila(
            table,
            [
                sb.id_sesion_entrenamiento,
                sb.id_bloque_entrenamiento,
                sb.orden,
                sb.repeticiones,
            ],
            sb.id_sesion_entrenamiento,
            apiUrl,
        );
    });

    mostrarTabla(table, apiUrl);
}

function renderSesiones(data, apiUrl) {
    const headers = ["ID", "Nombre", "Fecha", "ID Plan", "Completada"];
    const table = crearTabla(headers);

    data.forEach((s) => {
        agregarFila(
            table,
            [s.id, s.nombre, s.fecha, s.id_plan, s.completada],
            s.id,
            apiUrl,
        );
    });

    mostrarTabla(table, apiUrl);
}

function renderPlanes(data, apiUrl) {
    const headers = ["ID", "Nombre", "Descripción", "Fecha Inicio", "Fecha Fin"];
    const table = crearTabla(headers);

    data.forEach((p) => {
        agregarFila(
            table,
            [p.id, p.nombre, p.descripcion, p.fecha_inicio, p.fecha_fin],
            p.id,
            apiUrl,
        );
    });

    mostrarTabla(table, apiUrl);
}

function renderResultados(data, apiUrl) {
    const headers = [
        "Fecha", "Duración", "Kilómetros", "Recorrido", "Pulso Medio", "Comentario"
    ];
    const table = crearTabla(headers);

    data.forEach((r) => {
        agregarFila(
            table,
            [r.fecha, r.duracion, r.kilometros, r.recorrido, r.pulso_medio, r.comentario],
            r.id,
            apiUrl,
        );
    });

    mostrarTabla(table, apiUrl);
}

// ===================== CRUD =====================

function mostrarFormularioCrear(apiUrl) {
    pintarFormulario({}, apiUrl, null); // Mostrar el formulario vacío para crear un nuevo registro
}

function pintarFormulario(data, apiUrl, id = null) {
    const contenido = document.getElementById("contenido");
    contenido.innerHTML = "";

    const form = document.createElement("form");

    const endpoint = Object.keys(camposPorModelo).find((key) =>
        apiUrl.includes(key),
    );

    const campos = camposPorModelo[endpoint];

    if (!campos) {
        console.error("No hay configuración para:", apiUrl);
        alert("Modelo no configurado en camposPorModelo");
        return;
    }

    campos.forEach((key) => {
        const label = document.createElement("label");
        label.textContent = key;

        const input = document.createElement("input");
        input.name = key;

        // Lógica para campos especiales (fecha, checkbox, select, etc.)
        if (key === "completada" || key === "activo") {
            input.type = "checkbox";
            input.checked = data[key] == 1;
        } else {
            input.type = "text";
        }

        input.value = data[key] ?? "";
        form.append(label, input);
    });

    const btn = document.createElement("button");
    btn.textContent = id ? "Actualizar" : "Crear"; // "Actualizar" si es edición, "Crear" si es nuevo
    btn.type = "submit";
    form.appendChild(btn);

    form.onsubmit = (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const objeto = {};

        formData.forEach((value, key) => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input.type === "checkbox") {
                objeto[key] = input.checked ? 1 : 0;
            } else {
                objeto[key] = value;
            }
        });

        // Aquí hacemos el POST para añadir el nuevo elemento
        fetch(id ? `${apiUrl}/${id}` : apiUrl, {
            method: id ? "PUT" : "POST",  // PUT si es actualización, POST si es nuevo
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(objeto),
        })
            .then(async (res) => {
                const text = await res.text();

                if (!res.ok) {
                    console.error("ERROR BACKEND:", text);
                    throw new Error(text);
                }

                return JSON.parse(text);
            })
            .then(() => cargarSeccion(apiUrl)) // Recargar la sección después de la acción
            .catch(async (error) => {
                console.error(error);
                alert("Error al guardar. Mira la consola.");
            });
    };

    contenido.appendChild(form);
}

function mostrarTabla(table, apiUrl) {
    const contenido = document.getElementById("contenido");
    contenido.appendChild(table);

    const btnCrear = document.createElement("button");
    btnCrear.textContent = "Crear Nuevo";
    btnCrear.onclick = () => mostrarFormularioCrear(apiUrl);
    contenido.appendChild(btnCrear);
}

// ===================== TABLA =====================

function crearTabla(headers) {
    const table = document.createElement("table");
    const thead = document.createElement("thead");
    const tr = document.createElement("tr");

    headers.forEach((header) => {
        const th = document.createElement("th");
        th.textContent = header;
        tr.appendChild(th);
    });

    thead.appendChild(tr);
    table.appendChild(thead);
    table.appendChild(document.createElement("tbody"));
    return table;
}

function agregarFila(table, rowData, id, apiUrl) {
    const tbody = table.querySelector("tbody");
    const tr = document.createElement("tr");

    rowData.forEach((data) => {
        const td = document.createElement("td");
        td.textContent = data;
        tr.appendChild(td);
    });

    // Opcional: Agregar botones para editar o eliminar
    const tdAcciones = document.createElement("td");
    const btnEditar = document.createElement("button");
    btnEditar.textContent = "Editar";
    btnEditar.onclick = () => {
        pintarFormulario(rowData, apiUrl, id);
    };
    tdAcciones.appendChild(btnEditar);

    const btnEliminar = document.createElement("button");
    btnEliminar.textContent = "Eliminar";
    btnEliminar.onclick = () => {
        eliminarElemento(id, apiUrl);
    };
    tdAcciones.appendChild(btnEliminar);

    tr.appendChild(tdAcciones);
    tbody.appendChild(tr);
}

function eliminarElemento(id, apiUrl) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        fetch(`${apiUrl}/${id}`, {
            method: "DELETE",
        })
            .then(() => cargarSeccion(apiUrl))
            .catch(() => alert("Error al eliminar el registro"));
    }
}
