$(document).ready (() => {

    $.ajax({
        url: "./class-pessoa.php",
        type: "POST",
        data: {
            action: 'buscarUsuarios'
        },
        dataType: 'json',
        success: (res) => {
            console.log(res);
            const html = `
                ${res.map((dados) => {
                    const {email, id, nivel, nome, senha, usuario_login} = dados;
                    return(`
                        <tr>
                            <td>${nome}</td>
                            <td>${email}</td>
                            <td>${usuario_login}</td>
                            <td>
                                <a id='editar'>Editar</a>
                                <a id='excluir'>Excluir</a>
                            </td>
                        </tr>
                    `);
                }).join(' ')
                }
            `;
            $('#dados').append(html);
        },
        error: () => {
            console.log("Erro");
        }
    })
    }
)

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

function Excluir(id) {
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