function mostraPostPiaciuti()
{                 
                    
                    $.ajax({
                    type : 'POST',
                    url : 'https://mindflow.altervista.org/Locale/IndexProfileScreen/retrieveProjects.php',
                    data : {
                    	mostra_piaciuti : true
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                            
                             console.log(retPar)
							//showOnlineImage(retPar)
                            
                            document.getElementById('projects').innerHTML = '<button class="reloadbutton" onclick = "window.location.reload()"> Back </button>'
                            document.getElementById('searchBar').innerHTML = '' 
                            document.getElementById('projects').innerHTML += retPar
                            
                    }
                })   


}
function mostraAmici()
{                 
                    
                    $.ajax({
                    type : 'POST',
                    url : 'https://mindflow.altervista.org/Locale/IndexProfileScreen/retrieveProjects.php',
                    data : {
                    	mostra_amici : true
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                            
                             console.log(retPar)
							//showOnlineImage(retPar)
                            
                            document.getElementById('projects').innerHTML = '<button class="reloadbutton" onclick = "window.location.reload()"> Back </button>'
                            document.getElementById('searchBar').innerHTML = '' 
                            document.getElementById('projects').innerHTML += retPar
                            
                    }
                })   


}

function mostraPropriPost()
{                 
                    
                    $.ajax({
                    type : 'POST',
                    url : 'https://mindflow.altervista.org/Locale/IndexProfileScreen/retrieveProjects.php',
                    data : {
                    	mostra_post : true
                    },
                    success : function(retPar){
                    		//result = JSON.parse(retPar);
                            
                             console.log(retPar)
							//showOnlineImage(retPar)
                            document.getElementById('searchBar').innerHTML = '' 
                            document.getElementById('projects').innerHTML = '<button class="reloadbutton" onclick = "window.location.reload()"> Back </button>'
                            document.getElementById('projects').innerHTML += retPar
                            
                    }
                })   


}
