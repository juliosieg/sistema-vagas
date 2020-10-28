$(function(){

    $('[name="salario"]').mask('#.##0,00', {reverse: true});
    $('[name="filtro_salarioInicial"]').mask('#.##0,00', {reverse: true});
    $('[name="filtro_salarioFinal"]').mask('#.##0,00', {reverse: true});
    $(".desfazerCandidatura").hide();
    $(".infoCandidatura").hide();

    carregaVagas();

    carregaFiltroEscolaridade(getUrlParameter('escolaridade'));
    carregaFiltroRegimeContrato(getUrlParameter('regime_contrato'));
    carregaFiltroEstado(getUrlParameter('estado'));
    if(getUrlParameter('estado')){
        carregaFiltroCidades(getUrlParameter('estado'), getUrlParameter('cidade'));
    }
})

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};

function getParamsURL() {

    var salarioInicial = this.getUrlParameter('salarioInicial') || '';
    var salarioFinal = this.getUrlParameter('salarioFinal') || '';
    var escolaridade = this.getUrlParameter('escolaridade') || '';
    var pcd = this.getUrlParameter('pcd') || '';
    var regime_contrato = this.getUrlParameter('regime_contrato') || '';
    var cidade = this.getUrlParameter('cidade') || '';
    var estado = this.getUrlParameter('estado') || '';

    return '&salarioInicial=' + salarioInicial + '&salarioFinal=' + salarioFinal + 
    '&escolaridade=' + escolaridade + '&pcd=' + pcd + '&regime_contrato=' + regime_contrato +
    '&cidade=' + cidade + '&estado=' + estado;

}

function getParams() {

    var salarioInicial = ($('[name=filtro_salarioInicial]').val().replace(".", "")).replace(",", ".");
    var salarioFinal = ($('[name=filtro_salarioFinal]').val().replace(".", "")).replace(",", ".");
    var escolaridade = $('[name=filtro_escolaridade]').val() || '';
    var pcd = $('[name=filtro_pcd]').val() || '';
    var regime_contrato = $('[name=filtro_regime_contrato] option:selected').val() || '';
    var cidade = $('[name=filtro_cidade] option:selected').val() || '';
    var estado = $('[name=filtro_estado] option:selected').val() || '';

    return '&salarioInicial=' + salarioInicial + '&salarioFinal=' + salarioFinal + 
    '&escolaridade=' + escolaridade + '&pcd=' + pcd + '&regime_contrato=' + regime_contrato +
    '&cidade=' + cidade + '&estado=' + estado;

}

function carregaVagas() {

    var url = "pages/vagas-candidato/funcoesVagas.php?funcao=carregarVagas" + this.getParamsURL();

    $.get({url, success: function(result){
        var test = jQuery.parseJSON(result);
        drawTable(test);

        $('#tabelaVagas').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "order": [['1', 'desc']],
            "columnDefs": [
                { orderable: false, targets: 3 }
            ],
            "info": true,
            "autoWidth": true,
            "pageLength": 25,
            "lengthMenu": [5, 10, 25, 50, 75, 100],
            "language" : {
                "decimal":        "",
                "emptyTable":     "Nenhum dado disponível na tabela",
                "info":           "Mostrando _TOTAL_ registro(s)",
                "infoEmpty":      "Mostrando 0 registros",
                "infoFiltered":   "(_MAX_ registros filtrados)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "loadingRecords": "Carregando...",
                "processing":     "Processando...",
                "search":         "Pesquisar:",
                "zeroRecords":    "Nenhum registro encontrado",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
                }
            }
        });
    }});

}

function drawTable(data) {

    if (data.length > 1) {
        for (var i = 0; i < data.length; i++) {
            drawRow(data[i]);
        }

    } else if (data.length == 1) {

        drawRow(data[0]);
    }
}

function drawRow(rowData) {
    var row = $("<tr />")
    $("#tabelaVagas").append(row);
    row.append($("<td codigo='" + rowData.id + "'>" + rowData.cargo + "</td>"));
    row.append($("<td>" + formatSalario(rowData.salario) + "</td>"));
    row.append($("<td>" + (rowData.cidade ? (rowData.cidade + '/' + rowData.uf) : '<i>Não informado</i>') + "</td>"));
    row.append($("<td>" + (rowData.situacao == 1 ? '<b>Candidatura Realizada</b>' : 'Candidatura não realizada') + "</td>"));
    row.append($("<td style='text-align: center'> \n\
        <a style='cursor: pointer' codigo=" + rowData.id + " onclick=\"verVaga($(this).attr('codigo'))\"><i class='fa fa-eye' title='Ver vaga'/></i> Ver vaga </a>"));
}

function formatSalario(salario) {
    return numberToReal(salario);
}

