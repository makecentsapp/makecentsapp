

//extend jquery validation script to allow commas, if we keep trying to use commas
$.validator.methods.range = function (value, element, param) {
    var globalizedValue = value.replace(",", ".");
    return this.optional(element) || (globalizedValue >= param[0] && globalizedValue <= param[1]);
}
 
$.validator.methods.number = function (value, element) {
    return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:[\s\.,]\d{3})+)(?:[\.,]\d+)?$/.test(value);
}

jQuery(function($) {
    //define form name for validation
    var form = $("#mainForm");
    var formDiv = ("#main");

    var writeMode = true;
    var formdata = '';

    //to make the form a little more pretty, it is hidden by default and below shows it again on page load
    $(formDiv).show();

    //add in the progress bar to the top of the form container
    $(form).prepend('<div class="progress" style="height: 3px;"><div id="form-progress" class="progress-bar bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div></div>');
    $('#form-progress').css('width', '0%');


    //jquery validate has to be attached to a form tag, not a div
    $(form).validate({
        errorClass: "state-error text-center m-t-10",
        validClass: "state-success",
        errorElement: "p",
        onkeyup: false,
        onclick: false,
        rules: {
            name: {
                required: true
            },
            debts: {
                required: true
            },
            annualIncome: {
                required: true,
                pattern: /^[0-9,]+$/,
                minlength: 4
            }
        },
        messages: {
            name: {
                required: 'YO GIRL WHATS YA NAME?'
            },
            debts: {
                required: 'Please indicate if you have any debts'
            },
            annualIncome: {
                minlength: 'You make $0 a year?'
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).closest('.field').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.field').removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function(error, element) 
        {
            if (element.is(":radio") ||  element.is(":checkbox")) {
                error.appendTo( element.parents('.card-body') );
            }
            else { 
                // This is the default behavior 
                //error.insertAfter( element );
                error.appendTo( element.parents('.card-body') );
            }
        }
    });

    //step counter to allow user to pick up where they left off, with a little bit of null handling so JS doesnt get pissy
    
    
    //console.log(lastStepCompleted);
    //start the wizard
    $(formDiv).wizard({
        stepClasses: {
            current: "current",
            exclude: "exclude",
            stop: "stop",
            submit: "submit",
            unidirectional: "unidirectional"
        },
        transitions: {
            //hardcoded logic branch for goal
            children: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=children]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
                return branch;
            },
            childrenYes: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=childrenYes]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
                return branch;
            },
            debts: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=debts]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
                return branch;
            },
            housing: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=housing]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
                return branch;
            },
            retirementMatch: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=retirementMatch]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    if( form.valid() == true ){
                        var branch = 'retirementMatch';
                    }
                }
                return branch;
            },
            upcomingExpense: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=upcomingExpense]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    if( form.valid() == true ){
                        var branch = 'upcomingExpense';
                    }
                }
                return branch;
            },
            foodExpense: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=foodExpense]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    if( form.valid() == true ){
                        var branch = 'foodExpense';
                    }
                }
                return branch;
            },
            car: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=car]:checked" ).attr('data-goto');
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    if( form.valid() == true ){
                        var branch = 'car';
                    }
                }
                return branch;
            },
        },
        beforeSelect: function( event, state ) {
            //logic for use of enter key to move to next step
               $(document).keyup(function (e) {
                   if (e.keyCode == 13) {
                       //the two little bits at the end are to stop trigger from firing twice, ala stackoverflow
                    $('#bottomForward').trigger('click').stopPropagation().preventDefault();
                    return false;
                }
            });
            //check if we are on the last step, if so change some elements up to show a the big finale
               if (state.isLastStep == false) {
                   $('#bottomForward, #bottomBackward').show();
               }
               
        },
        beforeForward: function( event, state ) {
            //console.log(state);
            //check if the button pressed to advance was a id=skip, otherwise validate according to rules
            if (typeof(event['currentTarget']) != "undefined" && event['currentTarget'] !== null) {
                if (event['currentTarget']['id'] !== 'skip') {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
            }

        },
        afterSelect: function( event, state ) {
            //advance progress bar
            $('#numAnswered').html(state.stepsComplete);
            $('#numTotal').html(state.stepsPossible);
               $('#form-progress').css('width', (state.percentComplete)+'%');
               //reset forward button color
               $('#bottomForward').addClass('btn-primary').removeClass('btn-success');

               //get name from current step and set hidden form field value, for the pickup function
               $('#mainCurrentStep').val(state.step.find("input").attr("name"));

               //if we are on the last step, hide the buttons so wecan have a custom submit
               if (state.isLastStep == true) {
                   $('#bottomForward, #bottomBackward').hide();
               }
               if (state.isLastStep == true) {
                   nextMsg();
               }

               //testing wizard history
               //console.log(state);

               //check if anything in the form has been updated since last afterSelect call
            if (formdata !== $(form).serialize()) {
                formdata = $(form).serialize();
                //if writemode is on, ajax post the data to handler
                if (writeMode == true) {
                    //$('#errorRpt').append("<p class='alert alert-info'>Send: " + formdata + "</p>");
                    $.ajax({
                        data: formdata,
                        type: "post",
                        url: base_url+'Account/submit',
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            $('#errorRpt').append("<p class='alert alert-danger'>Status: " + textStatus + "</p>");
                            $('#errorRpt').append("<p class='alert alert-danger'>Error: " + XMLHttpRequest.responseText + "</p>");
                        },
                        success: function(data){
                            //$('#errorRpt').append("<p class='alert alert-success'>Return: " + JSON.stringify(data) + "</p>");
                        }
                    });
                }
            }

        }
    });
    //hide the buttons at the beginning so that we can have a custom button on opening step
    if (lastStepCompleted.length !== 0) {
        $('#bottomForward, #bottomBackward').hide();
    }

    //setup the showHide for the country selector as well as disable fields which are not displayed
    $('.smartfm-ctrl').change(function(){
        $('.hiddenbox').hide();
        $('.hiddenbox :input').attr('disabled','disabled');
        $('#' + $(this).val()).show();
        $('#' + $(this).val() + " :input").removeAttr('disabled');
    });

    //set the textbox attached to the slider, value equal to default slider value
    $("#annualIncome").val($("#incomeSlider").slider("value"));
    $("#annualIncome").blur(function() {
        $("#incomeSlider").slider("value", $(this).val());
    });

    //change the button color once there is some amount of form interaction, look to the afterselect function for the revert counterpart
    $('input').on('input', function() {
        //for radio questions (which includes boolean), when the user clicks on an option, just go to the next step by clicking the forward button for them
        if ($(this).attr('type') == 'radio') {
            $('#bottomForward').trigger('click');
            return false;
        }
        
        
        $('#bottomForward').removeClass('btn-primary').addClass('btn-success'); 
    });

    //routine for the final step to cycle through some messages
    function nextMsg() {
        // list of messages to display
        
        if (msgs.length == 0) {
            // once there is no more message, show final submit button
            $('#msg').hide();
            $('#finalmsg').show();
        } 
        else {
            // change content of msg, fade in, wait, fade out and continue with next msg
            $('#msg').html(msgs.pop()).fadeIn(500).delay(1000).fadeOut(500, nextMsg);
        }
    };
    //messages to show on final step, must be outside of the function
    var msgs = [
        "Calculating dollars",
        "Running debt models",
        "Predicting retirement hobbies",
    ].reverse();

    //find the field that we left off on, pulled in from DB in variable $lastStepCompleted
    //if statement checks if something was stored in the DB
    
    if (lastStepCompleted.length !== 0) {
        var select = $(formDiv).wizard("form").find("[name="+lastStepCompleted+"]").closest(".step");
        //if nothing was found to match on the name field in the input, then look for it under an ID since I used them somewhat interchanably depending on how the input needed to be created. This is particularly relevant on anything that submits as an array, for example clone or checkbox inputs.
        if (select.length == 0) {
            select = $(formDiv).wizard("form").find("[id="+lastStepCompleted+"]").closest(".step");
        }
    }
    //fire when user clicks the button
    $('#pickup').click( function(){
        //old way -
            //find how many steps it takes to get back to where they were
            //selectStepCount = $(formDiv).wizard("stepIndex", select);
            //step foward the number of steps, subtracting one to get exactly where they left off
            /*console.log(selectStepCount);
            $(formDiv).wizard("forward", selectStepCount-1);*/
        $(formDiv).wizard("select", select);            
    });
    
});