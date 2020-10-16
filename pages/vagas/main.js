$(function(){

    $('[name="salario"]').mask('#.##0,00', {reverse: true});
    $('[name="filtro_salarioInicial"]').mask('#.##0,00', {reverse: true});
    $('[name="filtro_salarioFinal"]').mask('#.##0,00', {reverse: true});

    carregaVagas();

    carregaDisponibilidadesHorario();
    carregaTiposCNH();
    carregaRegimesContrato();
    carregaEscolaridades();
    carregaBeneficios();
    carregaEstados();
})


$('#modalInsercao').on('shown.bs.modal', function() {
    $(document).off('focusin.modal');
});

$('#modalInsercao').on('hidden.bs.modal', function () {

    $(this).find('form').trigger('reset');

    $("[name=id]").val("");

    carregarCidades('', '');

    $('input').iCheck('uncheck');

    liberaCampos();

})

function carregaVagas() {

    var url = "pages/vagas/funcoesVagas.php?funcao=carregarVagas" + this.getParams();

    $.get({url, success: function(result){
        var test = jQuery.parseJSON(result);
        drawTable(test);

        $('#tabelaVagas').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "order": [['3', 'desc']],
            "columnDefs": [
                { orderable: false, targets: 4 }
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
    row.append($("<td>" + formatStatus(rowData.status) + "</td>"));
    row.append($("<td>" + formatData(rowData.dt_insercao) + "</td>"));
    row.append($("<td> \n\
        <i class='fa fa-eye' title='Ver vaga' style='cursor: pointer' codigo=" + rowData.id + " onclick=\"verVaga($(this).attr('codigo'))\"/></i> \n\
        <i class='fa fa-edit' title='" + (rowData.status == 5 ? "Vaga excluída'" : "Editar Vaga'") + "' style='" + (rowData.status == 5 ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + "codigo=" + rowData.id + " onclick=\"editarVaga($(this).attr('codigo'))\"/></i> \n\
        <i class='fa fa-trash' title='" + (rowData.status == 5 ? "Vaga já excluída'" : "Excluir Vaga'") + "' style='" + (rowData.status == 5 ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + "codigo=" + rowData.id + " cargo='" + rowData.cargo + "' onclick=\"excluirVaga($(this).attr('cargo'), $(this).attr('codigo'))\"/></i> \n\
        <i class='fa fa-cog' title='" + (rowData.status == 5 ? "Vaga excluída'" : "Alterar Status'") + "' style='" + (rowData.status == 5 ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + "codigo=" + rowData.id + " onclick=\"alterarStatus('"+ rowData.id +"', '" + rowData.status + "')\"/></i> \n\ "));
}

function formatSalario(salario) {
    return numberToReal(salario);
}

function numberToReal(numero) {
    var numero = parseFloat(numero).toFixed(2).split('.');
    numero[0] = "R$ " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}

function formatStatus(status) {
    switch(status) {
        case '1':
            return 'Vaga aberta';
        case '2':
            return 'Processo em Andamento';
        case '3':
            return 'Candidato selecionado';
        case '4':
            return 'Vaga encerrada';
        case '5':
            return 'Vaga excluída';
    }
}

function formatData(data) {
    var dateTime = data.split(' ');
    var date = dateTime[0];
    var hour = dateTime[1];
    date = date.split('-');

    return date[2] + '/' + date[1] + '/' + date[0] + ' ' + hour;
}

function carregaBeneficios(beneficios = '', bloqueia = false) {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarBeneficios", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=beneficios]").find('label[class="checkbox"]').remove();

        var arrBeneficios = '';
        if(beneficios != '') {
            arrBeneficios = beneficios.split(',');
        }

        for(var i = 0; i < resultado.length; i++) {

            var checked = '';
            var disabled = '';
            
            if(arrBeneficios.includes(resultado[i].id)) {
                checked = 'checked';
            }

            if(bloqueia){
                disabled = 'disabled';
            }
            
            var option = '<label class="checkbox" style="margin-right: 15px;">';
            option += '<input name="beneficio_'+resultado[i].id+'" value="'+resultado[i].id+'" type="checkbox" '+checked+' '+disabled+'>';
            option += '<span class="label-text">'+resultado[i].descricao+'<span class="icon-check"></span></span>';
            option += '</label>';
            $("[name=beneficios]").append(option);

            $('input').iCheck({
                checkboxClass: 'icheckbox_class icheckbox_square-orange',
            });
        }
    }});
}

function carregaDisponibilidadesHorario() {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarDisponibilidadesHorario", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=disp_horario]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].descricao+'</option>';
            $("[name=disp_horario]").append(option);
        }
    }});
}

function carregaTiposCNH() {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarTiposCNH", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=cnh]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].descricao+'</option>';
            $("[name=cnh]").append(option);
        }
    }});
}