function numberToReal(numero) {
    var numero = parseFloat(numero).toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function carregaBeneficios(id) {

    $("[name=beneficios]").html('<i>Informação não disponível</i>');

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarBeneficios&id="+id, success: function(result){
        
        var resultado = JSON.parse(result);

        if(resultado.length > 0) {
            $("[name=beneficios]").html('');
        }

        for(var i = 0; i < resultado.length; i++) {

            $("[name=beneficios]").append(resultado[i].descricao);

            if(i + 1 < resultado.length) {
                $("[name=beneficios]").append(', ');
            }

        }
    }});
}

function carregaInfoCandidatura(id) {

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregaInfoCandidatura&id="+id, success: function(result){
        
        var resultado = JSON.parse(result);

        if(resultado.length > 0) {

            var dtCandidatura = resultado[0].dt_candidatura;
            dtCandidatura = dtCandidatura.split(' ');
            horaCandidatura = dtCandidatura['1'];
            dtCandidatura = dtCandidatura['0'].split('-');

            $(".infoCandidatura").html("<b>Candidatou-se em:</b> " + dtCandidatura[2] + '/' + dtCandidatura[1] + '/' + dtCandidatura[0] + ' ' + horaCandidatura);
            $(".infoCandidatura").show();
            $(".desfazerCandidatura").show();
            $(".candidatarSe").hide();
        } else {
            $(".infoCandidatura").html("");
            $(".infoCandidatura").hide();
            $(".desfazerCandidatura").hide();
            $(".candidatarSe").show();
        }

    }});

}

function carregaDisponibilidadesHorario(id) {

    var retorno = '<i> Informação não disponível </i>';

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarDisponibilidadesHorario", success: function(result){
        var resultado = JSON.parse(result);

        for(var i = 0; i < resultado.length; i++) {
            if(id == resultado[i].id) {
                retorno = resultado[i].descricao;
            }
        }

        $("[name='disp_horario']").html(retorno);
    }});
    
}

function carregaTiposCNH(id) {

    var retorno = '<i> Informação não disponível </i>';

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarTiposCNH", success: function(result){
        var resultado = JSON.parse(result);

        for(var i = 0; i < resultado.length; i++) {
            if(id == resultado[i].id) {
                retorno = resultado[i].descricao;
            }
        }

        $("[name='cnh']").html(retorno);
    }});
}

function carregaRegimesContrato(id) {

    var retorno = '<i> Informação não disponível </i>';

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarRegimeContrato", success: function(result){
        var resultado = JSON.parse(result);

        for(var i = 0; i < resultado.length; i++) {
            if(id == resultado[i].id) {
                retorno = resultado[i].descricao;
            }
        }

        $("[name='reg_contrato']").html(retorno);
    }});
}

function carregaEscolaridades(id) {

    var retorno = '<i> Informação não disponível </i>';

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarEscolaridades", success: function(result){
        var resultado = JSON.parse(result);

        for(var i = 0; i < resultado.length; i++) {
            if(id == resultado[i].id) {
                retorno = resultado[i].descricao;
            }
        }

        $("[name='escolaridade']").html(retorno);
    }});
}

function carregaEstados(id) {

    var retorno = '<i> Informação não disponível </i>';

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarEstados", success: function(result){
        var resultado = JSON.parse(result);

        for(var i = 0; i < resultado.length; i++) {
            if(id == resultado[i].Id) {
                retorno = resultado[i].Nome;
            }
        }

        $("[name='estado']").html(retorno);
    }});
}

function carregarCidades(id) {

    var retorno = '<i> Informação não disponível </i>';

    if (id == '') {
        $("[name='cidade']").html(retorno);
    } else {

        $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarCidades&id="+id, success: function(result){
            var resultado = JSON.parse(result);

            for(var i = 0; i < resultado.length; i++) {
                if(id == resultado[i].Id) {
                    retorno = resultado[i].Nome;
                }
            }

            $("[name='cidade']").html(retorno);
        }});
    }
}

function verVaga(idVaga) {
    bloqueia('body', true, 'win8', 'Buscando dados da vaga...');
    pesquisaCodigo(idVaga, true);
}

