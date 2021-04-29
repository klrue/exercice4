(function(){

    let bouton = document.getElementById('bout_nouvelles')
    let nouvelles = document.querySelector('.nouvelles section')
   //bouton.addEventListener('mousedown', monAjax)
    window.addEventListener('load', monAjax)


    function monAjax()
    {
       let maRequete = new XMLHttpRequest();
       console.log(maRequete)
       maRequete.open('GET', 'http://localhost/4w4-1/wp-json/wp/v2/posts?categorie=33&per_page=3');
       maRequete.onload = function () {
           console.log(maRequete)
           if (maRequete.status >= 200 && maRequete.status < 400) {
               let data = JSON.parse(maRequete.responseText);
               chaineResultat = '';
               for(const elm of data){
                chaineResultat += '<h2>' + elm.title.rendered + '</h2>'
                chaineResultat += elm.content.rendered
               }
               nouvelles.innerHTML = chaineResultat;
            }
           
            else {
               console.log('La connexion est faite mais il y a une erreur')
           }
       }
       maRequete.onerror = function () {
           console.log("erreur de connexion");
       }
       maRequete.send()
    }
}())