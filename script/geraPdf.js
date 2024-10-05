function gerarPDF() {
    var element = document.querySelector('.tab_listagem'); // Seletor para o conteúdo que você deseja converter
    
    // Usa html2pdf para gerar o PDF
    html2pdf(element, {
      margin: 1,
      
      filename: 'pregacoes_mes.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 3 },
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    });
  }
  