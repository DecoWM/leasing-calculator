/*jQuery.fn.toggleOption = function( show ) {
    jQuery( this ).toggle( show );
    if( show ) {
        if( jQuery( this ).parent( 'span.toggleOption' ).length )
            jQuery( this ).unwrap( );
    } else {
        if( jQuery( this ).parent( 'span.toggleOption' ).length == 0 )
        {
            var orig = jQuery( this );
            //var clone = jQuery( this ).clone();

            orig.parent().append(orig);
            //orig.remove();
            orig.wrap( '<span class="toggleOption" style="display: none;" />' );
        }
    }
};*/

APPLICATION = {
    common : {
        init : function() {
            //yepnope.injectCss('www/css/ie8.css');

            //agregar evento click para desplegar login form
            
        },  // --> End method: init

        helpPopup: function() {

            $("a#flecha-next").click(function(){
                var i = APPLICATION.common.page;
                $("#img"+i).hide();
                i++;
                $("#img"+i).show();
                console.log(i);
                APPLICATION.common.page = i;

                if(i == 4)
                    $("a#flecha-next").hide();
                else
                    $("a#flecha-prev").show();
            });

            $("a#flecha-prev").click(function(){
                var i = APPLICATION.common.page;
                $("#img"+i).hide();
                i--;
                $("#img"+i).show();
                console.log(i);
                APPLICATION.common.page = i;
                
                if(i == 1)
                    $("a#flecha-prev").hide();
                else
                    $("a#flecha-next").show();
            });

            $("a#flecha-prev").hide();

        },

        page: 1
    },

    home : {
        init : function()
        {
            /** Temp 
            $('#loginfacebook').hide();
            $('#edit-submit-2').click(function(e){
                e.preventDefault();
                var user_name = $('#user_name').val();
                var user_pass = $('#user_pass').val();
                if(user_name == 'laboral' && user_pass == 'laboral')
                    $('#loginfacebook').show();
            });
			Temp **/
            $('#botcomosejuega, #ayuda').click(function(){
                $("#contenedor-imagenes .img-slider").hide();
                $("#img1").show();
                $("#contenedor-slider-ayuda").fadeIn();
            });
             
			
            APPLICATION.common.helpPopup();
            
            $(document).on("click", "#ayuda-cerrar", function(){
                $("#contenedor-slider-ayuda").hide();
            });
        }
    },

    quiz: {
    	init: function()
    	{
			$('#qtimer').html('<span>45</span>');

            APPLICATION.quiz.questionTimer = new AdvancedTimer(460,
                function(){
                    //Complete
                    APPLICATION.quiz.respond(null);
                    setTimeout(function(){
                        window.location = host+'season'
                    }, 3000); 
                }, 
                function(){
                    //Tick
					//convert timer miliseconds to rounded seconds
                    $('#qtimer').html('<span>'+Tools.zerofill(Math.floor(APPLICATION.quiz.questionTimer.count/10))+'</span>');
                    
                }
            )
    	},

    	questionTimer: null,
        questionStatus: 0,

    	respond: function(id_answer)
    	{
			var time = APPLICATION.quiz.questionTimer.forceStop();
            APPLICATION.quiz.questionStatus++;

            if(APPLICATION.quiz.questionStatus == 1)
            {
        		$.ajax({
                    type: "POST",
                    url: host+'quiz/respond',

                    data: {  
                        "id_answer": id_answer,
                        "time" : time,
                    },
                    dataType: "json",
                    timeout: 1000, // in milliseconds
                    success: function(data) {
                        if(!data.hasErrors)
                        {
                            if(data.result == 'correct')
                            {
                            	//correct
    							$('#question-modal-acertado').show();
    							$('#question-modal-acertado').fadeOut(2000, function(){
    								window.location = host+'season';
    							});
                            }
                            else
                            {
                            	$('#question-modal-fallado').show();
    							$('#question-modal-fallado').fadeOut(2000, function(){
    								window.location = host+'season';
    							});
                            }
                        }
                        else
                        {
                        	window.location = host+'season';
                        }
                    },
                    error: function(request, status, err) {
                        if(status == "timeout") 

                        {
                            console.log(err);
                            window.location = host+'season';
                        }
                    }
                });
            }
    	}
    },
	season: {
		init: function()
    	{
			//help
			$('#ayuda').click(function(){
                $("#contenedor-imagenes .img-slider").hide();
                $("#img1").show();
                $("#contenedor-slider-ayuda").fadeIn();
            });
            /** Temp **/

            APPLICATION.common.helpPopup();

            $(document).on("click", "#ayuda-cerrar", function(){
                $("#contenedor-slider-ayuda").hide();
            });
		}
	
	},
	
    forecast: {
    	init: function()
    	{
			//help
			$('#ayuda').click(function(){
                $("#contenedor-imagenes .img-slider").hide();
                $("#img1").show();
                $("#contenedor-slider-ayuda").fadeIn();
            });
            /** Temp **/

            APPLICATION.common.helpPopup();

            $(document).on("click", "#ayuda-cerrar", function(){
                $("#contenedor-slider-ayuda").hide();
            });
		
            /*APPLICATION.forecast.teams = {
                'semifinals': g_semifinals,
                'finals': g_finals
            }

            APPLICATION.forecast.regenerateOptions(false);
            APPLICATION.forecast.bindMechanism();*/

            $('#teams-title').click(function(){
                $('#players-list').hide();
                $('#teams-list').show();
                $('#players-title').removeClass('selected');
                $(this).addClass('selected');
            });

            $('#players-title').click(function(){
                $('#teams-list').hide();
                $('#players-list').show();
                $('#teams-title').removeClass('selected');
                $(this).addClass('selected');
            });

            //validando combos
            $("#forecast-submit.enabled").click(function(){
                //comparar semifinal
                var error = new  Array();
                var semifinal_equipo = pronostico("semifinal","semifinal")
                error[0] = compare(semifinal_equipo,"No puedes repetir los equipos de la semifinal","Debes seleccionar todos los equipos de la semifinal")

                //comparar final
                var final_equipo = pronostico("final","final")
                error[1] = compare(final_equipo,"No puedes repetir los equipos de la final","Debes seleccionar todos los equipos de la final")
                
                //comparar mvp
                var mvp = pronostico("mvp","final")
                error[2] = compare(mvp,"No puedes repetir los jugadores MVP","Debes seleccionar los jugadores MVP")

                //comparar max_scorer
                var max_scorer = pronostico("max_scorer","final")
                error[3] = compare(max_scorer,"No puedes repetir los máximos anotadores","Debes seleccionar los máximos Anotadores")

                //comparar max_rebounder
                var max_rebounder = pronostico("max_rebounder","final")
                error[4] = compare(max_rebounder,"No puedes repetir los máximos reboteadores","Debes seleccionar los máximos reboteadores")

                //comparar max_asistant
                var max_asistant = pronostico("max_asistant","final")
                error[5] = compare(max_asistant,"No debes repetir los máximos asistentes","Debes seleccionar los máximos asistentes")


                //valid value group final
                team_1 = $("#final_1").val()
				team_2 = $("#final_2").val()
                state1 = 0
                state2 = 0
				
				for(h=0;h < semifinal_equipo.length;h++){
					state1 += (team_1==semifinal_equipo[h]) ? 1:0
                    state2 += (team_2==semifinal_equipo[h]) ? 1:0
				}
                var valid_final = state1 + state2
                if(valid_final!=2){
                    error[6] = "Los  Equipos finalistas deben estar entre los semifinalistas"
                }else{
                    error[6] = ""
                }
	
                //valid value champeon
                var champeon = $("#champeon").val()
                if(champeon==""){
                    //alert("seleccionar champeon")
                    error[7] = "No has seleccionado al equipo campeón"
                }else if(champeon!=team_1 && champeon!=team_2){
                    error[7] = "El Equipo campeón debe ser uno de los finalistas"
                }


                var cadena_error = ""
                var cadena_status = ""
                for(g=0;g < error.length;g++){
                    cadena_error += "<div class='mensaje_error'>" + error[g] + "</div>"
                    cadena_status += error[g]
                }

                if(cadena_status!=""){
                    reset();
                    alertify.alert(cadena_error);
                }else{
					var cadena_ok = "<div class='mensaje_error'>Tus datos se han guardado correctamente. Recuerda que dispones hasta el jueves 6 de febrero a las 14:00 h para realizar los cambios que desees</div>";
					alertify.alert(cadena_ok, function (e) {
						if (e) {
							// user clicked "ok"
							$("#forecast-form").submit();
						} 
					});
					
                    
                }

            });

            $("#forecast option").each(function(key, elem){
                if($(elem).attr('data-class'))
                    $(elem).parent().addClass($(elem).attr('data-class'));
            });
    	},

        teams: {
            'semifinals': {},
            'finals': {}
        },

        regenerateOptions: function(hard) 
        {
            var semifinals = APPLICATION.forecast.teams.semifinals;
            var finals = APPLICATION.forecast.teams.finals;

            if(hard)
            {
                $('#forecast-form select.active option.team-option').each(function(key, oelem){
                    $(oelem).toggleOption(true);
                });
            }
            
            $('#semifinal-teams select').each(function(key, elem){
                for(var sid in semifinals)
                {
                    if($(elem).attr('id') != sid)
                    {                       
                        $(elem).find('option.team-option').each(function(okey, oelem){
                            if($(oelem).val() == semifinals[sid])
                                $(oelem).toggleOption(false);
                        });
                    }
                }
            });

            $('#final-teams select').each(function(key, elem){
                $(elem).find('option.team-option').each(function(okey, oelem){
                    $(oelem).toggleOption(false);
                    for(var sid in semifinals)
                    {
                        if($(oelem).val() == semifinals[sid])
                            $(oelem).toggleOption(true);
                    }
                });
            });

            $('#final-teams select').each(function(key, elem){
                for(var fid in finals)
                {
                    if($(elem).attr('id') != fid)
                    {                       
                        $(elem).find('option.team-option').each(function(okey, oelem){
                            if($(oelem).val() == finals[fid])
                                $(oelem).toggleOption(false);
                        });
                    }
                }
            });

            $('#champeon-team select option.team-option').each(function(key, oelem){
                $(oelem).toggleOption(false);
                for(var fid in finals)
                {
                    if($(oelem).val() == finals[fid])
                        $(oelem).toggleOption(true);
                }
            });
        },

        bindMechanism: function()
        {
            $("#semifinal-teams select").change(function(){ console.log($(this).attr('id'));
                console.log($(this).val());
                APPLICATION.forecast.teams.semifinals[$(this).attr('id')] = $(this).val();
                
                var semi1 = $('#semifinal-teams select.team-1').val();
                var semi2 = $('#semifinal-teams select.team-2').val();
                var semi3 = $('#semifinal-teams select.team-3').val();
                var semi4 = $('#semifinal-teams select.team-4').val();
                
                if(semi1 != '' && semi2 != '' && semi3 != '' && semi4 != '')
                {
                    $('#final-teams select').removeAttr('disabled');
                }  
                else
                {
                    $('#final-teams select').attr('disabled', 'disabled');
                    $('#champeon-team select').attr('disabled', 'disabled');
                }     

                APPLICATION.forecast.regenerateOptions(true);
            });

            $("#final-teams select").change(function(){
                APPLICATION.forecast.teams.finals[$(this).attr('id')] = $(this).val();

                var final1 = $('#final-teams select.team-1').val();
                var final2 = $('#final-teams select.team-2').val();
                
                if(final1 != '' && final2 != '')
                {
                    $('#champeon-team select').removeAttr('disabled');
                }   
                else
                {
                    $('#champeon-team select').attr('disabled', 'disabled');
                }     

                APPLICATION.forecast.regenerateOptions(true);
            });
        }
    }
};

//Ejecutador de metodos segun vista
UTIL = {
    exec: function(controller, action) {
        var ns = APPLICATION,
            action = (action === undefined) ? "init" : action;

        if (controller !== "" && ns[controller] && typeof ns[controller][action] === "function") {
            ns[controller][action]();
        }
    },

    init: function() {
        var body       = document.body,
            controller = body.getAttribute("data-controller"),
            action     = body.getAttribute("data-action");

        UTIL.exec("common");
        UTIL.exec(controller);
        UTIL.exec(controller, action);
    }
};

$(document).on('ready', UTIL.init);