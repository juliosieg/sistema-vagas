$(function(){

    carregaMeusDados();

})

function carregaMeusDados() {

    var id = $("[name=id]").val();

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarCurriculo&id="+id, success: function(data){

        var dados = JSON.parse(data);

        $("[name='id']").val(dados[0]['id']);
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
 
        carregaEstados(dados[0]['estado']);
        carregaCidades(dados[0]['estado'], dados[0]['cidade']);

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
    
        carregarAreas(dados[0]['area_interesse']);
        carregarNiveis(dados[0]['nivel_interesse']);

        carregarExperiencias(dados[0]['id']);
        carregarIdiomas(dados[0]['id']);
        carregarEscolaridade(dados[0]['id']);

        bloqueia('body', false);

    }});

}

function carregaEstados(estado) {

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

function carregarAreas(area) {

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

function carregarNiveis(nivel) {

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

function adicionarLinhaExperiencia(dados) {

    $(".experiencias").append(
        "<div class='experiencia experiencia_"+dados['id']+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>" +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='empresa_"+dados['id']+"'>Empresa</label>" +
        "<input type='text' name='empresa_"+dados['id']+"' value='"+dados['empresa']+"' required class='form-control' placeholder='Empresa'/>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='cargo_"+dados['id']+"'>Cargo</label>" +
        "<input type='text' name='cargo_"+dados['id']+"' value='"+dados['cargo']+"' required class='form-control' placeholder='Cargo'/>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='dtInicioEmpresa_"+dados['id']+"'>Data de Início</label>" +
        "<input type='date' name='dtInicioEmpresa_"+dados['id']+"' value='"+dados['dtInicio']+"' required class='form-control' placeholder='dd/mm/yyyy'/>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='dtFimEmpresa_"+dados['id']+"'>Data de Saída</label>" +
        "<input type='date' name='dtFimEmpresa_"+dados['id']+"' id='dtFimEmpresa_"+dados['id']+"' value='"+dados['dtFim']+"' class='form-control' placeholder='dd/mm/yyyy'/>" +
        "</div>" +
        "<div class='col-md-6'></div>" +
        "<div class='col-md-6'>" +
        "<input type='checkbox' class='form_control' id='trabalhoAtual_"+dados['id']+"' name='trabalhoAtual_"+dados['id']+"' "+(dados['trabalhoAtual'] == 1 ? 'checked' : '' )+"/>" +
        "<label for='trabalhoAtual_"+dados['id']+"' style='font-weight: normal'>&nbsp;Ainda estou trabalhando nessa empresa</label>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-12'>" +
        "<label for='atribuicoes_empresa_"+dados['id']+"'>Principais atribuições</label>" +
        "<textarea id='atribuicoes_empresa_"+dados['id']+"' required class='form-control' name='atribuicoes_empresa_"+dados['id']+"' rows='5'>"+dados['atribuicoes']+"</textarea>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-12' style='text-align: right'>" +
        "<br>" +
        "<div class='pull-right'>" +
        "<a href='javascript:excluirLinhaExperienciaProfissional("+dados['id']+")' class='btn btn-danger btn-flat'>Excluir</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<br class='experiencia_"+dados['id']+"'/>"
    )


}

function carregarExperiencias(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarExperienciasCandidato&id="+id, success: function(data){

        var resultado = JSON.parse(data);

        for(var i = 0; i < resultado.length; i++) {

            adicionarLinhaExperiencia(resultado[i]);

        }
    

    }});

}

function carregaOpcoesIdiomas(id, idioma) {

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

function adicionarLinhaIdioma(dados) {
    $(".idiomas").append(
        "<div class='idioma idioma_"+dados['id']+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'> " +
        "<div class='row'>" +
        "<div class='col-md-6'>" +
        "<label for='idioma_"+dados['id']+"'>Idioma</label>" +
        "<select name='idioma_"+dados['id']+"' required class='form-control' placeholder='Idioma'>" +
        "</select>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='nivel_idioma_"+dados['id']+"'>Nível</label>" +
        "<select  name='nivel_idioma_"+dados['id']+"' required class='form-control'>" +
        "</select>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-12' style='text-align: right'>" +
        "<br>" +
        "<div class='pull-right'>" +
        "<a href='javascript:excluirIdioma("+dados['id']+")' class='btn btn-danger btn-flat'>Excluir</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<br class='idioma_"+dados['id']+"'/>"
    )

    carregaOpcoesIdiomas(dados['id'], dados['idioma']);
    carregaOpcoesNiveisIdiomas(dados['id'], dados['nivel']);
}

function carregarIdiomas(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarIdiomasCandidato&id="+id, success: function(data){

        var resultado = JSON.parse(data);

        for(var i = 0; i < resultado.length; i++) {

            adicionarLinhaIdioma(resultado[i]);

        }
    
    }});

}

