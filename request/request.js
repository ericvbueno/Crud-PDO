$(document).ready (() => {
    $("#salvar").click(function(event){
        event.preventDefault();
      });

    $.ajax({
        url: "./class-pessoa.php",
        type: "POST",
        data: {
            action: 'buscarRegistros'
        },
        dataType: 'json',
        beforeSend: () => {
            if (!$('.loading').length){ 
                $('table').after(
                    `<div class="loading">
                    </div>`
                );
            }
        },    
        success: (res) => {
            console.log(res);
            $('.loading').remove();
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

function Cadastrar() {
    let nome = $('#nome').val();
    let email = $('#email').val();
    let login = $('#login').val();
    let senha = $('#senha').val();

    $.ajax({
        url: "./class-pessoa.php",
        type: "POST",
        data: {
            action: 'cadastrarUsuario',
            nome:   nome, 
            email:  email,
            login:  login,
            senha:  senha
            },
        beforeSend: () => {
            if (!$('.loading').length){ 
                $('table').after(
                    `<div class="loading">
                    </div>`
                );
            }
        },
        success: (res) => {
            console.log("Deu certo");
            $('.loading').remove();
            console.log(res);
        },
        error: () => {
            console.log("Deu ruim");
            $('.loading').remove();
            console.log(res);
        }
    })
}

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
        beforeSend: () => {
            if (!$('.loading').length){ 
                $('table').after(
                    `<div class="loading">
                    </div>`
                );
            }
        },
        success: (res) => {
            console.log("Usuario excluido com sucesso");
            $('.loading').remove();
            location.reload();
        },
        error: () => {
            console.log("Erro");
            $('.loading').remove();
        }
    })
}