function carregaRegimesContrato() {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarRegimeContrato", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=reg_contrato]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].descricao+'</option>';
            $("[name=reg_contrato]").append(option);
        }
    }});
}

function carregaEscolaridades() {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarEscolaridades", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=escolaridade]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].descricao+'</option>';
            $("[name=escolaridade]").append(option);
        }
    }});
}

function carregaEstados() {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarEstados", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=estado]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].Id+'">'+resultado[i].Nome+'</option>';
            $("[name=estado]").append(option);
        }
    }});
}

function carregarCidades(idEstado, idCidade) {

    if(idEstado != '') {
        
        $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarCidades&idEstado=" + idEstado + "&idCidade=" +idCidade, success: function(result){
            var resultado = JSON.parse(result);

            $("[name=cidade]").find('option').remove();
            $("[name=cidade]").append( '<option value="">Selecione</option>');

            for(var i = 0; i < resultado.length; i++) {
                var selected = '';
                if (idCidade != '' && idCidade == resultado[i].Id) {
                    selected = 'selected';
                }
                var option = '<option value="'+resultado[i].Id+'" '+selected+'>'+resultado[i].Nome+'</option>';
                $("[name=cidade]").append(option);
            }
        }});
    } else {

        $("[name=cidade]").find('option').remove();
        $("[name=cidade]").append( '<option value="">Selecione um estado</option>');

    }
}


function salvarDados() {

    var id                  = $("[name='id']").val();
    var cargo               = $("[name='cargo']").val();
    var salario             = $("[name='salario']").val();
    var disp_horario        = $("[name='disp_horario']").val();
    var pcd                 = $("[name='pcd']").val();
    var cnh                 = $("[name='cnh']").val();
    var reg_contrato        = $("[name='reg_contrato']").val();
    var tempo_experiencia   = $("[name='tempo_experiencia']").val();
    var escolaridade        = $("[name='escolaridade']").val();
    var estado              = $("[name='estado']").val();
    var cidade              = $("[name='cidade']").val();
    var descricao           = $("[name='descricao']").val();
    var responsabilidades   = $("[name='responsabilidades']").val();
    var atribuicoes         = $("[name='atribuicoes']").val();
    var obs_cargo           = $("[name='obs_cargo']").val();

    var beneficios = [];
    
    $("[name^='beneficio_").each(function (){
        if(this.checked) {
            beneficios.push(this.value);
        }
    })
    
    /*Testar dados obrigatórios*/

    if(cargo == '' || salario == '') {
        toastr.error('Um ou mais dados obrigatórios não preenchidos');
    } else {

        $.post("pages/vagas/funcoesVagas.php?funcao=salvarVaga",
        {
            id, cargo, salario, disp_horario, pcd, cnh, reg_contrato, tempo_experiencia, escolaridade,
            estado, cidade, descricao, responsabilidades, atribuicoes, obs_cargo, beneficios
        },
        function(data){
            if(data == 1) {
                if(id){
                    toastr.success('Vaga atualizada com sucesso.');
                } else {
                    toastr.success('Vaga inserida com sucesso.');
                }
                $("#modalInsercao").modal('toggle');
                recarregaVagas();
            } else {
                toastr.error(data);
            }
        });
    }
}

async function alterarStatus(idVaga, statusAtual) {
    /* inputOptions can be an object or Promise */
    var inputOptions = [
        {
            'id': 1,
            'value': 'Vaga aberta'
        },
        {
            'id': 2,
            'value': 'Processo em andamento'
        },
        {
            'id': 3,
            'value': 'Candidato selecionado'
        },
        {   
            'id': 4,
            'value': 'Vaga encerrada'
        }
    ];

    for (var i = 0; i < inputOptions.length; i++) {
        if(inputOptions[i].id == statusAtual) {
            inputOptions.splice(i, 1);
        }
    };

    var selectInputOptions = [];

    for (var i = 0; i < inputOptions.length; i++) {
        selectInputOptions[inputOptions[i].id] = inputOptions[i].value; 
    };
  
    const { value : status }  = await Swal.fire({
        title: 'Selecione um status',
        html: "<b>Status atual:</b> " + this.formatStatus(statusAtual),
        input: 'select',
        inputOptions: selectInputOptions,
        inputPlaceholder: "Selecione",
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value) {
                    resolve();
                } else {
                    resolve('Você precisa selecionar um status!');
                }
            })
        }
    })

    if (status) {
        $.post("pages/vagas/funcoesVagas.php?funcao=alterarStatus",{idVaga, status}, function(data){
            if(data == 1) {
                toastr.success('Vaga alterada com sucesso.');
                recarregaVagas();
            } else {
                toastr.error(data);
            }
        });
    }
}

function excluirVaga(cargo, idVaga) {
    Swal.fire({
        title: 'Deseja excluir a vaga?',
        html: '<b>Cargo:</b> ' + cargo,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar'
      }).then((result) => {

        if(result.value == true) {

            $.post("pages/vagas/funcoesVagas.php?funcao=excluirVaga",{idVaga}, function(data){
                if(data == 1) {
                    toastr.success('Vaga excluída com sucesso.');
                    recarregaVagas();
                } else {
                    toastr.error(data);
                }
            });
        }
    })
}

