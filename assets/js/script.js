jQuery(document).ready(function( $ ){
if( jQuery('.my_camera').length )
{

    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '.my_camera' );
  
  
  jQuery('.takeimage').click(function(){
    Webcam.snap( function(data_uri) {
    		jQuery('.web-cam-column-first').hide();
            Webcam.reset( '.my_camera' );
           	jQuery(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
        
    
  });

}

});