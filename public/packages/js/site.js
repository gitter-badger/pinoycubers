function check_condition() {
    var condition = $('input[name="condition"]:checked').val()

    if(condition == 'brandnew')
        $('#detail-container').collapse('hide')
    else if(condition == 'used')
        $('#detail-container').collapse('show')
}

function check_shipping() {
    var shipping = $('#shipping').val()

    if(shipping == '1')
        $('#shipping-detail-container').collapse('show')
    else if(shipping == '0')
        $('#shipping-detail-container').collapse('hide')
}

function check_meetups() {
    var meetup = $('#meetups').val()

    if(meetup == '1')
        $('#meetup-detail-container').collapse('show')
    else if(meetup == '0')
        $('#meetup-detail-container').collapse('hide')
}

function type_change() {
    var type = $('#types').val()

    if(type == 'other')
        $('#type-container').collapse('show')
    else
        $('#type-container').collapse('hide')
}

function manufacturer_change() {
    var manufacturer = $('#manufacturers').val()

    if(manufacturer == 'other')
        $('#manufacturer-container').collapse('show')
    else
        $('#manufacturer-container').collapse('hide')
}

$(document).ready(function() {
    /* Initialize collapsibles */
    $('#detail-container').collapse({toggle: false})
    $('#shipping-detail-container').collapse({toggle: false})
    $('#meetup-detail-container').collapse({toggle: false})
    $('#type-container').collapse({toggle: false})
    $('#manufacturer-container').collapse({toggle: false})

    /* Check default values */
    check_condition()
    check_shipping()
    check_meetups()
    type_change()
    manufacturer_change()

    /* Form events */

    $('.condition-radio').click(function() {
        check_condition()
    })

    $('#shipping').change(function() {
        check_shipping()
    })

    $('#meetups').change(function() {
        check_meetups()
    })

    $('#types').change(function() {
        type_change()
    })

    $('#manufacturers').change(function() {
        manufacturer_change()
    })
})