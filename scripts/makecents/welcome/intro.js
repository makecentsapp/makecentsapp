//extend jquery validation script to allow commas, if we keep trying to use commas
$.validator.methods.range = function (value, element, param) {
    var globalizedValue = value.replace(",", ".");
    return this.optional(element) || (globalizedValue >= param[0] && globalizedValue <= param[1]);
}

$.validator.methods.number = function (value, element) {
    return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:[\s\.,]\d{3})+)(?:[\.,]\d+)?$/.test(value);
}

//function to add commas to long numbers such as the income slider, should be moved to its own JS file at some point
function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

jQuery(function($) {
    //define form name for validation
    var form = $("#welcomeForm");
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
            console.log('inserting error');
            if ( element.is(":radio") ||  element.is(":checkbox"))
            {
                error.appendTo( element.parents('.card-body') );
            }
            else
            { // This is the default behavior
                //error.insertAfter( element );
                error.appendTo( element.parents('.card-body') );
            }
        }
    });

    //start the wizard
    $(formDiv).wizard({
        unidirectional: false,
        transitions: {
            //hardcoded logic branch for goal
            debts: function( state, action ) {
                //locate the goal branch and define a variable so that we can pass to the next step / validate properly
                var branch = state.step.find( "[name=debts]:checked" ).val();
                if ( !branch ) {
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
                return branch;
            }
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
               if (state.isFirstStep == false || state.isLastStep == false) {
                   $('#bottomForward, #bottomBackward').show();
               }


        },
        beforeForward: function( event, state ) {
            //check if the button pressed to advance was a id=skip, otherwise validate according to rules
            if (event['currentTarget']['id'] !== 'skip') {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            }

        },
        afterSelect: function( event, state ) {
            //advance progress bar
            $('#numAnswered').html(state.stepsComplete);
            $('#numTotal').html(state.stepsPossible);
               $('#form-progress').css('width', (state.stepsComplete/state.stepsPossible)*100+'%');
               //reset forward button color
               $('#bottomForward').addClass('btn-primary').removeClass('btn-success');

               //if we are on the last step, hide the buttons so wecan have a custom submit
               if (state.isFirstStep == true || state.isLastStep == true) {
                   $('#bottomForward, #bottomBackward').hide();
               }

               //check if anything in the form has been updated since last afterSelect call
            if (formdata !== $(form).serialize()) {
                formdata = $(form).serialize();
                //if writemode is on, ajax post the data to handler
                if (writeMode == true) {
                    //$('#errorRpt').append("<p class='alert alert-info'>Send: " + formdata + "</p>");
                    $.ajax({
                        data: formdata,
                        type: "post",
                        url: base_url+'Intro/submit',
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
    //initialize the slider
    $("#incomeSlider").slider({
        min: 0,
        max: 100000,
        step: 1000,
        range: "min",
        slide: function(event, ui) {
            //change the next button color if there is any interaction with the slider
            $('#bottomForward').removeClass('btn-primary').addClass('btn-success');
            //run function to add commas to thousands/millions
            //$("#annualIncome").val(addCommas(ui.value));
            $("#annualIncome").attr('value', ui.value).val(ui.value);
        }
    });

    //initialize the clone fields
    $('#debt-clone-fields').cloneya();

    //put the date mask on the DOB field
    $("#dobInput").mask('99/99/9999', {placeholder:'MM/DD/YYYY'});

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
        $('#bottomForward').removeClass('btn-primary').addClass('btn-success');
    });

    //hide the buttons at the beginning so that we can have a custom button
    $('#bottomForward, #bottomBackward').hide();

    //emoji slider for feelings
    //https://codepen.io/Guilh/pen/BxWyRP
    const range = document.querySelector('#feelingRange');
    const mojidiv = document.querySelector('.moji');
    //const mojis = ['😄','🙂','😐','😑','☹️','😩','😠'];
    const mojis = ['💩','😩','☹️','😑','😐','🙂','😄'];

    range.addEventListener('input', (e) => {
      let rangeValue = e.target.value;
      mojidiv.textContent = mojis[rangeValue];
    });
});