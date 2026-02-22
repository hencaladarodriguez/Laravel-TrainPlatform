const FORM_SCHEMAS = {
    "/api/planes": [
        "nombre",
        "descripcion",
        "fecha_inicio",
        "fecha_fin",
        "objetivo",
        "activo",
    ],
    "/api/sesiones": [
        "id_plan",
        "fecha",
        "nombre",
        "descripcion",
        "completada",
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
    "/api/resultados": [
        "id_sesion",
        "fecha",
        "duracion",
        "kilometros",
        "comentario",
    ],
};

// ===================== CONFIG =====================

const API_BASE = "http://localhost:8000";

// ===================== TOKEN =====================

function setToken(token) {
    localStorage.setItem("token", token);
}

function getToken() {
    return localStorage.getItem("token");
}

function removeToken() {
    localStorage.removeItem("token");
}

// ===================== FETCH CENTRAL =====================

function apiFetch(url, options = {}) {
    const token = getToken();

    if (!token) {
        window.location.href = "/";
        return;
    }

    return fetch(API_BASE + url, {
        ...options,
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            Authorization: "Bearer " + token,
            ...(options.headers || {}),
        },
    }).then(async (res) => {
        if (res.status === 401) {
            removeToken();
            alert("Sesión expirada");
            window.location.href = "/";
            throw new Error("401");
        }

        if (!res.ok) {
            throw new Error("Error servidor " + res.status);
        }

        if (res.status === 204) return null;

        return res.json();
    });
}

// ===================== LOGIN =====================

function initLogin() {
    const form = document.querySelector("#loginForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const email = form.email.value;
        const password = form.password.value;

        fetch(API_BASE + "/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            body: JSON.stringify({ email, password }),
        })
            .then((res) => {
                if (!res.ok) throw new Error("Credenciales incorrectas");
                return res.json();
            })
            .then((data) => {
                setToken(data.token);
                window.location.href = "/dashboard";
            })
            .catch((err) => {
                alert("Login incorrecto");
                console.error(err);
            });
    });
}

// ===================== DASHBOARD =====================

function initDashboard() {
    if (!document.getElementById("contenido")) return;

    if (!getToken()) {
        window.location.href = "/";
        return;
    }

    // Cargar usuario
    apiFetch("/api/user").then((user) => {
        const bienvenida = document.getElementById("bienvenida");
        if (bienvenida) {
            bienvenida.textContent = "Bienvenido " + user.nombre;
        }
    });

    // Navegación lateral
    document.querySelectorAll(".nav-links a").forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            cargarSeccion(link.dataset.api);
        });
    });
}

// ===================== CARGAR SECCIÓN =====================

function cargarSeccion(url) {
    const contenido = document.getElementById("contenido");

    apiFetch(url)
        .then((data) => {
            contenido.innerHTML = "";

            if (!Array.isArray(data) || data.length === 0) {
                const mensaje = document.createElement("p");
                mensaje.textContent = "No tienes datos todavía.";

                const btn = document.createElement("button");
                btn.textContent = "Añadir nuevo";
                btn.onclick = () => mostrarFormulario(url);

                contenido.appendChild(mensaje);
                contenido.appendChild(btn);
                return;
            }

            renderTabla(data, url);
        })
        .catch((err) => {
            console.error(err);
            contenido.innerHTML = "Error cargando datos";
        });
}

// ===================== RENDER TABLA =====================

function renderTabla(data, apiUrl) {
    const contenido = document.getElementById("contenido");

    const table = document.createElement("table");
    const thead = document.createElement("thead");
    const tbody = document.createElement("tbody");

    const headers = Object.keys(data[0]);

    const trHead = document.createElement("tr");

    headers.forEach((key) => {
        const th = document.createElement("th");
        th.textContent = key;
        trHead.appendChild(th);
    });

    const thAcciones = document.createElement("th");
    thAcciones.textContent = "Acciones";
    trHead.appendChild(thAcciones);

    thead.appendChild(trHead);
    table.appendChild(thead);

    data.forEach((item) => {
        const tr = document.createElement("tr");

        headers.forEach((key) => {
            const td = document.createElement("td");
            td.textContent = item[key];
            tr.appendChild(td);
        });

        const tdAcciones = document.createElement("td");

        const btnEditar = document.createElement("button");
        btnEditar.textContent = "Editar";
        btnEditar.onclick = () => mostrarFormulario(apiUrl, item);

        const btnEliminar = document.createElement("button");
        btnEliminar.textContent = "Eliminar";
        btnEliminar.onclick = () => eliminarRegistro(apiUrl, item.id);

        tdAcciones.appendChild(btnEditar);
        tdAcciones.appendChild(btnEliminar);

        tr.appendChild(tdAcciones);
        tbody.appendChild(tr);
    });

    table.appendChild(tbody);
    contenido.appendChild(table);

    const btnCrear = document.createElement("button");
    btnCrear.textContent = "Añadir nuevo";
    btnCrear.onclick = () => mostrarFormulario(apiUrl);

    contenido.appendChild(btnCrear);
}

// ===================== FORMULARIO =====================

function mostrarFormulario(apiUrl, data = null) {
    const contenido = document.getElementById("contenido");
    contenido.innerHTML = "";

    const form = document.createElement("form");

    const campos = FORM_SCHEMAS[apiUrl];

    if (!campos) {
        alert("Formulario no definido para esta sección");
        return;
    }

    campos.forEach((key) => {
        const label = document.createElement("label");
        label.textContent = key;

        const input = document.createElement("input");
        input.name = key;

        if (data && data[key] !== undefined) {
            input.value = data[key];
        }

        form.appendChild(label);
        form.appendChild(input);
    });

    const btn = document.createElement("button");
    btn.textContent = data ? "Actualizar" : "Crear";
    btn.type = "submit";
    form.appendChild(btn);

    form.onsubmit = function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const objeto = {};

        formData.forEach((value, key) => {
            // Convertir booleanos
            if (key === "activo" || key === "completada") {
                objeto[key] = value === "true" || value === "1";
            }

            // Convertir números
            else if (!isNaN(value) && value !== "") {
                objeto[key] = Number(value);
            } else {
                objeto[key] = value;
            }
        });

        const options = {
            method: "POST",
            body: JSON.stringify(data ? { ...objeto, _method: "PUT" } : objeto),
        };

        apiFetch(data ? `${apiUrl}/${data.id}` : apiUrl, options)
            .then(() => cargarSeccion(apiUrl))
            .catch((err) => {
                console.error(err);
                alert("Error guardando (revisa consola)");
            });
    };

    contenido.appendChild(form);
}

// ===================== ELIMINAR =====================

function eliminarRegistro(apiUrl, id) {
    if (!confirm("¿Seguro que quieres eliminar?")) return;

    apiFetch(`${apiUrl}/${id}`, {
        method: "DELETE",
    })
        .then(() => cargarSeccion(apiUrl))
        .catch((err) => {
            console.error(err);
            alert("Error eliminando");
        });
}

// ===================== LOGOUT =====================

function logout() {
    apiFetch("/api/logout", { method: "POST" }).finally(() => {
        removeToken();
        window.location.href = "/";
    });
}

// ===================== INIT GLOBAL =====================

document.addEventListener("DOMContentLoaded", function () {
    initLogin();
    initDashboard();
});

console.log("JS cargado correctamente");
