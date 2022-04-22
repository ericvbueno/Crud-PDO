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
                                <button id='editar' onclick="Editar()">Editar</button>
                                <button id='excluir' onclick="Excluir(${id})">Excluir</button>
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
    console.log("Deu certo");
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

function Excluir(id_usuario) {
    $.ajax({
        url: "./class-pessoa.php",
        type: "POST",
        data: {
            action: 'excluirUsuario',
            id: id_usuario
        },
        dataType: 'json',
        success: (res) => {
            console.log("Usuario excluido com sucesso");
            location.reload();
        },
        error: () => {
            console.log("Erro");
        }
    })
}