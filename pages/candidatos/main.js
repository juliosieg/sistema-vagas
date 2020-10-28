$(function(){

    carregaAreas();
    carregaNiveis();
    carregaIdiomas();
    carregaNiveisIdioma();
    carregaEstados();
    
    var estado = searchParam('estado');
    var cidade = searchParam('cidade');
    
    if(estado && estado != '') {
        carregaCidades(estado, cidade)
    }

    carregaCandidatos();

})


$('#modalVerCurriculo').on('hidden.bs.modal', function () {

    $("[name='id']").val('');
    $("[name='nome']").val('');
    $("[name='cpf']").val('');
    $("[name='estadoCivil']").val('');
    $("[name='naturalidade']").val('');
    $("[name='dt_nascimento']").val('');
    $("[name='email']").val('');
    $("[name='pcd']").val('');

    $("[name='endereco']").val('');
    $("[name='numero']").val('');
    $("[name='complemento']").val('');
    $("[name='bairro']").val('');
    $("[name='estado']").val('');
    $("[name='cidade']").val('');

    $("[name='celular']").val('');
    $("[name='fixo']").val('');
    $("[name='linkedin']").val('');
    $("[name='facebook']").val('');
    $("[name='blog']").val('');

    $("[name='area_interesse']").val('');
    $("[name='nivel_interesse']").val('');

    $(".experiencias").html('');
    $(".formacoes").html('');
    $(".idiomas").html('');

})


function searchParam(parameter) {
    var url_string = window.location.href;
    var url = new URL(url_string);
    return url.searchParams.get(parameter);
}

function carregaAreas() {

    var selectedParam = this.searchParam('area');

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarAreas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_area]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(selectedParam && selectedParam != '' && selectedParam == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].area+'</option>';
            $("[name=filtro_area]").append(option);
        }
    }});
}

function carregaNiveis() {

    var selectedParam = this.searchParam('nivel');

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarNiveis", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_nivel]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(selectedParam && selectedParam != '' && selectedParam == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].nivel+'</option>';
            $("[name=filtro_nivel]").append(option);
        }
    }});
}

function carregaIdiomas() {

    var selectedParam = this.searchParam('idioma');

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarIdiomas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_idioma]").append( '<option value="">Selecione</option>');
        
        for(var i = 0; i < resultado.length; i++) {
        
            var selected = '';
        
            if(selectedParam && selectedParam != '' && selectedParam == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].idioma+'</option>';
            
            $("[name=filtro_idioma]").append(option);
        }
    }});
}

function carregaNiveisIdioma() {

    var selectedParam = this.searchParam('nivel_idioma');

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarNiveisIdiomas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_nivel_idioma]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(selectedParam && selectedParam != '' && selectedParam == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].nivel+'</option>';
            
            $("[name=filtro_nivel_idioma]").append(option);
        }
    }});
}

function carregaEstadosVerCurriculo(estado) {

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarEstados", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=estado]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(estado && estado != '' && estado == resultado[i].Id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].Id+'" '+selected+'>'+resultado[i].Nome+'</option>';
            
            $("[name=estado]").append(option);
        }
    }});
}

function carregaCidadesVerCurriculo(idEstado, idCidade) {

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


function carregaEstados() {

    var selectedParam = this.searchParam('estado');

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarEstados", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_estado]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(selectedParam && selectedParam != '' && selectedParam == resultado[i].Id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].Id+'" '+selected+'>'+resultado[i].Nome+'</option>';
            
            $("[name=filtro_estado]").append(option);
        }
    }});
}

