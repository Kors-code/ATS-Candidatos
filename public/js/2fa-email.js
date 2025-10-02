document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-carga-masiva');

    form.addEventListener('submit', function (e) {
        const vacanteSlug = document.getElementById('vacante_id').value;

        if (!vacanteSlug) {
            e.preventDefault();
            alert("Por favor selecciona una vacante");
            return;
        }

        // Cambiar action del formulario dinámicamente
        this.action = "/vacantes/" + vacanteSlug + "/candidatos/masivo";
    });

    // Previsualización de archivos
    document.getElementById('cvs').addEventListener('change', function (e) {
        const preview = document.getElementById('preview');
        preview.innerHTML = "";
        for (let file of e.target.files) {
            let item = document.createElement("div");
            item.textContent = file.name + " (" + Math.round(file.size / 1024) + " KB)";
            preview.appendChild(item);
        }
    });
});
