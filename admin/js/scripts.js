tinymce.init({ selector:'textarea' });
/*document.getElementById('checkAllBoxes').addEventListener('check',function(){
    
    console.log("hiii");
});*/
//jQuery
$(document).ready(function(){
  // alert("hi"); 
    $('#checkAllBoxes').click(function(event){
        if(this.checked){
            //alert("hi"); 
            
            $('.checkBoxes').each(function(){
                
                
                this.checked=true;
            });
        }else{
            $('.checkBoxes').each(function(){
                
                
                this.checked=false;
            });
            
        }
    });
    
    
   // $("body").prepend("hallo");
    
   /* var divBox="<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(divBox);
   /* $('#load-sceen').delay(700).fadeOut(600,function(){
        
        $('this').remove();
        
    });*/
});
