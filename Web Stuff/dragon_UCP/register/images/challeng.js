
var RecaptchaState = {
    site : '6LeL1wUAAAAAAJ6M4Rd6GzH86I_9_snNaLPqy_ff',
    challenge : '03AHJ_VusuLWmuOhaRqzCjrabJBXK4R-ZJ945W4GVP8f5XujGxIBd2jqWpnBJ9XIS35uveEX4r6nfjz_RNLm7RBIpm2AjHhc6fJQMIaj-jG_VHmIv4JTOkneAT-aXgKt6tkqwshRG4YKl8kZztIUyT9P9WETCZ9wzRzA',
    is_incorrect : false,
    programming_error : '',
    error_message : '',
    server : 'http://www.google.com/recaptcha/api/',
    timeout : 18000
};

document.write('<scr'+'ipt type="text/javascript" s'+'rc="' + RecaptchaState.server + 'js/recaptcha.js"></scr'+'ipt>');
