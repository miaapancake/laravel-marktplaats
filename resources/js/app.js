import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {

    // Automatically scroll marked divs to bottom
    const scrollDivs = document.querySelectorAll("[data-scroll-to-bottom]");
    scrollDivs.forEach((div) => {
        div.scrollTop = div.scrollHeight;
        document.addEventListener('htmx:afterRequest', () => {
            div.scrollTop = div.scrollHeight;
        });
    });


    // Auto grow textxareas
    document.querySelectorAll("textarea").forEach(function(textarea) {
        textarea.style.height = textarea.scrollHeight + "px";
        textarea.style.overflowY = "hidden";
        textarea.style.resize = "none";

        textarea.addEventListener("input", function() {
            this.style.height = "auto";
            this.style.height = this.scrollHeight + "px";
        });
    });

    const CSRF_TOKEN = document.querySelector("meta[name='_token']").getAttribute('content');

    document.addEventListener('htmx:configRequest', (e) => {
        e.detail.headers['X-CSRF-TOKEN'] = CSRF_TOKEN;
    });


    // Make the chat message box submit on enter
    const messageBox = document.getElementById("message");
    if (messageBox) {

        // Prevent extra newlines on submit
        messageBox.addEventListener("keydown", (e) => {
            if (!e.shiftKey && e.key == "Enter") {
                e.preventDefault();
                return false;
            } else {
                return true;
            }
        });

        // When enter is pressed without shift submit message
        messageBox.addEventListener("keyup", (e) => {
            if (!e.shiftKey && e.key == "Enter") {
                e.preventDefault();
                if (htmx) {
                    htmx.trigger(messageBox.form, "submit");
                } else {
                    messageBox.form.submit();
                }
                return false;
            }
        });
    }

})