function carregaCidades(idEstado, idCidade) {

    if(idEstado != '') {
        
        $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarCidades&idEstado=" + idEstado + "&idCidade=" +idCidade, success: function(result){
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

function getParamsFromFilter() {

    var area = $('#filtro_area').val();
    var nivel = $('#filtro_nivel').val();
    var idioma = $('#filtro_idioma').val();
    var nivel_idioma = $('#filtro_nivel_idioma').val();
    var estado = $('#filtro_estado').val();
    var cidade = $('#filtro_cidade').val();
 
    return '&area=' + area + '&nivel=' + nivel + 
    '&idioma=' + idioma + '&nivel_idioma=' + nivel_idioma + '&estado=' +
    estado + '&cidade=' + cidade;

}

function getParamsFromUrl() {

    var area = this.searchParam('area');
    var nivel = this.searchParam('nivel');
    var idioma = this.searchParam('idioma');
    var nivel_idioma = this.searchParam('nivel_idioma');
    var estado = this.searchParam('estado');
    var cidade = this.searchParam('cidade');

    return '&area=' + area + '&nivel=' + nivel + 
    '&idioma=' + idioma + '&nivel_idioma=' + nivel_idioma + '&estado=' +
    estado + '&cidade=' + cidade;

}

function carregaCandidatos() {
    
    var url = "pages/candidatos/funcoesCandidatos.php?funcao=carregarCandidatos" + this.getParamsFromUrl();

    $.get({url, success: function(result){
        var test = jQuery.parseJSON(result);
        drawTable(test);

        $('#tabelaCandidatos').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "order": [['1', 'desc']],
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
    $("#tabelaCandidatos").append(row);
    row.append($("<td codigo='" + rowData.id + "'>" + rowData.nome + "</td>"));
    row.append($("<td>" + rowData.area + "</td>"));
    row.append($("<td>" + rowData.nivel + "</td>"));
    row.append($("<td>" + formatData(rowData.dt_atualizacao) + "</td>"));
    row.append($("<td> \n\
        <i class='fa fa-eye' title='Ver currículo' style='cursor: pointer' codigo=" + rowData.id + " onclick=\"verCurriculo($(this).attr('codigo'))\"/></i> \n\
        <i class='fab fa-linkedin-in' title='" + (rowData.linkedin == '' ? "LinkedIn Indisponível'" : "Acessar Linkedin'") + " style='" + (rowData.linkedin == '' ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + " onclick=\"abrirLinkNovaAba(\'"+rowData.linkedin+"\')\"/></i> \n\
        <i class='fab fa-facebook' title='" + (rowData.facebook == '' ? "Facebook Indisponível'" : "Acessar Facebook'") + " style='" + (rowData.facebook == '' ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + " onclick=\"abrirLinkNovaAba(\'"+rowData.facebook+"\')\"/></i> \n\
        <i class='fa fa-link' title='" + (rowData.blog == '' ? "Blog Indisponível'" : "Acessar Blog'") + " style='" + (rowData.blog == '' ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + "' onclick=\"abrirLinkNovaAba(\'"+rowData.blog+"\')\"/></i> \n\
        <i class='fa fa-briefcase' title='Ver candidaturas' style='cursor: pointer' codigo=" + rowData.id + " onclick=\"verCandidaturas('"+ rowData.id +"')\"/></i> \n\ "));
}

function abrirLinkNovaAba(url) {
    if (url != undefined && url != '') {
        window.open(url, '_blank');
    }
}

function formatData(data) {
    var dateTime = data.split(' ');
    var date = dateTime[0];
    var hour = dateTime[1];
    date = date.split('-');

    return date[2] + '/' + date[1] + '/' + date[0] + ' ' + hour;
}


function carregarAreasVerCurriculo(area) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarAreas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=area_interesse]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(area && area != '' && area == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].area+'</option>';
            $("[name=area_interesse]").append(option);
        }
    }});
}

function carregarNiveisVerCurriculo(nivel) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarNiveis", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=nivel_interesse]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {

            var selected = '';

            if(nivel && nivel != '' && nivel == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].nivel+'</option>';
            $("[name=nivel_interesse]").append(option);
        }
    }});
}

function adicionarLinhaExperienciaCandidato(dados) {

    $(".experiencias").append(
        "<div class='experiencia experiencia_"+dados['id']+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px' disabled>" +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='empresa_"+dados['id']+"'>Empresa</label>" +
        "<input type='text' name='empresa_"+dados['id']+"' class='form-control' disabled value='"+dados['empresa']+"'/>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='cargo_"+dados['id']+"'>Cargo</label>" +
        "<input type='text' name='cargo_"+dados['id']+"' class='form-control' disabled value='"+dados['cargo']+"'/>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='dtInicioEmpresa_"+dados['id']+"'>Data de Início</label>" +
        "<input type='date' name='dtInicioEmpresa_"+dados['id']+"' class='form-control' value='"+dados['dtInicio']+"' disabled/>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='dtFimEmpresa_"+dados['id']+"'>Data de Saída</label>" +
        "<input type='date' name='dtFimEmpresa_"+dados['id']+"' id='dtFimEmpresa_"+dados['id']+"' value='"+dados['dtFim']+"' disabled class='form-control'/>" +
        "</div>" +
        "<div class='col-md-6'></div>" +
        "<div class='col-md-6'>" +
        "<input type='checkbox' class='form_control' disabled id='trabalhoAtual_"+dados['id']+"' name='trabalhoAtual_"+dados['id']+"' "+(dados['trabalhoAtual'] == 1 ? 'checked' : '' )+"/>" +
        "<label for='trabalhoAtual_"+dados['id']+"' style='font-weight: normal'>&nbsp;Ainda estou trabalhando nessa empresa</label>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-12'>" +
        "<label for='atribuicoes_empresa_"+dados['id']+"'>Principais atribuições</label>" +
        "<textarea id='atribuicoes_empresa_"+dados['id']+"' class='form-control' name='atribuicoes_empresa_"+dados['id']+"' disabled rows='5'>"+dados['atribuicoes']+"</textarea>" +
        "</div>" +
        "</div>"
    )


}

