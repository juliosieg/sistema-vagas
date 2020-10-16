$(function(){

    carregaCandidatos();
    carregaAreas();
    carregaNiveis();
    carregaIdiomas();
    carregaNiveisIdioma();
    carregaEstados();
    
    var estado = searchParam('estado');
    var cidade = searchParam('cidade');
    
    if(estado && estado != '' && cidade && cidade != '') {
        carregaCidades(estado, cidade)
    }
    

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

        var selected = '';

        for(var i = 0; i < resultado.length; i++) {

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

        var selected = '';

        for(var i = 0; i < resultado.length; i++) {

            
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
        var selected = '';
        
        for(var i = 0; i < resultado.length; i++) {
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

        var selected = '';

        for(var i = 0; i < resultado.length; i++) {

            if(selectedParam && selectedParam != '' && selectedParam == resultado[i].id){
                selected = 'selected';
            }

            var option = '<option value="'+resultado[i].id+'" '+selected+'>'+resultado[i].nivel+'</option>';
            $("[name=filtro_nivel_idioma]").append(option);
        }
    }});
}

function carregaEstados() {

    var selectedParam = this.searchParam('estado');

    $.get({url: "pages/vagas/funcoesVagas.php?funcao=carregarEstados", success: function(result){
        var resultado = JSON.parse(result);

        $("[name=filtro_estado]").append( '<option value="">Selecione</option>');

        var selected = '';

        for(var i = 0; i < resultado.length; i++) {

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

function carregaCandidatos() {

    var url = "pages/candidatos/funcoesCandidatos.php?funcao=carregarCandidatos" + this.getParams();

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
        <i class='fa fa-link' title='" + (rowData.blog == '' ? "Blog Indisponível'" : "Acessar Blog'") + " style='" + (rowData.blog == '' ? "cursor: normal; color: gray;'" : "cursor: pointer;'") + "' onclick=\"abrirLinkNovaAba(\'"+rowData.blog+"\')\"/></i> \n\ "));
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

function verCurriculo(idCurriculo) {
    bloqueia('body', true, 'win8', 'Buscando dados do currículo...');
    //pesquisaCodigo(idCurriculo, true);
}

function getParams() {

    var area = $('[name=filtro_area]').val();
    var nivel = $('[name=filtro_nivel]').val();
    var idioma = $('[name=filtro_idioma]').val();
    var nivel_idioma = $('[name=filtro_nivel_idioma]').val();
    var estado = $('[name=filtro_estado]').val();
    var cidade = $('[name=filtro_cidade]').val();
 
    return '&area=' + area + '&nivel=' + nivel + 
    '&idioma=' + idioma + '&nivel_idioma=' + nivel_idioma + '&estado=' +
    estado + '&cidade=' + cidade;

}

function filtrarCandidatos() {

    window.location.href = '?pg=candidatos' + this.getParams();

}