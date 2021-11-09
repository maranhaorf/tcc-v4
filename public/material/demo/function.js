function Cadastrar_Produto(value) {
    
    $.ajax({
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": value
        },
        url: "{{ route('arquivar_ct') }}",
        success: function (msg) {
            if(msg == 'deu certo'){
                mensagem = "Operaçao Finalizada";
                load_fim(mensagem);
                setTimeout(() => { location.reload();}, 2000);
            }else{
                load_fim(msg);
                window.location.assign(msg);
            }


        }
    });
}

function Pesquisar(value) {
    alert(value)
    $.ajax({
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": value
        },
        url: "{{ route('baixar_planilha') }}",
        success: function (msg) {
            window.location.assign(msg);
        }
    });
    }