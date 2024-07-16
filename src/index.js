const background_main = document.querySelector('.background_main');
const message_section = document.querySelector('.message_section');
const submit_button = document.querySelector('#submit_button');
const form = document.querySelector('.create_message_form');
const textarea = document.querySelector('#create_message_textarea');


let area_status = 0
let activeTextarea

let chargerment_message_auto = 0;
chargerment_message_auto = clearInterval(chargerment_message_auto)

document.addEventListener("DOMContentLoaded", function () {
    message_section.scrollTop = message_section.scrollHeight;
    if (screen.width < 1024) {
        textarea.addEventListener("click", () => {
            document.body.addEventListener("click", () => {
                activeTextarea = document.activeElement;
                if (area_status === 1 && activeTextarea != textarea) {
                    form.classList.remove("message_textarea_selected");
                    background_main.classList.remove("background_opac");
                    setTimeout(() => { area_status = 0 }, 99);
                };
            });

            if (!textarea.classList.contains("message_textarea_selected")) {
                form.classList.add("message_textarea_selected");
                background_main.classList.add("background_opac");
                setTimeout(() => { area_status = 1 }, 99);
            };
        });
    }

    let last_message_id = 0;
    chargerment_message_auto = setInterval(AutoUpdateMessage, 1000)

    function AutoUpdateMessage() {
        console.log($('.message_section div:last-child'));
        last_message_id = $('.message_section div:last-child').attr('id')

        console.log(typeof (last_message_id));
        last_message_id = Number(last_message_id)
        console.log(last_message_id);
        if (last_message_id > 0) {
            console.log(typeof (last_message_id) + " => Condition passé");
            $.ajax({
                url: "./load_message.php",
                type: "POST",
                dataType: "html",
                data: { lastid: last_message_id },
                success: function (data) {
                    if (data) {
                        $('.message_section').append(data);
                        message_section.scrollTop = message_section.scrollHeight;
                    }
                },
                error: function (e, xhr, s) {
                    let error = e.responseJSON;
                    if (e.status) {
                        alert("Error: " + e.status)
                    }
                }
            });
        };
    };
});