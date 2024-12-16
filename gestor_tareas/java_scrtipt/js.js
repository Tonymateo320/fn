document.addEventListener('DOMContentLoaded', function () {
    const tareas = document.querySelectorAll('.tarea');
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const closeButton = document.querySelector('.close-modal');

    tareas.forEach(tarea => {
        const header = tarea.querySelector('.tarea-header');
        const editButton = tarea.querySelector('.edit-tarea');
        const deleteButton = tarea.querySelector('.delete-tarea');
        const checkbox = tarea.querySelector('.completar-tarea');

        header.addEventListener('click', function (event) {
            // Evitar que el evento se propague a los botones dentro del header
            if (!event.target.closest('button') && !event.target.closest('input[type="checkbox"]')) {
                tarea.classList.toggle('active');
            }
        });

        if (editButton) {
            editButton.addEventListener('click', function () {
                const tareaId = tarea.dataset.id;
                const titulo = tarea.querySelector('h3').innerText;
                const descripcion = tarea.querySelector('.tarea-body p').innerText;

                document.getElementById('editId').value = tareaId;
                document.getElementById('editTitulo').value = titulo;
                document.getElementById('editDescripcion').value = descripcion;
                editModal.style.display = 'block';
            });
        }

        if (deleteButton) {
            deleteButton.addEventListener('click', function () {
                const tareaId = tarea.dataset.id;
                if (confirm('¿Estás seguro de que quieres eliminar esta tarea?')) {
                    const form = document.createElement('form');
                    form.action = 'dashboard.php';
                    form.method = 'post';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'eliminar';
                    input.value = tareaId;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        if (checkbox) {
            checkbox.addEventListener('change', function () {
                const tareaId = tarea.dataset.id;
                const form = document.createElement('form');
                form.action = 'dashboard.php';
                form.method = 'post';
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = checkbox.checked ? 'completar' : 'descompletar';
                input.value = tareaId;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            });
        }
    });

    closeButton.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });
});