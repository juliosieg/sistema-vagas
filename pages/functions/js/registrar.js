$(function(){

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

    carregaEstados();
    carregaAreas();
    carregaNiveis();
    carregaIdiomas(1);
    carregaNiveisIdiomas(1);

})

$('[name=btnExperienciaProfissional]').on('click', function() {
    $(".experiencias").append(
        adicionarNovaLinhaExperienca()
    )
});

$('[name=btnFormacao]').on('click', function() {
    $(".formacoes").append(
        adicionarNovaFormacao()
    )
});

$('[name=btnIdioma]').on('click', function() {

    var classes = $(".idioma").last().attr("class");
    if(classes != undefined) {
        classes = classes.replaceAll("idioma", "");
        classes = classes.replace("_", "");
        classes = parseInt(classes);
        var nextId = classes + 1;

    } else {
        nextId = 1;
    }

    $(".idiomas").append(
        adicionarNovoIdioma(nextId)
    )

    carregaIdiomas(nextId);
    carregaNiveisIdiomas(nextId);
});

function adicionarNovoIdioma(nextId) {
    
    return "<div class='idioma idioma_"+nextId+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'> " +
    "<div class='row'>" +
    "<div class='col-md-6'>" +
    "<label for='idioma_"+nextId+"'>Idioma</label>" +
    "<select name='idioma_"+nextId+"' required class='form-control' placeholder='Idioma'>" +
    "</select>" +
    "</div>" +
    "<div class='col-md-6'>" +
    "<label for='nivel_idioma_"+nextId+"'>Nível</label>" +
    "<select  name='nivel_idioma_"+nextId+"' required class='form-control'>" +
    "</select>" +
    "</div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-12' style='text-align: right'>" +
    "<br>" +
    "<div class='pull-right'>" +
    "<a href='javascript:excluirIdioma("+nextId+")' class='btn btn-danger btn-flat'>Excluir</a>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "<br class='idioma_"+nextId+"'/>";

    
}

function adicionarNovaFormacao() {

    var classes = $(".formacao").last().attr("class");
    if(classes != undefined) {
        classes = classes.replaceAll("formacao", "");
        classes = classes.replace("_", "");
        classes = parseInt(classes);
        var nextId = classes + 1;

    } else {
        nextId = 1;
    }
    

    return "<div class='formacao formacao_"+nextId+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>" +
    "<div class='row'>" +
    "<div class='col-md-4'>" +
    "<label for='instituicao_"+nextId+"'>Instituição</label>" +
    "<input type='text' name='instituicao_"+nextId+"' required class='form-control' placeholder='Instituição'/>" +
    "</div>" +
    "<div class='col-md-4'>" +
    "<label for='curso_"+nextId+"'>Curso</label>" +
    "<input type='text' name='curso_"+nextId+"' required class='form-control' placeholder='Curso'/>" +
    "</div>" +
    "<div class='col-md-4'>" +
    "<label for='nivel_"+nextId+"'>Nível</label>" +
    "<select name='nivel_"+nextId+"' required class='form-control'>" +
    "<option value=''>Selecione</option>" +
    "<option value='1'>Ensino Fundamental</option>" +
    "<option value='2'>Ensino Médio</option>" +
    "<option value='3'>Ensino Técnico</option>" +
    "<option value='4'>Ensino Superior</option>" +
    "<option value='5'>Pós-Graduação</option>" +
    "</select>" +
    "</div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-6'>" +
    "<label for='dtInicioFormacao_"+nextId+"'>Data de Início</label>" +
    "<input type='date' name='dtInicioFormacao_"+nextId+"' required class='form-control' placeholder='dd/mm/yyyy'/>" +
    "</div>" +
    "<div class='col-md-6'>" +
    "<label for='dtFimFormacao_"+nextId+"'>Data de Formação (Previsão de Conclusão)</label>" +
    "<input type='date' name='dtFimFormacao_"+nextId+"' required id='dtFimFormacao_"+nextId+"' class='form-control' placeholder='dd/mm/yyyy'/>" +
    "</div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-12' style='text-align: right'>" +
    "<br>" +
    "<div class='pull-right'>" +
    "<a href='javascript:excluirFormacao("+nextId+")' class='btn btn-danger btn-flat'>Excluir</a>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>"+
    "<br class='formacao_"+nextId+"'/>";
}

