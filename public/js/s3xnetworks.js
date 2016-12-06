// Date pickers for Tours, to date can not be before from date
$(function() {
    $( "#from" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        onClose: function( selectedDate ) {
            $( "#to" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3,
        onClose: function( selectedDate ) {
            $( "#from" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
});

// Delayed Modal Display + Cookie On Click
$(document).ready(function() {
    // If no cookie with our chosen name (e.g. no_thanks)...
    if ($.cookie("s3xnetworks.com") == null) {
        // Show the modal, with delay func.
        $('#myModal').reveal;
        function show_modal() {
            $('#myModal').modal({backdrop: 'static', keyboard: false});
        }
        // Set delay func. time in milliseconds
        window.setTimeout(show_modal, 0);
    }

    // On click of specified class (e.g. 'no_thanks'), trigger cookie, with expiration in end of year 2026
    $(".buttone").click(function() {
        document.cookie = "s3xnetworks.com=true; expires=Sat, 31 Dec 2026 23:59:59 UTC";
    });

    $(".buttonx").click(function() {
        window.location.replace("http://www.google.com");
    });
});

// Search
$(document).ready(function() {
    $('#InputSearchI').keydown(function(event) {
        if (event.keyCode == 13 || event.keyCode == 10) {
            var data = $('#InputSearchI').val();
            data = data.replace(/-/g, '');
            var pubUri = $('#publicUrl').val();
            var pubCity = $('#publicCity').val();
            var pCity = '';
            if (pubCity != '') {
                pCity = '-' + pubCity;
            }
            var pubGen = $('#publicGender').val();
            var pGen = '';
            if (pubGen != '') {
                pGen = '-' + pubGen;
            }

            $('#searchform').submit(function() {
                $.post($(this).attr('action'), $(this).serialize(), function() {
                    window.location = pubUri + '/search/' + data + pCity + pGen;
                });
                return false;
            });
        }
    });
});

// Tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});

// Login popover
$("[data-toggle=popover]").popover({
    html: true,
    content: function() {
        $('#tooltiplogin').tooltip('hide');
        return $('#popupBottom').html();
    }
});

// Private area index packages accordion
$(document).ready(function() {
    $('div.dropdown').each(function() {
        var $dropdown = $(this);

        $("div.dropdown-link", $dropdown).click(function(e) {
            e.preventDefault();
            $div = $("div.dropdown-container", $dropdown);
            $div.toggle();
            $("div.dropdown-container").not($div).hide();
            return false;
        });
    });

    $('html').click(function(){
        $("div.dropdown-container").hide();
    });
});

// Select working city on working country selection
$("#working_country").change(function(e) {
    e.preventDefault();
    var value = $(this).val();
    var i;

    $.ajax({
        type: 'POST',
        contentType: "application/json",
        url: '/private/changecity/',
        data: JSON.stringify(value),
        beforeSend: function() {
            $('#working_city').html("<option id='ajax_loader'>loading ...</option>");
            $('#ajax_loader').addClass('loadinggif');
        },
        success: function(response) {
            //$('#working_city option').not(":first").remove();
            $('#working_city option').remove();
            $('#working_city_sel option').remove();

            parsed = $.parseJSON(response);

            for (i in parsed) {
                if (parsed.hasOwnProperty(i)) {
                    $('#working_city')
                        .append($('<option></option>')
                            .attr('value',parsed[i][0])
                            .text(parsed[i][0]));
                }
            }
        }
    });
});

// create visual MLM tree
var pretty = function() {
    var self = $(this), children = self.children(".containerMlm"), width = (100/children.length) - 2;
    children.css("width", width + "%").each(pretty);
};
function loadMLM (parentId, data, val) {
    for (var i = 0; i < data.length; i++) {
        var member = data[i];
        if (member.memberId === val) { member.parentId = null; }
        if (member.parentId === parentId) {
            var parent = parentId ? $("#containerFor" + parentId) : $("#mainContainer"),
                memberId = member.memberId,
                metaInfo = member.name + " ($" + member.amount + ")";
            parent.append("<div class='containerMlm' id='containerFor" + memberId + "'><div class='member'>" + memberId +
            "<div class='metaInfo'>" + metaInfo + "</div></div></div>");
            loadMLM (memberId, data);
        }
    }
    $("#mainContainer").each(pretty);
};

// get and load MLM schema
$(document).ready(function() {
    var value = $('#userId').val();

    $.ajax({
        type: 'POST',
        contentType: "application/json",
        url: '/private/loadMlm/',
        data: JSON.stringify(value),
        /*beforeSend: function() {
            $('#working_city').html("<option id='ajax_loader'>loading ...</option>");
            $('#ajax_loader').addClass('loadinggif');
        },*/
        success: function(response) {
            parsed = $.parseJSON(response);
            loadMLM(null, parsed, value);
        }
    });
});

// Fill working city from cities add/edit/tours
$(document).on('dblclick', '#working_city option', function(e) {
    e.preventDefault();
    if ($('#hidden_sel').val() == 1) {
        if ($('#working_city_sel').children('option').length <= 3) {
            return !$('#working_city option:selected').appendTo('#working_city_sel');
        }
        else {
            $.msgBox({
                title:"MAX Cities selected",
                content:"You can select only 4 cities. If you want to change your selection, please remove some cities to add new one to the selection.",
                type:"info"
            });
        }
    }
    else if ($('#hidden_sel').val() == 2) {
        if ($('#working_city_sel1').children('option').length < 1) {
            return !$('#working_city option:selected').appendTo('#working_city_sel1');
        }
        else {
            $.msgBox({
                title:"MAX Cities selected",
                content:"You can select only 1 city. If you want to change your selection, please remove city to add new one to the selection.",
                type:"info"
            });
        }
    }
});

// Remove cities add/edit
$(document).on('dblclick', '#working_city_sel option', function(e) {
    e.preventDefault();
    return !$('#working_city_sel option:selected').appendTo('#working_city');
});

// Remove cities tours
$(document).on('dblclick', '#working_city_sel1 option', function(e) {
    e.preventDefault();
    return !$('#working_city_sel1 option:selected').appendTo('#working_city');
});

// Select all added cities to process
var selectCities = function() {
    for (var i = 0; i < $('#working_city_sel').children('option').length; i++) {
        $('#working_city_sel').children('option')[i].selected = true;
    }
}

// Validate forms
$(function() {
    $('#outside_form').validetta({
        realTime : true
    });
});

// Calculate how many to pay for coins
$(document).ready(function() {
    $('#packages').change(function(e) {
        e.preventDefault();
        var val1 = $(this).val();
        if (val1 == 15) {
            $('#price_coins').val('50 EUR');
        }
        else if (val1 == 16) {
            $('#price_coins').val('100 EUR');
        }
        else {
            $('#price_coins').val('');
        }
    });
});

// Calculate price for packages
$(document).ready(function() {
    var clicked = $(":radio[name='payment']");
    var len = clicked.length;
    for (var i = 0; i < len; i++)
    {
        clicked[i].onclick = function () {
            var n = this.value;
            if (n == 1) {
                $("#packagesd").prop('disabled', false);
                $('#packagesg').prop('disabled', true);
                $('#packagess').prop('disabled', true);
                $('#packagesf').prop('disabled', true);
                $('#packagesg').val('0');
                $('#price_packg').val('');
                $('#packagess').val('0');
                $('#price_packs').val('');
                $('#packagesf').val('0');
                $('#price_packf').val('');
                $('#priceg').val('');
                $('#prices').val('');
                $('#pricef').val('');
                $("#packagesd").change(function(e) {
                    e.preventDefault();
                    var $d = $("select[name='packagesd']");
                    var f = $d.val();
                    if (f == 15) {
                        $('#price_packd').val('150 EUR');
                        $('#priced').val('150');
                    }
                    else if (f == 30) {
                        $('#price_packd').val('200 EUR');
                        $('#priced').val('200');
                    }
                    else {
                        $('#price_packd').val('');
                        $('#priced').val('');
                    }
                });
            }
            else if (n == 4) {
                $("#packagesd").prop('disabled', true);
                $('#packagesg').prop('disabled', false);
                $('#packagess').prop('disabled', true);
                $('#packagesf').prop('disabled', true);
                $('#packagesd').val('0');
                $('#price_packd').val('');
                $('#packagess').val('0');
                $('#price_packs').val('');
                $('#packagesf').val('0');
                $('#price_packf').val('');
                $('#priced').val('');
                $('#prices').val('');
                $('#pricef').val('');
                $("#packagesg").change(function(e) {
                    e.preventDefault();
                    var $d = $("select[name='packagesg']");
                    var f = $d.val();
                    if (f == 15) {
                        $('#price_packg').val('130 EUR');
                        $('#priceg').val('130');
                    }
                    else if (f == 30) {
                        $('#price_packg').val('170 EUR');
                        $('#priceg').val('170');
                    }
                    else {
                        $('#price_packg').val('');
                        $('#priceg').val('');
                    }
                });
            }
            else if (n == 7) {
                $("#packagesd").prop('disabled', true);
                $('#packagesg').prop('disabled', true);
                $('#packagess').prop('disabled', false);
                $('#packagesf').prop('disabled', true);
                $('#packagesd').val('0');
                $('#price_packd').val('');
                $('#packagesg').val('0');
                $('#price_packg').val('');
                $('#packagesf').val('0');
                $('#price_packf').val('');
                $('#priced').val('');
                $('#priceg').val('');
                $('#pricef').val('');
                $("#packagess").change(function(e) {
                    e.preventDefault();
                    var $d = $("select[name='packagess']");
                    var f = $d.val();
                    if (f == 15) {
                        $('#price_packs').val('110 EUR');
                        $('#prices').val('110');
                    }
                    else if (f == 30) {
                        $('#price_packs').val('140 EUR');
                        $('#prices').val('140');
                    }
                    else {
                        $('#price_packs').val('');
                        $('#prices').val('');
                    }
                });
            }
            else if (n == 21) {
                $("#packagesd").prop('disabled', true);
                $('#packagesg').prop('disabled', true);
                $('#packagess').prop('disabled', true);
                $('#packagesf').prop('disabled', false);
                $('#packagesd').val('0');
                $('#price_packd').val('');
                $('#packagesg').val('0');
                $('#price_packg').val('');
                $('#packagess').val('0');
                $('#price_packs').val('');
                $('#priced').val('');
                $('#priceg').val('');
                $('#prices').val('');
                $("#packagesf").change(function(e) {
                    e.preventDefault();
                    var $d = $("select[name='packagesf']");
                    var f = $d.val();
                    if (f == 7) {
                        $('#price_packf').val('FREE (0 EUR)');
                        $('#pricef').val('0');
                    }
                    else {
                        $('#price_packf').val('');
                        $('#pricef').val('');
                    }
                });
            }
            else {
                $("#packagesd").prop('disabled', true);
                $('#packagesg').prop('disabled', true);
                $('#packagess').prop('disabled', true);
                $('#packagesf').prop('disabled', true);
                $('#packagesd').val('0');
                $('#price_packd').val('');
                $('#packagesg').val('0');
                $('#price_packg').val('');
                $('#packagess').val('0');
                $('#price_packs').val('');
                $('#packagesf').val('0');
                $('#price_packf').val('');
                $('#priced').val('');
                $('#priceg').val('');
                $('#prices').val('');
                $('#pricef').val('');
            }
        };
    }
});

// Calculate price for VIP
$(document).ready(function() {
    $("select[name='adverts'], :text[name='vipDays']").bind("change keyup", function(e) {
        e.preventDefault();
        var $r = $(":text[name='vipDays']");
        var $l = $("select[name='adverts']");
        if($r.length == 1) {
            var t = $r.val();
            var g = $l.val();
            if (g > 0) {
                f = 5;
                $('#price_vip').val((t * f) + ' s3xcoins (' + (t * f) + ' EUR)');
            }
            else {
                $('#price_vip').val('');
            }
        }
    });
});

// Gallery settings
$(document).ready(function() {
    var owl = $("#owl-demo");

    owl.owlCarousel({
        slideSpeed : 2000,
        paginationSpeed : 400,
        singleItem: true,
        autoHeight : true
    });

    // Custom Navigation Events
    $(".next").click(function(){
        owl.trigger('owl.next');
    })
    $(".prev").click(function(){
        owl.trigger('owl.prev');
    })
});

// Open modal for comment
$('#commentModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipientId = button.data('id'); // Extract info from data-* attributes
    var recipientName = button.data('name');
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    modal.find('.id_input').val(recipientId);
    modal.find('.name_input').val(recipientName);
})

// show/hide comments
var trs = $('#show-comments-body .div1');
var btnMore = $('#seeMoreRecords');
var btnLess = $('#seeLessRecords');
var trsLength = trs.length;
var currentIndex = 5;

trs.hide();
trs.slice(0, 5).show();
checkButton();

btnMore.click(function (e) {
    e.preventDefault();
    trs.slice(currentIndex, currentIndex + 5).show();
    currentIndex += 5;
    checkButton();
});

btnLess.click(function (e) {
    e.preventDefault();
    trs.slice(currentIndex - 5, currentIndex).hide();
    currentIndex -= 5;
    checkButton();
});

function checkButton() {
    var currentLength = $('#show-comments-body .div1:visible').length;

    if (currentLength >= trsLength) {
        btnMore.hide();
    }
    else {
        btnMore.show();
    }
    if (trsLength > 5 && currentLength > 5) {
        btnLess.show();
    }
    else {
        btnLess.hide();
    }
}

$(document).ready(function() {
    $('#paybutton').click(function (event) {
        var sig = $('#paybutton').data('id');
        var data = $('#paybutton').data('name');
        liqPayCheckoutCallback(data, sig);
    });
});

liqPayCheckoutCallback = function(dataset, sig) {
    LiqPayCheckout.init({
        data: dataset,
        signature: sig,
        embedTo: "#liqpay_checkout",
        mode: "popup" // embed || popup
    }).on("liqpay.callback", function(data){
        window.location = '/private/result';
        //console.log(data.status);
        //console.log(data);
    }).on("liqpay.ready", function(data){
        // ready
    }).on("liqpay.close", function(data){
        // close
    });
};

// function for counter, need to tweak it
/*var getCountDown = function(end_date)
{
    var ad_id = $('#ad_id').val();
    var remaining_time = $('#remaining_pack').val();
    var divID = '#getting-started'+ad_id;
    $('#getting-started').countdown(end_date, function(event)
    {
        $(this).text(
            event.strftime('%D days %H:%M:%S')
        );
    });
}*/