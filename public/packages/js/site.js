$('.condition-radio').click(function() {
    var condition = $('input[name="condition"]:checked').val()

    if(condition == 'brandnew')
        $('#detail-container').collapse('hide')
    else if(condition == 'used')
        $('#detail-container').collapse('show')
})

$('#shipping').change(function() {
    var shipping = $('#shipping').val()

    if(shipping == '1')
        $('#shipping-detail-container').collapse('show')
    else if(shipping == '0')
        $('#shipping-detail-container').collapse('hide')
})

$('#meetups').change(function() {
    var meetup = $('#meetups').val()

    if(meetup == '1')
        $('#meetup-detail-container').collapse('show')
    else if(meetup == '0')
        $('#meetup-detail-container').collapse('hide')
})

$('#types').change(function() {
    var type = $('#types').val()

    if(type == 'other')
        $('#type-container').collapse('show')
    else
        $('#type-container').collapse('hide')
})

$('#manufacturers').change(function() {
    var manufacturer = $('#manufacturers').val()

    if(manufacturer == 'other')
        $('#manufacturer-container').collapse('show')
    else
        $('#manufacturer-container').collapse('hide')
})