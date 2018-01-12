var url_base = "http://wwwp.cs.unc.edu/Courses/comp426-f16/users/jessiee/project/server-side";
var group_count = 1;
var controller = "/Brand_controller.php";
//var brands = $('#brands');
$(document).ready(function (){
	load_brand();
	
	$("#brand_button").on('click',function(e){
		load_brand();
		
	});

	$("#search-brand-btn").on('click',function(e) {
		var target = $('#search-brand').val();
	$.ajax('../server-side/Brand_controller.php?search='+target,
  		{async: false,
  		type: "GET",
 		  dataType: "json",
 		  success: function(brand_json) {
 		  	 if (brand_json.found == true) {
 		  	 	$('#search-result').empty();
				$('#search-result').append('<div class="col-md-4"></div><div class="col-md-4 col-sm-6 portfolio-item">'+
	                    '<a href="#brand'+brand_json.B_id+'" class="portfolio-link" data-toggle="modal">'+
	                    	                       ' <div class="portfolio-hover">'+
	                            '<div class="portfolio-hover-content">'+
	                                '<i class="fa fa-th" aria-hidden="true"></i>'+
	                            '</div>'+
	                        '</div>'+
	                        '<img style="width:400px;height:289px" src="img/logos/'+brand_json.logo_path+'" class="img-responsive" alt="img">'+
	                    '</a>'+
	                    '<div class="portfolio-caption">'+
	                       ' <h4>'+brand_json.Name+'</h4>'+
	                       ' <p class="text-muted">'+ brand_json.Origin+'</p>'+
	                   ' </div>'+
	                '</div><div class="col-md-4"></div>'
					);
				$('#content').append(    
					'<div class="portfolio-modal modal fade" id="brand'+brand_json.B_id+'" tabindex="-1" role="dialog" aria-hidden="true">'+
        '<div class="modal-dialog"><div class="modal-content"><div class="close-modal" data-dismiss="modal"><div class="lr"><div class="rl">'+
                       ' </div></div></div>'+
                '<div class="container">'+
                    '<div class="row">'+
                        '<div class="col-lg-8 col-lg-offset-2">'+
                            '<div class="modal-body">'+

'<img class="img-responsive img-centered" src="img/logos/'+brand_json.logo_path+'" alt="img">'+
                                '<h2>'+brand_json.Name+'</h2>'+
'<p class="item-intro text-muted">Origin: '+brand_json.Origin+'</p >'+
'<p class="item-intro text-muted">Year: '+brand_json.Year+'</p >'+
'<img class="img-responsive img-centered" src="'+brand_json.Picture+'" alt="img">'+
'<p>'+brand_json.About+'</p >'+
'<p class="item-intro text-muted">Website: <a target="_blank" href="'+brand_json.Website+'">'+brand_json.Name+'</a></p >'+
                                '<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close </button>'+
                            '</div></div></div></div></div></div></div>'
                            );
 		  	 }
 		  	 else{
 		  	 	$('#search-result').empty();
 		  	 	$('#search-result').append('<p class="item-intro text-muted">Sorry, no such barnd found.</p>');
 		  	 }

				//brands.append(grid);
				
			}	
      });
	});

	$('#search-designer-btn').on('click',function(e) {

	});
});

var load_brand = function(){
	var brands = $('#brands');
	var content = $('#content');
	brands.empty();
	content.empty();
	$.ajax('../server-side/Brand_controller.php/brand',
	      { async: false,
	      	type: "GET",
		    dataType: "json",
		      success: function(brand_ids) {
		      	for (var i=0; i<brand_ids.length; i++) {
			   			load_brand_info(brand_ids[i]);
		      	}
		      	//load_info(1);
		      } 
	      });
};

var load_brand_info=function(id){

	  $.ajax('../server-side/Brand_controller.php/brand/'+id,
  		{async: false,
  		type: "GET",
 		  dataType: "json",
 		  success: function(brand_json) {
				//var b = new Brand(brand_json);
				$('#brands').append('<div class="col-md-4 col-sm-6 portfolio-item">'+
	                    '<a href="#brand'+brand_json.B_id+'" class="portfolio-link" data-toggle="modal">'+
	                    	                       ' <div class="portfolio-hover">'+
	                            '<div class="portfolio-hover-content">'+
	                                '<i class="fa fa-th" aria-hidden="true"></i>'+
	                            '</div>'+
	                        '</div>'+
	                        '<img style="width:400px;height:289px" src="img/logos/'+brand_json.logo_path+'" class="img-responsive" alt="img">'+
	                    '</a>'+ 
	                    '<div class="portfolio-caption">'+
	                       ' <h4>'+brand_json.Name+'</h4>'+
	                       ' <p class="text-muted">'+ brand_json.Origin+'</p>'+
	                   ' </div>'+
	                '</div>'
					);
				$('#content').append(    
					'<div class="portfolio-modal modal fade" id="brand'+brand_json.B_id+'" tabindex="-1" role="dialog" aria-hidden="true">'+
        '<div class="modal-dialog"><div class="modal-content"><div class="close-modal" data-dismiss="modal"><div class="lr"><div class="rl">'+
                       ' </div></div></div>'+
                '<div class="container">'+
                    '<div class="row">'+
                        '<div class="col-lg-8 col-lg-offset-2">'+
                            '<div class="modal-body">'+

'<img class="img-responsive img-centered" src="img/logos/'+brand_json.logo_path+'" alt="img">'+
                                '<h2>'+brand_json.Name+'</h2>'+
'<p class="item-intro text-muted">Origin: '+brand_json.Origin+'</p >'+
'<p class="item-intro text-muted">Year: '+brand_json.Year+'</p >'+
'<img class="img-responsive img-centered" src="'+brand_json.Picture+'" alt="img">'+
'<p>'+brand_json.About+'</p >'+
'<p class="item-intro text-muted">Website: <a target="_blank" href="'+brand_json.Website+'">'+brand_json.Name+'</a></p >'+


                                '<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close </button>'+
                            '</div></div></div></div></div></div></div>'
                            );
				//brands.append(grid);
				
			}	
      });
    };


