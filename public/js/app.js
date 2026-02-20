window.addEventListener('DOMContentLoaded', () => {
    const contenido = document.getElementById('contenido');

    document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const url = link.dataset.api;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (!data.length) {
                    contenido.innerHTML = '<p>No hay datos disponibles.</p>';
                    return;
                }

                let html = '<table class="tabla">';
                html += '<tr>' + Object.keys(data[0]).map(k => `<th>${k}</th>`).join('') + '</tr>';

                data.forEach(item => {
                    html += '<tr>' + Object.values(item).map(v => `<td>${v}</td>`).join('') + '</tr>';
                });

                html += '</table>';
                contenido.innerHTML = html;
            })
            .catch(err => {
                contenido.innerHTML = '<p>Error al cargar los datos.</p>';
                console.error(err);
            });
        });
    });
});
