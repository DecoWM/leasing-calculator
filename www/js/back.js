APPLICATION = {
    common : {
        init : function() {
            //yepnope.injectCss('www/css/ie8.css');

            //agregar evento click para desplegar login form
            
        },  // --> End method: init

    },

    home : {
        init : function()
        {

        }
    },

    player: {
        init: function()
        {
            $('#player-filter').change(function(){
                var team = $(this).val();
                $('#player-list .player').hide();
                $('#player-list .player.'+team).show();
            });

            $('#player-list .player').hide();

            var first_team = $('#player-filter option').first().val();
            $('#player-filter').val(first_team).change();
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