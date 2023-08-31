document.addEventListener("DOMContentLoaded", function() {
    // Función para resaltar la fila seleccionada en la tabla
    function highlightRow(event) {
      const row = event.target.parentNode;
      row.classList.toggle("highlight");
    }
  
    // Obtener todas las filas de la tabla
    const tableRows = document.querySelectorAll("#table tbody tr");
  
    // Agregar evento de clic a cada fila de la tabla
    tableRows.forEach((row) => {
      row.addEventListener("click", highlightRow);
    });
  });
  