function carregarExperienciasCandidato(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarExperienciasCandidato&id="+id, success: function(data){

        var resultado = JSON.parse(data);

        if(resultado.length > 0){
            for(var i = 0; i < resultado.length; i++) {

                adicionarLinhaExperienciaCandidato(resultado[i]);
    
            }
        } else {
            $(".experiencias").append("<i>Nenhuma informação disponível.</i>");
        }

    }});

}

function carregaOpcoesIdiomasCandidato(id, idioma) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarIdiomas", success: function(data){

        var resultado = JSON.parse(data);

        $("[name=idioma_"+id+"]").append( '<option value="">Selecione</option>');
        
        for(var i = 0; i < resultado.length; i++) {
        
            var selected = '';
        
            if(idioma && idioma != '' && idioma == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].idioma+'</option>';
            
            $("[name=idioma_"+id+"]").append(option);
        }
    }});

}

function carregaOpcoesNiveisIdiomas(id, nivel) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarNiveisIdiomas", success: function(data){

        var resultado = JSON.parse(data);

        $("[name=nivel_idioma_"+id+"]").append( '<option value="">Selecione</option>');
        
        for(var i = 0; i < resultado.length; i++) {
        
            var selected = '';
        
            if(nivel && nivel != '' && nivel == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].nivel+'</option>';
            
            $("[name=nivel_idioma_"+id+"]").append(option);
        }
    }});

}

function adicionarLinhaIdiomaCandidato(dados) {
    $(".idiomas").append(
         "<div class='idioma idioma_"+dados['id']+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px'> " +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='idioma_"+dados['id']+"'>Idioma</label>" +
        "<select name='idioma_"+dados['id']+"' class='form-control' placeholder='Idioma' disabled>" +
        "</select>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='nivel_idioma_"+dados['id']+"'>Nível</label>" +
        "<select  name='nivel_idioma_"+dados['id']+"' class='form-control' disabled>" +
        "</select>" +
        "</div>" +
        "</div>" +
        "</div>"
    )

    carregaOpcoesIdiomasCandidato(dados['id'], dados['idioma']);
    carregaOpcoesNiveisIdiomas(dados['id'], dados['nivel']);
}

function carregarIdiomasCandidato(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarIdiomasCandidato&id="+id, success: function(data){

        var resultado = JSON.parse(data);

        if(resultado.length > 0){
            for(var i = 0; i < resultado.length; i++) {

                adicionarLinhaIdiomaCandidato(resultado[i]);
    
            }
        } else {
            $(".idiomas").append("<i>Nenhuma informação disponível.</i>");
        }

    }});

}

function adicionarLinhaFormacaoCandidato(dados) {
    $(".formacoes").append(
        "<div class='formacao formacao_"+dados['id']+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px'>" +
        "<div class='row'>" +
        "<div class='col-md-4'>" +
        "<label for='instituicao_"+dados['id']+"'>Instituição</label>" +
        "<input type='text' name='instituicao_"+dados['id']+"' disabled value='"+dados['instituicao']+"' class='form-control'/>" +
        "</div>" +
        "<div class='col-md-4'>" +
        "<label for='curso_"+dados['id']+"'>Curso</label>" +
        "<input type='text' name='curso_"+dados['id']+"' disabled value='"+dados['curso']+"' class='form-control'/>" +
        "</div>" +
        "<div class='col-md-4'>" +
        "<label for='nivel_"+dados['id']+"'>Nível</label>" +
        "<select name='nivel_"+dados['id']+"' disabled class='form-control'>" +
        "<option value=''>Selecione</option>" +
        "<option value='1' "+(dados['nivel'] == 1 ? 'selected' : '')+">Ensino Fundamental</option>" +
        "<option value='2' "+(dados['nivel'] == 2 ? 'selected' : '')+">Ensino Médio</option>" +
        "<option value='3' "+(dados['nivel'] == 3 ? 'selected' : '')+">Ensino Técnico</option>" +
        "<option value='4' "+(dados['nivel'] == 4 ? 'selected' : '')+">Ensino Superior</option>" +
        "<option value='5' "+(dados['nivel'] == 5 ? 'selected' : '')+">Pós-Graduação</option>" +
        "</select>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='dtInicioFormacao_"+dados['id']+"'>Data de Início</label>" +
        "<input type='date' name='dtInicioFormacao_"+dados['id']+"' disabled value='"+dados['dtInicioFormacao']+"' class='form-control'/>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='dtFimFormacao_"+dados['id']+"'>Data de Formação (Previsão de Conclusão)</label>" +
        "<input type='date' name='dtFimFormacao_"+dados['id']+"' disabled value='"+dados['dtFimFormacao']+"' id='dtFimFormacao_"+dados['id']+"' class='form-control'/>" +
        "</div>" +
        "</div>" +
        "</div>"
    )
}

