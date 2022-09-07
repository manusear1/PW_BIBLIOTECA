window.onload = function(){
var url = "https://profrodolfo.com.br/biblioteca/livro.php";
fetch(url)
.then(resposta => {
	return resposta.json();
})
.then( function (json){
	var d = document.querySelector('.dados');
    var texto = '';
	for(i = 0; i < json.length ; i++){
		texto += '<div class="container">';
        texto += '<div class="cont">';
        texto += '<img class="img-fluid" src="'+json[i].capa+'" id="img">';
        texto += '<div class="descricao">'; 
        texto += '<h3> Titulo: '+json[i].titulo+'</h3>';
        texto += '<h3> Sinopse: '+json[i].sinopse+'</h3>';
        texto += '<h3> Editora: '+json[i].id_editora+'</h3>';
        texto += '<h3> Gênero: '+json[i].id_genero+'</h3>';
        texto += '<h3> Classificação: '+json[i].classificacao+'</h3>';
        texto += '<h3>Ano: '+json[i].ano+'</h3>';
        texto += '</div>';
        texto += '</div>';
        texto += '</div> <br>';
	}
    d.innerHTML += texto;
})
.catch();
}