function adicionarLinhaFormacao(dados) {
    $(".formacoes").append(
        "<div class='formacao formacao_"+dados['id']+"' style='border-radius: 4px; border: 1px solid #e4e4e4; padding: 10px; background-color: snow'>" +
        "<div class='row'>" +
        "<div class='col-md-4'>" +
        "<label for='instituicao_"+dados['id']+"'>Instituição</label>" +
        "<input type='text' name='instituicao_"+dados['id']+"' value='"+dados['instituicao']+"' required class='form-control' placeholder='Instituição'/>" +
        "</div>" +
        "<div class='col-md-4'>" +
        "<label for='curso_"+dados['id']+"'>Curso</label>" +
        "<input type='text' name='curso_"+dados['id']+"' value='"+dados['curso']+"' required class='form-control' placeholder='Curso'/>" +
        "</div>" +
        "<div class='col-md-4'>" +
        "<label for='nivel_"+dados['id']+"'>Nível</label>" +
        "<select name='nivel_"+dados['id']+"' required class='form-control'>" +
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
        "<input type='date' name='dtInicioFormacao_"+dados['id']+"' value='"+dados['dtInicioFormacao']+"' required class='form-control' placeholder='dd/mm/yyyy'/>" +
        "</div>" +
        "<div class='col-md-6'>" +
        "<label for='dtFimFormacao_"+dados['id']+"'>Data de Formação (Previsão de Conclusão)</label>" +
        "<input type='date' name='dtFimFormacao_"+dados['id']+"' required id='dtFimFormacao_"+dados['id']+"' value='"+dados['dtFimFormacao']+"' class='form-control' placeholder='dd/mm/yyyy'/>" +
        "</div>" +
        "</div>" +
        "<div class='row'>" +
        "<div class='col-md-12' style='text-align: right'>" +
        "<br>" +
        "<div class='pull-right'>" +
        "<a href='javascript:excluirFormacao("+dados['id']+")' class='btn btn-danger btn-flat'>Excluir</a>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "<br class='formacao_"+dados['id']+"'/>"
    )
}

function carregarEscolaridade(id) {

    $.get({url: "pages/candidatos/funcoesCandidatos.php?funcao=carregarEscolaridadeCandidato&id="+id, success: function(data){

        var resultado = JSON.parse(data);

        for(var i = 0; i < resultado.length; i++) {

            adicionarLinhaFormacao(resultado[i]);

        }

    }});

}

function excluirLinhaExperienciaProfissional(id) {
    $(".experiencia_"+id).remove();
}

function excluirFormacao(id) {
    $(".formacao_"+id).remove();
}

function excluirIdioma(id) {
    $(".idioma_"+id).remove();
}

function adicionarNovaFormacao(){
    var maxValue = 0;
    $(".formacao").each(function() {

        var classes = $(this).attr("class");
        if(classes != undefined) {
            classes = classes.replaceAll("formacao", "");
            classes = classes.replace("_", "");
            classes = parseInt(classes);

            if(classes > maxValue) {
                maxValue = classes;
            }
        }
    })

    var dados = {
        id: maxValue + 1,
        instituicao: '',
        curso: '',
        dtInicioFormacao: '',
        dtFimFormacao: ''
    }

    adicionarLinhaFormacao(dados);
}

function adicionarNovaExperiencia() {

    var maxValue = 0;
    $(".experiencia").each(function() {

        var classes = $(this).attr("class");
        if(classes != undefined) {
            classes = classes.replaceAll("experiencia", "");
            classes = classes.replace("_", "");
            classes = parseInt(classes);

            if(classes > maxValue) {
                maxValue = classes;
            }
        }
    })

    var dados = {
        id: maxValue + 1,
        empresa: '',
        cargo: '',
        dtInicio: '',
        dtFim: '',
        trabalhoAtual: '',
        atribuicoes: ''
    }

    adicionarLinhaExperiencia(dados);
}

function adicionarNovoIdioma() {

    var maxValue = 0;
    $(".idioma").each(function() {

        var classes = $(this).attr("class");
        if(classes != undefined) {
            classes = classes.replaceAll("idioma", "");
            classes = classes.replace("_", "");
            classes = parseInt(classes);

            if(classes > maxValue) {
                maxValue = classes;
            }
        }
    })

    var dados = {
        id: maxValue + 1,
        idioma: '',
        nivel: ''
    }

    adicionarLinhaIdioma(dados);
}

function salvarDados() {
    bloqueia('body', true, 'win8', 'Aguarde...');

    var form = $("#formMeusDados");

    $.post({
        dataType: "json",
        url: './pages/meus-dados/salvarDados.php',
        data: form.serialize(),
        success: function (data) {
            $.each(data, function(key, value)
            {    
                if(value['ret']==true) {
                    bloqueia('body', false, '', '');
                    toastr.success(value['msg']);
                }
                else{
                    bloqueia('body', false, '', '');
                    toastr.error(value['msg']);
                }
            });
        }
    });

}