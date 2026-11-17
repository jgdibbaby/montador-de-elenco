console.log("js rodando");


const corpoTabela = document.getElementById('corpo-tabela');
const btnCadastrar = document.getElementById('btn-cadastrar');

const urlApi = 'http://localhost:8000/index.php'; 


// GET
function carregarJogadores() {
    fetch(urlApi)
        .then(resposta => resposta.json()) 
        .then(jogadores => {
            const linhas = jogadores.map(jogador => {
                return `
                    <tr>
                        <td>${jogador.nome}</td>
                        <td>${jogador.posicao}</td>
                        <td>${jogador.camisa}</td>
                        <td>
                            <button onclick="atualizarJogador(${jogador.id})">Atualizar</button>
                            <button onclick="excluirJogador(${jogador.id})">Excluir</button>
                        </td>
                    </tr>
                `;
            });

            corpoTabela.innerHTML = linhas.join('');
        });
}


//POST
btnCadastrar.addEventListener('click', () => {

    const nome = document.getElementById('nome').value;
    const posicao = document.getElementById('posicao').value;
    const camisa = document.getElementById('camisa').value;

    const dados = {
        nome: nome,
        posicao: posicao,
        camisa: camisa
    };

    fetch(urlApi, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados) 
    }).then(() => {
        carregarJogadores();
        
        document.getElementById('nome').value = '';
        document.getElementById('posicao').value = '';
        document.getElementById('camisa').value = '';
    });
});

//DELETE
function excluirJogador(id) {
    if (confirm("Tem certeza que deseja dispensar este jogador?")) {
        fetch(`${urlApi}?id=${id}`, {
            method: 'DELETE'
        }).then(() => {
            carregarJogadores(); 
        });
    }
}

//PUT
function atualizarJogador(id) {
    const novoNome = prompt("Digite o novo nome do jogador:");
    
    if (novoNome) {
        fetch(`${urlApi}?id=${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ nome: novoNome })
        }).then(() => {
            carregarJogadores(); 
        });
    }
}

carregarJogadores();