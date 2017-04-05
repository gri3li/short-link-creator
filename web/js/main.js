$(function() {

    var $picker = $('#picker');
    var $ttl = $('#ttl');
    var $ttlInput = $('#ttl-input');
    var $pickerWrap = $('#picker-wrap');

    $ttl.change(function(){
        $pickerWrap.toggle();
        return false;
    });

    $picker.datetimepicker({
        defaultDate: moment().add(1, 'days'),
        minDate: moment(),
        inline: true,
        sideBySide: true
    });

    $picker.on('dp.change',function () {
        $ttlInput.val($picker.data('DateTimePicker').date().unix());
    });
    $picker.trigger('dp.change');

});