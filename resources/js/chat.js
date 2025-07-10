import './bootstrap';

function listenForChatMessages(chatId) {
    console.debug(`Listening for chat messages in chat: ${chatId}`);

    Echo.private(`chats.${chatId}`)
        .listen('ChatMessageSent', (e) => {
            console.log(e);
            htmx.ajax('GET', `/messages/${e.message.id}`, { target: '#messages', swap: 'beforeend' })
        });
}

document.addEventListener("DOMContentLoaded", () => {
    const CHAT_ID = document.querySelector("meta[name='chat_id']").getAttribute('content');
    listenForChatMessages(CHAT_ID);
});
