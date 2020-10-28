$(function(){

    carregarCandidaturas();

    $.get({url: "pages/admin/funcoesAdmin.php?funcao=carregarDashboard", success: function(result){
        var resultado = JSON.parse(result);

        $(".qtdVagas").text(resultado['qtdVagas']);
        $(".qtdCandidatos").text(resultado['qtdCandidatos']);
        $(".qtdVagasCandidato").text(resultado['qtdVagasCandidato'] + ' Vaga(s) Aberta(s)');
        $(".dtAtualizacaoDados").text(resultado['dtAtualizacaoDados']);
    }});

});

function carregarCandidaturas() {

    $.get({url: "pages/admin/funcoesAdmin.php?funcao=carregarCandidaturas", success: function(result){

        var json = JSON.parse(result);

        if(json.length > 0) {
            $(".minhasCandidaturas").html('');

            for(var i = 0; i < json.length; i++ ){

                var dtCandidatura = json[i].dt_candidatura;
                dtCandidatura = dtCandidatura.split(' ');
                horaCandidatura = dtCandidatura['1'];
                dtCandidatura = dtCandidatura['0'].split('-');

                $(".minhasCandidaturas").append(
                    '<div class="col-md-3">' +
                    '<div class="info-box bg-default">' +
                    '<span class="info-box-icon"><i class="fa fa-briefcase"></i></span>' +
                    '<div class="info-box-content">' +
                    '<span class="info-box-text"><b>'+json[i].cargo+'</b></span>' +
                    '<span>Candidatura realizada em '+dtCandidatura[2] + '/' + dtCandidatura[1] + '/' + dtCandidatura[0]+'</span>' +
                    '<br><span>Status: '+(json[i].status == 1 ? 'Candidaturas abertas' : 'Processo em andamento')+'</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                );
            }
        }

    }});
    
}