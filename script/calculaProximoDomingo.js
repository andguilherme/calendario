
            //função que atualiza data da próxima transmissão
            function atualizarDataEHorarioProximoDomingo() {
              var hoje = new Date();
              var proximoDomingo = new Date();

              // Calcula o próximo domingo
              proximoDomingo.setDate(hoje.getDate() + (7 - hoje.getDay()));

              // Formata a data no formato desejado
              var dia = proximoDomingo.getDate();
              var mes = proximoDomingo.toLocaleDateString('pt-BR', {
                month: 'long'
              });
              var ano = proximoDomingo.getFullYear();

              // Atualiza o conteúdo da tag de data
              var elementoData = document.getElementById("dataProximoDomingo");
              elementoData.textContent = "Dia " + dia + " de " + mes + " de " + ano;

              // Atualiza o conteúdo da tag de horário
              var elementoHorario = document.getElementById("horarioProximoDomingo");
              elementoHorario.textContent = "às 10h e às 19h";
            }

            atualizarDataEHorarioProximoDomingo();