function carregarEscolaridadeCandidato(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarEscolaridadeCandidato&id="+id, success: function(data){

        var resultado = JSON.parse(data);

        if(resultado.length > 0){
            for(var i = 0; i < resultado.length; i++) {

                adicionarLinhaFormacaoCandidato(resultado[i]);
    
            }
        } else {
            $(".formacoes").append("<i>Nenhuma informação disponível.</i>");
        }

        

    }});

}

function verCurriculo(idCurriculo) {
    bloqueia('body', true, 'win8', 'Buscando dados do currículo...');
    pesquisaCodigo(idCurriculo);
}

function pesquisaCodigo(idCurriculo) {
    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarCurriculo&id="+idCurriculo, success: function(data){

        var dados = JSON.parse(data);

        $("#modalVerCurriculo").modal('toggle');

        $("[name='id']").val(idCurriculo);
        $("[name='nome']").val(dados[0]['nome']);
        $("[name='cpf']").val(dados[0]['cpf']);
        $('input:radio[name="sexo"]').filter('[value="'+dados[0]['sexo']+'"]').attr('checked', true);
        $("[name='estadoCivil']").val(dados[0]['estado_civil']);
        $("[name='naturalidade']").val(dados[0]['naturalidade']);
        $("[name='dt_nascimento']").val(dados[0]['data_nascimento']);
        $("[name='email']").val(dados[0]['email']);
        $("[name='pcd']").val(dados[0]['pcd']);

        $("[name='endereco']").val(dados[0]['endereco']);
        $("[name='numero']").val(dados[0]['numero']);
        $("[name='complemento']").val(dados[0]['complemento']);
        $("[name='bairro']").val(dados[0]['bairro']);
 
        carregaEstadosVerCurriculo(dados[0]['estado']);
        carregaCidadesVerCurriculo(dados[0]['estado'], dados[0]['cidade']);

        $("[name='celular']").val(dados[0]['celular']);
        $("[name='fixo']").val(dados[0]['fixo']);
        $("[name='linkedin']").val(dados[0]['linkedin']);
        $("[name='facebook']").val(dados[0]['facebook']);
        $("[name='blog']").val(dados[0]['blog']);

        $('[name=cpf]').mask('000.000.000-00');

        var SPMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };
          
        $('[name=fixo]').mask("(00) 0000-0000");
        $('[name=celular]').mask(SPMaskBehavior, spOptions);
        $('[name=observacoes_candidato]').val(dados[0]['observacoes']);
    
        carregarAreasVerCurriculo(dados[0]['area_interesse']);
        carregarNiveisVerCurriculo(dados[0]['nivel_interesse']);

        carregarExperienciasCandidato(dados[0]['id']);
        carregarIdiomasCandidato(dados[0]['id']);
        carregarEscolaridadeCandidato(dados[0]['id']);

        bloqueia('body', false);

    }});
}

function filtrarCandidatos() {

    window.location.href = '?pg=candidatos' + this.getParamsFromFilter();

}

function verCandidaturas(idCandidato) {
    $.post({url: "pages/candidatos/funcoesCandidatos.php?funcao=verCandidaturas", data: {idCandidato}, success: function(result){
        var data = JSON.parse(result);

        var dados = '';

        if(data.length > 0) {

            for(var i=0; i<data.length; i++) {

                var dtCandidatura = data[i].dt_candidatura;
                dtCandidatura = dtCandidatura.split(' ');
                horaCandidatura = dtCandidatura['1'];
                dtCandidatura = dtCandidatura['0'].split('-');

                dados += '<b>Cargo:</b> ' + data[i]['cargo'] + '';
                dados += '<br>';
                dados += '<b>Data da Candidatura:</b> ' +dtCandidatura[2] + '/' + dtCandidatura[1] + '/' + dtCandidatura[0]+ '';
                dados += '<br><br>';
            }

            Swal.fire({
                title: 'Candidaturas',
                html: dados
            })
        } else {
            Swal.fire({
                title: 'Candidaturas',
                text: 'Nenhuma candidatura realizada.'
            })
        }
    }});
}