class FormFilho {

    constructor(tipo) {

        this.tipo = tipo;

        this.formulario = $("form[tipo=" + tipo + "]");

        this.formulario_dados = null;

        this.tabela = $("table[tipo=" + tipo + "]");

        this.tabela_coluna = null;

    }

    static pegarFilhos() {

        let filhos = new Object();

        $(".form-filho").each(function () {

            filhos[$(this).attr('tipo')] = new FormFilho($(this).attr('tipo'));

        });

        return filhos;

    }

    alimentarDados() {

        let formulario_dados = new Object;

        $("form[tipo=" + this.tipo + "]").find("input[coluna], select[coluna]").each(function () {

            formulario_dados[$(this).attr("coluna")] = $(this).val();

        });

        let tabela_coluna = new Object;

        this.formulario_dados = formulario_dados;

        $("table[tipo=" + this.tipo + "]").find("th").each(function () {

            tabela_coluna[$(this).attr("coluna")] = $(this).attr('class');

        });

        this.tabela_coluna = tabela_coluna;

    }


    inserirTabelaFilha() {

        this.alimentarDados();

        let pos = this.tipo.indexOf('_');

        let k1 = this.tipo.substring(pos + 1) + "_id";

        let k2 = this.tipo.substring(0, pos) + "_id";

        let v1 = $("input[tipo=" + this.tipo + "][coluna=" + k1 + "]").val();

        let v2 = $("input[tipo=" + this.tipo + "][coluna=" + k2 + "]").val();

        let l = (this.tabela.find("td[coluna=" + k1 + "][coluna-valor=" + v1 + "]").length > 0 && this.tabela.find("td[coluna=" + k2 + "][coluna-valor=" + v2 + "]").length > 0)

        if (pos != -1 && l) {

            alert('Esse registro já existe na tabela');

        } else {

            let fd = Object.entries(this.formulario_dados);

            let tc = Object.entries(this.tabela_coluna);

            let tck = Object.entries(this.tabela_coluna).map(function (v) {

                return v[0];

            });

            let c = null;

            for (let i = 0; i < fd.length; i++) {

                if (tck.indexOf(fd[i][0]) > -1) {

                    c = c + "<td class='new-row " + tc[i][1] + "' coluna=" + tc[i][0] + " coluna-valor=" + fd[i][1] + ">" + fd[i][1] + "</td>";

                }

            }

            this.tabela.find("tbody").append(
                "<tr id=>" + c + "<td class='new-row'> <a type='button' class='btn btn-danger action-buttons remover-filho'><i class='fa fa-trash fa-sm'></i></a></td></tr>"
            );

        }

    }

    removerTabelaFilha(linha) {

        if (linha.closest('td').hasClass('new-row')) {

            linha.closest('tr').remove();

        } else {

            this.tabela.find("tr#" + linha.closest('tr').attr('id')).children().addClass('deleted-row');

        }
    }

    passarFilhosSessao() {

        let dados = new Object();

        let filhos_incluir = new Array();

        let filhos_deletar = new Array();

        this.tabela.find(".new-row").parents("tr").each(function () {

            let o = new Object();

            $(this).children().each(function () {

                o[$(this).attr('coluna')] = $(this).attr('coluna-valor');


            })

            filhos_incluir.push(o);

        });

        dados.filhos_incluir = filhos_incluir;


        this.tabela.find(".deleted-row").parents("tr").each(function () {

            let o = new Object();

            $(this).children().each(function () {

                o[$(this).attr('coluna')] = $(this).attr('coluna-valor');


            })

            filhos_deletar.push(o);

        });

        dados.filhos_deletar = filhos_deletar;

        dados.tipo = this.tipo;

        return ajaxRequest(dados, 'incluir');

    }

}

class ModalPesquisa {

    constructor(tipo) {

        this.tipo = tipo;

        let tipo_principal = new Object();

        tipo_principal.tipo = tipo.split("_")[0];

        tipo_principal.valor = $("button[modal-tipo=" + tipo + "]").parent().siblings('input').val();

        this.tipo_principal = tipo_principal;

        let trt = tipo.split("_");

        trt.length > 1 ? trt.shift() : (trt = []);

        trt = (Array.isArray(trt) && trt !== []) ? trt : new Array(trt);

        let tr = new Array();

        if (trt !== []) {

            for (let i = 0; i < trt.length; i++) {

                let o = new Object();

                o.tipo = trt[i];

                o.valor = $("input[coluna=" + trt[i].slice(0, -1) + "_id], select[coluna=" + trt[i].slice(0, -1) + "_id]").val();

                tr.push(o);

            }

        }

        this.tipos_relacionados = tr;

        let dados = new Object();

        dados.tipo = this.tipo;

        dados.tipo_principal = this.tipo_principal;

        dados.tipos_relacionados = this.tipos_relacionados;

        this.dados = dados;


    }

    criarModal() {

        var r = ajaxRequest(this.dados, 'consultar');

        let tipo = this.tipo;

        $.when(r).done(function (response) {

            if ($(".modal[tipo=" + tipo + "]").length === 0) {

                $("button[modal-tipo=" + tipo + "]").after(
                    "<div class='modal fade' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' tipo=" + tipo + ">" +
                    "<div class='modal-dialog' role='document'>" +
                    "<div class='modal-content'>" +
                    "<div class='modal-header'>" +
                    "<h5 class='modal-title' id='exampleModalLabel'>Escolha a opção</h5>" +
                    "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
                    "<span aria-hidden='true'>&times;</span>" +
                    "</button>" +
                    "</div>" +
                    "<div class='modal-body'>" +
                    "</div>" +
                    "<div class='modal-footer'>" +
                    "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

            }

            let modal = $(".modal[tipo=" + tipo + "]");

            let res = response.resultado;

            modal.find("#results-list").remove();

            modal.find(".modal-body").append("<ul id='results-list'> </ul>");

            let i;

            for (i = 0; i < res.length; i++) {

                modal.find("#results-list").append("<li id=" + res[i].id + ">" + res[i]['coluna'] + "</li>");

            }

            modal.modal('show');

            $("li").click(function () {

                let id_escolhida = $(this).attr('id');

                $(this).parents(".input-group").children("input").val(id_escolhida);

                modal.modal('hide');

            });


        });


    }

}

function ajaxRequest(dados, rota) {

    let _token = $('meta[name="csrf-token"]').attr('content');
    var objDiferido = $.Deferred();

    $.ajax({
        url: "/ajax/" + rota,
        type: "POST",
        dataType: 'JSON',
        data: {
            dados: dados,
            _token: _token
        },
        success: function (response) {

            objDiferido.resolve(response);

        },
    });

    return objDiferido.promise()

}

$(document).ready(function () {

    let filhos = FormFilho.pegarFilhos();

    $("button[form=form-principal]").on('click', function (event) {

        event.preventDefault();

        let e = Object.entries(filhos);

        let req = new Array();

        for (let i = 0; i < e.length; i++) {

            let r = e[i][1].passarFilhosSessao();

            req.push(r);

        }


        $.when.apply($, req).done(function () {

            $("form#form-principal").submit();

        });

    });


    $(".incluir-filho").on('click', function (event) {

        event.preventDefault();

        filhos[$(this).attr('tipo')].inserirTabelaFilha();
    });

    $("table").on('click', '.remover-filho', function () {

        filhos[$(this).parents("table").attr('tipo')].removerTabelaFilha($(this));

    });

    $("button[modal-tipo]").on('click', function (event) {

        event.preventDefault();

        let m = new ModalPesquisa($(this).attr('modal-tipo'));


        m.criarModal();

    });

});
