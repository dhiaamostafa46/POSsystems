

$(document).ready(function () {
    $('.table-responsive td:contains("development")').css({
        "white-space": "break-spaces"
    });
    $('.nav-item a').each(function () {
        var href = $(this).attr('href') && $(this).attr('href') !== "#" ? $(this).attr('href').toLowerCase() : "";
        if (href && location.href.toLowerCase().indexOf(href) > -1) {
            $(this).parent('li').addClass('menu-selected').closest('.dropdown-menu').siblings('.nav-link').parent('li').addClass('menu-selected');
        }
    });
    $('#video-banner').css('max-height', window.innerHeight -20);

    $('.left-panel-nav .plus-minus').on('click', function () {
        if (!$(this).hasClass('minus')) {
            $(this).addClass('minus');
            $(this).closest('li').next('ul').show(100);
        }
        else {
            $(this).removeClass('minus');
            $(this).closest('li').next('ul').hide(100);
        }
    });
    $(".toggle-accordion").on("click", function () {

        if ($(this).hasClass('active-menu')) {
            $(this).removeClass('active-menu');
            $('.expandall').toggleClass('hide-acco');
            $('.card-body.collapse').removeClass('show');
            $('.card-header').addClass('collapsed');

        }
        else {
            $(this).addClass('active-menu');
            $('.card-body.collapse').addClass('show');
            $('.card-header').removeClass('collapsed');
        }
    });
    leftNavigationAvtive();
});

$(window).scroll(function () {
    if ($(window).scrollTop() > $('#header').outerHeight()*1.8) {
        $('#header').addClass('hover');
    }
    else if ($(window).scrollTop() < $('#header').outerHeight() * 1.8) {
        $('#header').removeClass('hover');
    }
});
const leftNavigationAvtive = () => {
    $('.left-panel-nav').length ?
        $('a[href="' + window.location.href + '"]').parent('li').addClass('active').closest('ul').show().addClass('show').prev('li').find('.plus-minus').addClass('minus') : null;
    $('a[href="' + window.location.href + '"]').parent('li').addClass('active').next('ul').addClass('left-nav-show').closest('ul').show().addClass('show').prev('li').find('.plus-minus').addClass('minus');
}

function SubsOnSuccess(data) {
    console.log(data);
    if (data.Success == true) {
        $('#return').removeClass('hide');
        $("#Subscribediv").hide();
        $('#divStatus').removeClass('alert-warning');
        $("#divStatus").addClass('alert-success w-100');
        $("#divStatus").text(data.Msg);
    }
    else {
        $("#Subscribediv").show();
        $('#return').removeClass('hide');
        $('#divStatus').removeClass('alert-success');
        $("#divStatus").addClass('alert-warning w-100');
        $("#divStatus").text(data.Msg);
        setTimeout(function () {
            $("#return").addClass('hide', {}, 500);
        }, 5000);

    }


}
function SubsOnFailure(data) {
    $("#Subscribediv").show();
    $('#return').removeClass('alert-success');
    $("#divStatus").addClass('alert-warning');
    $("#divStatus").text(data);
}



function expandCollaspe(obj, id) {
    if ($(obj).children('.expandall').is(':visible')) {
        $(obj).children('.expandall').hide();
        $(obj).children('.collapseall').show();
        $(id).find('.collapse').addClass('show');
        $(id).find('h2').children('button').attr('aria-expanded', true);
    }
    else {
        $(obj).children('.collapseall').hide();
        $(obj).children('.expandall').show();
        $(id).find('.collapse').removeClass('show');
        $(id).find('h2').children('button').attr('aria-expanded', false);
    }
}