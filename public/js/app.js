window.addEventListener("DOMContentLoaded", () => {
    console.log("DOM cargado, JS funcionando");

    const contenido = document.getElementById("contenido");

    document.querySelectorAll(".nav-links a").forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault();
            const url = link.dataset.api;
            console.log("Click en enlace:", url);

            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Accept": "application/json"
                },
            })
            .then(res => {
                console.log("Respuesta fetch:", res.status);
                return res.json();
            })
            .then(data => {
                console.log("Datos recibidos de la API:", data);
                contenido.innerHTML = "";

                if (!data.length) {
                    const p = document.createElement("p");
                    p.textContent = "No hay datos disponibles.";
                    contenido.appendChild(p);
                    return;
                }

                // Llama a la función de render según la URL
                if (url.includes("resultados")) {
                    renderResultados(data);
                } else if (url.includes("planes")) {
                    renderPlanes(data);
                } else if (url.includes("sesiones")) {
                    renderSesiones(data);
                } else if (url.includes("sesion-bloques")) {
                    renderSesionBloques(data);
                } else if (url.includes("bloques")) {
                    renderBloques(data);
                }
            })
            .catch(err => {
                contenido.innerHTML = "<p>Error al cargar los datos.</p>";
                console.error("Error en fetch:", err);
            });
        });
    });
});

// ===================== FUNCIONES DE RENDER =====================

function renderResultados(data) {
    const headers = ["ID","Fecha","Duración","Km","Ciclista","Sesión","Bicicleta"];
    const table = crearTabla(headers);

    data.forEach(r => {
        agregarFila(table, [
            r.id,
            r.fecha,
            r.duracion,
            r.kilometros,
            r.ciclista ? `${r.ciclista.nombre} ${r.ciclista.apellidos}` : "—",
            r.sesion ? r.sesion.nombre : "—",
            r.bicicleta ? r.bicicleta.nombre : "—"
        ]);
    });

    mostrarTabla(table);
}

function renderPlanes(data) {
    const headers = ["ID","Nombre","Objetivo","Inicio","Fin","Ciclista"];
    const table = crearTabla(headers);

    data.forEach(p => {
        agregarFila(table, [
            p.id,
            p.nombre,
            p.objetivo,
            p.fecha_inicio,
            p.fecha_fin,
            p.ciclista ? `${p.ciclista.nombre} ${p.ciclista.apellidos}` : "—"
        ]);
    });

    mostrarTabla(table);
}

function renderSesiones(data) {
    const headers = ["ID","Nombre","Fecha","Plan","Completada"];
    const table = crearTabla(headers);

    data.forEach(s => {
        agregarFila(table, [
            s.id,
            s.nombre,
            s.fecha,
            s.plan ? s.plan.nombre : "—",
            s.completada ? "Sí" : "No"
        ]);
    });

    mostrarTabla(table);
}

function renderSesionBloques(data) {
    const headers = ["ID","ID Sesión","ID Bloque","Orden","Repeticiones"];
    const table = crearTabla(headers);

    data.forEach(sb => {
        agregarFila(table, [
            sb.id,
            sb.id_sesion_entrenamiento,
            sb.id_bloque_entrenamiento,
            sb.orden,
            sb.repeticiones
        ]);
    });

    mostrarTabla(table);
}

function renderBloques(data) {
    const headers = ["ID","Nombre","Tipo","Duración","Potencia Min","Potencia Max"];
    const table = crearTabla(headers);

    data.forEach(b => {
        agregarFila(table, [
            b.id,
            b.nombre,
            b.tipo,
            b.duracion_estimada,
            b.potencia_pct_min,
            b.potencia_pct_max
        ]);
    });

    mostrarTabla(table);
}

// ===================== FUNCIONES AUXILIARES =====================

function crearTabla(headers) {
    const table = document.createElement("table");
    table.classList.add("tabla");

    const thead = document.createElement("thead");
    const headerRow = document.createElement("tr");

    headers.forEach(text => {
        const th = document.createElement("th");
        th.textContent = text;
        headerRow.appendChild(th);
    });

    thead.appendChild(headerRow);
    table.appendChild(thead);

    const tbody = document.createElement("tbody");
    table.appendChild(tbody);

    return table;
}

function agregarFila(table, valores) {
    const tbody = table.querySelector("tbody");
    const tr = document.createElement("tr");

    valores.forEach(valor => {
        const td = document.createElement("td");
        td.textContent = (typeof valor === "object" && valor !== null)
            ? JSON.stringify(valor) // Si accidentalmente queda un objeto, se ve legible
            : valor ?? "—";
        tr.appendChild(td);
    });

    tbody.appendChild(tr);
}

function mostrarTabla(table) {
    const contenido = document.getElementById("contenido");
    contenido.appendChild(table);
}