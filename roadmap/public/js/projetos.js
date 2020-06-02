$(document).ready(function () {

    $("button#pesquisar-roadmap").on('click', function (event) {

        event.preventDefault();

        $(".invalid-feedback").remove();

        if ($("input[name=descricao]").val().length > 0 && $("input[name=descricao]").val().length < 3) {

            $("input[name=descricao]").after(
                "<span class='d-block invalid-feedback' role='alert'>" +
                "<strong>O argumento de pesquisa deve ter ao menos 3 letras.</strong>" +
                "</span>"
            );

        } else {

            var loc = 0;

            $(".projeto-card").each(function () {

                if ($(this).attr('projeto-id') == $("input[name=id]").val()) {

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(this).offset().top
                    }, 2000);

                    loc = 1;

                    return;

                } else if ($("input[name=descricao]").val().length > 2 && $(this).attr('projeto-descricao').toUpperCase().includes($("input[name=descricao]").val().toUpperCase())) {

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(this).offset().top
                    }, 2000);

                    loc = 1;

                    return;

                }


            })

            if (loc === 0) {

                alert('O projeto não foi localizado.');
            }

        }

    });

});