function pesquisaCodigo(idVaga) {

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarVaga&idVaga="+idVaga,
    success: function(data){

        var dados = JSON.parse(data);

        $("#modalInsercao").modal('toggle');
        $("[name='id']").val(idVaga);
        $("[name='cargo']").html(dados[0]['cargo'] != '' ? dados[0]['cargo'] : '<i> Informação não disponível </i>');
        $("[name='salario']").html((dados[0]['salario'] ? parseFloat(dados[0]['salario']).toFixed(2) : '')).trigger('input');
        if(salario != '') {
            var salario = $("[name='salario']").html();
            $("[name='salario']").html('R$ '+ salario);
        }

        carregaDisponibilidadesHorario(dados[0]['disp_horario']);
        carregaTiposCNH(dados[0]['tipo_cnh']);
        carregaRegimesContrato(dados[0]['reg_contrato']);
        carregaEscolaridades(dados[0]['escolaridade']);
        carregaEstados(dados[0]['estado']);
        carregarCidades(dados[0]['cidade']);
        carregaBeneficios(dados[0]['id']);

        carregaInfoCandidatura(dados[0]['id']);

        $("[name='pcd']").html(dados[0]['pcd'] != '' ? (dados[0]['pcd'] == 1 ? 'Sim' : 'Não') : '<i> Informação não disponível </i>');
        $("[name='tempo_experiencia']").html(dados[0]['tempo_experiencia'] != '' ? dados[0]['tempo_experiencia'] : '<i> Informação não disponível </i>');

        $("[name='descricao']").html(dados[0]['descricao_vaga'] != '' ? dados[0]['descricao_vaga'] : '<i> Informação não disponível </i>');
        $("[name='responsabilidades']").html(dados[0]['responsabilidades'] != '' ? dados[0]['responsabilidades'] : '<i> Informação não disponível </i>');
        $("[name='atribuicoes']").html(dados[0]['atribuicoes'] != '' ? dados[0]['atribuicoes'] : '<i> Informação não disponível </i>');
        $("[name='obs_cargo']").html(dados[0]['observacoes'] != '' ? dados[0]['observacoes'] : '<i> Informação não disponível </i>');

        bloqueia('body', false);

    }});
}

function recarregaVagas() {
    $("#tabelaVagas").dataTable().fnClearTable();
    $("#tabelaVagas").dataTable().fnDestroy();
    carregaVagas();
}



function filtrarVagas() {

    window.location.href = '?pg=vagas-candidato' + this.getParams();

}

function carregaFiltroEscolaridade(id) {

    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarEscolaridades", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_escolaridade]").append( '<option value="">Todas</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';
            if(resultado[i].id == id) {
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].descricao+'</option>';
            $("[name=filtro_escolaridade]").append(option);
        }
    }});
}

function carregaFiltroRegimeContrato(id) {
    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarRegimeContrato", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_regime_contrato]").append( '<option value="">Todos</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';
            if(resultado[i].id == id) {
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].descricao+'</option>';
            $("[name=filtro_regime_contrato]").append(option);
        }
    }});
}

function carregaFiltroEstado(id) {
    $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarEstados", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_estado]").append( '<option value="">Todos</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';
            if(resultado[i].Id == id) {
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].Id+'" '+selected+'>'+resultado[i].Nome+'</option>';
            $("[name=filtro_estado]").append(option);
        }
    }});
}

function carregaFiltroCidades(idEstado, idCidade) {
    if(idEstado != '') {
        
        $.get({url: "pages/vagas-candidato/funcoesVagas.php?funcao=carregarCidadesFiltro&idEstado=" + idEstado + "&idCidade=" +idCidade, success: function(result){
            var resultado = JSON.parse(result);

            $("[name=filtro_cidade]").find('option').remove();
            $("[name=filtro_cidade]").append( '<option value="">Selecione</option>');

            for(var i = 0; i < resultado.length; i++) {
                var selected = '';
                if (idCidade != '' && idCidade == resultado[i].Id) {
                    selected = 'selected';
                }
                var option = '<option value="'+resultado[i].Id+'" '+selected+'>'+resultado[i].Nome+'</option>';
                $("[name=filtro_cidade]").append(option);
            }
        }});
    } else {

        $("[name=filtro_cidade]").find('option').remove();
        $("[name=filtro_cidade]").append( '<option value="">Selecione um estado</option>');

    }
}

function candidatarSe() {

    var idVaga = $("[name=id]").val();

    Swal.fire({
        title: 'Deseja candidatar-se à essa vaga?',
        showCancelButton: true,
        showCancelButton: true,
        confirmButtonText: `Sim`,
        cancelButtonText: `Não`,
      }).then((result) => {
        if (result.value) {
            $.post("pages/vagas-candidato/funcoesVagas.php?funcao=candidatarSe",{idVaga}, function(data){
                if(data == 1) {
                    toastr.success('Candidatura confirmada');
                    recarregaVagas();
                    $("#modalInsercao .modal-header button").click();
                } else {
                    toastr.error(data);
                }
            });
        } 
      })

}

function desafazerCandidatura() {

    var idVaga = $("[name=id]").val();

    Swal.fire({
        title: 'Deseja remover sua candidatura dessa vaga?',
        showCancelButton: true,
        showCancelButton: true,
        confirmButtonText: `Sim`,
        cancelButtonText: `Não`,
      }).then((result) => {
        if (result.value) {
            $.post("pages/vagas-candidato/funcoesVagas.php?funcao=removerCandidatura",{idVaga}, function(data){
                if(data == 1) {
                    toastr.success('Candidatura removida');
                    recarregaVagas();
                    $("#modalInsercao .modal-header button").click();
                } else {
                    toastr.error(data);
                }
            });
        } 
      })

}