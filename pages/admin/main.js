$(function(){

    $.get({url: "pages/admin/funcoesAdmin.php?funcao=carregarDashboard", success: function(result){
        var resultado = JSON.parse(result);

        $(".qtdVagas").text(resultado['qtdVagas']);
        $(".qtdCandidatos").text(resultado['qtdCandidatos']);
    }});

});