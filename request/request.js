function Editar(id) {
    $.ajax({
        url: "process/process.php",
        type: "POST",
        data: {id_usuario: id},
        success: (res) => {
            console.log("Deu certo");
        },
        error: () => {
            console.log("Deu ruim");
        }
    })
}