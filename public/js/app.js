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

    fetch(url, {
        headers: {
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((res) => {
            if (!res.ok) throw new Error();
            return res.json();
        })
        .then((data) => {
            contenido.innerHTML = "";

            if (!Array.isArray(data) || !data.length) {
                contenido.innerHTML = "<p>No hay datos disponibles.</p>";
                return;
            }

            if (url.includes("resultados")) renderResultados(data, url);
            else if (url.includes("planes")) renderPlanes(data, url);
            else if (url.includes("sesion-bloques"))
                renderSesionBloques(data, url);
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

// ===================== CRUD =====================

function mostrarFormularioCrear(apiUrl) {
    pintarFormulario({}, apiUrl, null);
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

        // Para el campo 'tipo', que es ENUM
        if (key === "tipo") {
            const select = document.createElement("select");
            select.name = key;
            select.required = true;

            const opciones = ["rodaje", "intervalos", "fuerza", "recuperacion", "test"];
            opciones.forEach((opcion) => {
                const option = document.createElement("option");
                option.value = opcion;
                option.textContent = opcion.charAt(0).toUpperCase() + opcion.slice(1);
                if (data[key] === opcion) option.selected = true;
                select.appendChild(option);
            });

            form.append(label, select);
        } else if (key === "velocidad") {
            // Para 'velocidad', otro campo ENUM
            const select = document.createElement("select");
            select.name = key;
            select.required = true;

            const opciones = ["9v", "10v", "11v", "12v"];
            opciones.forEach((opcion) => {
                const option = document.createElement("option");
                option.value = opcion;
                option.textContent = opcion;
                if (data[key] === opcion) option.selected = true;
                select.appendChild(option);
            });

            form.append(label, select);
        } else if (key.includes("fecha")) {
            input.type = "date";
        } else if (key.includes("completada") || key.includes("activo")) {
            input.type = "checkbox";
            input.checked = data[key] == 1;
        } else if (key.startsWith("id_")) {
            input.type = "number";
        } else {
            input.type = "text";
        }

        input.value = data[key] ?? "";
        form.append(label, input);
    });

    const btn = document.createElement("button");
    btn.textContent = id ? "Actualizar" : "Crear";
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

        fetch(id ? `${apiUrl}/${id}` : apiUrl, {
            method: id ? "PUT" : "POST",
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
            .then((res) => {
                if (!res.ok) throw new Error();
                return res.json();
            })
            .then(() => cargarSeccion(endpoint))
            .catch(async (error) => {
                console.error(error);
                alert("Error al guardar. Mira la consola.");
            });
    };

    contenido.appendChild(form);
}