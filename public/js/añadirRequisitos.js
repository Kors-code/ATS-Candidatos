document.addEventListener('DOMContentLoaded', function () {
    let contador = 1;
    let contadorbeneficios = 1;
    const btnAgregar = document.getElementById('btn-agregar');
    const btnQuitar = document.getElementById('btn-quitar')
    const contenedor = document.getElementById('contenedor-requisitos');
    const btnAgregarBeneficio = document.getElementById('btn-agregarbeneficio')
    const contenedorBeneficios = document.getElementById('contenedor-beneficios')
    const btnQuitarBeneficio = document.getElementById('btn-quitarbeneficio')

    btnAgregarBeneficio.addEventListener('click', function (){
        contadorbeneficios++;
        const nuevoCampoB = document.createElement('div');
        nuevoCampoB.classList.add('campo');
        nuevoCampoB.innerHTML =  `
            <input type="text" name="beneficios[]">
        `;
        contenedorBeneficios.appendChild(nuevoCampoB);
        
    });
    btnQuitarBeneficio.addEventListener('click', function (){
        if (contenedorBeneficios.children.length > 1) { 
            contenedorBeneficios.removeChild(contenedorBeneficios.lastElementChild);
            contadorbeneficios--;
        }
    });
    btnQuitar.addEventListener('click', function (){
        if (contenedor.children.length > 1) { 
            contenedor.removeChild(contenedor.lastElementChild);
            contador--;
        }
    });

    btnAgregar.addEventListener('click', function () {
        contador++;
        const nuevoCampo = document.createElement('div');
        nuevoCampo.classList.add('campo');
        nuevoCampo.innerHTML = `
            <input type="text" name="requisitos[]">
        `;
        contenedor.appendChild(nuevoCampo);
    });
});
