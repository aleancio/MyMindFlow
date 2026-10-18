function updateSinglePost(id_post, surce)
{
			$.ajax({
                    type : 'POST',
                    url : '../../Social/PostManager.php',
                    data : {
                    	id : id_post,
                        operazione : 'mostraSingolo'
                    },
                    success : function(retPar){
                            
                            retPar = retPar.split("</html>").pop()
                           // console.log(retPar)
                            document.getElementById('post'+id_post).innerHTML = retPar;
                            document.getElementById('like'+id_post).src = surce;
                            
                    }
                }) 

}

function mettiLike(id_post){

         
         if(document.getElementById('like'+id_post).src != 'https://mindflow.altervista.org/IMAGES/liked.png'){
                $.ajax({
                        type : 'POST',
                        url : '../../Social/PostManager.php',
                        data : {
                            id : id_post,
                            operazione : 'like'
                        },
                        success : function(retPar){
                                //result = JSON.parse(retPar);


                                        //document.getElementById('content').innerHTML = '';	
                                        //showAllPost();
                                        console.log(retPar)
                                        updateSinglePost(id_post, retPar)


                        }
                    })  
                }
                else {
               // alert('togli_like')
                      $.ajax({
                      type : 'POST',
                      url : '../../Social/PostManager.php',
                      data : {
                          id : id_post,
                          operazione : 'togli_like'
                      },
                      success : function(retPar){
                              //result = JSON.parse(retPar);
									console.log(retPar)

                                      //document.getElementById('content').innerHTML = '';	
                                      //showAllPost();
                                      //console.log('like'+id_post)
                                      updateSinglePost(id_post, retPar)


                      }
                  })                  
                
                }


}

