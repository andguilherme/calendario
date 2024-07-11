document.addEventListener('DOMContentLoaded', () => {
    const nomeMes = document.getElementById('nome-mes');
    const dias = document.getElementById('dias');
    const modal = document.getElementById('eventoModal');
    const closeModal = document.querySelector('.close');
    const dataEvento = document.getElementById('data-evento');
    const dataTarefa = document.getElementById('data-tarefa');
    let dataAtual = new Date();
    const formularioEvento = document.getElementById('formularioEvento');
    const formularioTarefa = document.getElementById('formularioTarefa');
    const btnEvento = document.querySelector('.btn-evento.btn-ativo');
    const btnTarefa = document.querySelector('.btn-evento:not(.btn-ativo)');

    function renderizarCalendario() {
        dias.innerHTML = '';
        const mesAtual = dataAtual.getMonth();
        const anoAtual = dataAtual.getFullYear();
        const primeiroDia = new Date(anoAtual, mesAtual, 1);
        const diaDaSemana = primeiroDia.getDay();
        const ultimoDia = new Date(anoAtual, mesAtual + 1, 0).getDate();
        const hoje = new Date().getDate();

        nomeMes.textContent = primeiroDia.toLocaleDateString('pt-BR', { month: 'long', year: 'numeric' });

        // Adiciona espaços vazios para os dias antes do primeiro dia do mês
        for (let i = 0; i < diaDaSemana; i++) {
            dias.appendChild(document.createElement("div"));
        }

        for (let i = 1; i <= ultimoDia; i++) {
            const dia = document.createElement('div');
            dia.textContent = i;
            if ((i + diaDaSemana - 1) % 7 === 0) { // Verifica se é domingo
                dia.classList.add('domingo');
            }
            if (i === hoje && mesAtual === new Date().getMonth() && anoAtual === new Date().getFullYear()) {
                dia.classList.add('hoje'); // Destaca o dia atual
            }
            dias.appendChild(dia);

            // Adiciona o manipulador de clique para cada dia com ação de definir a data do evento
            dia.addEventListener('click', () => {
                const mesFormatado = ('0' + (mesAtual + 1)).slice(-2); // Garante que o mês tenha dois dígitos
                const diaFormatado = ('0' + i).slice(-2); // Garante que o dia tenha dois dígitos
                const dataFormatada = `${anoAtual}-${mesFormatado}-${diaFormatado}`; // Formato YYYY-MM-DD
            
                dataEvento.value = dataFormatada; // Define a data no campo de evento
                dataTarefa.value = dataFormatada; // Define a data no campo de tarefa
                abrirModal();
            });
        }
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            fecharModal();
        }
    });

    function abrirModal() {
        modal.style.display = 'block';
        selecionarFormularioAtivo();
    }

    function fecharModal() {
        modal.style.display = 'none';
        formularioEvento.reset();
        formularioTarefa.reset();
    }

    closeModal.addEventListener('click', fecharModal);

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            fecharModal();
        }
    });

    document.getElementById('proximo-mes').addEventListener('click', () => {
        dataAtual.setMonth(dataAtual.getMonth() + 1);
        renderizarCalendario();
    });

    document.getElementById('mes-anterior').addEventListener('click', () => {
        dataAtual.setMonth(dataAtual.getMonth() - 1);
        renderizarCalendario();
    });

   /*  formularioTarefa.addEventListener('submit', (event) => {
        event.preventDefault();
        const dataAtual = new Date();
    const mesFormatado = ('0' + (dataAtual.getMonth() + 1)).slice(-2);
    const diaFormatado = ('0' + dataAtual.getDate()).slice(-2);
    const dataFormatada = `${dataAtual.getFullYear()}-${mesFormatado}-${diaFormatado}`;

    dataTarefa.value = dataFormatada;
    // Presumindo que você deseja enviar o formulário após o preenchimento da data
    // formularioTarefa.submit();
    }); */
    

    function selecionarFormularioAtivo() {
        btnEvento.addEventListener('click', () => {
            btnEvento.classList.add('btn-ativo');
            btnTarefa.classList.remove('btn-ativo');
            formularioEvento.style.display = 'block';
            formularioTarefa.style.display = 'none';
        });

        btnTarefa.addEventListener('click', () => {
            btnTarefa.classList.add('btn-ativo');
            btnEvento.classList.remove('btn-ativo');
            formularioTarefa.style.display = 'block';
            formularioEvento.style.display = 'none';
        });
    }

    renderizarCalendario();
    selecionarFormularioAtivo();
});


/* script do menu hamburguer */

document.getElementById('icone-menu').addEventListener('click', function() {
    var menu = document.getElementById('menu');
    if(menu.classList.contains('menu-escondido')) {
        menu.classList.remove('menu-escondido');
        menu.classList.add('menu-visivel');
    } else {
        menu.classList.remove('menu-visivel');
        menu.classList.add('menu-escondido');
    }
});
