$(document).ready(() => {
    $("#salvar").click(function(event){
        event.preventDefault();
    });

    $.ajax({
        url: "../Crud-PDO/Facade/UserFacade.php",
        type: "POST",
        data: {
            action: 'buscarRegistros'
        },
        dataType: 'json',
        beforeSend: () => {
            if (!$('.loading').length){ 
                $('table').after(
                    `<div class="loading"></div>`
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
                                <button id='editar' onclick="Editar(${id})">Editar</button>
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
            $('.loading').remove();
        }
    })
})

function Cadastrar() {
    let nome = $('#nome').val();
    let email = $('#email').val();
    let login = $('#login').val();
    let senha = $('#senha').val();

    $.ajax({
        url: "../Crud-PDO/Facade/UserFacade.php",
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
                    `<div class="loading"></div>`
                );
            }
        },
        success: (res) => {
            console.log("Deu certo");
            $('.loading').remove();
            console.log(res);
            // location.reload();
        },
        error: () => {
            console.log("Deu ruim");
            $('.loading').remove();
            console.log(res);
        }
    })
}