function adicionarNovaLinhaExperienca() {

    var classes = $(".experiencia").last().attr("class");
    if(classes != undefined) {
        classes = classes.replaceAll("experiencia", "");
        classes = classes.replace("_", "");
        classes = parseInt(classes);
        var nextId = classes + 1;

    } else {
        nextId = 1;
    }
    

    return "<div class='experiencia experiencia_"+nextId+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>" +
    "<div class='row'>" +
    "<div class='col-md-6'>" +
    "<label for='empresa_"+nextId+"'>Empresa</label>" +
    "<input type='text' name='empresa_"+nextId+"' required class='form-control' placeholder='Empresa'/>" +
    "</div>" +
    "<div class='col-md-6'>" +
    "<label for='cargo_"+nextId+"'>Cargo</label>" +
    "<input type='text' name='cargo_"+nextId+"' required class='form-control' placeholder='Cargo'/>" +
    "</div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-6'>" +
    "<label for='dtInicioEmpresa_"+nextId+"'>Data de Início</label>" +
    "<input type='date' name='dtInicioEmpresa_"+nextId+"' required class='form-control' placeholder='dd/mm/yyyy'/>" +
    "</div>" +
    "<div class='col-md-6'>" +
    "<label for='dtFimEmpresa_"+nextId+"'>Data de Saída</label>" +
    "<input type='date' name='dtFimEmpresa_"+nextId+"' id='dtFimEmpresa_"+nextId+"' class='form-control' placeholder='dd/mm/yyyy'/>" +
    "</div>" +
    "<div class='col-md-6'></div>" +
    "<div class='col-md-6'>" +
    "<input type='checkbox' class='form_control' id='trabalhoAtual_"+nextId+"' name='trabalhoAtual_"+nextId+"'/>" +
    "<label for='trabalhoAtual_"+nextId+"' style='font-weight: normal'>&nbsp;Ainda estou trabalhando nessa empresa</label>" +
    "</div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-12'>" +
    "<label for='atribuicoes_empresa_"+nextId+"'>Principais atribuições</label>" +
    "<textarea id='atribuicoes_empresa_"+nextId+"' required class='form-control' name='atribuicoes_empresa_"+nextId+"' rows='5'></textarea>" +
    "</div>" +
    "</div>" +
    "<div class='row'>" +
    "<div class='col-md-12' style='text-align: right'>" +
    "<br>" +
    "<div class='pull-right'>" +
    "<a href='javascript:excluirLinhaExperienciaProfissional("+nextId+")' class='btn btn-danger btn-flat'>Excluir</a>" +
    "</div>" +
    "</div>" +
    "</div>" +
    "</div>"+
    "<br class='experiencia_"+nextId+"'/>";
}

function excluirLinhaExperienciaProfissional(id) {
    $(".experiencia_"+id).remove();
}

function excluirFormacao(id) {
    $(".formacao_"+id).remove();
}

function excluirIdioma(id) {
    $(".idioma"+id).remove();
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

function carregaAreas() {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarAreas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=area_interesse]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].area+'</option>';
            $("[name=area_interesse]").append(option);
        }
    }});
}

function carregaNiveis() {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarNiveis", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=nivel_interesse]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].nivel+'</option>';
            $("[name=nivel_interesse]").append(option);
        }
    }});
}

function carregaIdiomas(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarIdiomas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=idioma_"+id+"]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].idioma+'</option>';
            $("[name=idioma_"+id+"]").append(option);
        }
    }});
}

function carregaNiveisIdiomas(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarNiveisIdiomas", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=nivel_idioma_"+id+"]").append( '<option value="">Selecione</option>');

        for(var i = 0; i < resultado.length; i++) {
            var option = '<option value="'+resultado[i].id+'">'+resultado[i].nivel+'</option>';
            $("[name=nivel_idioma_"+id+"]").append(option);
        }
    }});
}

function carregaCidades(idEstado, idCidade) {

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

function enviarDados(e) {
    bloqueia('body', true, 'win8', 'Aguarde...');

    e.preventDefault();

    var form = $("#formCandidato");

    $.post({
        dataType: "json",
        url: './pages/candidatos/cadastrarCandidato.php',
        data: form.serialize(),
        success: function (data) {
            $.each(data, function(key, value)
            {    
                if(value['ret']==true) {
                    bloqueia('body', false, '', '');
                    toastr.success(value['msg']);
                    setTimeout(function(){
                        window.location.replace("./");
                    }, 3000);
                }
                else{
                    bloqueia('body', false, '', '');
                    toastr.error(value['msg']);
                }
            });
        }
    });
}