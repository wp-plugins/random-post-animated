
jQuery(document).ready(function($){
	
	var debug = false;
	
	$.each($('.h5ab-random-post'), function(index, value) {
            
		   var id = $(this).attr('id'),
		          slidertimer = $(this).attr('data-timer'),
				  rand =  $(this).attr('data-rand'),
				  restart = false,
				  functions = {};

                  $('#' + id + " li").hide();
				  
				  //Adapted from: http://cssglobe.com/simple-way-to-random-display-or-rotate-content-using/
				  functions['startSlider_' + rand]  = function() {
							var len = $('#' + id + "> li ").length,
									randomNum = function() {
											var number = Math.floor(Math.random()*len) + 1;
											return number;
									},
									showItem = function() {
										var item = randomNum();
						
										if(debug) console.log($('#' + id));
										if(debug)   console.log(item);
										if(debug)   console.log("Restart:  " + restart);

										
										$('#' + id + " li").fadeOut(1000);
                                        setTimeout(function(){
										  $("#" + id + " li:nth-child(" + item + ")").fadeIn(1000);
                                        },1100);
									};
									
									functions['postslider_' + rand] = setInterval(function() { 
																						     showItem(); 
																							 }, slidertimer * 1000 );
									
								  if(!restart) {
										showItem();
												functions['postslider_' + rand];
								   } else {
										functions['postslider_' + rand];														 
								  }
				  }
				  
				 functions['startSlider_' + rand]();
				  
				  $('#' + id).hover(
					  function() {
						if(debug) console.log("Clearing set interval for #" + id);
						clearInterval(functions['postslider_' + rand]);
					  }, function() {
						if(debug) console.log("Restarting for #" + id);
						restart = true;
						functions['startSlider_' + rand]();
						restart = false;
					  }
				);			 				 
	});
 
});