function verVaga(idVaga) {
    bloqueia('body', true, 'win8', 'Buscando dados da vaga...');
    pesquisaCodigo(idVaga, true);
}

function editarVaga(idVaga) {
    bloqueia('body', true, 'win8', 'Buscando dados da vaga...');
    pesquisaCodigo(idVaga, false);
}

function pesquisaCodigo(idVaga, bloqueiaC) {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarVaga&idVaga="+idVaga,
    success: function(data){

        var dados = JSON.parse(data);

        $("#modalInsercao").modal('toggle');
        $("[name='id']").val(idVaga);
        $("[name='cargo']").val(dados[0]['cargo']);
        $("[name='salario']").val(parseFloat(dados[0]['salario']).toFixed(2)).trigger('input');
        $("[name='disp_horario']").val(dados[0]['disp_horario']);
        $("[name='pcd']").val(dados[0]['pcd']);
        $("[name='cnh']").val(dados[0]['tipo_cnh']);
        $("[name='reg_contrato']").val(dados[0]['reg_contrato']);
        $("[name='tempo_experiencia']").val(dados[0]['tempo_experiencia']);
        $("[name='escolaridade']").val(dados[0]['escolaridade']);
        $("[name='estado']").val(dados[0]['estado']);

        carregarCidades(dados[0]['estado'], dados[0]['cidade']);
        carregaBeneficios(dados[0]['beneficios'], bloqueiaC);

        $("[name='descricao']").val(dados[0]['descricao_vaga']);
        $("[name='responsabilidades']").val(dados[0]['responsabilidades']);
        $("[name='atribuicoes']").val(dados[0]['atribuicoes']);
        $("[name='obs_cargo']").val(dados[0]['observacoes']);

        if (bloqueiaC) {
            bloqueiaCampos();
        }

        bloqueia('body', false);

    }});
}

function recarregaVagas() {
    $("#tabelaVagas").dataTable().fnClearTable();
    $("#tabelaVagas").dataTable().fnDestroy();
    carregaVagas();
}

function bloqueiaCampos() {
    $("[name=cargo]").attr("disabled", true);
    $("[name=salario]").attr("disabled", true);
    $("[name=disp_horario]").attr("disabled", true);
    $("[name=pcd]").attr("disabled", true);
    $("[name=cnh]").attr("disabled", true);
    $("[name=reg_contrato]").attr("disabled", true);
    $("[name=tempo_experiencia]").attr("disabled", true);
    $("[name=escolaridade]").attr("disabled", true);
    $("[name=estado]").attr("disabled", true);
    $("[name=cidade]").attr("disabled", true);
    $("[name=descricao]").attr("disabled", true);
    $("[name=responsabilidades]").attr("disabled", true);
    $("[name=atribuicoes]").attr("disabled", true);
    $("[name=obs_cargo]").attr("disabled", true);

    $('input').iCheck('disable');

    $(".modal-footer").hide();
}

function liberaCampos() {
    $("[name=cargo]").removeAttr("disabled");
    $("[name=salario]").removeAttr("disabled");
    $("[name=disp_horario]").removeAttr("disabled");
    $("[name=pcd]").removeAttr("disabled");
    $("[name=cnh]").removeAttr("disabled");
    $("[name=reg_contrato]").removeAttr("disabled");
    $("[name=tempo_experiencia]").removeAttr("disabled");
    $("[name=escolaridade]").removeAttr("disabled");
    $("[name=estado]").removeAttr("disabled");
    $("[name=cidade]").removeAttr("disabled");
    $("[name=descricao]").removeAttr("disabled");
    $("[name=responsabilidades]").removeAttr("disabled");
    $("[name=atribuicoes]").removeAttr("disabled");
    $("[name=obs_cargo]").removeAttr("disabled");

    $(".modal-footer").show();
}

function getParams() {

    var status = $('[name=filtro_status]').val();
 
    var dtCadastroInicial = $('[name=filtro_dtCadastroInicial]').val();
    var dtCadastroFinal = $('[name=filtro_dtCadastroFinal]').val();
    
    var salarioInicial = ($('[name=filtro_salarioInicial]').val().replace(".", "")).replace(",", ".");
    var salarioFinal = ($('[name=filtro_salarioFinal]').val().replace(".", "")).replace(",", ".");

    return '&status=' + status + '&dtCadastroInicial=' + dtCadastroInicial + 
    '&dtCadastroFinal=' + dtCadastroFinal + '&salarioInicial=' + salarioInicial + '&salarioFinal=' +
    salarioFinal;

}

function filtrarVagas() {

    window.location.href = '?pg=vagas' + this.getParams();

}